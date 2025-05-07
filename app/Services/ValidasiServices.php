<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class ValidasiServices
{
    public function validationPerusahaan($data)
    {
        $rules = [
            'nama_perusahaan' => 'required',
            'nama_group_perusahaan' => 'required',
            'alamat_lengkap' => 'required',
            'alamat_group_lengkap' => 'required',
            'kota_kabupaten' => 'required',
            'no_hp' => 'required',
            'bidang_usaha' => 'required',
            'alamat_email_perusahaan' => $data['alamat_email_perusahaan'] != '' ? ($data['alamat_email_perusahaan'] != '-' ? 'email' : '') : '',
            'status_kepemilikan' => 'required',
            'nama_lengkap' => $data['bentuk_usaha'] == 'perseorangan' ? 'required' : '',
            'nomor_ktp' => $data['bentuk_usaha'] == 'perseorangan' ? 'required|numeric|digits:16' : '',
            'foto_ktp' => $data['update_id'] ? 'mimes:jpg,jpeg,pdf,png' : ($data['bentuk_usaha'] == 'perseorangan' ? 'required|mimes:jpg,jpeg,pdf,png' : ''),
            'nomor_npwp' => $data['bentuk_usaha'] == 'badan_usaha' ? 'required' : '',
            'nama_npwp' => $data['bentuk_usaha'] == 'badan_usaha' ? 'required' : '',
            'badan_usaha' => $data['bentuk_usaha'] == 'badan_usaha' ? 'required' : '',
            'email_faktur' => $data['bentuk_usaha'] == 'badan_usaha' ? 'required|email' : '',
            'foto_npwp' => $data['update_id'] ? 'mimes:jpg,jpeg,pdf,png' : ($data['bentuk_usaha'] == 'badan_usaha' ? 'required|mimes:jpg,jpeg,pdf,png' : ''),
            'foto_sppkp' => $data['update_id'] ? 'mimes:jpg,jpeg,pdf,png' : ($data['bentuk_usaha'] == 'badan_usaha' ? ($data['status_pkp'] == 'pkp' ? 'required|mimes:jpg,jpeg,pdf,png' : '') : ''),
            'alamat_npwp' => $data['bentuk_usaha'] == 'badan_usaha' ? 'required' : '',
            'kota_npwp' => $data['bentuk_usaha'] == 'badan_usaha' ? 'required' : '',
            'nama_group' => $data['status_kepemilikan'] == 'group' ? 'required' : '',
            'bidang_usaha_lain' => $data['bidang_usaha'] == 'lainnya' ? 'required' : ''
        ];

        $message = [
            'nama_perusahaan.required' => 'Nama perusahaan harus diisi',
            'nama_group_perusahaan.required' => 'Nama group perusahaan harus diisi',
            'alamat_lengkap.required' => 'Alamat lengkap harus diisi',
            'alamat_group_lengkap.required' => 'Alamat Group harus diisi',
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
            'bidang_usaha_lain.required' => 'Bidang usaha harus diisi'
        ];

        return Validator::make($data, $rules, $message);
    }

    public function validationInformasiBank($data)
    {
        $rules = [
            'nomor_rekening' => 'required|numeric|digits_between:10,16',
            'nama_rekening' => 'required',
            'status_rekening' => 'required',
            'nama_bank' => 'required',
            'rekening_lain' => ($data['status_rekening'] == 'lainnya') ? 'required' : '',
        ];

        $message = [
            'nomor_rekening.required' => 'Nomor rekening harus diisi',
            'nomor_rekening.numeric' => 'Nomor rekening harus berupa angka',
            'nomor_rekening.digits_between' => 'Nomor rekening harus diantara 10 - 16 digit',
            'nama_rekening.required' => 'Nama rekening harus diisi',
            'status_rekening.required' => 'Status rekening harus diisi',
            'nama_bank.required' => 'Nama bank harus diisi',
            'rekening_lain.required' => 'Rekening lain wajib diisi',
        ];

        return Validator::make($rules, $message, $data);
    }

    public function validationIdentitas($data)
    {
        $rules = [
            'foto_penanggung' => $data['update_id'] ? 'mimes:jpg,jpeg,pdf,png' : 'required|mimes:jpg,jpeg,pdf,png',
            'nama_penanggung_jawab' => 'required',
            'jabatan' => 'required',
            'identitas_penanggung_jawab' => 'required',
            'nomor_hp_penanggung_jawab' => 'required',
        ];

        $message = [
            'nama_penanggung_jawab.required' => 'Nama penanggung jawab harus diisi',
            'jabatan.required' => 'Jabatan harus diisi',
            'identitas_penanggung_jawab.required' => 'Identitas penanggung jawab harus diisi',
            'foto_penanggung.required' => 'Foto identitas penanggung jawab harus diisi',
            'foto_penanggung.mimes' => 'Format file identitas penanggung jawab harus berupa JPG, PNG, JPEG, atau PDF',
            'nomor_hp_penanggung_jawab.required' => 'Nomor HP penanggung jawab harus diisi',
            'nomor_hp_penanggung_jawab.numeric' => 'Nomor HP penanggung jawab harus berupa angka',
            'nomor_hp_penanggung_jawab.digits_between' => 'Nomor HP penanggung jawab harus diantara 10 - 13 digit',
        ];

        return Validator::make($rules, $message, $data);
    }

    public function validationCabang($data)
    {
        $rules = [
            'nitku_cabang.*' => ($data['bentuk_usaha'] == 'badan_usaha' ? 'required|digits:22' : ''),
            'nama_cabang.*' => ($data['bentuk_usaha'] == 'badan_usaha' ? 'required' : ''),
            'alamat_nitku.*' => ($data['bentuk_usaha'] == 'badan_usaha' ? 'required' : ''),
        ];

        $message = [
            'nitku_cabang.*.required' => 'NITKU harus diisi',
            'nitku_cabang.*.digits' => 'NITKU harus 22 digit',
            'nama_cabang.*.required' => 'Nama cabang harus diisi',
            'alamat_nitku.*.required' => 'Alamat cabang harus diisi',
        ];

        return Validator::make($rules, $message, $data);
    }
}
