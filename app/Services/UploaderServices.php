<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

Class UploaderServices
{
    public function upload(string $filePath): void
    {
        foreach([config('services.service_l'), config('services.service_v')] as $service) {
            try {
                Http::withHeaders([
                    'x-api-key' => $service['api_key'],
                    'Host' => parse_url($service['url'], PHP_URL_HOST)
                ])->attach(
                    'file',
                    fopen($filePath, 'r'),
                    basename($filePath)
                )->post("{$service['url']}/api/uploadFIle", [
                    'category' => 'FileIDMergeingPdf'
                ]);
            } catch(\Exception $e) {

            }
        }
    }
}