<?php 
namespace App\Helper;

use Illuminate\Http\Request;

Class ApiStorage {
    public static function store_file(Request $request) {
        $apiKey = 'Telor-Asin-951357-Papasari';
        $apiUrl = 'http://192.168.2.239:9292/upload'; // Endpoint API Express Anda

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
                        'contents' => $request->input('identitas_perusahaan'),
                    ],
                    [
                        'name'     => 'CustomerName',
                        'contents' => $request->input('nama_lengkap'),
                    ],
                ],
            ]);

            dd($response);

            // Periksa apakah permintaan berhasil
            if ($response->getStatusCode() == 200) {
                $responseBody = json_decode($response->getBody(), true);
                dd($responseBody);
                // $filename = $responseBody['filename'];
                // $filepath = $responseBody['filepath'];
                // return response()->json(['success' => true, 'namafile' => $filename]);
            } else {
                // return response()->json(['success' => false, 'message' => "File uploaded Not successfully"]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}