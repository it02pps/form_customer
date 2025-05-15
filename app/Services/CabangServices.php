<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Cabang;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;

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
            $validator = $this->validasiServices->validationCabang($request->all());
            if ($validator->fails()) {
                return ['status' => false, 'error' => $validator->errors()->all()];
            }

            if ($request['nitku_cabang'][0] != null) {
                foreach ($request['nitku_cabang'] as $i => $loop_cabang) {
                    Cabang::insert([
                        'identitas_perusahaan_id' => $perusahaan,
                        'nitku' => $request['nitku_cabang'][$i],
                        'nama' => $request['nama_cabang'][$i],
                        'alamat' => $request['alamat_nitku'][$i],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }

            return ['status' => true];
        } catch (\Exception $e) {
            return ['status' => false, 'error' => 'Terjadi kesalahan'];
        }
    }
}
