<?php
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class UploadSPPKP
{
    public static function handleUpload($filename, $oldData, $tempPath, $id)
    {
        $content = file_get_contents($tempPath);

        $response = Http::withHeaders([
            'x-api-key' => config('services.service_v.api_key'),
        ])->get(config('services.service_v.url') . '/api/checkfile', [
            'category' => 'FileSPPKPCompany',
            'filename' => $oldData ? $oldData : ''
        ]);

        if ($response->ok()) {
            $category = 'FileSPPKPCompany';
            $response = Http::withHeaders([
                'x-api-key' => config('services.service_v.api_key'),
            ])->delete(config('services.service_v.url') . "/api/deletefile/$category/$oldData", []);
        }

        // $data->sppkp = $filename;
        $response = Http::withHeaders([
            'x-api-key' => config('services.service_v.api_key'),
        ])->attach(
            'file',
            $content,
            $filename
        )->post(config('services.service_v.url') . '/api/uploadfile', [
            'category' => 'FileSPPKPCompany',
            'filename' => substr($filename, 0, strrpos($filename, '.'))
        ]);

        if($response->failed()) {
            DB::table('identitas_perusahaan')->where('id', $id)->update(['status_upload_sppkp' => 'failed']);
            throw new Exception("Upload gagal: " . $response->status());
        }

        DB::table('identitas_perusahaan')->where('id', $id)->update(['status_upload_sppkp' => 'success']);
        @unlink($tempPath);
    }
}