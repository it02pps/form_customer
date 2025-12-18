<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

use function PHPSTORM_META\map;

Class FileFetcherServices
{
    private array $services;

    public function __construct() {
        $this->services = [
            config('services.service_l'),
            config('services.service_v')
        ];
    }

    public function fetch(array $mappingFileCategories): array
    {
        $collectedFiles = [];
        $signature = null;
        $counter = 1;

        foreach($mappingFileCategories as $indexCategory => $files) {
            foreach($files as $file) {
                if(!$file) continue;

                foreach($this->services as $service) {
                    $response = $this->getFile($service, $indexCategory, $file);
                    if(!$response) continue;

                    if($indexCategory === 'FileIDSignature') {
                        $signature = $this->saveTempFile($response);
                        break;
                    }

                    $collectedFiles[] = [
                        'type' => 'image',
                        'title' => "Lampiran {$counter} - " . $this->resolveTitle($indexCategory),
                        'path' => $this->toBase64($response)
                    ];

                    $counter++;
                    break;
                }
            }
        }

        return [
            'files' => $collectedFiles,
            'signature' => $signature
        ];
    }

    private function getFile($service, $category, $file)
    {
        try {
            $response = Http::withHeaders([
                'x-api-key' => $service['api_key'],
            ])->get($service['url'] . "/api/getfile/$category/$file");

            return $response->successful() ? $response->body() : null;
        } catch(\Exception $e) {
            return null;
        }
    }

    private function toBase64($binary): string
    {
        $mime = (new \finfo(FILEINFO_MIME_TYPE))->buffer($binary);
        return "data:$mime;base64," . base64_encode($binary);
    }

    private function saveTempFile($binary): string
    {
        $path = storage_path('app/tmp_signature_' . uniqid() . '.png');
        file_put_contents($path, $binary);
        return $path;
    }

    private function resolveTitle(string $category): string
    {
        return match ($category) {
            'FileIDCompanyOrPersonal' => 'Identitas Perusahaan',
            'FileSPPKPCompany' => 'SPPKP Perusahaan',
            'FileIDPersonCharge' => 'Identitas Penanggung Jawab',
            'default' => 'Dokumen Pendukung'
        };
    }
}