<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class APIStorageController extends Controller
{
    public function store(Request $request)
    {
        $apiKey = 'Telor-Asin-951357-Papasari';
        $apiUrl = 'http://localhost:3000/upload'; // Endpoint API Express Anda

        $file = $request->file('foto_ktp');
        $filePath = $file->getPathname();
        $fileName = $file->getClientOriginalName();

        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', $apiUrl, [
                'headers' => [
                    'x-api-key' => $apiKey,
                ],
                'multipart' => [
                    [
                        'name'     => 'file',
                        'contents' => fopen($filePath, 'r'),
                        'filename' => $fileName,
                    ],
                    [
                        'name'     => 'category',
                        'contents' => $request->input('category'),
                    ],
                    [
                        'name'     => 'CustomerName',
                        'contents' => $request->input('CustomerName'),
                    ],
                ],
            ]);

            // Periksa apakah permintaan berhasil
            if ($response->getStatusCode() == 200) {
                $responseBody = json_decode($response->getBody(), true);
                $filename = $responseBody['filename'];
                $filepath = $responseBody['filepath'];

                // Simpan informasi file di database
                Upload::create([
                    'customer_name' => $request->input('CustomerName'),
                    'category' => $request->input('category'),
                    'filename' => $filename,
                    'file_path' => $filepath,
                ]);

                return response()->json(['success' => true, 'message' => "File uploaded successfully: $filename"]);
            } else {
                return response()->json(['success' => false, 'message' => "File uploaded Not successfully"]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
