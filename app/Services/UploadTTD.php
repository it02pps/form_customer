<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UploadTTD
{
    public static function handleUpload($oldData, $path, $imageName, $id)
    {
        $content = Storage::disk('public')->get($path);

        $response = Http::withHeaders([
            'x-api-key' => config('services.service_v.api_key'),
        ])->get(config('services.service_v.url') . '/api/checkfile', [
            'category' => 'FileIDSignature',
            'filename' => $oldData ? $oldData : ''
        ]);

        $result = $response->json();
        if ($result['status'] == true) {
            $category = 'FileIDSignature';
            $signature = $oldData;
            $response = Http::withHeaders([
                'x-api-key' => config('services.service_v.api_key'),
            ])->delete(config('services.service_v.url') . "/api/deletefile/$category/$signature", []);
            $result = $response->json();
        }

        // $identitas_penanggung->ttd = $imageName;
        $response = Http::withHeaders([
            'x-api-key' => config('services.service_v.api_key'),
        ])->attach(
            'file',
            $content,
            $imageName
        )->post(config('services.service_v.url') . '/api/uploadfile', [
            'category' => 'FileIDSignature',
            'filename' => substr($imageName, 0, strrpos($imageName, '.'))
        ]);

        $result = $response->json();
        if ($result['status'] == true) {
            DB::table('data_identitas')->where('identitas_perusahaan_id', $id)->update(['status_upload_ttd' => 'success']);
            Storage::delete($path);
        } else {
            DB::table('data_identitas')->where('identitas_perusahaan_id', $id)->update(['status_upload_ttd' => 'failed']);
        }
    }
}