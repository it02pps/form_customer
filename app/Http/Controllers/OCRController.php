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

            $storedPath = storage_path(
                'app/' . $tempPath
            );

            if (!file_exists($storedPath)) {
                throw new \Exception(
                    'File KTP gagal disimpan.'
                );
            }

            $response = Http::asMultipart()
                ->withHeaders([
                    'Accept' => 'application/json',
                    'API-KEY' => config('services.bos_api.api_key'),
                ])->attach(
                    'photo',
                    file_get_contents($storedPath),
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

    private function clearOCRText(?string $value): ?string {
        if(!$value) {
            return null;
        }

        $value = trim($value);

        $value = preg_replace('/\s+/u', ' ', $value);

        return $value ?: null;
    }

    private function parseNpwpRawText(string $rawText): array {
        $lines = preg_split(
            '/\r\n|\r|\n/',
            strtoupper($rawText)
        );

        $lines = array_map(
            function ($line) {
                $line = trim($line);
                return preg_replace('/\s+/u', ' ', $line);
            },
            $lines
        );

        $lines = array_values(
            array_filter(
                $lines,
                fn ($line) => $line !== ''
            )
        );

        $result = [
            'npwp' => null,
            'name' => null,
            'address' => null,
            'city' => null,
            'npwp16' => null,
            'province' => null,
        ];

        foreach ($lines as $line) {
            if (
                str_starts_with(
                    $line,
                    'KPP '
                )
            ) {
                $result['tax_office'] =
                    $line;

                break;
            }
        }

        foreach ($lines as $line) {
            if (
                preg_match(
                    '/\b(\d{2}\.\d{3}\.\d{3}\.\d-\d{3}\.\d{3})\b/',
                    $line,
                    $match
                )
            ) {
                $result['npwp'] =
                    $match[1];

                break;
            }
        }

        $npwp16Index = null;

        foreach ($lines as $index => $line) {
            if (
                preg_match(
                    '/NPWP\s*16\s*:?\s*([0-9\s.-]{16,25})/i',
                    $line,
                    $match
                )
            ) {
                $digits = preg_replace(
                    '/\D/',
                    '',
                    $match[1]
                );

                if (
                    strlen($digits) === 16
                ) {
                    $result['npwp16'] =
                        $digits;

                    $npwp16Index =
                        $index;

                    break;
                }
            }
        }

        if (!$result['npwp16']) {
            foreach (
                $lines as $index => $line
            ) {
                $digits = preg_replace(
                    '/\D/',
                    '',
                    $line
                );

                if (
                    strlen($digits) === 16
                ) {
                    /*
                     * Hindari kemungkinan tanggal
                     * atau data lain yang tidak relevan.
                     */
                    if (
                        !str_contains(
                            $line,
                            'TANGGAL'
                        )
                    ) {
                        $result['npwp16'] =
                            $digits;

                        $npwp16Index =
                            $index;

                        break;
                    }
                }
            }
        }

        if ($npwp16Index !== null) {
            for (
                $i = $npwp16Index - 1;
                $i >= 0;
                $i--
            ) {
                $line = $lines[$i];

                /*
                 * Skip label/header.
                 */
                if (
                    str_contains(
                        $line,
                        'NPWP'
                    ) ||
                    str_contains(
                        $line,
                        'NPVP'
                    ) ||
                    str_starts_with(
                        $line,
                        'KPP '
                    )
                ) {
                    continue;
                }

                /*
                 * Skip NPWP format lama.
                 */
                if (
                    preg_match(
                        '/\d{2}\.\d{3}\.\d{3}\.\d-\d{3}\.\d{3}/',
                        $line
                    )
                ) {
                    continue;
                }

                /*
                 * Skip baris dominan angka.
                 */
                if (
                    preg_match(
                        '/^\d+$/',
                        preg_replace(
                            '/\s/',
                            '',
                            $line
                        )
                    )
                ) {
                    continue;
                }

                /*
                 * Nama perusahaan boleh mengandung:
                 * PT, CV, UD, angka, dll.
                 *
                 * Jadi jangan pakai rule
                 * "nama tidak boleh ada angka".
                 */
                $result['name'] =
                    $line;

                break;
            }
        }

        if (
            !$result['name'] &&
            $result['npwp']
        ) {
            foreach (
                $lines as $index => $line
            ) {
                if (
                    str_contains(
                        $line,
                        $result['npwp']
                    )
                ) {
                    for (
                        $i = $index + 1;
                        $i < count($lines);
                        $i++
                    ) {
                        $candidate =
                            $lines[$i];

                        if (
                            str_contains(
                                $candidate,
                                'NPWP'
                            )
                        ) {
                            continue;
                        }

                        if (
                            preg_match(
                                '/^(JL\.?|JLN\.?|JALAN)\b/i',
                                $candidate
                            )
                        ) {
                            break;
                        }

                        $result['name'] =
                            $candidate;

                        break;
                    }

                    break;
                }
            }
        }

        foreach (
            $lines as $index => $line
        ) {
            $isAddressStart =
                preg_match(
                    '/^(JL\.?|JLN\.?|JALAN|GG\.?|GANG|KOMP\.?|KOMPLEK)\b/i',
                    $line
                ) ||
                preg_match(
                    '/\bRT[.\s]?\d+/i',
                    $line
                );

            if (!$isAddressStart) {
                continue;
            }

            $addressLines = [
                $line
            ];

            for (
                $i = $index + 1;
                $i < count($lines);
                $i++
            ) {
                $nextLine =
                    $lines[$i];

                /*
                 * Stop saat masuk kota/provinsi.
                 */
                if (
                    preg_match(
                        '/^(KOTA|KABUPATEN|KAB\.?)\s+/i',
                        $nextLine
                    )
                ) {
                    break;
                }

                /*
                 * Stop pada footer.
                 */
                if (
                    str_contains(
                        $nextLine,
                        'TANGGAL TERDAFTAR'
                    ) ||
                    str_contains(
                        $nextLine,
                        'DIREKTORAT JENDERAL'
                    ) ||
                    $nextLine === 'ODJP' ||
                    $nextLine === 'DJP'
                ) {
                    break;
                }

                /*
                 * Stop jika ternyata masuk province.
                 */
                if (
                    $this->containsProvince(
                        $nextLine
                    )
                ) {
                    break;
                }

                $addressLines[] =
                    $nextLine;
            }

            $result['address'] =
                implode(
                    ' ',
                    $addressLines
                );

            break;
        }

        $provinces =
            $this->indonesianProvinces();

        foreach ($lines as $line) {
            foreach (
                $provinces as $province
            ) {
                if (
                    str_contains(
                        $line,
                        $province
                    )
                ) {
                    $result['province'] =
                        $province;

                    break 2;
                }
            }
        }

        foreach ($lines as $line) {
            if (
                preg_match(
                    '/\b(KOTA|KABUPATEN|KAB\.?)\s+(.+)/i',
                    $line,
                    $match
                )
            ) {
                $city = trim(
                    $match[2]
                );

                /*
                 * Kalau province ada dalam
                 * line yang sama, buang province.
                 *
                 * Contoh:
                 *
                 * KOTA PONTIANAK KALIMANTAN BARAT
                 *
                 * menjadi:
                 *
                 * PONTIANAK
                 */
                foreach (
                    $provinces as $province
                ) {
                    $city = trim(
                        str_replace(
                            $province,
                            '',
                            $city
                        )
                    );
                }

                $result['city'] =
                    $city;

                break;
            }
        }

        foreach (
            $result as $key => $value
        ) {
            $result[$key] =
                $this->cleanOcrText(
                    $value
                );
        }

        return $result;
    }

    private function indonesianProvinces(): array
    {
        return [
            'ACEH',

            'SUMATERA UTARA',
            'SUMATERA BARAT',
            'RIAU',
            'KEPULAUAN RIAU',
            'JAMBI',
            'SUMATERA SELATAN',
            'KEPULAUAN BANGKA BELITUNG',
            'BENGKULU',
            'LAMPUNG',

            'DKI JAKARTA',
            'BANTEN',
            'JAWA BARAT',
            'JAWA TENGAH',
            'DI YOGYAKARTA',
            'JAWA TIMUR',

            'BALI',

            'NUSA TENGGARA BARAT',
            'NUSA TENGGARA TIMUR',

            'KALIMANTAN BARAT',
            'KALIMANTAN TENGAH',
            'KALIMANTAN SELATAN',
            'KALIMANTAN TIMUR',
            'KALIMANTAN UTARA',

            'SULAWESI UTARA',
            'GORONTALO',
            'SULAWESI TENGAH',
            'SULAWESI BARAT',
            'SULAWESI SELATAN',
            'SULAWESI TENGGARA',

            'MALUKU',
            'MALUKU UTARA',

            'PAPUA',
            'PAPUA BARAT',
            'PAPUA BARAT DAYA',
            'PAPUA SELATAN',
            'PAPUA TENGAH',
            'PAPUA PEGUNUNGAN',
        ];
    }

    private function containsProvince(
        string $line
    ): bool {
        foreach (
            $this->indonesianProvinces()
            as $province
        ) {
            if (
                str_contains(
                    $line,
                    $province
                )
            ) {
                return true;
            }
        }

        return false;
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

            $storedPath =
                storage_path(
                    'app/' . $tempPath
                );

            if (
                !file_exists(
                    $storedPath
                )
            ) {
                throw new \Exception(
                    'File NPWP gagal disimpan.'
                );
            }

            $imageSize =
                @getimagesize(
                    $storedPath
                );

            if (!$imageSize) {
                throw new \Exception(
                    'File gambar NPWP tidak valid.'
                );
            }

            $width =
                $imageSize[0] ?? 0;

            $height =
                $imageSize[1] ?? 0;

            if (
                $width < 500 ||
                $height < 300
            ) {
                return response()->json([
                    'success' => false,

                    'message' =>
                        "Resolusi gambar terlalu kecil ({$width}x{$height}). Silakan ambil foto lebih dekat dan lebih jelas.",
                ], 422);
            }

            $response = Http::asMultipart()
                ->withHeaders([
                    'Accept' => 'application/json',
                    'API-KEY' => config('services.bos_api.api_key'),
                ])
                ->attach(
                    'photo',
                    file_get_contents($storedPath),
                    $fileName,
                    [
                        'Content-Type' => $imageSize['mime'] ?? 'image/jpeg',
                    ]
                )
                ->post('https://bos-api.com/api/ocr/npwp');

            $result = $response->json();

            Log::info(
                'NPWP OCR RESPONSE',
                [
                    'status' =>
                        $response->status(),

                    'success' =>
                        $result[
                            'success'
                        ] ?? null,

                    'confidence_score' =>
                        $result[
                            'confidence_score'
                        ] ?? null,

                    'document' =>
                        $result[
                            'document'
                        ] ?? null,

                    'data' =>
                        $result[
                            'data'
                        ] ?? null,

                    'raw_text' =>
                        $result[
                            'ocr'
                        ][
                            'raw_text'
                        ] ?? null,
                ]
            );

            if(!($result['success'] ?? false)) {
                return response()->json([
                    'success' => false,
                    'message' => $result['message'] ?? "OCR gagal"
                ], 422);
            }

            $rawText =
                $result[
                    'ocr'
                ][
                    'raw_text'
                ] ?? '';

            $parsed =
                $this
                    ->parseNpwpRawText(
                        $rawText
                    );

            $structured =
                $result['document']
                ?? $result['data']
                ?? [];

            /*
             * RAW parser diutamakan.
             * Structured BOS dipakai
             * hanya kalau parser kosong.
             */
            $npwp =
                $parsed['npwp']
                ?? $structured['npwp']
                ?? null;

            $npwp16 =
                $parsed['npwp16']
                ?? $structured['nik']
                ?? $structured['npwp16']
                ?? null;

            $name =
                $parsed['name']
                ?? $structured['name']
                ?? null;

            $address =
                $parsed['address']
                ?? $structured['address']
                ?? null;

            $city =
                $parsed['city']
                ?? $structured['city']
                ?? null;

            $province =
                $parsed['province']
                ?? $structured['province']
                ?? null;

            $taxOffice =
                $parsed['tax_office']
                ?? $structured[
                    'tax_office'
                ]
                ?? null;

            /*
             * Clean whitespace.
             */
            $npwp =
                $this->cleanOcrText(
                    $npwp
                );

            $npwp16 =
                $this->cleanOcrText(
                    $npwp16
                );

            $name =
                $this->cleanOcrText(
                    $name
                );

            $address =
                $this->cleanOcrText(
                    $address
                );

            $city =
                $this->cleanOcrText(
                    $city
                );

            $province =
                $this->cleanOcrText(
                    $province
                );

            /*
             * Debug final result.
             */
            Log::info(
                'NPWP PARSED RESULT',
                [
                    'raw_parsed' =>
                        $parsed,

                    'structured' =>
                        $structured,

                    'final' => [
                        'npwp' =>
                            $npwp,

                        'npwp16' =>
                            $npwp16,

                        'name' =>
                            $name,

                        'address' =>
                            $address,

                        'city' =>
                            $city,

                        'province' =>
                            $province,

                        'tax_office' =>
                            $taxOffice,
                    ],
                ]
            );
            
            session()->put('ocrData', [
                'photo' => $tempPath,
                'data' => [
                    'no_npwp' => $npwp,
                    'npwp16' => $npwp16,
                    'nama' => $name,
                    'alamat' => $address,
                    'kota' => $city,
                    'province' => $province,
                    'tax_office' => $taxOffice,
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
                'redirect_url' => $url
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
