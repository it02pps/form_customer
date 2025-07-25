<?php

namespace App\Services;

use App\Models\IdentitasPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class perusahaanServices
{
    protected $validasiServices;
    public function __construct(ValidasiServices $validasiServices)
    {
        $this->validasiServices = $validasiServices;
    }

    public function handleFormPerusahaan(Request $request)
    {
        // dd($request->all(), Crypt::decryptString($request->update_id));
        try {
            $validator = $this->validasiServices->validationPerusahaan($request->all());
            if ($validator->fails()) {
                return ['status' => false, 'error' => $validator->errors()->all()];
            }

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

            // Non-aktif old customer
            if ($request->bentuk_usaha == 'perseorangan') {
                if ($request->update_id) {
                    if ($request->opsi == 'pengkinian_data') {
                        $update = IdentitasPerusahaan::where('nomor_ktp', Crypt::decryptString($request->update_id));
                        $update->update(['status_aktif' => '0']);
                        $oldData = $update->latest()->first();
                    } else {
                        $oldData = IdentitasPerusahaan::where('nomor_ktp', Crypt::decryptString($request->update_id))->latest()->first();
                    }
                } else {
                    $oldData = '';
                }
            } else {
                if ($request->update_id) {
                    if ($request->opsi == 'pengkinian_data') {
                        $update = IdentitasPerusahaan::where('nomor_npwp', Crypt::decryptString($request->update_id));
                        $update->update(['status_aktif' => '0']);
                        $oldData = $update->latest()->first();
                    } else {
                        $oldData = IdentitasPerusahaan::where('nomor_npwp', Crypt::decryptString($request->update_id))->latest()->first();
                    }
                } else {
                    $oldData = '';
                }
            }

            // Store data
            $data = IdentitasPerusahaan::create(
                [
                    'kode_customer' => $kode_cust,
                    'nama_perusahaan' => $request->nama_perusahaan,
                    'nama_group_perusahaan' => $request->nama_group_perusahaan,
                    'alamat_lengkap' => $request->alamat_lengkap,
                    'alamat_group_lengkap' => $request->alamat_group_lengkap,
                    'kota_kabupaten' => $request->kota_kabupaten,
                    'alamat_email' => $request->alamat_email_perusahaan,
                    'nomor_handphone' => $request->no_hp,
                    'tahun_berdiri' => $request->tahun_berdiri,
                    'lama_usaha' => $request->lama_usaha,
                    'bidang_usaha' => $request->bidang_usaha,
                    'bidang_usaha_lain' => $request->bidang_usaha == 'lainnya' ? $request->bidang_usaha_lain : null,
                    'status_kepemilikan' => $request->status_kepemilikan,
                    'nama_group' => $request->status_kepemilikan == 'group' ? $request->nama_group : null,
                    'nama_sales' => $request->sales,
                    'status_aktif' => '1',
                    'bentuk_usaha' => $request->bentuk_usaha,
                    'identitas' => $request->bentuk_usaha == 'perseorangan' ? 'ktp' : 'npwp',

                    // Perseorangan
                    'nomor_ktp' => $request->bentuk_usaha == 'perseorangan' ? $request->nomor_ktp : null,
                    'nama_lengkap' => $request->bentuk_usaha == 'perseorangan' ? $request->nama_lengkap : null,
                    'alamat_ktp' => $request->bentuk_usaha == 'perseorangan' ? $request->alamat_ktp : null,

                    // Badan Usaha
                    'nomor_npwp' => $request->bentuk_usaha == 'badan_usaha' ? $request->nomor_npwp : null,
                    'nama_npwp' => $request->bentuk_usaha == 'badan_usaha' ? $request->nama_npwp : null,
                    'badan_usaha' => $request->bentuk_usaha == 'badan_usaha' ? $request->badan_usaha : null,
                    'email_khusus_faktur_pajak' => $request->bentuk_usaha == 'badan_usaha' ? $request->email_faktur : null,
                    'nomor_whatsapp' => $request->bentuk_usaha == 'badan_usaha' ? $request->no_wa : null,
                    'status_pkp' => $request->bentuk_usaha == 'badan_usaha' ? $request->status_pkp : null,
                    'alamat_npwp' => $request->bentuk_usaha == 'badan_usaha' ? $request->alamat_npwp : null,
                    'kota_npwp' => $request->bentuk_usaha == 'badan_usaha' ? $request->kota_npwp : null,
                    'badan_usaha_lain' => $request->bentuk_usaha == 'badan_usaha' ? ($request->badan_usaha == 'lainnya' ? $request->badan_usaha_lain : null) : '',
                ]
            );

            // Store image
            if ($request->bentuk_usaha == 'perseorangan') {
                if ($request->hasFile('foto_ktp')) {
                    $foto = $request->file('foto_ktp');
                    $filename = uniqid() . '-KTP-' . Str::slug($request->nama_lengkap, '-') . '.' . $foto->getClientOriginalExtension();
                    // $foto->storeAs('uploads/identitas_perusahaan', $filename, 'custom_path');

                    $response = Http::withHeaders([
                        'x-api-key' => config('services.service_x.api_key'),
                        'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                    ])->get(config('services.service_x.url') . '/api/checkfile', [
                        'category' => 'FileIDCompanyOrPersonal',
                        'filename' => $data->foto_ktp
                    ]);

                    $result = $response->json();
                    if ($result['status'] == true) {
                        $category = 'FileIDCompanyOrPersonal';
                        $response = Http::withHeaders([
                            'x-api-key' => config('services.service_x.api_key'),
                            'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                        ])->delete(config('services.service_x.url') . "/api/deletefile/$category/$data->foto_ktp", []);
                        $result = $response->json();
                    }

                    $data->foto_ktp = $filename;
                    $response = Http::withHeaders([
                        'x-api-key' => config('services.service_x.api_key'),
                        'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                    ])->attach(
                        'file',
                        file_get_contents($foto->getRealPath()),
                        $filename
                    )->post(config('services.service_x.url') . '/api/uploadfile', [
                        'category' => 'FileIDCompanyOrPersonal',
                        'filename' => substr($filename, 0, strrpos($filename, '.'))
                    ]);
                } else {
                    $data->foto_ktp = $oldData->foto_ktp;
                }
            } else {
                if ($request->hasFile('foto_npwp')) {
                    $foto = $request->file('foto_npwp');
                    $filename = uniqid() . '-NPWP-' . Str::slug($request->nama_npwp, '-') . '.' . $foto->getClientOriginalExtension();
                    // $foto->storeAs('uploads/identitas_perusahaan', $filename, 'custom_path');

                    $response = Http::withHeaders([
                        'x-api-key' => config('services.service_x.api_key'),
                        'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                    ])->get(config('services.service_x.url') . '/api/checkfile', [
                        'category' => 'FileIDCompanyOrPersonal',
                        'filename' => $data->foto_npwp
                    ]);

                    $result = $response->json();
                    if ($result['status'] == true) {
                        $category = 'FileIDCompanyOrPersonal';
                        $response = Http::withHeaders([
                            'x-api-key' => config('services.service_x.api_key'),
                            'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                        ])->delete(config('services.service_x.url') . "/api/deletefile/$category/$data->foto_npwp", []);
                        $result = $response->json();
                    }

                    $data->foto_npwp = $filename;
                    $response = Http::withHeaders([
                        'x-api-key' => config('services.service_x.api_key'),
                        'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                    ])->attach(
                        'file',
                        file_get_contents($foto->getRealPath()),
                        $filename
                    )->post(config('services.service_x.url') . '/api/uploadfile', [
                        'category' => 'FileIDCompanyOrPersonal',
                        'filename' => substr($filename, 0, strrpos($filename, '.'))
                    ]);
                } else {
                    $data->foto_npwp = $oldData->foto_npwp;
                }

                if ($request->status_pkp == 'pkp') {
                    if ($request->hasFile('foto_sppkp')) {
                        $foto = $request->file('foto_sppkp');
                        $filename = uniqid() . '-SPPKP-' . Str::slug($request->nama_npwp, '-') . '.' . $foto->getClientOriginalExtension();
                        // $foto->storeAs('uploads/identitas_perusahaan', $filename, 'custom_path');

                        $response = Http::withHeaders([
                            'x-api-key' => config('services.service_x.api_key'),
                            'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                        ])->get(config('services.service_x.url') . '/api/checkfile', [
                            'category' => 'FileSPPKPCompany',
                            'filename' => $data->sppkp
                        ]);

                        $result = $response->json();
                        if ($result['status'] == true) {
                            $category = 'FileSPPKPCompany';
                            $response = Http::withHeaders([
                                'x-api-key' => config('services.service_x.api_key'),
                                'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                            ])->delete(config('services.service_x.url') . "/api/deletefile/$category/$data->sppkp", []);
                            $result = $response->json();
                        }

                        $data->sppkp = $filename;
                        $response = Http::withHeaders([
                            'x-api-key' => config('services.service_x.api_key'),
                            'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                        ])->attach(
                            'file',
                            file_get_contents($foto->getRealPath()),
                            $filename
                        )->post(config('services.service_x.url') . '/api/uploadfile', [
                            'category' => 'FileSPPKPCompany',
                            'filename' => substr($filename, 0, strrpos($filename, '.'))
                        ]);
                    } else {
                        $data->sppkp = $oldData->sppkp;
                    }
                }
            }
            $data->save();

            $link = route('form_customer.detail', ['menu' => str_replace('_', '-', $request->bentuk_usaha), 'id' => Crypt::encryptString($data->id)]);
            return ['status' => true, 'link' => $link, 'new_data' => $data->id, 'old_data' => ($data->bentuk_usaha == 'perseorangan' ? ($request->update_id ? $oldData->id : '') : '')];
        } catch (\Exception $e) {
            // dd($e);
            return ['status' => false, 'error' => 'Terjadi Kesalahaan'];
        }
    }
}
