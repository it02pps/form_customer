<?php

namespace App\Services;

use App\Models\DataIdentitas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Helper\base30ToImage;

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

            if ($request->bentuk_usaha == 'perseorangan') {
                if ($old_perusahaan) {
                    $oldData = DataIdentitas::where('identitas_perusahaan_id', $old_perusahaan)->latest()->first();
                } else {
                    $oldData = '';
                }
            } else {
                if ($old_perusahaan) {
                    $oldData = DataIdentitas::where('identitas_perusahaan_id', $old_perusahaan)->latest()->first();
                } else {
                    $oldData = '';
                }
            }

            // dd($oldData->foto);

            $data = DataIdentitas::create(
                [
                    'identitas_perusahaan_id' => $new_perusahaan,
                    'nama' => $request->nama_penanggung_jawab,
                    'jabatan' => $request->jabatan,
                    'identitas' => $request->identitas_penanggung_jawab,
                    'no_hp' => $request->nomor_hp_penanggung_jawab,
                ]
            );

            if ($request->hasFile('foto_penanggung')) {
                if (File::exists('uploads/penanggung_jawab/' . $data->foto)) {
                    File::delete('uploads/penanggung_jawab/' . $data->foto);
                }

                $foto = $request->file('foto_penanggung');
                $filename = uniqid() . '-' . Str::slug($request->nama_penanggung_jawab, '-') . '.' . $foto->getClientOriginalExtension();
                $foto->storeAs('uploads/penanggung_jawab', $filename, 'custom_path');
                $data->foto = $filename;
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
                    if (!is_dir('uploads/ttd')) {
                        mkdir('uploads/ttd/', 0777, true);
                    }

                    // Nama file untuk menyimpan gambar
                    $imageName = str_replace(' ', '-', $request->nama_penanggung_jawab) . '.png';
                    $filePath = 'uploads/ttd/' . $imageName;

                    // Menyimpan gambar ke storage
                    $fullPath = public_path($filePath);
                    imagepng($img, $fullPath);
                    imagedestroy($img);
                    $data->ttd = $imageName;

                    // // Mengirim gambar ke API
                    // $foto_ttd = fopen($filePath, 'r');
                    // // dd($foto_ttd);
                    // $response = Http::withHeaders([
                    //     'x-api-key' => $this->apiKey,
                    // ])->attach(
                    //     'file',
                    //     $foto_ttd,
                    //     $imageName
                    // )->post($this->apiUrl, [
                    //     'category' => 'sign',
                    //     'filename' => $imageName,
                    // ]);

                    // fclose($foto_ttd);

                    // // dd($response);
                    // if ($response->successful()) {
                    //     $filename = $response->json('filename');
                    //     $filepath = $response->json('filepath');
                    //     $identitas_penanggung_jawab->ttd = $filename;
                    // }
                } else {
                    $data->ttd = $oldData->ttd ? $oldData->ttd : null;
                }
            }

            $data->save();

            return ['status' => true];
        } catch (\Exception $e) {
            return ['status' => false, 'error' => 'Terjadi Kesalahan'];
        }
    }
}
