<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OCRController extends Controller
{
    public function scan_npwp($menu, $status = NULL, $status2 = NULL, $param = NULL) {
        return view("customer.badan_usaha.ocr");
    }

    public function scan_ktp($menu, $status = NULL, $status2 = NULL, $param = NULL) {
        return view("customer.perseorangan.ocr", compact('menu', 'status', 'status2', 'param'));
    }

    public function ktp(Request $request) {
        try {
            $request->validate([
                'photo' => [
                    'required',
                    'file',
                    'mimes:jpg,jpeg,png',
                    'max:5120'
                ],
                'menu' => [
                    'required',
                    'in:badan-usaha,perseorangan'
                ],
                'status' => [
                    'required',
                    'in:customer-baru,customer-lama'
                ],
                'status2' => [
                    'nullable',
                    'in:pengkinian-data,cabang-baru'
                ],
                'param' => [
                    'nullable'
                ],
            ]);

            $menu = $request->menu;
            $status = $request->status;
            $status2 = $request->status2;
            $param = $request->param;
            $file = $request->file("photo");

            $response = Http::asMultipart()
                ->withHeaders([
                    'Accept' => 'application/json',
                    'API-KEY' => config('services.bos_api.api_key'),
                ])->attach(
                    'photo',
                    file_get_contents($file->getRealPath()),
                    $file->getClientOriginalName()
                )->post('https://bos-api.com/api/ocr/ktp');

            $result = $response->json();

            if(!($result['success'] ?? false)) {
                return response()->json([
                    'success' => false,
                    'message' => $result['message'] ?? "OCR gagal"
                ], 422);
            }

            $data = $result['document'] ?? [];

            session()->flash('data', [
                'no_ktp' => $data['nik'] ?? null,
                'nama' => $data['name'] ?? null,
                'alamat' => $data['address'] ?? null,
                'rt_rw' => $data['rt_rw'] ?? null,
                'kelurahan' => $data['village'] ?? null,
                'kecamatan' => $data['district'] ?? null,
                'kota_kabupaten' => $data['city_or_regency'] ?? null,
                'provinsi' => $data['province'] ?? null,
                'jenis_kelamin' => $data['gender'] ?? null,
                'agama' => $data['religion'] ?? null,
                'status_perkawinan' => $data['marital_status'] ?? null,
                'pekerjaan' => $data['occupation'] ?? null,
                'kewarganegaraan' => $data['citizenship'] ?? null,
                'tempat_lahir' => $data['birth_place'] ?? null,
                'tanggal_lahir' => $data['birth_date'] ?? null,
                'confidence_score' => $result['confidence_score'] ?? null,
            ]);

            $url = route('form_customer.view_badan_usaha', [
                'menu' => $request->menu,
                'status' => $request->status,
                'status2' => $request->status2,
                'param' => $request->param,
            ]);

            return response()->json([
                'success' => true,
                'redirect_url' => $url,
            ]);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function npwp(Request $request) {
        try {
            $request->validate([
                'photo' => [
                    'required',
                    'file',
                    'mimes:jpg,jpeg,png',
                    'max:5120'
                ]
            ]);

            $file = $request->file("photo");

            $response = Http::asMultipart()
            ->withHeaders([
                'Accept' => 'application/json',
                'API-KEY' => config('services.bos_api.api_key'),
            ])
            ->attach(
                'photo',
                file_get_contents($file->getRealPath()),
                $file->getClientOriginalName()
            )
            ->post('https://bos-api.com/api/ocr/npwp');

            $result = $response->json();

            if(!($result['success'] ?? false)) {
                return response()->json([
                    'success' => false,
                    'message' => $result['message'] ?? "OCR gagal"
                ], 422);
            }

            $data = $result['document'] ?? [];

            return response()->json([
                'success' => true,
                'data' => [
                    'no_npwp' => $data['npwp'] ?? null,
                    'nama' => $data['name'] ?? null,
                    'alamat' => $data['address'] ?? null,
                ]
            ]);
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
