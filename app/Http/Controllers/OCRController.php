<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OCRController extends Controller
{
    public function scan_npwp($menu, $status = NULL, $status2 = NULL, $param = NULL) {
        return view("customer.badan_usaha.ocr", compact('menu', 'status', 'status2', 'param'));
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

            $extension = $file->getClientOriginalExtension();
            $fileName = Str::uuid() . '.' . $extension;
            $tempPath = $file->storeAs(
                'temp/ktp',
                $fileName
            );

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

            session()->put('ocrData', [
                'photo' => $tempPath,
                'data' => [
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
                    'confidence_score' => $result['confidence_score'] ?? null
                ],
                'created_at' => now()->timestamp
            ]);
            
            $url = route('form_customer.view_badan_usaha', [
                'menu' => $menu,
                'status' => $status,
                'status2' => $status2,
                'param' => $param,
            ]);

            return response()->json([
                'success' => true,
                'redirect_url' => $url,
            ]);
        } catch (\Exception $e) {
            Log::error('OCR KTP Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function parseNpwpRawText(string $rawText): array
    {
        $lines = array_values(array_filter(
            array_map('trim', preg_split('/\r\n|\r|\n/', strtoupper($rawText)))
        ));

        $result = [
            'npwp' => null,
            'name' => null,
            'address' => null,
            'city' => null,
            'npwp16' => null,
            'province' => null,
        ];

        /*
        * NPWP
        *
        * Contoh:
        * 12.345.678.9-012.345
        * 123456789012345
        * NPWP16 123456789123456
        */

        foreach ($lines as $line) {
            if (preg_match('/\b(\d{16})\b/', $line, $match)) {
                $result['npwp'] = $match[1];
                $result['npwp16'] = $match[1];
                break;
            }

            if (preg_match(
                '/\b(\d{2}\.\d{3}\.\d{3}\.\d-\d{3}\.\d{3})\b/',
                $line,
                $match
            )) {
                $result['npwp'] = $match[1];
                break;
            }
        }

        /*
        * Cari posisi NPWP.
        * Nama biasanya berada setelah nomor NPWP.
        */

        $npwpIndex = null;

        foreach ($lines as $index => $line) {
            if (
                preg_match('/\d{16}/', $line) ||
                preg_match('/\d{2}\.\d{3}\.\d{3}\.\d-\d{3}\.\d{3}/', $line)
            ) {
                $npwpIndex = $index;
                break;
            }
        }

        if ($npwpIndex !== null) {
            for ($i = $npwpIndex + 1; $i < count($lines); $i++) {
                $line = $lines[$i];

                if (
                    str_contains($line, 'NPWP16') ||
                    str_contains($line, 'JL.') ||
                    str_contains($line, 'JALAN') ||
                    str_contains($line, 'RT.') ||
                    str_contains($line, 'RW.')
                ) {
                    continue;
                }

                if (
                    preg_match('/\b(KOTA|KABUPATEN|KAB\.)\b/', $line) ||
                    preg_match('/\b(KALIMANTAN|JAWA|SUMATERA|SULAWESI|PAPUA|BALI)\b/', $line)
                ) {
                    continue;
                }

                $result['name'] = $line;
                break;
            }
        }

        /*
        * Address
        */

        foreach ($lines as $index => $line) {
            if (
                preg_match('/^(JL\.|JLN\.|JALAN)\b/', $line) ||
                preg_match('/\bRT[.\s]?\d+/i', $line)
            ) {
                $addressLines = [$line];

                // Ambil baris berikutnya selama belum masuk wilayah kota/provinsi
                for ($i = $index + 1; $i < count($lines); $i++) {
                    $nextLine = $lines[$i];

                    if (
                        str_contains($nextLine, 'KOTA ') ||
                        str_contains($nextLine, 'KABUPATEN ') ||
                        str_contains($nextLine, 'KALIMANTAN ') ||
                        str_contains($nextLine, 'JAWA ') ||
                        str_contains($nextLine, 'SUMATERA ')
                    ) {
                        break;
                    }

                    if (
                        str_contains($nextLine, 'TANGGAL TERDAFTAR') ||
                        $nextLine === 'ODJP'
                    ) {
                        break;
                    }

                    $addressLines[] = $nextLine;
                }

                $result['address'] = implode(' ', $addressLines);
                break;
            }
        }

        /*
        * City / Regency
        */

        foreach ($lines as $line) {
            if (preg_match(
                '/\b(KOTA|KABUPATEN|KAB\.)\s+([A-Z\s]+?)(?=\s+(KALIMANTAN|JAWA|SUMATERA|SULAWESI|PAPUA|BALI)\b|$)/i',
                $line,
                $match
            )) {
                $result['city'] = trim($match[2]);
                break;
            }
        }

        /*
        * Province
        */

        foreach ($lines as $line) {
            if (preg_match(
                '/\b(KALIMANTAN\s+(?:BARAT|TIMUR|TENGAH|SELATAN|UTARA)|JAWA\s+(?:BARAT|TIMUR|TENGAH)|SUMATERA\s+(?:BARAT|UTARA|SELATAN)|SULAWESI\s+(?:SELATAN|UTARA|TENGGARA|TENGAH))\b/i',
                $line,
                $match
            )) {
                $result['province'] = trim($match[1]);
                break;
            }
        }

        return $result;
    }

    public function npwp(Request $request) {
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

            $extension = $file->getClientOriginalExtension();
            $fileName = Str::uuid() . '.' . $extension;
            $tempPath = $file->storeAs(
                'temp/npwp',
                $fileName
            );

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
            $rawText = $result['ocr']['raw_text'] ?? '';
            $parsed = $this->parseNpwpRawText($rawText);

            if(!($result['success'] ?? false)) {
                return response()->json([
                    'success' => false,
                    'message' => $result['message'] ?? "OCR gagal"
                ], 422);
            }

            $data = $parsed ?? [];

            Log::info("Data : ", [
                'parsedData' => $parsed,
                'datas' => $data
            ]);
            
            session()->put('ocrData', [
                'photo' => $tempPath,
                'data' => [
                    'no_npwp' => $data['npwp'] ?? null,
                    'nama' => $data['name'] ?? null,
                    'alamat' => $data['address'] ?? null,
                    'kota' => $data['city'] ?? null,
                    'npwp16' => $data['npwp16'] ?? null,
                    // 'tax_office' => $data['tax_office'] ?? null,
                    'confidence_score' => $result['confidence_score'] ?? null
                ],
                'created_at' => now()->timestamp
            ]);
            
            // $url = route('form_customer.view_badan_usaha', [
            //     'menu' => $menu,
            //     'status' => $status,
            //     'status2' => $status2,
            //     'param' => $param,
            // ]);

            return response()->json([
                'success' => true,
                'redirect_url' => $url ?? ''
            ]);
        } catch (\Exception $e) {
            Log::error('OCR NPWP Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
