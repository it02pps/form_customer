<?php

namespace App\Services;

use App\Models\DataIdentitas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Helper\base30ToImage;
use Carbon\Carbon;
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
            $validator = $this->validasiServices->validationIdentitas($request->all());
            if ($validator->fails()) {
                return ['status' => false, 'error' => $validator->errors()->all()];
            }

            if ($old_perusahaan) {
                $oldDataPenanggung = DataIdentitas::where('identitas_perusahaan_id', $old_perusahaan)->latest()->first();
            } else {
                $oldDataPenanggung = '';
            }

            if ($request->bentuk_usaha == 'perseorangan') {
                $oldData = $oldDataPenanggung;
            } else {
                $oldData = $oldDataPenanggung;
            }

            $data = DataIdentitas::create(
                [
                    'identitas_perusahaan_id' => $new_perusahaan,
                    'nama' => strtoupper($request->nama_penanggung_jawab),
                    'jabatan' => strtoupper($request->jabatan),
                    'identitas' => $request->identitas_penanggung_jawab,
                    'no_hp' => $request->nomor_hp_penanggung_jawab,
                    'created_at' => Carbon::now()
                ]
            );

            if ($request->hasFile('foto_penanggung')) {
                $foto = $request->file('foto_penanggung');
                $filename = uniqid() . '-PIC-' . strtoupper($request->identitas_penanggung_jawab) . '-' . Str::slug($request->nama_penanggung_jawab, '-') . '.' . $foto->getClientOriginalExtension();

                $response = Http::withHeaders([
                    'x-api-key' => config('services.service_x.api_key'),
                    'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                ])->get(config('services.service_x.url') . '/api/checkfile', [
                    'category' => 'FileIDPersonCharge',
                    'filename' => $data->foto
                ]);

                $result = $response->json();
                if ($result['status'] == true) {
                    $category = 'FileIDPersonCharge';
                    $response = Http::withHeaders([
                        'x-api-key' => config('services.service_x.api_key'),
                        'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                    ])->delete(config('services.service_x.url') . "/api/deletefile/$category/$data->foto", []);
                    $result = $response->json();
                }

                $data->foto = $filename;
                $response = Http::withHeaders([
                    'x-api-key' => config('services.service_x.api_key'),
                    'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                ])->attach(
                    'file',
                    file_get_contents($foto->getRealPath()),
                    $filename
                )->post(config('services.service_x.url') . '/api/uploadfile', [
                    'category' => 'FileIDPersonCharge',
                    'filename' => substr($filename, 0, strrpos($filename, '.'))
                ]);
            } else {
                $data->foto = $oldData->foto;
            }

            if ($request->bentuk_usaha == 'perseorangan') {
                if ($request->hasil_ttd) {
                    // Konversi base30 menjadi koordinat asli
                    $JSignatureTools = new base30ToImage;
                    $rawData = $JSignatureTools->base64ToNative($request->hasil_ttd);

                    // Membuat canvas gambar
                    $img = imagecreatetruecolor(592, 271);
                    $white = imagecolorallocate($img, 255, 255, 255);
                    $black = imagecolorallocate($img, 0, 0, 0);
                    imagefill($img, 0, 0, $white);

                    // Membuat fungsi untuk menggambar garis yang lebih tebal (bold)
                    function drawBoldLine($image, $x1, $y1, $x2, $y2, $penColor, $thickness = 3)
                    {
                        // Loop untuk menggambar garis dengan ketebalan
                        for ($i = -$thickness; $i <= $thickness; $i++) {
                            for ($j = -$thickness; $j <= $thickness; $j++) {
                                imageline($image, $x1 + $i, $y1 + $j, $x2 + $i, $y2 + $j, $penColor);
                            }
                        }
                    }

                    // Menggambar tanda tangan ke canvas
                    foreach ($rawData as $stroke) {
                        for ($i = 0; $i < count($stroke['x']); $i++) {
                            if ($i > 0) {
                                drawBoldLine(
                                    $img,
                                    $stroke['x'][$i - 1],
                                    $stroke['y'][$i - 1],
                                    $stroke['x'][$i],
                                    $stroke['y'][$i],
                                    $black,
                                    0.5 // ketebalan garis
                                );
                            }
                        }
                    }

                    // Nama file untuk menyimpan gambar
                    $imageName = uniqid() . '-TTD-' . str_replace(' ', '-', $request->nama_penanggung_jawab) . '.png';

                    ob_start();
                    imagepng($img);
                    $imageBinary = ob_get_clean();
                    imagedestroy($img);
                    $response = Http::withHeaders([
                        'x-api-key' => config('services.service_x.api_key'),
                        'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                    ])->get(config('services.service_x.url') . '/api/checkfile', [
                        'category' => 'FileIDSignature',
                        'filename' => $data->ttd
                    ]);

                    $result = $response->json();
                    if ($result['status'] == true) {
                        $category = 'FileIDSignature';
                        $response = Http::withHeaders([
                            'x-api-key' => config('services.service_x.api_key'),
                            'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                        ])->delete(config('services.service_x.url') . "/api/deletefile/$category/$data->ttd", []);
                        $result = $response->json();
                    }

                    $data->ttd = $imageName;
                    $response = Http::withHeaders([
                        'x-api-key' => config('services.service_x.api_key'),
                        'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                    ])->attach(
                        'file',
                        $imageBinary,
                        $imageName
                    )->post(config('services.service_x.url') . '/api/uploadfile', [
                        'category' => 'FileIDSignature',
                        'filename' => substr($imageName, 0, strrpos($imageName, '.'))
                    ]);
                } else {
                    return ['status' => false, 'error' => 'Tanda Tangan tidak boleh kosong'];
                }
            }

            $data->save();

            return ['status' => true];
        } catch (\Exception $e) {
            // dd($e);
            return ['status' => false, 'error' => 'Terjadi Kesalahan'];
        }
    }
}
