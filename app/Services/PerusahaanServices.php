<?php

namespace App\Services;

use App\Models\Cabang;
use App\Models\DataIdentitas;
use App\Models\IdentitasPerusahaan;
use App\Models\InformasiBank;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Helper\base30ToImage;
use Illuminate\Support\Str;
use App\Jobs\UploadIdentitas;
use App\Jobs\UploadKTP;
use App\Jobs\UploadNPWP;
use App\Jobs\UploadSPPKP;
use App\Jobs\UploadTTD;
use Illuminate\Support\Facades\Storage;

class perusahaanServices
{
    protected $validasiServices;
    public function __construct(ValidasiServices $validasiServices)
    {
        $this->validasiServices = $validasiServices;
    }

    public function handleFormPerusahaan(Request $request)
    {
        DB::beginTransaction();
        try {
            set_time_limit(120);

            // Non-aktif old customer
            if ($request->update_id) {
                $decrypt_id = Crypt::decryptString($request->update_id);
                $data = IdentitasPerusahaan::with('data_identitas')->where('nomor_ktp', $decrypt_id)->orWhere('nomor_npwp', $decrypt_id);
                if ($request->opsi == 'pengkinian_data') {
                    $data->update(['status_aktif' => '0']);
                    $oldData = $data->latest()->first();
                } else {
                    $oldData = $data->latest()->first();
                }
            } else {
                $oldData = '';
            }

            // START: Validation
            $validator = $this->validasiServices->validationPerusahaan($request->all());
            if ($validator->fails()) {
                return ['status' => false, 'error' => $validator->errors()->all()];
            }

            $validator = $this->validasiServices->validationInformasiBank($request->all());
            if ($validator->fails()) {
                return ['status' => false, 'error' => $validator->errors()->all()];
            }

            $validator = $this->validasiServices->validationIdentitas($request->all());
            if ($validator->fails()) {
                return ['status' => false, 'error' => $validator->errors()->all()];
            }

            $validator = $this->validasiServices->validationCabang($request->all());
            if ($validator->fails()) {
                return ['status' => false, 'error' => $validator->errors()->all()];
            }
            // END: Validation

            // Automatic create customer code
            $lastest_cust = IdentitasPerusahaan::latest('id')->first();
            $lastSerialNumber = $lastest_cust ? $lastest_cust->kode_customer : '00001';
            $serial_number = (int) substr($lastSerialNumber, 0);
            $number = str_pad($serial_number + 1, 5, "0", STR_PAD_LEFT);
            $kode_cust = $number;

            // Validation NIK, NPWP and Email Faktur
            if ($request->nomor_ktp == '-') {
                return ['status' => false, 'error' => 'Nomor NIK wajib diisi'];
            }

            if ($request->bentuk_usaha == 'badan_usaha') {
                if ($request->nomor_npwp == '-') {
                    return ['status' => false, 'error' => 'Nomor NPWP wajib diisi'];
                }

                if ($request->email_faktur == '-') {
                    return ['status' => false, 'error' => 'Email faktur pajak wajib diisi dengan format yang benar'];
                }
            }

            // START: Store Data
            $data = IdentitasPerusahaan::create(
                [
                    'kode_customer' => $kode_cust,
                    'nama_perusahaan' => strtoupper($request->nama_perusahaan),
                    'nama_group_perusahaan' => strtoupper($request->nama_group_perusahaan),
                    'alamat_lengkap' => strtoupper($request->alamat_lengkap),
                    'alamat_group_lengkap' => strtoupper($request->alamat_group_lengkap),
                    'kota_kabupaten' => strtoupper($request->kota_kabupaten),
                    'alamat_email' => $request->alamat_email_perusahaan,
                    'nomor_handphone' => $request->no_hp,
                    'tahun_berdiri' => $request->tahun_berdiri,
                    'lama_usaha' => $request->lama_usaha,
                    'bidang_usaha' => $request->bidang_usaha,
                    'bidang_usaha_lain' => $request->bidang_usaha == 'lainnya' ? strtoupper($request->bidang_usaha_lain) : null,
                    'status_kepemilikan' => $request->status_kepemilikan,
                    'nama_group' => $request->status_kepemilikan == 'group' ? strtoupper($request->nama_group) : null,
                    'nama_sales' => $request->sales,
                    'status_aktif' => '1',
                    'bentuk_usaha' => $request->bentuk_usaha,
                    'identitas' => $request->bentuk_usaha == 'perseorangan' ? 'ktp' : 'npwp',

                    // Perseorangan
                    'nomor_ktp' => $request->bentuk_usaha == 'perseorangan' ? $request->nomor_ktp : null,
                    'nama_lengkap' => $request->bentuk_usaha == 'perseorangan' ? strtoupper($request->nama_lengkap) : null,
                    'alamat_ktp' => $request->bentuk_usaha == 'perseorangan' ? strtoupper($request->alamat_ktp) : null,

                    // Badan Usaha
                    'nomor_npwp' => $request->bentuk_usaha == 'badan_usaha' ? $request->nomor_npwp : null,
                    'nama_npwp' => $request->bentuk_usaha == 'badan_usaha' ? strtoupper($request->nama_npwp) : null,
                    'badan_usaha' => $request->bentuk_usaha == 'badan_usaha' ? $request->badan_usaha : null,
                    'email_khusus_faktur_pajak' => $request->bentuk_usaha == 'badan_usaha' ? $request->email_faktur : null,
                    'nomor_whatsapp' => $request->bentuk_usaha == 'badan_usaha' ? $request->no_wa : null,
                    'status_pkp' => $request->bentuk_usaha == 'badan_usaha' ? $request->status_pkp : null,
                    'alamat_npwp' => $request->bentuk_usaha == 'badan_usaha' ? strtoupper($request->alamat_npwp) : null,
                    'kota_npwp' => $request->bentuk_usaha == 'badan_usaha' ? strtoupper($request->kota_npwp) : null,
                    'badan_usaha_lain' => $request->bentuk_usaha == 'badan_usaha' ? ($request->badan_usaha == 'lainnya' ? strtoupper($request->badan_usaha_lain) : null) : '',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );

            InformasiBank::updateOrCreate(
                ['identitas_perusahaan_id' => $data->id],
                [
                    'nomor_rekening' => $request->nomor_rekening,
                    'nama_rekening' => strtoupper($request->nama_rekening),
                    'status' => $request->status_rekening,
                    'nama_bank' => strtoupper($request->nama_bank),
                    'rekening_lain' => $request->status_rekening == 'lainnya' ? strtoupper($request->rekening_lain) : null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );

            DataIdentitas::updateOrCreate(
                ['identitas_perusahaan_id' => $data->id],
                [
                    'nama' => strtoupper($request->nama_penanggung_jawab),
                    'jabatan' => strtoupper($request->jabatan),
                    'identitas' => $request->identitas_penanggung_jawab,
                    'no_hp' => $request->nomor_hp_penanggung_jawab,
                    'created_at' => Carbon::now(),

                ]
            );

            if ($request['nitku_cabang'][0] != null) {
                foreach ($request['nitku_cabang'] as $i => $loop_cabang) {
                    Cabang::insert([
                        'identitas_perusahaan_id' => $data->id,
                        'nitku' => $request['nitku_cabang'][$i],
                        'nama' => strtoupper($request['nama_cabang'][$i]),
                        'alamat' => strtoupper($request['alamat_nitku'][$i]),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }
            // END: Store Data

            // START: File storing
            // Perusahaan
            if ($request->bentuk_usaha == 'perseorangan') {
                if ($request->hasFile('foto_ktp')) {
                    $foto = $request->file('foto_ktp');
                    $filename = uniqid() . '-KTP-' . Str::slug($request->nama_lengkap, '-') . '.' . $foto->getClientOriginalExtension();

                    // Temporary store files
                    $tempPath = $foto->storeAs('temp_files', $filename);

                    DB::table('identitas_perusahaan')->where('id', $data->id)->update([
                        'foto_ktp' => $filename
                    ]);
                    UploadKTP::dispatch($filename, ($oldData ? $oldData->foto_ktp : ''), $tempPath);
                } else {
                    $filename = $oldData->foto_ktp;
                }

                if ($request->hasil_ttd) {
                    // Konversi base30 menjadi koordinat asli
                    $JSignatureTools = new base30ToImage;
                    $rawData = $JSignatureTools->base64ToNative($request->hasil_ttd);

                    // Membuat canvas gambar
                    $img = imagecreatetruecolor(592, 271);
                    $white = imagecolorallocate($img, 255, 255, 255);
                    $black = imagecolorallocate($img, 0, 0, 0);
                    imagefill($img, 0, 0, $white);

                    // Membuat fungsi untuk menggambar garis yang lebih tebal (bold)
                    function drawBoldLine($image, $x1, $y1, $x2, $y2, $penColor, $thickness = 3)
                    {
                        // Loop untuk menggambar garis dengan ketebalan
                        for ($i = -$thickness; $i <= $thickness; $i++) {
                            for ($j = -$thickness; $j <= $thickness; $j++) {
                                imageline($image, $x1 + $i, $y1 + $j, $x2 + $i, $y2 + $j, $penColor);
                            }
                        }
                    }

                    // Menggambar tanda tangan ke canvas
                    foreach ($rawData as $stroke) {
                        for ($i = 0; $i < count($stroke['x']); $i++) {
                            if ($i > 0) {
                                drawBoldLine(
                                    $img,
                                    $stroke['x'][$i - 1],
                                    $stroke['y'][$i - 1],
                                    $stroke['x'][$i],
                                    $stroke['y'][$i],
                                    $black,
                                    0.5 // ketebalan garis
                                );
                            }
                        }
                    }

                    // Nama file untuk menyimpan gambar
                    $imageName = uniqid() . '-TTD-' . str_replace(' ', '-', $request->nama_penanggung_jawab) . '.png';

                    ob_start();
                    imagepng($img);
                    $imageBinary = ob_get_clean();
                    imagedestroy($img);


                    $path = "temp_files/" . $imageName;
                    Storage::put($path, $imageBinary);
                    DB::table('data_identitas')->where('identitas_perusahaan_id', $data->id)->update([
                        'ttd' => $imageName
                    ]);
                    UploadTTD::dispatch(($oldData ? (string) $oldData->data_identitas['ttd'] : ''), $path, $imageName);
                } else {
                    return ['status' => false, 'error' => 'Tanda Tangan tidak boleh kosong'];
                }
            } else {
                if ($request->hasFile('foto_npwp')) {
                    $foto = $request->file('foto_npwp');
                    $filename = uniqid() . '-NPWP-' . Str::slug($request->nama_npwp, '-') . '.' . $foto->getClientOriginalExtension();

                    // Temporary store files
                    $tempPath = $foto->storeAs('temp_files', $filename);

                    DB::table('identitas_perusahaan')->where('id', $data->id)->update([
                        'foto_npwp' => $filename
                    ]);
                    UploadNPWP::dispatch($filename, ($oldData ? $oldData->foto_npwp : ''), $tempPath);
                } else {
                    $filename = $oldData->foto_npwp;
                }

                if ($request->status_pkp == 'pkp') {
                    if ($request->hasFile('foto_sppkp')) {
                        $foto = $request->file('foto_sppkp');
                        $filename = uniqid() . '-SPPKP-' . Str::slug($request->nama_npwp, '-') . '.' . $foto->getClientOriginalExtension();

                        // Temporary store files
                        $tempPath = $foto->storeAs('temp_files', $filename);

                        DB::table('identitas_perusahaan')->where('id', $data->id)->update([
                            'sppkp' => $filename
                        ]);
                        UploadSPPKP::dispatch($filename, ($oldData ? $oldData->sppkp : ''), $tempPath);
                    } else {
                        $filename = $oldData->sppkp;
                    }
                }
            }

            if ($request->hasFile('foto_penanggung')) {
                $foto = $request->file('foto_penanggung');
                $filename = uniqid() . '-PIC-' . strtoupper($request->identitas_penanggung_jawab) . '-' . Str::slug($request->nama_penanggung_jawab, '-') . '.' . $foto->getClientOriginalExtension();

                // Temporary store files
                $tempPath = $foto->storeAs('temp_files', $filename);

                DB::table('data_identitas')->where('identitas_perusahaan_id', $data->id)->update([
                    'foto' => $filename,
                ]);
                UploadIdentitas::dispatch($filename, ($oldData ? $oldData->data_identitas->foto : ''), $tempPath);
            } else {
                $filename = $oldData->data_identitas->foto;
            }

            // END: File storing
            DB::commit();
            $link = route('form_customer.detail', ['menu' => str_replace('_', '-', $request->bentuk_usaha), 'id' => Crypt::encryptString($data->id)]);
            return ['status' => true, 'link' => $link];
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return ['status' => false, 'error' => 'Terjadi Kesalahaan'];
        }
    }
}
