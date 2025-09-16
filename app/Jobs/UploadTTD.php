<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class UploadTTD implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $oldData;
    public $imageBinary;
    public $imageName;

    public function __construct($oldData, $imageBinary, $imageName)
    {
        $this->oldData = $oldData;
        $this->imageBinary = $imageBinary;
        $this->imageName = $imageName;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $oldData = $this->oldData;
        $imageBinary = $this->imageBinary;
        $imageName = $this->imageName;

        $response = Http::withHeaders([
            'x-api-key' => config('services.service_x.api_key'),
            'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
        ])->get(config('services.service_x.url') . '/api/checkfile', [
            'category' => 'FileIDSignature',
            'filename' => $oldData ? $oldData : ''
        ]);

        $result = $response->json();
        if ($result['status'] == true) {
            $category = 'FileIDSignature';
            $signature = $oldData;
            $response = Http::withHeaders([
                'x-api-key' => config('services.service_x.api_key'),
                'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
            ])->delete(config('services.service_x.url') . "/api/deletefile/$category/$signature", []);
            $result = $response->json();
        }

        // $identitas_penanggung->ttd = $imageName;
        $response = Http::withHeaders([
            'x-api-key' => config('services.service_x.api_key'),
            'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
        ])->attach(
            'file',
            $imageBinary,
            $imageName
        )->post(config('services.service_x.url') . '/api/uploadfile', [
            'category' => 'FileIDSignature',
            'filename' => substr($imageName, 0, strrpos($imageName, '.'))
        ]);
    }
}
