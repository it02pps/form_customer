<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class UPloadNPWP
{
    public static function handleUpload($filename, $oldData, $tempPath, $id)
    {
        $content = file_get_contents($tempPath);

        $response = Http::withHeaders([
            'x-api-key' => config('services.service_v.api_key'),
            'Host' => parse_url(config('services.service_v.url'), PHP_URL_HOST)
        ])->get(config('services.service_v.url') . '/api/checkfile', [
            'category' => 'FileIDCompanyOrPersonal',
            'filename' => $oldData ? $oldData : ''
        ]);

        $result = $response->json();
        if ($result['status'] == true) {
            $category = 'FileIDCompanyOrPersonal';
            $response = Http::withHeaders([
                'x-api-key' => config('services.service_v.api_key'),
                'Host' => parse_url(config('services.service_v.url'), PHP_URL_HOST)
            ])->delete(config('services.service_v.url') . "/api/deletefile/$category/$oldData", []);
            $result = $response->json();
        }

        // $data->foto_npwp = $filename;
        $response = Http::withHeaders([
            'x-api-key' => config('services.service_v.api_key'),
            'Host' => parse_url(config('services.service_v.url'), PHP_URL_HOST)
        ])->attach(
            'file',
            $content,
            $filename
        )->post(config('services.service_v.url') . '/api/uploadfile', [
            'category' => 'FileIDCompanyOrPersonal',
            'filename' => substr($filename, 0, strrpos($filename, '.'))
        ]);

        $result = $response->json();
        if ($result['status'] == true) {
            DB::table('identitas_perusahaan')->where('id', $id)->update(['status_upload_npwp' => 'success']);
            @unlink($tempPath);
        } else {
            DB::table('identitas_perusahaan')->where('id', $id)->update(['status_upload_npwp' => 'failed']);
        }
    }
}