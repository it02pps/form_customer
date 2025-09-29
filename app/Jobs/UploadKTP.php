<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UploadKTP implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $filename;
    public $oldData;
    public $tempPath;
    public $id;

    public function __construct($filename, $oldData, $tempPath, $id)
    {
        $this->filename = $filename;
        $this->oldData = $oldData;
        $this->tempPath = $tempPath;
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $filename = $this->filename;
        $oldData = $this->oldData;
        $filePath = storage_path('app/public/' . $this->tempPath);

        $response = Http::withHeaders([
            'x-api-key' => config('services.service_x.api_key'),
            'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
        ])->get(config('services.service_x.url') . '/api/checkfile', [
            'category' => 'FileIDCompanyOrPersonal',
            'filename' => $oldData ? $oldData : ''
        ]);

        $result = $response->json();
        if ($result['status'] == true) {
            $category = 'FileIDCompanyOrPersonal';
            $response = Http::withHeaders([
                'x-api-key' => config('services.service_x.api_key'),
                'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
            ])->delete(config('services.service_x.url') . "/api/deletefile/$category/$oldData", []);
            $result = $response->json();
        }

        // $data->foto_ktp = $filename;
        $response = Http::withHeaders([
            'x-api-key' => config('services.service_x.api_key'),
            'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
        ])->attach(
            'file',
            file_get_contents($filePath),
            $filename
        )->post(config('services.service_x.url') . '/api/uploadfile', [
            'category' => 'FileIDCompanyOrPersonal',
            'filename' => substr($filename, 0, strrpos($filename, '.'))
        ]);

        $result = $response->json();
        if ($result['status'] == true) {
            DB::table('identitas_perusahaan')->where('id', $this->id)->update(['status_upload_nik' => 'success']);
            @unlink($filePath);
        } else {
            DB::table('identitas_perusahaan')->where('id', $this->id)->update(['status_upload_nik' => 'failed']);
        }
    }
}
