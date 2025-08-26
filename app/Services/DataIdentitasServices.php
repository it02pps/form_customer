<?php

namespace App\Services;


use App\Models\IdentitasPerusahaan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;

class DataIdentitasServices
{
    protected $validasiServices;
    protected $perusahaanServices;
    public function __construct(ValidasiServices $validasiServices)
    {
        $this->validasiServices = $validasiServices;
    }

    public function handleFormIdentitas($request, $new_perusahaan, $old_perusahaan)
    {
        try {
            set_time_limit(120);



            if ($old_perusahaan) {
                $oldDataPenanggung = IdentitasPerusahaan::with('data_identitas')->where(function ($query) use ($old_perusahaan) {
                    $query->where('nomor_ktp', Crypt::decryptString($old_perusahaan));
                    $query->orWhere('nomor_npwp', Crypt::decryptString($old_perusahaan));
                })->latest()->select('');
            } else {
                $oldDataPenanggung = '';
            }

            // dd($old_perusahaan, $oldDataPenanggung);



            // $data->save();

            return ['status' => true];
        } catch (\Exception $e) {
            dd($e);
            return ['status' => false, 'error' => 'Terjadi Kesalahan'];
        }
    }
}
