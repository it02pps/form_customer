<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class UploadIdentitas implements ShouldQueue
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
        $content = file_get_contents($this->tempPath);

        $response = Http::withHeaders([
            'x-api-key' => config('services.service_x.api_key'),
            'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
        ])->get(config('services.service_x.url') . '/api/checkfile', [
            'category' => 'FileIDPersonCharge',
            'filename' => $oldData ? $oldData : ''
        ]);

        $result = $response->json();
        if ($result['status'] == true) {
            $category = 'FileIDPersonCharge';
            $response = Http::withHeaders([
                'x-api-key' => config('services.service_x.api_key'),
                'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
            ])->delete(config('services.service_x.url') . "/api/deletefile/$category/$oldData", []);
            $result = $response->json();
        }

        // $identitas_penanggung->tempPath = $filename;
        $response = Http::withHeaders([
            'x-api-key' => config('services.service_x.api_key'),
            'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
        ])->attach(
            'file',
            $content,
            $filename
        )->post(config('services.service_x.url') . '/api/uploadfile', [
            'category' => 'FileIDPersonCharge',
            'filename' => substr($filename, 0, strrpos($filename, '.'))
        ]);

        $result = $response->json();
        if ($result['status'] == true) {
            DB::table('data_identitas')->where('identitas_perusahaan_id', $this->id)->update(['status_upload_foto' => 'success']);
            @unlink($this->tempPath);
        } else {
            DB::table('data_identitas')->where('identitas_perusahaan_id', $this->id)->update(['status_upload_foto' => 'failed']);
        }
    }
}
