<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class UploadKTP
{

    public static function handleUpload($filename, $oldData, $tempPath, $id)
    {
        $content = file_get_contents($tempPath);

        $response = Http::withHeaders([
            'x-api-key' => config('services.service_v.api_key'),
        ])->get(config('services.service_v.url') . '/api/checkfile', [
            'category' => 'FileIDCompanyOrPersonal',
            'filename' => $oldData ? $oldData : ''
        ]);

        if ($response->ok()) {
            $category = 'FileIDCompanyOrPersonal';
            $response = Http::withHeaders([
                'x-api-key' => config('services.service_v.api_key'),
            ])->delete(config('services.service_v.url') . "/api/deletefile/$category/$oldData", []);
        }

        // $data->foto_ktp = $filename;
        $response = Http::withHeaders([
            'x-api-key' => config('services.service_v.api_key'),
        ])->attach(
            'file',
            $content,
            $filename
        )->post(config('services.service_v.url') . '/api/uploadfile', [
            'category' => 'FileIDCompanyOrPersonal',
            'filename' => substr($filename, 0, strrpos($filename, '.'))
        ]);
        
        if ($response->ok()) {
            DB::table('identitas_perusahaan')->where('id', $id)->update(['status_upload_nik' => 'success']);
            @unlink($tempPath);
        } else {
            DB::table('identitas_perusahaan')->where('id', $id)->update(['status_upload_nik' => 'failed']);
        }
    }
}