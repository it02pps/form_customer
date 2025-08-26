<?php

namespace App\Services;

use App\Models\InformasiBank;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InformasiBankServices
{
    protected $validasiServices;
    public function __construct(ValidasiServices $validasiServices)
    {
        $this->validasiServices = $validasiServices;
    }

    public function handleFormInformasiBank(Request $request, $perusahaan)
    {
        try {
            

            

            return ['status' => true];
        } catch (\Exception $e) {
            // dd($e);
            return ['status' => false, 'error' => 'Terjadi Kesalahaan'];
        }
    }
}
