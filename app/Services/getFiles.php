<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class getFiles
{
    public static function fetchFiles($category, $filename) {
        $services = [
            'service_l' => config('services.service_l'),
            'service_v' => config('services.service_v')
        ];

        foreach($services as $service) {
            try {
                $response = Http::withHeaders([
                    'x-api-key' => $service['api_key'],
                    'Host' => parse_url($service['url'], PHP_URL_HOST),
                ])->get($service['url'] . '/api/checkstatus');
                
                if(!$response->ok() || $response->json('status') !== true) {
                    continue;
                }
                
                $file = Http::withHeaders([
                    'x-api-key' => $service['api_key'],
                    'Host' => parse_url($service['url'], PHP_URL_HOST)
                ])->get($service['url'] . "/api/getfile/$category/$filename", []);

                if($file->ok()) {
                    return response($file->body(), 200)
                        ->header('Content-Type', $file->header('Content-Type'));
                }
            } catch(\Exception $e) {
                continue;
            }
        }

        abort(404, "File tidak ditemukan disemua service");

        // try {
        //     $response = Http::withHeaders([
        //         'x-api-key' => config('services.service_v.api_key'),
        //         'Host' => parse_url(config('services.service_v.url'), PHP_URL_HOST)
        //     ])->get(config('services.service_v.url') . '/api/checkstatus');

        //     if ($response->json()['status'] == false) {
        //         abort(403, 'Server tidak bisa diakses, silahkan hubungi pihak yang bersangkutan.');
        //     }
        //     return view('customer.menu');
        // } catch (\Illuminate\Http\Client\ConnectionException $e) {
        //     // dd($e);
        //     abort(403, 'Server tidak bisa diakses, silahkan hubungi pihak yang bersangkutan.');
        // }

        // try {
        //     $response = Http::withHeaders([
        //         'x-api-key' => config('services.service_v.api_key'),
        //         'Host' => parse_url(config('services.service_v.url'), PHP_URL_HOST)
        //     ])->get(config('services.service_v.url') . "/api/getfile/$category/$filename", []);
        //     dd($response->body());
        //     return response($response->body(), 200)
        //         ->header('Content-Type', $response->header('Content-Type'));
        // } catch (\Illuminate\Http\Client\ConnectionException) {
        //     abort(403, 'Server tidak bisa diakses, silahkan hubungi pihak yang bersangkutan.');
        // }
    }
}