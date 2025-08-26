<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Cabang;
use Illuminate\Support\Carbon;

class CabangServices
{
    protected $validasiServices;
    protected $perusahaanServices;
    public function __construct(ValidasiServices $validasiServices, PerusahaanServices $perusahaanServices)
    {
        $this->validasiServices = $validasiServices;
        $this->perusahaanServices = $perusahaanServices;
    }

    public function handleCabang(Request $request, $perusahaan)
    {
        try {
            

            

            return ['status' => true];
        } catch (\Exception $e) {
            // dd($e);
            return ['status' => false, 'error' => 'Terjadi kesalahan'];
        }
    }
}
