<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;

class ImageController extends Controller
{
    public function index($category, $fileName)
    {
        $apiKey = 'Telor-Asin-951357-Papasari';
        $imageUrl = env('API_URL') . "files/{$category}/{$fileName}";
        // dd($imageUrl);
        $response = Http::withHeaders([
            'x-api-key' => $apiKey,
        ])->get($imageUrl);
        // dd($response);
        if ($response->successful()) {
            return response($response->body(), 200)
                ->header('Content-Type', $response->header('Content-Type'));
        } else {
            return response()->json(['message' => 'Gambar tidak ditemukan'], 404);
        }
    }
}
