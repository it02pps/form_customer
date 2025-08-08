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
            $validator = $this->validasiServices->validationInformasiBank($request->all());
            if ($validator->fails()) {
                return ['status' => false, 'error' => $validator->errors()->all()];
            }

            InformasiBank::updateOrCreate(
                ['identitas_perusahaan_id' => $perusahaan],
                [
                    'nomor_rekening' => $request->nomor_rekening,
                    'nama_rekening' => $request->nama_rekening,
                    'status' => $request->status_rekening,
                    'nama_bank' => $request->nama_bank,
                    'rekening_lain' => $request->status_rekening == 'lainnya' ? $request->rekening_lain : null,
                    'created_at' => Carbon::now()
                ]
            );

            return ['status' => true];
        } catch (\Exception $e) {
            // dd($e);
            return ['status' => false, 'error' => 'Terjadi Kesalahaan'];
        }
    }
}
