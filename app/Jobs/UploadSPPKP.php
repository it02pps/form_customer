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

class UploadSPPKP implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $filename;
    public $oldData;
    public $path;
    public $id;

    public function __construct($filename, $oldData, $path, $id)
    {
        $this->filename = $filename;
        $this->oldData = $oldData;
        $this->path = $path;
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $filename = $this->filename;
        $oldData = $this->oldData;
        // $filePath = storage_path('app/public/' . $this->path);
        $filePath = Storage::disk('public')->get($this->path);

        $response = Http::withHeaders([
            'x-api-key' => config('services.service_x.api_key'),
            'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
        ])->get(config('services.service_x.url') . '/api/checkfile', [
            'category' => 'FileSPPKPCompany',
            'filename' => $oldData ? $oldData : ''
        ]);

        $result = $response->json();
        if ($result['status'] == true) {
            $category = 'FileSPPKPCompany';
            $response = Http::withHeaders([
                'x-api-key' => config('services.service_x.api_key'),
                'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
            ])->delete(config('services.service_x.url') . "/api/deletefile/$category/$oldData", []);
            $result = $response->json();
        }

        // $data->sppkp = $filename;
        $response = Http::withHeaders([
            'x-api-key' => config('services.service_x.api_key'),
            'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
        ])->attach(
            'file',
            file_get_contents($filePath),
            $filename
        )->post(config('services.service_x.url') . '/api/uploadfile', [
            'category' => 'FileSPPKPCompany',
            'filename' => substr($filename, 0, strrpos($filename, '.'))
        ]);

        $result = $response->json();
        if ($result['status'] == true) {
            DB::table('identitas_perusahaan')->where('id', $this->id)->update(['status_upload_sppkp' => 'success']);
            @unlink($filePath);
        } else {
            DB::table('identitas_perusahaan')->where('id', $this->id)->update(['status_upload_sppkp' => 'failed']);
        }
    }
}
