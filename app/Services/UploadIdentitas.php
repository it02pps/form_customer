<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class UploadIdentitas
{
    public static function handleUpload($filename, $oldData, $tempPath, $id)
    {
        $content = fopen($tempPath, 'rb');

        $response = Http::withHeaders([
            'x-api-key' => config('services.service_v.api_key'),
        ])->get(config('services.service_v.url') . '/api/checkfile', [
            'category' => 'FileIDPersonCharge',
            'filename' => $oldData ? $oldData : ''
        ]);

        if ($response->ok()) {
            $category = 'FileIDPersonCharge';
            $response = Http::withHeaders([
                'x-api-key' => config('services.service_v.api_key'),
            ])->delete(config('services.service_v.url') . "/api/deletefile/$category/$oldData", []);
        }

        rewind($content);

        // $identitas_penanggung->tempPath = $filename;
        $response = Http::withHeaders([
            'x-api-key' => config('services.service_v.api_key'),
        ])->attach(
            'file',
            $content,
            $filename
        )->post(config('services.service_v.url') . '/api/uploadfile', [
            'category' => 'FileIDPersonCharge',
            'filename' => substr($filename, 0, strrpos($filename, '.'))
        ]);

        fclose($content);
        if ($response->ok()) {
            DB::table('data_identitas')->where('identitas_perusahaan_id', $id)->update(['status_upload_foto' => 'success']);
            @unlink($tempPath);
        } else {
            DB::table('data_identitas')->where('identitas_perusahaan_id', $id)->update(['status_upload_foto' => 'failed']);
        }
    }
}