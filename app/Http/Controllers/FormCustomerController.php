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

class FormCustomerController extends Controller
{
    public function index(Request $request) {
        if($request->enkripsi) {
            $data = Crypt::decryptString($request->enkripsi);
            $data_perusahaan = IdentitasPerusahaan::with('informasi_bank', 'data_identitas')->where('id', $data)->first();
            $url = route('form_customer.detail', ['id' => $request->enkripsi]);
            $enkripsi = $request->enkripsi;
        } else {
            $data_perusahaan = null;
            $url = null;
            $enkripsi = null;
        }

        // dd($data_perusahaan);
        return view('welcome', compact('data_perusahaan', 'url', 'enkripsi'));
    }

    protected function validator($data) {
        $rules = [
            'nama_perusahaan' => 'required',
            'nama_group_perusahaan' => 'required',
            'alamat_lengkap' => 'required',
            'kota_kabupaten' => 'required',
            'no_hp' => 'required|numeric|digits_between:10,13',
            'kecamatan' => 'required',
            'bidang_usaha' => 'required',
            'tahun_berdiri' => 'required|date',
            'lama_usaha' => 'required',
            'email_perusahaan' => 'required|email',
            'foto_ktp_penanggung' => $data['update_id'] ? 'mimes:jpg,png,jpeg,pdf' : ($data['identitas_penanggung_jawab'] == 'ktp' ? 'required|mimes:jpg,png,jpeg,pdf' : ''),
            'foto_npwp_penanggung' => $data['update_id'] ? 'mimes:jpg,png,jpeg,pdf' : ($data['identitas_penanggung_jawab'] == 'npwp' ? 'required|mimes:jpg,png,jpeg,pdf' : ''),
            'status_kepemilikan' => 'required',
            'nama_penanggung_jawab' => 'required',
            'jabatan' => 'required',
            'identitas_penanggung_jawab' => 'required',
            'identitas_perusahaan' => 'required',
            'nomor_rekening' => 'required|numeric|digits_between:10,16',
            'nama_rekening' => 'required',
            'status_rekening' => 'required',
            'nama_bank' => 'required',
            'nama_lengkap' => ($data['identitas_perusahaan'] == 'ktp' ? 'required' : ''),
            'nomor_ktp' => ($data['identitas_perusahaan'] == 'ktp' ? 'required|numeric|digits:16' : ''),
            'foto_ktp' => $data['update_id'] ? 'mimes:jpg,png,jpeg,pdf' : ($data['identitas_perusahaan'] == 'ktp' ? 'required|mimes:jpg,png,jpeg,pdf' : ''),
            'nomor_npwp' => ($data['identitas_perusahaan'] == 'npwp' ? 'required|digits_between:15,16' : ''),
            'nama_npwp' => ($data['identitas_perusahaan'] == 'npwp' ? 'required' : ''),
            'badan_usaha' => ($data['identitas_perusahaan'] == 'npwp' ? 'required' : ''),
            'email_faktur' => ($data['identitas_perusahaan'] == 'npwp' ? 'required|email' : ''),
            'foto_npwp' => $data['update_id'] ? 'mimes:jpg,png,jpeg,pdf' : ($data['identitas_perusahaan'] == 'npwp' ? 'required|mimes:jpg,png,jpeg,pdf' : ''),
            'foto_sppkp' => $data['update_id'] ? 'mimes:jpg,png,jpeg,pdf' : ($data['status_pkp'] == 'pkp' ? 'required|mimes:jpg,png,jpeg,pdf' : ''),
            'alamat_npwp' => $data['identitas_perusahaan'] == 'npwp' ? 'required' : '',
            'kota_npwp' => $data['identitas_perusahaan'] == 'npwp' ? 'required' : ''
        ];

        $message = [
            'nama_perusahaan.required' => 'Nama perusahaan harus diisi',
            'nama_group_perusahaan.required' => 'Nama group perusahaan harus diisi',
            'alamat_lengkap.required' => 'Alamat lengkap harus diisi',
            'kota_kabupaten.required' => 'Kota/Kabupaten harus diisi',
            'no_hp.required' => 'Nomor handphone harus diisi',
            'no_hp.numeric' => 'Nomor handphone harus berupa angka',
            'no_hp.digits_between' => 'Nomor Handphone harus diantara 10 - 13 digit',
            'kecamatan.required' => 'Kecamatan harus diisi',
            'bidang_usaha.required' => 'Bidang usaha harus diisi',
            'tahun_berdiri.required' => 'Tahun berdiri harus diisi',
            'tahun_berdiri.date' => 'Tahun berdiri harus berupa tanggal',
            'email_perusahaan.required' => 'Email perusahaan harus diisi',
            'email_perusahaan.email' => 'Email perusahaan harus valid',
            'status_kepemilikan.required' => 'Status kepemilikan harus diisi',
            'nama_penanggung_jawab.required' => 'Nama penanggung jawab harus diisi',
            'jabatan.required' => 'Jabatan harus diisi',
            'identitas_penanggung_jawab.required' => 'Identitas penanggung jawab harus diisi',
            'identitas_perusahaan.required' => 'Identitas perusahaan harus diisi',
            'nomor_rekening.required' => 'Nomor rekening harus diisi',
            'nomor_rekening.numeric' => 'Nomor rekening harus berupa angka',
            'nomor_rekening.digits_between' => 'Nomor rekening harus diantara 10 - 16 digit',
            'nama_rekening.required' => 'Nama rekening harus diisi',
            'status_rekening' => 'Status rekening harus diisi',
            'nama_bank.required' => 'Nama bank harus diisi',
            'foto_ktp_penanggung.required' => 'Foto KTP penanggung jawab harus diisi',
            'foto_ktp_penanggung.mimes' => 'Format file harus berupa JPG, PNG, JPEG, atau PDF',
            'foto_npwp_penanggung.required' => 'Foto NPWP penanggung jawab harus diisi',
            'foto_npwp_penanggung.mimes' => 'Format file harus berupa JPG, PNG, JPEG, atau PDF',
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'nomor_ktp.required' => 'Nomor KTP harus diisi',
            'nomor_ktp.numeric' => 'Nomor KTP harus berupa angka',
            'nomor_ktp.digits' => 'Nomor KTP harus 16 digit',
            'foto_ktp.required' => 'Foto KTP harus diisi',
            'foto_ktp.mimes' => 'Format file harus berupa JPG, PNG, JPEG, atau PDF',
            'nomor_npwp.required' => 'Nomor NPWP harus diisi',
            'nomor_npwp.digits_between' => 'Nomor NPWP harus diantara 15 - 16 digit',
            'nama_npwp.required' => 'Nama NPWP harus diisi',
            'badan_usaha.required' => 'Badan usaha harus diisi',
            'email_faktur.required' => 'Email faktur harus diisi',
            'email_faktur.email' => 'Format email harus valid',
            'foto_npwp.required' => 'Foto NPWP harus diisi',
            'foto_npwp.mimes' => 'Format file harus berupa JPG, PNG, JPEG, atau PDF',
            'foto_sppkp.required' => 'Foto SPPKP harus diisi',
            'foto_sppkp.mimes' => 'Format file harus berupa JPG, PNG, JPEG, atau PDF',
            'alamat_npwp.required' => 'Alamat NPWP harus diisi',
            'kota_npwp.required' => 'Kota NPWP harus diisi'
        ];

        return Validator::make($data, $rules, $message);
    }

    public function store(Request $request) {
        try {
            $validator = $this->validator($request->all());
            if($validator->fails()) {
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
            $identitas_perusahaan->kecamatan = $request->kecamatan;
            $identitas_perusahaan->bidang_usaha = $request->bidang_usaha;

            // Hitung lama usaha berdasarkan tahun berdiri dengan tahun sekarang
            // $sekarang = Carbon::now()->format('Y');
            // $tahun_berdiri = Carbon::parse($request->tahun_berdiri)->format('Y');
            // $hasil = $sekarang - $tahun_berdiri;

            $identitas_perusahaan->lama_usaha = Str::replace(' tahun', '', $request->lama_usaha);
            $identitas_perusahaan->tahun_berdiri = $request->tahun_berdiri;
            $identitas_perusahaan->alamat_email = $request->email_perusahaan;
            $identitas_perusahaan->nomor_handphone = $request->no_hp;
            $identitas_perusahaan->status_kepemilikan = $request->status_kepemilikan;
            $identitas_perusahaan->identitas = $request->identitas_perusahaan;

            // Kondisi jika identitas perusahaan yang dipakai KTP / NPWP
            if($request->identitas_perusahaan == 'ktp') {
                $identitas_perusahaan->nama_lengkap = $request->nama_lengkap;
                $identitas_perusahaan->nomor_ktp = $request->nomor_ktp;
                if($request->hasFile('foto_ktp')) {
                    if(File::exists('uploads/identitas_perusahaan/' . $identitas_perusahaan->foto_ktp)) {
                        File::delete('uploads/identitas_perusahaan/' . $identitas_perusahaan->foto_ktp);
                    }
                    $foto = $request->file('foto_ktp');
                    $ext = $foto->getClientOriginalExtension();
                    $filename = uniqid() . '-' . 'KTP-' . Str::slug($request->nama_lengkap, '-') . '.' . $ext;

                    $foto->move('uploads/identitas_perusahaan/', $filename);
                    $identitas_perusahaan->foto_ktp = $filename;
                }

                // Clear NPWP column
                $identitas_perusahaan->badan_usaha = null;
                $identitas_perusahaan->nama_npwp = null;
                $identitas_perusahaan->nomor_npwp = null;
                $identitas_perusahaan->foto_npwp = null;
                $identitas_perusahaan->email_khusus_faktur_pajak = null;
                $identitas_perusahaan->status_pkp = 'non_pkp';
                $identitas_perusahaan->sppkp = null;
            } else {
                $identitas_perusahaan->badan_usaha = $request->badan_usaha;
                $identitas_perusahaan->nama_npwp = $request->nama_npwp;
                $identitas_perusahaan->nomor_npwp = $request->nomor_npwp;
                if($request->hasFile('foto_npwp')) {
                    if(File::exists('uploads/identitas_perusahaan/' . $identitas_perusahaan->foto_npwp)) {
                        File::delete('uploads/identitas_perusahaan/' . $identitas_perusahaan->foto_npwp);
                    }
                    $foto = $request->file('foto_npwp');
                    $ext = $foto->getClientOriginalExtension();
                    $filename = uniqid() . '-' . 'NPWP-' . Str::slug($request->nama_npwp, '-') . '.' . $ext;

                    $foto->move('uploads/identitas_perusahaan/', $filename);
                    $identitas_perusahaan->foto_npwp = $filename;
                }
                $identitas_perusahaan->email_khusus_faktur_pajak = $request->email_faktur;
                $identitas_perusahaan->status_pkp = $request->status_pkp;
                $identitas_perusahaan->alamat_npwp = $request->alamat_npwp;
                $identitas_perusahaan->kota_npwp = $request->kota_npwp;

                if($request->status_pkp == 'pkp') {
                    if($request->hasFile('foto_sppkp')) {
                        if(File::exists('uploads/identitas_perusahaan/' . $identitas_perusahaan->sppkp)) {
                            File::delete('uploads/identitas_perusahaan/' . $identitas_perusahaan->sppkp);
                        }
                        $foto = $request->file('foto_sppkp');
                        $ext = $foto->getClientOriginalExtension();
                        $filename = uniqid() . '-SPPKP' . '.' . $ext;
    
                        $foto->move('uploads/identitas_perusahaan/', $filename);
                        $identitas_perusahaan->sppkp = $filename;
                    }
                }

                // Clear KTP column
                $identitas_perusahaan->nama_lengkap = null;
                $identitas_perusahaan->nomor_ktp = null;
                $identitas_perusahaan->foto_ktp = null;
            }
            $identitas_perusahaan->status_konfirmasi = '0';
            $identitas_perusahaan->save();

            // Identitas penanggung jawab
            $identitas_penanggung_jawab = DataIdentitas::firstOrNew([
                'identitas_perusahaan_id' => $dekripsi
            ]);
            $identitas_penanggung_jawab->identitas_perusahaan_id = $identitas_perusahaan->id;
            $identitas_penanggung_jawab->nama = $request->nama_penanggung_jawab;
            $identitas_penanggung_jawab->jabatan = $request->jabatan;
            $identitas_penanggung_jawab->identitas = $request->identitas_penanggung_jawab;
            $identitas_penanggung_jawab->ttd = $request->hasil_ttd;
            if($request->identitas_penanggung_jawab == 'ktp') {
                if($request->hasFile('foto_ktp_penanggung')) {
                    if(File::exists('uploads/penanggung_jawab/' . $identitas_penanggung_jawab->foto)) {
                        File::delete('uploads/penanggung_jawab/' . $identitas_penanggung_jawab->foto);
                    }
                    $foto = $request->file('foto_ktp_penanggung');
                    $ext = $foto->getClientOriginalExtension();
                    $filename = uniqid() . '-' . Str::slug($request->nama_penanggung_jawab, '-') . '.' . $ext;

                    $foto->move('uploads/penanggung_jawab/', $filename);
                    $identitas_penanggung_jawab->foto = $filename;
                }
            } else {
                if($request->hasFile('foto_npwp_penanggung')) {
                    if(File::exists('uploads/penanggung_jawab/' . $identitas_penanggung_jawab->foto)) {
                        File::delete('uploads/penanggung_jawab/' . $identitas_penanggung_jawab->foto);
                    }
                    $foto = $request->file('foto_npwp_penanggung');
                    $ext = $foto->getClientOriginalExtension();
                    $filename = uniqid() . '-' . Str::slug($request->nama_penanggung_jawab, '-') . '.' . $ext;

                    $foto->move('uploads/penanggung_jawab/', $filename);
                    $identitas_penanggung_jawab->foto = $filename;
                }
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
            $bank->save();

            $link = route('form_customer.detail', ['id' => Crypt::encryptString($identitas_perusahaan->id)]);

            return ['status' => true, 'link' => $link];
        } catch(\Exception $e) {
            return ['status' => false, 'error' => 'Terjadi kesalahan'];
        }
    }

    public function detail(Request $request) {
        // Mendekripsikan id
        $dekripsi = Crypt::decryptString($request->id);

        // Memanggil data berdasarkan id identitas perusahaan
        $data_perusahaan = IdentitasPerusahaan::with('data_identitas', 'informasi_bank')->where('id', $dekripsi)->first();

        return view('information', [
            'enkripsi' => $request->id,
            'perusahaan' => $data_perusahaan,
            'url' => route('form_customer.index', ['enkripsi' => $request->id])
        ]);
    }

    public function select(Request $request) {
        if($request->id) {
            $dekripsi = Crypt::decryptString($request->id);
            $data = IdentitasPerusahaan::with('data_identitas', 'informasi_bank')->where('id', $dekripsi)->first();
    
            return ['status' => true, 'data' => $data];
        } else {
            return ['status' => false];
        }
    }

    public function confirmation(Request $request) {
        try {
            $dekripsi = Crypt::decryptString($request->id);

            $confirmation = IdentitasPerusahaan::find($dekripsi);
            $confirmation->status_konfirmasi = '1';
            $confirmation->save();

            return ['status' => true];
        } catch(\Exception $e) {
            return ['status' => false];
        }
    }

    public function download_pdf(Request $request) {
        $decrypt = Crypt::decryptString($request->id);
        $data = IdentitasPerusahaan::with('data_identitas', 'informasi_bank')->where('id', $decrypt)->first();
        // dd($data);

        $pdf = Pdf::loadView('pdf.index', [
            'data' => $data
        ]);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        return $pdf->stream();
    }
}
