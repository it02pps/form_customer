<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataIdentitas;
use App\Models\IdentitasPerusahaan;
use App\Models\InformasiBank;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Helper\ApiStorage;
use App\Helper\base30ToImage;
use App\Models\Cabang;
use App\Models\Sales;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Visibility;
use Illuminate\Support\Facades\Http;
use setasign\Fpdi\Fpdi;

use function PHPUnit\Framework\isEmpty;

class FormCustomerController extends Controller
{
    public $apiKey;
    public $apiUrl;
    public $path;

    public function __construct()
    {
        $this->apiKey = 'Telor-Asin-951357-Papasari';
        $this->apiUrl = env('API_URL') . 'upload';
        $this->path = 'penanggung_jawab/';
    }

    public function menu()
    {
        return view('customer.fix_menu');
    }

    public function index($menu, Request $request)
    {
        if ($request->enkripsi) {
            $data = Crypt::decryptString($request->enkripsi);
            $data = IdentitasPerusahaan::with('informasi_bank', 'data_identitas', 'cabang')->where('bentuk_usaha', str_replace('-', '_', $menu))->where('id', $data)->first();
            $url = route('form_customer.detail', ['menu' => $menu, 'id' => $request->enkripsi]);
            $enkripsi = $request->enkripsi;
        } else {
            $data = null;
            $url = null;
            $enkripsi = null;
        }

        $sales = Sales::select('nama_sales')->get();
        $bidang_usaha = [
            'toko_retail',
            'bumn',
            'reseller',
            'pabrik',
            'kontraktor',
            'toko_online',
            'dock_kapal',
            'end_user',
            'ekspedisi',
            'lainnya'
        ];

        // dd($data);

        if ($menu === 'perseorangan') {
            return view('customer.fix_perseorangan', compact('data', 'url', 'enkripsi', 'menu', 'bidang_usaha', 'sales'));
        } else {
            return view('customer.fix_badan_usaha', compact('data', 'url', 'enkripsi', 'menu', 'bidang_usaha', 'sales'));
        }
    }

    protected function validator($data)
    {
        $rules = [
            // Identitas Perusahaan
            'nama_perusahaan' => 'required',
            'nama_group_perusahaan' => 'required',
            'alamat_lengkap' => 'required',
            'kota_kabupaten' => 'required',
            'no_hp' => 'required',
            'bidang_usaha' => 'required',
            'alamat_email_perusahaan' => $data['alamat_email_perusahaan'] != '' ? ($data['alamat_email_perusahaan'] != '-' ? 'email' : '') : '',
            'status_kepemilikan' => 'required',
            'nama_lengkap' => $data['bentuk_usaha'] == 'perseorangan' ? 'required' : '',
            'nomor_ktp' => $data['bentuk_usaha'] == 'perseorangan' ? 'required|numeric|digits:16' : '',
            'foto_ktp' => $data['update_id'] ? 'mimes:jpg,jpeg,pdf' : ($data['bentuk_usaha'] == 'perseorangan' ? 'required|mimes:jpg,jpeg,pdf' : ''),
            'nomor_npwp' => $data['bentuk_usaha'] == 'badan_usaha' ? 'required' : '',
            'nama_npwp' => $data['bentuk_usaha'] == 'badan_usaha' ? 'required' : '',
            'badan_usaha' => $data['bentuk_usaha'] == 'badan_usaha' ? 'required' : '',
            'email_faktur' => $data['bentuk_usaha'] == 'badan_usaha' ? 'required|email' : '',
            'foto_npwp' => $data['update_id'] ? 'mimes:jpg,jpeg,pdf' : ($data['bentuk_usaha'] == 'badan_usaha' ? 'required|mimes:jpg,jpeg,pdf' : ''),
            'foto_sppkp' => $data['update_id'] ? 'mimes:jpg,jpeg,pdf' : ($data['bentuk_usaha'] == 'badan_usaha' ? ($data['status_pkp'] == 'pkp' ? 'required|mimes:jpg,jpeg,pdf' : '') : ''),
            'alamat_npwp' => $data['bentuk_usaha'] == 'badan_usaha' ? 'required' : '',
            'kota_npwp' => $data['bentuk_usaha'] == 'badan_usaha' ? 'required' : '',
            'nama_group' => $data['status_kepemilikan'] == 'group' ? 'required' : '',
            'bidang_usaha_lain' => $data['bidang_usaha'] == 'lainnya' ? 'required' : '',
            'jenis_cust' => 'required',
            'npwp_perseorangan' => $data['bentuk_usaha'] == 'perseorangan' ? 'required' : '',

            // Informasi Bank
            'nomor_rekening' => 'required|numeric|digits_between:10,16',
            'nama_rekening' => 'required',
            'status_rekening' => 'required',
            'nama_bank' => 'required',
            'rekening_lain' => ($data['status_rekening'] == 'lainnya') ? 'required' : '',

            // Identitas Penanggung Jawab
            'foto_penanggung' => $data['update_id'] ? 'mimes:jpg,jpeg,pdf' : 'required|mimes:jpg,jpeg,pdf',
            'nama_penanggung_jawab' => 'required',
            'jabatan' => 'required',
            'identitas_penanggung_jawab' => 'required',
            'nomor_hp_penanggung_jawab' => 'required',

            // Cabang
            'nitku_cabang.*' => ($data['bentuk_usaha'] == 'badan_usaha' ? 'required|digits:22' : ''),
            'nama_cabang.*' => ($data['bentuk_usaha'] == 'badan_usaha' ? 'required' : ''),
            'alamat_nitku.*' => ($data['bentuk_usaha'] == 'badan_usaha' ? 'required' : ''),
        ];

        $message = [
            // Identitas Perusahaan
            'nama_perusahaan.required' => 'Nama perusahaan harus diisi',
            'nama_group_perusahaan.required' => 'Nama group perusahaan harus diisi',
            'alamat_lengkap.required' => 'Alamat lengkap harus diisi',
            'kota_kabupaten.required' => 'Kota/Kabupaten harus diisi',
            'no_hp.required' => 'Nomor handphone harus diisi',
            'no_hp.numeric' => 'Nomor handphone harus berupa angka',
            'no_hp.digits_between' => 'Nomor Handphone harus diantara 10 - 13 digit',
            'bidang_usaha.required' => 'Bidang usaha harus diisi',
            'alamat_email_perusahaan.email' => 'Email perusahaan harus valid',
            'status_kepemilikan.required' => 'Status kepemilikan harus diisi',
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'nomor_ktp.required' => 'Nomor KTP harus diisi',
            'nomor_ktp.numeric' => 'Nomor KTP harus berupa angka',
            'nomor_ktp.digits' => 'Nomor KTP harus 16 digit',
            'foto_ktp.required' => 'Foto KTP harus diisi',
            'foto_ktp.mimes' => 'Format file KTP harus berupa JPG, PNG, JPEG, atau PDF',
            'nomor_npwp.required' => 'Nomor NPWP harus diisi',
            'nomor_npwp.digits_between' => 'Nomor NPWP harus diantara 15 - 16 digit',
            'nama_npwp.required' => 'Nama NPWP harus diisi',
            'badan_usaha.required' => 'Badan usaha harus diisi',
            'email_faktur.required' => 'Email faktur harus diisi',
            'email_faktur.email' => 'Format email harus valid',
            'foto_npwp.required' => 'Foto NPWP harus diisi',
            'foto_npwp.mimes' => 'Format file NPWP harus berupa JPG, PNG, JPEG, atau PDF',
            'foto_sppkp.required' => 'Foto SPPKP harus diisi',
            'foto_sppkp.mimes' => 'Format file SPPKP harus berupa JPG, PNG, JPEG, atau PDF',
            'alamat_npwp.required' => 'Alamat NPWP harus diisi',
            'kota_npwp.required' => 'Kota NPWP harus diisi',
            'nama_group.required' => 'Nama group harus diisi',
            'bidang_usaha_lain.required' => 'Bidang usaha harus diisi',
            'jenis_cust.required' => 'Jenis customer harus diisi',
            'npwp_perseorangan.required' => 'NPWP perseorangan harus diisi',

            // Informasi Bank
            'nomor_rekening.required' => 'Nomor rekening harus diisi',
            'nomor_rekening.numeric' => 'Nomor rekening harus berupa angka',
            'nomor_rekening.digits_between' => 'Nomor rekening harus diantara 10 - 16 digit',
            'nama_rekening.required' => 'Nama rekening harus diisi',
            'status_rekening' => 'Status rekening harus diisi',
            'nama_bank.required' => 'Nama bank harus diisi',
            'rekening_lain.required' => 'Rekening lain wajib diisi',

            // Identitas Penanggung Jawab
            'nama_penanggung_jawab.required' => 'Nama penanggung jawab harus diisi',
            'jabatan.required' => 'Jabatan harus diisi',
            'identitas_penanggung_jawab.required' => 'Identitas penanggung jawab harus diisi',
            'foto_penanggung.required' => 'Foto identitas penanggung jawab harus diisi',
            'foto_penanggung.mimes' => 'Format file identitas penanggung jawab harus berupa JPG, PNG, JPEG, atau PDF',
            'nomor_hp_penanggung_jawab.required' => 'Nomor HP penanggung jawab harus diisi',
            'nomor_hp_penanggung_jawab.numeric' => 'Nomor HP penanggung jawab harus berupa angka',
            'nomor_hp_penanggung_jawab.digits_between' => 'Nomor HP penanggung jawab harus diantara 10 - 13 digit',

            // Cabang
            'nitku_cabang.*.required' => 'NITKU harus diisi',
            'nitku_cabang.*.digits' => 'NITKU harus 22 digit',
            'nama_cabang.*.required' => 'Nama cabang harus diisi',
            'alamat_nitku.*.required' => 'Alamat cabang harus diisi',
        ];

        return Validator::make($data, $rules, $message);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $validator = $this->validator($request->all());
            if ($validator->fails()) {
                return ['status' => false, 'error' => $validator->errors()->all()];
            }

            // Cek id
            $dekripsi = $request->update_id ? Crypt::decryptString($request->update_id) : '';

            // Identitas perusahaan
            $identitas_perusahaan = IdentitasPerusahaan::findOrNew($dekripsi);
            $identitas_perusahaan->nama_perusahaan = $request->nama_perusahaan;
            $identitas_perusahaan->nama_group_perusahaan = $request->nama_group_perusahaan;
            $identitas_perusahaan->alamat_lengkap = $request->alamat_lengkap;
            $identitas_perusahaan->kota_kabupaten = $request->kota_kabupaten;
            $identitas_perusahaan->bidang_usaha = $request->bidang_usaha;
            $identitas_perusahaan->status_cust = $request->jenis_cust;

            // Buat kode customer
            $lastest_cust = IdentitasPerusahaan::latest('id')->first();
            $lastSerialNumber = $lastest_cust ? $lastest_cust->kode_customer : 'K-00001';
            $serial_number = (int) substr($lastSerialNumber, 2);
            $number = str_pad($serial_number + 1, 5, '0', STR_PAD_LEFT);
            $kode_cust = 'K-' . $number;
            $identitas_perusahaan->kode_customer = $kode_cust;

            if ($request->bidang_usaha == 'lainnya') {
                $identitas_perusahaan->bidang_usaha_lain = $request->bidang_usaha_lain;
            }

            // Hitung lama usaha berdasarkan tahun berdiri dengan tahun sekarang
            // $sekarang = Carbon::now()->format('Y');
            // $tahun_berdiri = Carbon::parse($request->tahun_berdiri)->format('Y');
            // $hasil = $sekarang - $tahun_berdiri;

            $identitas_perusahaan->tahun_berdiri = $request->tahun_berdiri;
            $identitas_perusahaan->lama_usaha = ($request->tahun_berdiri ? Str::replace(' tahun', '', $request->lama_usaha) : '');
            $identitas_perusahaan->alamat_email = $request->alamat_email_perusahaan;
            $identitas_perusahaan->nomor_handphone = $request->no_hp;
            $identitas_perusahaan->status_kepemilikan = $request->status_kepemilikan;
            $identitas_perusahaan->nama_sales = $request->sales;
            if ($request->status_kepemilikan == 'group') {
                $identitas_perusahaan->nama_group = $request->nama_group;
            }

            $identitas_perusahaan->identitas = ($request->bentuk_usaha == 'badan_usaha') ? 'npwp' : 'ktp';
            $identitas_perusahaan->bentuk_usaha = $request->bentuk_usaha;

            // Kondisi jika identitas perusahaan yang dipakai KTP / NPWP
            if ($request->bentuk_usaha == 'perseorangan') {
                $identitas_perusahaan->nama_lengkap = $request->nama_lengkap;
                $identitas_perusahaan->npwp_perseorangan = $request->npwp_perseorangan;

                if ($request->npwp_perseorangan == '1') {
                    $identitas_perusahaan->nomor_npwp = $request->nomor_ktp;
                    $identitas_perusahaan->nomor_ktp = null;
                } else {
                    $identitas_perusahaan->nomor_ktp = $request->nomor_ktp;
                    $identitas_perusahaan->nomor_npwp = null;
                }

                if ($request->nomor_ktp == '-') {
                    return ['status' => false, 'error' => 'Nomor KTP harus diisi'];
                }

                if ($request->hasFile('foto_ktp')) {
                    if (File::exists('uploads/identitas_perusahaan/' . $identitas_perusahaan->foto_ktp)) {
                        File::delete('uploads/identitas_perusahaan/' . $identitas_perusahaan->foto_ktp);
                    }
                    $foto = $request->file('foto_ktp');
                    $ext = $foto->getClientOriginalExtension();
                    $filename = uniqid() . '-' . 'KTP-' . Str::slug($request->nama_lengkap, '-') . '.' . $ext;
                    $foto->move('uploads/identitas_perusahaan/', $filename);
                    $identitas_perusahaan->foto_ktp = $filename;

                    // $foto_ktp = fopen($request->file('foto_ktp')->getPathname(), 'r');
                    // $response = Http::withHeaders([
                    //     'x-api-key' => $this->apiKey,
                    // ])->attach(
                    //     'file',
                    //     $foto_ktp,
                    //     $request->file('foto_ktp')->getClientOriginalName()
                    // )->post($this->apiUrl, [
                    //     'category' => 'ktp',
                    //     'filename' => $filename,
                    // ]);

                    // fclose($foto_ktp);

                    // if ($response->successful()) {
                    //     $filename = $response->json('filename');
                    //     $filepath = $response->json('filepath');
                    //     $identitas_perusahaan->foto_ktp = $filename;
                    // }
                }
                // Clear NPWP column
                $identitas_perusahaan->badan_usaha = null;
                $identitas_perusahaan->nama_npwp = null;
                $identitas_perusahaan->foto_npwp = null;
                $identitas_perusahaan->email_khusus_faktur_pajak = null;
                $identitas_perusahaan->status_pkp = 'non_pkp';
                $identitas_perusahaan->sppkp = null;
            } else {
                $identitas_perusahaan->badan_usaha = $request->badan_usaha;
                $identitas_perusahaan->nama_npwp = $request->nama_npwp;

                if ($request->nomor_npwp == '-') {
                    return ['status' => false, 'error' => 'Nomor NPWP harus diisi'];
                }
                $identitas_perusahaan->nomor_npwp = $request->nomor_npwp;
                if ($request->hasFile('foto_npwp')) {
                    if (File::exists('uploads/identitas_perusahaan/' . $identitas_perusahaan->foto_npwp)) {
                        File::delete('uploads/identitas_perusahaan/' . $identitas_perusahaan->foto_npwp);
                    }
                    $foto = $request->file('foto_npwp');
                    $ext = $foto->getClientOriginalExtension();
                    $filename = uniqid() . '-' . 'NPWP-' . Str::slug($request->nama_npwp, '-') . '.' . $ext;
                    $foto->move('uploads/identitas_perusahaan/', $filename);
                    $identitas_perusahaan->foto_npwp = $filename;


                    // $foto_npwp = fopen($request->file('foto_npwp')->getPathname(), 'r');
                    // $response = Http::withHeaders([
                    //     'x-api-key' => $this->apiKey,
                    // ])->attach(
                    //     'file',
                    //     $foto_npwp,
                    //     $request->file('foto_npwp')->getClientOriginalName()
                    // )->post($this->apiUrl, [
                    //     'category' => 'npwp',
                    //     'filename' => $filename,
                    // ]);

                    // fclose($foto_npwp);
                    // if ($response->successful()) {
                    //     $filename = $response->json('filename');
                    //     $filepath = $response->json('filepath');
                    //     $identitas_perusahaan->foto_npwp = $filename;
                    // }
                }

                // Validasi email faktur pajak
                if ($request->email_faktur == '-') {
                    return ['status' => false, 'error' => 'Email faktur pajak wajib diisi dengan format yang benar'];
                }

                $identitas_perusahaan->email_khusus_faktur_pajak = $request->email_faktur;
                $identitas_perusahaan->status_pkp = $request->status_pkp;
                $identitas_perusahaan->alamat_npwp = $request->alamat_npwp;
                $identitas_perusahaan->kota_npwp = $request->kota_npwp;

                if ($request->status_pkp == 'pkp') {
                    if ($request->hasFile('foto_sppkp')) {
                        if (File::exists('uploads/identitas_perusahaan/' . $identitas_perusahaan->sppkp)) {
                            File::delete('uploads/identitas_perusahaan/' . $identitas_perusahaan->sppkp);
                        }
                        $foto = $request->file('foto_sppkp');
                        $ext = $foto->getClientOriginalExtension();
                        $filename = uniqid() . '-SPPKP' . '.' . $ext;
                        $foto->move('uploads/identitas_perusahaan/', $filename);
                        $identitas_perusahaan->sppkp = $filename;

                        // $foto_sppkp = fopen($request->file('foto_sppkp')->getPathname(), 'r');
                        // $response = Http::withHeaders([
                        //     'x-api-key' => $this->apiKey,
                        // ])->attach(
                        //     'file',
                        //     $foto_sppkp,
                        //     $request->file('foto_sppkp')->getClientOriginalName()
                        // )->post($this->apiUrl, [
                        //     'category' => 'sppkp',
                        //     'filename' => $filename,
                        // ]);

                        // fclose($foto_sppkp);

                        // if ($response->successful()) {
                        //     $filename = $response->json('filename');
                        //     $filepath = $response->json('filepath');
                        //     $identitas_perusahaan->sppkp = $filename;
                        // }
                    }
                }

                // Clear KTP column
                $identitas_perusahaan->nama_lengkap = null;
                $identitas_perusahaan->nomor_ktp = null;
                $identitas_perusahaan->foto_ktp = null;
            }
            $identitas_perusahaan->save();

            // Cabang
            // if($request->bentuk_usaha == 'badan_usaha') {
            $cabang = Cabang::where('identitas_perusahaan_id', $dekripsi);
            if ($cabang->count() > 0) {
                $cabang->delete();
                if (count($request->nitku_cabang) > 0) {
                    for ($i = 0; $i < count($request->nitku_cabang); $i++) {
                        if ($request->nitku_cabang[$i] == '-') {
                            return ['status' => false, 'error' => 'NITKU Cabang wajib diisi dengan format yang benar'];
                        }

                        Cabang::insert([
                            'identitas_perusahaan_id' => $identitas_perusahaan->id,
                            'nitku' => $request->nitku_cabang[$i],
                            'nama' => $request->nama_cabang[$i],
                            'alamat' => $request->alamat_nitku[$i],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                }
            } else {
                if (count($request->nitku_cabang) > 0) {
                    for ($i = 0; $i < count($request->nitku_cabang); $i++) {
                        if ($request->nitku_cabang[$i] == '-') {
                            return ['status' => false, 'error' => 'NITKU Cabang wajib diisi dengan format yang benar'];
                        }

                        Cabang::insert([
                            'identitas_perusahaan_id' => $identitas_perusahaan->id,
                            'nitku' => $request->nitku_cabang[$i],
                            'nama' => $request->nama_cabang[$i],
                            'alamat' => $request->alamat_nitku[$i],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                }
            }
            // }

            // Identitas penanggung jawab
            $identitas_penanggung_jawab = DataIdentitas::firstOrNew([
                'identitas_perusahaan_id' => $dekripsi
            ]);
            $identitas_penanggung_jawab->identitas_perusahaan_id = $identitas_perusahaan->id;
            $identitas_penanggung_jawab->nama = $request->nama_penanggung_jawab;
            $identitas_penanggung_jawab->jabatan = $request->jabatan;
            $identitas_penanggung_jawab->identitas = $request->identitas_penanggung_jawab;
            $identitas_penanggung_jawab->no_hp = $request->nomor_hp_penanggung_jawab;

            if ($request->bentuk_usaha == 'perseorangan') {
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
                    if (!is_dir('uploads/ttd')) {
                        mkdir('uploads/ttd/', 0777, true);
                    }

                    // Nama file untuk menyimpan gambar
                    $imageName = str_replace(' ', '-', $request->nama_penanggung_jawab) . '.png';
                    $filePath = 'uploads/ttd/' . $imageName;

                    // Menyimpan gambar ke storage
                    $fullPath = public_path($filePath);
                    imagepng($img, $fullPath);
                    imagedestroy($img);
                    $identitas_penanggung_jawab->ttd = $imageName;

                    // Mengirim gambar ke API
                    // $foto_ttd = fopen($filePath, 'r');
                    // // dd($foto_ttd);
                    // $response = Http::withHeaders([
                    //     'x-api-key' => $this->apiKey,
                    // ])->attach(
                    //     'file',
                    //     $foto_ttd,
                    //     $imageName
                    // )->post($this->apiUrl, [
                    //     'category' => 'sign',
                    //     'filename' => $imageName,
                    // ]);

                    // fclose($foto_ttd);

                    // // dd($response);
                    // if ($response->successful()) {
                    //     $filename = $response->json('filename');
                    //     $filepath = $response->json('filepath');
                    //     $identitas_penanggung_jawab->ttd = $filename;
                    // }
                }
            }

            if ($request->hasFile('foto_penanggung')) {
                if (File::exists('uploads/penanggung_jawab/' . $identitas_penanggung_jawab->foto)) {
                    File::delete('uploads/penanggung_jawab/' . $identitas_penanggung_jawab->foto);
                }
                $foto = $request->file('foto_penanggung');
                $ext = $foto->getClientOriginalExtension();
                $filename = uniqid() . '-' . Str::slug($request->nama_penanggung_jawab, '-') . '.' . $ext;
                // Storage::disk('custom_path')->putFileAs($this->path, $foto, $filename);
                $foto->move('uploads/penanggung_jawab/', $filename);
                $identitas_penanggung_jawab->foto = $filename;

                // $foto_ktp_penanggung = fopen($request->file('foto_ktp_penanggung')->getPathname(), 'r');
                // // dd($request->file('foto_ktp_penanggung')->getClientOriginalName());
                // $response = Http::withHeaders([
                //     'x-api-key' => $this->apiKey,
                // ])->attach(
                //     'file',
                //     $foto_ktp_penanggung,
                //     $request->file('foto_ktp_penanggung')->getClientOriginalName()
                // )->post($this->apiUrl, [
                //     'category' => 'ktp_responsible',
                //     'filename' => $filename,
                // ]);

                // fclose($foto_ktp_penanggung);

                // if ($response->successful()) {
                //     $filename = $response->json('filename');
                //     $filepath = $response->json('filepath');
                //     $identitas_penanggung_jawab->foto = $filename;
                // }
            }
            $identitas_penanggung_jawab->save();

            // Informasi Bank
            $bank = InformasiBank::firstOrNew([
                'identitas_perusahaan_id' => $dekripsi
            ]);
            $bank->identitas_perusahaan_id = $identitas_perusahaan->id;
            $bank->nomor_rekening = $request->nomor_rekening;
            $bank->nama_rekening = $request->nama_rekening;
            $bank->status = $request->status_rekening;
            $bank->nama_bank = $request->nama_bank;
            if ($request->status_rekening == 'lainnya') {
                $bank->rekening_lain = $request->rekening_lain;
            }
            $bank->save();

            $link = route('form_customer.detail', ['menu' => str_replace('_', '-', $request->bentuk_usaha), 'id' => Crypt::encryptString($identitas_perusahaan->id)]);
            return ['status' => true, 'link' => $link];
        } catch (\Exception $e) {
            // dd($e);
            return ['status' => false, 'error' => 'Terjadi kesalahan'];
        }
    }

    public function detail($menu, Request $request)
    {
        // dd($request->all());
        // Mendekripsikan id
        $dekripsi = Crypt::decryptString($request->id);

        // Memanggil data berdasarkan id identitas perusahaan
        $data_perusahaan = IdentitasPerusahaan::with('data_identitas', 'informasi_bank')->where('id', $dekripsi)->first();

        if ($menu == 'badan-usaha' || $menu == 'badan_usaha') {
            $menu = str_replace('_', '-', $menu);
            return view('customer.fix_badan_usaha_detail', [
                'enkripsi' => $request->id,
                'perusahaan' => $data_perusahaan,
                'menu' => $menu,
                'url' => route('form_customer.index', ['menu' => $menu, 'enkripsi' => $request->id])
            ]);
        } else {
            return view('customer.fix_perseorangan_detail', [
                'enkripsi' => $request->id,
                'perusahaan' => $data_perusahaan,
                'menu' => $menu,
                'url' => route('form_customer.index', ['menu' => $menu, 'enkripsi' => $request->id])
            ]);
        }
    }

    public function select(Request $request)
    {
        if ($request->id) {
            $dekripsi = Crypt::decryptString($request->id);
            $data = IdentitasPerusahaan::with('data_identitas', 'informasi_bank')->where('id', $dekripsi)->first();

            return ['status' => true, 'data' => $data];
        } else {
            return ['status' => false];
        }
    }

    public function download_pdf($menu, Request $request)
    {
        $decrypt = Crypt::decryptString($request->id);
        $data = IdentitasPerusahaan::with('data_identitas', 'informasi_bank')->where('id', $decrypt)->first();
        // dd($data);

        if ($menu == 'badan_usaha' || $menu == 'badan-usaha') {
            $pdf = Pdf::loadView('pdf.badan_usaha_pdf', [
                'data' => $data
            ]);
            $pdf->setPaper('A4', 'portrait');
            $pdf->render();

            $pdfFiles = [];


            return $pdf->stream();
            // return $pdf->download($data['nama_perusahaan'] . '.pdf');
        } else {
            $pdf = Pdf::loadView('pdf.perseorangan_pdf', [
                'data' => $data
            ]);
            $pdf->setPaper('A4', 'portrait');
            $pdf->render();
            return $pdf->stream();
            // return $pdf->download($data['nama_perusahaan'] . '.pdf');
        }
    }

    public function upload_pdf(Request $request, $menu, $id)
    {
        try {
            $data = IdentitasPerusahaan::find(Crypt::decryptString($id));

            if ($request->hasFile('file_pdf')) {
                $file = $request->file('file_pdf');
                $ext = $file->getClientOriginalExtension();
                $filename = uniqid() . '-' . $data->nama_perusahaan . '.' . $ext;
                $file->move('uploads/identitas_perusahaan/', $filename);

                $data->file_customer_external = $filename;
                $data->status_upload = '1';
            }
            $data->save();

            return ['status' => true, 'url' => 'https://papasari.com'];
        } catch (\Exception $e) {
            return ['status' => false, 'error' => 'Terjadi Kesalahan'];
        }
    }

    public function search($keyword)
    {
        $data = IdentitasPerusahaan::with('informasi_bank', 'data_identitas', 'cabang')->where('nomor_ktp', $keyword)->orWhere('nomor_npwp', $keyword)->first();
        $enkripsi = Crypt::encryptString($data->id);
        return ['data' => $data, 'enkripsi' => $enkripsi];
    }

    // Function for merging PDF
    // private function mergingPdf(array $pdfFiles, string $outputFilename): string
    // {
    //     $pdf = new Fpdi();
    // }
}
