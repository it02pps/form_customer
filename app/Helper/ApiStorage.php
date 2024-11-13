<?php

namespace App\Helper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiStorage
{
    public static function store_file(Request $request)
    {
        $apiKey = 'Telor-Asin-951357-Papasari';
        $apiUrl = 'http://localhost:9292/upload';
        try {
            $file = fopen($request->file('file')->getPathname(), 'r');
            $response = Http::withHeaders([
                'x-api-key' => $apiKey,
            ])->attach(
                'file',
                $file,
                $request->file('file')->getClientOriginalName()
            )->post($apiUrl, [
                'category' => $request->input('category'),
                'CustomerName' => $request->input('CustomerName'),
            ]);

            // Close the file resource
            fclose($file);

            // Check if the request was successful
            if ($response->successful()) {
                // Get the filename and filepath from the response
                $filename = $response->json('filename');
                $filepath = $response->json('filepath');



                return  $filepath;
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
