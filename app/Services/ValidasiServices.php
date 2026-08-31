<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class ValidasiServices
{
    public function validationPerusahaan($data, $hasOcrPhoto = false)
    {
        $bentukUsaha = $data['bentuk_usaha'] ?? null;
        $statusKepemilikan = $data['status_kepemilikan'] ?? null;
        $bidangUsaha = $data['bidang_usaha'] ?? null;
        $badanUsaha = $data['badan_usaha'] ?? null;
        $statusPkp = $data['status_pkp'] ?? null;
        $isUpdate = !empty($data['update_id']);

        $isPerseorangan = $bentukUsaha === 'perseorangan';
        $isBadanUsaha = $bentukUsaha === 'badan_usaha';

        if ($isPerseorangan) {
            if ($isUpdate || $hasOcrPhoto) {
                $fotoKtpRule = 'nullable|mimes:jpg,jpeg,pdf,png';
            } else {
                $fotoKtpRule = 'required|mimes:jpg,jpeg,pdf,png';
            }
        } else {
            $fotoKtpRule = '';
        }

        if ($isBadanUsaha) {
            if ($isUpdate || $hasOcrPhoto) {
                $fotoNpwpRule = 'nullable|mimes:jpg,jpeg,pdf,png';
            } else {
                $fotoNpwpRule = 'required|mimes:jpg,jpeg,pdf,png';
            }

        } else {
            $fotoNpwpRule = '';
        }

        if ($isBadanUsaha && $statusPkp === 'pkp') {
            if ($isUpdate) {
                $fotoSppkpRule = 'nullable|mimes:jpg,jpeg,pdf,png';
            } else {
                $fotoSppkpRule = 'required|mimes:jpg,jpeg,pdf,png';
            }
        } else {
            $fotoSppkpRule = '';
        }

        $rules = [
            'nama_group_perusahaan' => 'required',
            'alamat_group_lengkap' => 'required',
            'kota_kabupaten' => 'required',
            'no_hp' => 'required',
            'bidang_usaha' => 'required',
            'alamat_email_perusahaan' =>
                !empty($data['alamat_email_perusahaan'])
                    && $data['alamat_email_perusahaan'] !== '-'
                        ? 'email'
                        : '',
            'status_kepemilikan' => 'required',
            'nama_group' =>
                $statusKepemilikan === 'group'
                    ? 'required'
                    : '',
            'bidang_usaha_lain' =>
                $bidangUsaha === 'lainnya'
                    ? 'required'
                    : '',

            'nama_lengkap' =>
                $isPerseorangan
                    ? 'required'
                    : '',
            'nomor_ktp' =>
                $isPerseorangan
                    ? 'required|numeric|digits:16'
                    : '',
            'foto_ktp' => $fotoKtpRule,

            'nomor_npwp' =>
                $isBadanUsaha
                    ? 'required'
                    : '',
            'nama_npwp' =>
                $isBadanUsaha
                    ? 'required'
                    : '',
            'badan_usaha' =>
                $isBadanUsaha
                    ? 'required'
                    : '',
            'badan_usaha_lain' =>
                $isBadanUsaha && $badanUsaha === 'lainnya'
                    ? 'required'
                    : '',
            'foto_npwp' => $fotoNpwpRule,
            'foto_sppkp' => $fotoSppkpRule,
            'alamat_npwp' =>
                $isBadanUsaha
                    ? 'required'
                    : '',
            'kota_npwp' =>
                $isBadanUsaha
                    ? 'required'
                    : '',
        ];

        $message = [
            'nama_group_perusahaan.required' =>
                'Nama group perusahaan harus diisi',
            'alamat_group_lengkap.required' =>
                'Alamat Group harus diisi',
            'kota_kabupaten.required' =>
                'Kota/Kabupaten harus diisi',
            'no_hp.required' =>
                'Nomor handphone harus diisi',
            'bidang_usaha.required' =>
                'Bidang usaha harus diisi',
            'alamat_email_perusahaan.email' =>
                'Format email tidak valid',
            'status_kepemilikan.required' =>
                'Status kepemilikan harus diisi',
            'nama_group.required' =>
                'Nama group harus diisi',
            'bidang_usaha_lain.required' =>
                'Bidang usaha lain harus diisi',

            'nama_lengkap.required' =>
                'Nama lengkap harus diisi',

            'nomor_ktp.required' =>
                'Nomor KTP harus diisi',
            'nomor_ktp.numeric' =>
                'Nomor KTP harus berupa angka',
            'nomor_ktp.digits' =>
                'Nomor KTP harus 16 digit',
            'foto_ktp.required' =>
                'Foto KTP harus diisi',
            'foto_ktp.mimes' =>
                'Format file KTP harus berupa JPG, PNG, JPEG, atau PDF',

            'nomor_npwp.required' =>
                'Nomor NPWP harus diisi',
            'nomor_npwp.digits_between' =>
                'Nomor NPWP harus diantara 15 - 16 digit',
            'nama_npwp.required' =>
                'Nama NPWP harus diisi',
            'badan_usaha.required' =>
                'Badan usaha harus diisi',
            'badan_usaha_lain.required' =>
                'Badan usaha lain harus diisi',
            'foto_npwp.required' =>
                'Foto NPWP harus diisi',
            'foto_npwp.mimes' =>
                'Format file NPWP harus berupa JPG, PNG, JPEG, atau PDF',
            'foto_sppkp.required' =>
                'Foto SPPKP harus diisi',
            'foto_sppkp.mimes' =>
                'Format file SPPKP harus berupa JPG, PNG, JPEG, atau PDF',
            'alamat_npwp.required' =>
                'Alamat NPWP harus diisi',  
            'kota_npwp.required' =>
                'Kota NPWP harus diisi',
        ];

        return Validator::make($data, $rules, $message);
    }

    public function validationInformasiBank($data)
    {
        $rules = [
            'nomor_rekening' => 'required|numeric',
            'nama_rekening' => 'required',
            'status_rekening' => 'required',
            'nama_bank' => 'required',
            'rekening_lain' => ($data['status_rekening'] == 'lainnya') ? 'required' : '',
        ];

        $message = [
            'nomor_rekening.required' => 'Nomor rekening harus diisi',
            'nomor_rekening.numeric' => 'Nomor rekening harus berupa angka',
            'nama_rekening.required' => 'Nama rekening harus diisi',
            'status_rekening.required' => 'Status rekening harus diisi',
            'nama_bank.required' => 'Nama bank harus diisi',
            'rekening_lain.required' => 'Rekening lain wajib diisi',
        ];

        return Validator::make($data, $rules, $message);
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

        return Validator::make($data, $rules, $message);
    }

    public function validationCabang($data)
    {
        $rules = [];

        if(($data['bentuk_usaha'] ?? null) === 'badan_usaha') {
            $rules = [
                'nitku_cabang' => "required|array|min:1",
                'nitku_cabang.*' => 'required|digits:22',
                'nama_cabang.*' => 'required',
                'alamat_nitku.*' => 'required',
            ];
        }

        $message = [
            'nitku_cabang.required' => 'NITKU harus diisi',
            'nitku_cabang.min' => 'Minimal 1 cabang harus diisi',
            'nitku_cabang.*.required' => 'NITKU harus diisi',
            'nitku_cabang.*.digits' => 'NITKU harus 22 digit',
            'nama_cabang.*.required' => 'Nama cabang harus diisi',
            'alamat_nitku.*.required' => 'Alamat cabang harus diisi',
        ];

        return Validator::make($data, $rules, $message);
    }

    public function validationDataFinance($data)
    {
        $rules = [
            'nama_finance' => 'required',
            'no_hp_finance' => 'required',
            'email_finance' => $data['email_finance'] != '' ? ($data['email_finance'] != '-' ? 'required|email' : 'required') : 'required',
        ];

        $message = [
            'nama_finance.required' => "Nama finance harus diisi",
            'no_hp_finance.required' => "No HP finance harus diisi",
            'email_finance.required' => "Email finance harus diisi",
            'email_finance.email' => "Email finance harus diisi",
        ];

        return Validator::make($data, $rules, $message);
    }
}
