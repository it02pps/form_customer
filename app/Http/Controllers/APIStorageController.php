<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class APIStorageController extends Controller
{
    public function store(Request $request) {
        if(strpos($request['CustomerName'], ".") === true) {
            return response()->json([
                'error' => 'Nama Customer tidak boleh mengandung titik (.)',
            ], 500);
        }

        $client = new Client();

        try {
            // Mengirim POST ke URL API
            $response = $client->post('http://localhost:8000/api/storage', [
                'headers' => [
                    'x-api-key' => 'Telor-Asin-951357-Papasari',
                ],
                'json' => [
                    'CustomerName' => trim($request['CustomerName']),
                    'Jenis' => trim($request['Jenis']),
                ],
            ]);

            // Response API
            $responseData = json_decode($response->getBody(), true);

            // Mengembalikan response
            return response()->json([
                'message' => 'Berhasil!',
                'api_response' => $responseData,
            ], 200);
        } catch(\Exception $e) {
            return response()->json([
                'error' => 'Gagal!',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
