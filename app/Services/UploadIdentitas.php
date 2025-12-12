<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class UploadIdentitas
{
    public static function handleUpload($filename, $oldData, $tempPath, $id)
    {
        $content = file_get_contents($tempPath);

        $response = Http::withHeaders([
            'x-api-key' => config('services.service_v.api_key'),
            'Host' => parse_url(config('services.service_v.url'), PHP_URL_HOST)
        ])->get(config('services.service_v.url') . '/api/checkfile', [
            'category' => 'FileIDPersonCharge',
            'filename' => $oldData ? $oldData : ''
        ]);

        $result = $response->json();
        if ($result['status'] == true) {
            $category = 'FileIDPersonCharge';
            $response = Http::withHeaders([
                'x-api-key' => config('services.service_v.api_key'),
                'Host' => parse_url(config('services.service_v.url'), PHP_URL_HOST)
            ])->delete(config('services.service_v.url') . "/api/deletefile/$category/$oldData", []);
            $result = $response->json();
        }

        // $identitas_penanggung->tempPath = $filename;
        $response = Http::withHeaders([
            'x-api-key' => config('services.service_v.api_key'),
            'Host' => parse_url(config('services.service_v.url'), PHP_URL_HOST)
        ])->attach(
            'file',
            $content,
            $filename
        )->post(config('services.service_v.url') . '/api/uploadfile', [
            'category' => 'FileIDPersonCharge',
            'filename' => substr($filename, 0, strrpos($filename, '.'))
        ]);

        $result = $response->json();
        if ($result['status'] == true) {
            DB::table('data_identitas')->where('identitas_perusahaan_id', $id)->update(['status_upload_foto' => 'success']);
            @unlink($tempPath);
        } else {
            DB::table('data_identitas')->where('identitas_perusahaan_id', $id)->update(['status_upload_foto' => 'failed']);
        }
    }
}