<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataIdentitas;
use App\Models\IdentitasPerusahaan;
use App\Models\InformasiBank;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Helper\ApiStorage;
use App\Helper\base30ToImage;
use App\Models\Cabang;
use App\Models\Sales;
use App\Services\CabangServices;
use App\Services\DataIdentitasServices;
use App\Services\InformasiBankServices;
use App\Services\PerusahaanServices;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Visibility;
use Illuminate\Support\Facades\Http;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader\PageBoundaries;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class FormCustomerController extends Controller
{
    public $apiKey;
    public $apiUrl;
    public $path;
    protected $perusahaanServices;
    protected $dataIdentitasServices;
    protected $informasiBankServices;
    protected $cabangServices;

    public function __construct(perusahaanServices $perusahaanServices, DataIdentitasServices $dataIdentitasServices, InformasiBankServices $informasiBankServices, CabangServices $cabangServices)
    {
        $this->perusahaanServices = $perusahaanServices;
        $this->dataIdentitasServices = $dataIdentitasServices;
        $this->informasiBankServices = $informasiBankServices;
        $this->cabangServices = $cabangServices;
    }

    public function menu()
    {
        try {
            $response = Http::withHeaders([
                'x-api-key' => config('services.service_x.api_key'),
                'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
            ])->get(config('services.service_x.url') . '/api/checkstatus');

            if ($response->json()['status'] == false) {
                abort(403, 'Server tidak bisa diakses, silahkan hubungi pihak yang bersangkutan.');
            }
            return view('customer.menu');
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            // dd($e);
            abort(403, 'Server tidak bisa diakses, silahkan hubungi pihak yang bersangkutan.');
        }
    }

    public function view_badan_usaha($menu, $status = NULL, $status2 = NULL, $param = NULL)
    {
        if ($menu == 'badan-usaha') {
            if ($param) {
                $data = IdentitasPerusahaan::with('informasi_bank', 'data_identitas', 'cabang')->where('bentuk_usaha', 'badan_usaha')->where('nomor_npwp', Crypt::decryptString($param))->latest()->first();
                $url = route('form_customer.detail', ['menu' => $menu, 'id' => $param]);
                $enkripsi = $param;
            } else {
                $data = NULL;
                $enkripsi = NULL;
                $url = NULL;
            }

            $sales = Sales::select('nama_sales')->get();
            $bidang_usaha = [
                'toko_retail',
                'bumn',
                'reseller',
                'pabrik',
                'kontraktor',
                'toko_online',
                'dock_kapal',
                'end_user',
                'ekspedisi',
                'lainnya'
            ];

            if ($status == 'customer-baru') {
                return view('customer.badan_usaha.cust_baru', compact('data', 'url', 'enkripsi', 'menu', 'sales', 'bidang_usaha'));
            }

            if ($status2 == 'pengkinian-data') {
                return view('customer.badan_usaha.cust_lama', compact('data', 'url', 'enkripsi', 'menu', 'sales', 'bidang_usaha'));
            } else {
                return view('customer.badan_usaha.usaha_baru', compact('data', 'url', 'enkripsi', 'menu', 'sales', 'bidang_usaha'));
            }
        } else {
            if ($param) {
                $param = Crypt::decryptString($param);
                // dd($param);
                $data = IdentitasPerusahaan::with('informasi_bank', 'data_identitas', 'cabang')->where('bentuk_usaha', 'perseorangan')->where('nomor_ktp', $param)->latest()->first();
                $url = route('form_customer.detail', ['menu' => $menu, 'id' => Crypt::encryptString($data)]);
                $enkripsi = Crypt::encryptString($param);
            } else {
                $data = NULL;
                $url = NULL;
                $enkripsi = NULL;
            }

            $sales = Sales::select('nama_sales')->get();
            $bidang_usaha = [
                'toko_retail',
                'bumn',
                'reseller',
                'pabrik',
                'kontraktor',
                'toko_online',
                'dock_kapal',
                'end_user',
                'ekspedisi',
                'lainnya'
            ];

            // dd($data);

            if ($status == 'customer-baru') {
                return view('customer.perseorangan.cust_baru', compact('data', 'url', 'enkripsi', 'menu', 'sales', 'bidang_usaha'));
            }

            if ($status2 == 'pengkinian-data') {
                return view('customer.perseorangan.cust_lama', compact('data', 'url', 'enkripsi', 'menu', 'sales', 'bidang_usaha'));
            } else {
                return view('customer.perseorangan.usaha_baru', compact('data', 'url', 'enkripsi', 'menu', 'sales', 'bidang_usaha'));
            }
        }
    }

    // public function view_perseorangan($menu, $status = NULL, $status2 = NULL, $param = NULL)
    // {
    //     if ($param) {
    //         $param = Crypt::decryptString($param);
    //         // dd($param);
    //         $data = IdentitasPerusahaan::with('informasi_bank', 'data_identitas', 'cabang')->where('bentuk_usaha', 'perseorangan')->where('nomor_ktp', $param)->latest()->first();
    //         $url = route('form_customer.detail', ['menu' => $menu, 'id' => Crypt::encryptString($data)]);
    //         $enkripsi = Crypt::encryptString($param);
    //     } else {
    //         $data = NULL;
    //         $url = NULL;
    //         $enkripsi = NULL;
    //     }

    //     $sales = Sales::select('nama_sales')->get();
    //     $bidang_usaha = [
    //         'toko_retail',
    //         'bumn',
    //         'reseller',
    //         'pabrik',
    //         'kontraktor',
    //         'toko_online',
    //         'dock_kapal',
    //         'end_user',
    //         'ekspedisi',
    //         'lainnya'
    //     ];

    //     // dd($data);

    //     if ($status == 'customer-baru') {
    //         return view('customer.perseorangan.cust_baru', compact('data', 'url', 'enkripsi', 'menu', 'sales', 'bidang_usaha'));
    //     }

    //     if ($status2 == 'pengkinian-data') {
    //         return view('customer.perseorangan.cust_lama', compact('data', 'url', 'enkripsi', 'menu', 'sales', 'bidang_usaha'));
    //     } else {
    //         return view('customer.perseorangan.usaha_baru', compact('data', 'url', 'enkripsi', 'menu', 'sales', 'bidang_usaha'));
    //     }
    // }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $perusahaan = $this->perusahaanServices->handleFormPerusahaan($request);
            // dd($perusahaan);
            if ($perusahaan['status'] == false) {
                return ['status' => false, 'error' => $perusahaan['error']];
            }

            $bank = $this->informasiBankServices->handleFormInformasiBank($request, $perusahaan['new_data']);
            if ($bank['status'] == false) {
                return ['status' => false, 'error' => $bank['error']];
            }

            $identitas = $this->dataIdentitasServices->handleFormIdentitas($request, $perusahaan['new_data'], $perusahaan['old_data']);
            if ($identitas['status'] == false) {
                return ['status' => false, 'error' => $identitas['error']];
            }

            $cabang = $this->cabangServices->handleCabang($request, $perusahaan['new_data']);
            if ($cabang['status'] == false) {
                return ['status' => false, 'error' => $cabang['error']];
            }
            DB::commit();

            return ['status' => true, 'link' => $perusahaan['link']];
        } catch (\Exception $e) {
            DB::rollback();
            return ['status' => false, 'error' => 'Terjadi Kesalahan'];
        }
    }

    public function detail($menu, Request $request)
    {
        // dd($request->all());
        // Mendekripsikan id
        $dekripsi = Crypt::decryptString($request->id);

        // Memanggil data berdasarkan id identitas perusahaan
        $data_perusahaan = IdentitasPerusahaan::with('data_identitas', 'informasi_bank')->where('id', $dekripsi)->first();
        if ($menu == 'badan-usaha' || $menu == 'badan_usaha') {
            $menu = str_replace('_', '-', $menu);
            return view('customer.badan_usaha.detail', [
                'enkripsi' => $request->id,
                'perusahaan' => $data_perusahaan,
                'menu' => $menu,
                'url' => route('form_customer.view_badan_usaha', ['menu' => $menu, 'status' => 'customer-lama', 'status2' => 'pengkinian-data', 'param' => Crypt::encryptString($data_perusahaan->nomor_npwp)])
            ]);
        } else {
            return view('customer.perseorangan.detail', [
                'enkripsi' => $request->id,
                'perusahaan' => $data_perusahaan,
                'menu' => $menu,
                'url' => route('form_customer.view_badan_usaha', ['menu' => $menu, 'status' => 'customer-lama', 'status2' => 'pengkinian-data', 'param' => Crypt::encryptString($data_perusahaan->nomor_ktp)])
            ]);
        }
    }

    public function select($menu, $id)
    {
        if ($menu == 'perseorangan') {
            if ($id) {
                $dekripsi = Crypt::decryptString($id);
                $data = IdentitasPerusahaan::with('data_identitas', 'informasi_bank')->where('nomor_ktp', $dekripsi)->latest()->first();

                return ['status' => true, 'data' => $data];
            } else {
                return ['status' => false];
            }
        } else {
            if ($id) {
                $dekripsi = Crypt::decryptString($id);
                $data = IdentitasPerusahaan::with('data_identitas', 'informasi_bank')->where('nomor_npwp', $dekripsi)->latest()->first();

                return ['status' => true, 'data' => $data];
            } else {
                return ['status' => false];
            }
        }
    }

    public function upload_pdf(Request $request, $menu, $id)
    {
        try {
            $data = IdentitasPerusahaan::find(Crypt::decryptString($id));

            if ($request->hasFile('file_pdf')) {
                $file = $request->file('file_pdf');
                $ext = $file->getClientOriginalExtension();
                $filename = uniqid() . '-PDFCust-' . $data->nama_perusahaan . '.' . $ext;

                try {
                    $response = Http::withHeaders([
                        'x-api-key' => config('services.service_x.api_key'),
                        'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                    ])->get(config('services.service_x.url') . '/api/checkfile', [
                        'category' => 'FilePDFCustomer',
                        'filename' => $data->file_customer_external
                    ]);

                    $result = $response->json();
                    if ($result['status'] == true) {
                        $category = 'FilePDFCustomer';
                        $response = Http::withHeaders([
                            'x-api-key' => config('services.service_x.api_key'),
                            'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                        ])->delete(config('services.service_x.url') . "/api/deletefile/$category/$data->file_customer_external", []);
                        $result = $response->json();
                    }

                    $data->file_customer_external = $filename;
                    $response = Http::withHeaders([
                        'x-api-key' => config('services.service_x.api_key'),
                        'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                    ])->attach(
                        'file',
                        file_get_contents($file->getRealPath()),
                        $filename
                    )->post(config('services.service_x.url') . '/api/uploadfile', [
                        'category' => 'FilePDFCustomer',
                        'filename' => substr($filename, 0, strrpos($filename, '.'))
                    ]);
                } catch (\Illuminate\Http\Client\ConnectionException $e) {
                    abort(403, 'Server tidak bisa diakses, silahkan hubungi pihak yang bersangkutan.');
                }
                $data->status_upload = '1';
            }
            $data->save();

            return ['status' => true, 'url' => 'https://papasari.com'];
        } catch (\Exception $e) {
            return ['status' => false, 'error' => 'Terjadi Kesalahan'];
        }
    }

    public function download_pdf($menu, Request $request)
    {
        $decrypt = Crypt::decryptString($request->id);
        $data = IdentitasPerusahaan::with('data_identitas', 'informasi_bank')->where('id', $decrypt)->first();

        try {
            $getFilePenanggung = Http::withHeaders([
                'x-api-key' => config('services.service_x.api_key'),
                'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
            ])->get(config('services.service_x.url') . "/api/getfile/FileIDPersonCharge/" . $data->data_identitas->foto, []);

            $imageBase64Penanggung = null;
            if ($getFilePenanggung->successful()) {
                $fileMime = (new \finfo(FILEINFO_MIME_TYPE))->buffer($getFilePenanggung->body());
                $imageBase64Penanggung = 'data:' . $fileMime . ';base64,' . base64_encode($getFilePenanggung->body());
            }
        } catch (\Illuminate\Http\Client\ConnectionException) {
            abort(403, 'Server tidak bisa diakses, silahkan hubungi pihak yang bersangkutan.');
        }

        if ($menu == 'badan_usaha' || $menu == 'badan-usaha') {
            try {
                $getFileNpwp = Http::withHeaders([
                    'x-api-key' => config('services.service_x.api_key'),
                    'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                ])->get(config('services.service_x.url') . "/api/getfile/FileIDCompanyOrPersonal/" . $data->foto_npwp, []);

                $imageBase64Npwp = null;
                if ($getFileNpwp->successful()) {
                    $fileMime = (new \finfo(FILEINFO_MIME_TYPE))->buffer($getFileNpwp->body());
                    $imageBase64Npwp = 'data:' . $fileMime . ';base64,' . base64_encode($getFileNpwp->body());
                }
            } catch (\Illuminate\Http\Client\ConnectionException) {
                abort(403, 'Server tidak bisa diakses, silahkan hubungi pihak yang bersangkutan.');
            }

            try {
                $getFileSppkp = Http::withHeaders([
                    'x-api-key' => config('services.service_x.api_key'),
                    'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                ])->get(config('services.service_x.url') . "/api/getfile/FileSPPKPCompany/" . $data->sppkp, []);

                $imageBase64Sppkp = null;
                if ($getFileSppkp->successful()) {
                    $fileMime = (new \finfo(FILEINFO_MIME_TYPE))->buffer($getFileSppkp->body());
                    $imageBase64Sppkp = 'data:' . $fileMime . ';base64,' . base64_encode($getFileSppkp->body());
                }
            } catch (\Illuminate\Http\Client\ConnectionException) {
                abort(403, 'Server tidak bisa diakses, silahkan hubungi pihak yang bersangkutan.');
            }

            $pdf = Pdf::loadView('pdf.badan_usaha_pdf', [
                'npwpImage' => $imageBase64Npwp,
                'penanggungImage' => $imageBase64Penanggung,
                'sppkpImage' => $imageBase64Sppkp,
                'data' => $data
            ]);
            $pdf->setPaper('A4', 'portrait');
            $pdf->render();

            $name = uniqid() . '-PDF-' . $data['nama_perusahaan'] . '.pdf';
            $temp_pdf = public_path('uploads/temporary/tempFile-' . $name);
            file_put_contents($temp_pdf, $pdf->output());

            $files = [
                $imageBase64Npwp,
                $imageBase64Sppkp,
                $imageBase64Penanggung
            ];

            $all_files = array_merge([$temp_pdf], $files);
            $mergePdfPath = $this->mergingPdf($all_files, $name);

            File::delete($temp_pdf);
            // return $pdf->stream();
            return response()->download($mergePdfPath);
        } else {
            try {
                $getFileKtp = Http::withHeaders([
                    'x-api-key' => config('services.service_x.api_key'),
                    'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                ])->get(config('services.service_x.url') . "/api/getfile/FileIDCompanyOrPersonal/" . $data->foto_ktp, []);

                $imageBase64Ktp = null;
                if ($getFileKtp->successful()) {
                    $fileMime = (new \finfo(FILEINFO_MIME_TYPE))->buffer($getFileKtp->body());
                    $imageBase64Ktp = 'data:' . $fileMime . ';base64,' . base64_encode($getFileKtp->body());
                }
            } catch (\Illuminate\Http\Client\ConnectionException) {
                abort(403, 'Server tidak bisa diakses, silahkan hubungi pihak yang bersangkutan.');
            }

            try {
                $getFileSignature = Http::withHeaders([
                    'x-api-key' => config('services.service_x.api_key'),
                    'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                ])->get(config('services.service_x.url') . "/api/getfile/FileIDSignature/" . $data->data_identitas->ttd, []);

                $imaegBase64Signature = null;
                if ($getFileSignature->successful()) {
                    $fileMime = (new \finfo(FILEINFO_MIME_TYPE))->buffer($getFileSignature->body());
                    $imaegBase64Signature = 'data:' . $fileMime . ';base64,' . base64_encode($getFileSignature->body());
                }
            } catch (\Illuminate\Http\Client\ConnectionException) {
                abort(403, 'Server tidak bisa diakses, silahkan hubungi pihak yang bersangkutan.');
            }

            $pdf = Pdf::loadView('pdf.perseorangan_pdf', [
                'ktpImage' => $imageBase64Ktp,
                'penanggungImage' => $imageBase64Penanggung,
                'signatureImage' => $imaegBase64Signature,
                'data' => $data
            ]);
            $pdf->setPaper('A4', 'portrait');
            $pdf->render();

            $name = uniqid() . '-PDF-' . $data['nama_perusahaan'] . '.pdf';
            $temp_pdf = public_path('uploads/temporary/tempFile-' . $name);
            file_put_contents($temp_pdf, $pdf->output());

            $files = [
                $imageBase64Ktp,
                $imageBase64Penanggung,
            ];

            $all_files = array_merge([$temp_pdf], $files);
            $mergePdfPath = $this->mergingPdf($all_files, $name);

            File::delete($temp_pdf);
            return response()->download($mergePdfPath);
        }
    }

    // Function for merging PDF
    private function mergingPdf(array $pdfFiles, string $outputFilename): string
    {
        // Manually include FPDF
        require_once base_path('vendor/setasign/fpdf/fpdf.php');
        require_once base_path('vendor/setasign/fpdi/src/autoload.php');

        $pdf = new Fpdi();
        $pageWidth = 210;
        $maxImageWidth = 200;
        $pageHeight = 297;
        $imageHeight = 90;
        $marginBottom = 20;
        $y = 20;

        foreach ($pdfFiles as $file) {
            if (preg_match('/^data:application\/pdf;base64,/', $file)) {
                $tmpFile = tempnam(sys_get_temp_dir(), 'pdf_') . '.pdf';
                file_put_contents($tmpFile, base64_decode(preg_replace('/^data:application\/pdf;base64,/', '', $file)));
                $file = $tmpFile;
            } else if (preg_match('/^data:image\/(\w+);base64,/', $file, $matches)) {
                $ext = $matches[1];
                $tmpFile = tempnam(sys_get_temp_dir(), 'img_') . '.' . $ext;
                file_put_contents($tmpFile, base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $file)));
                $file = $tmpFile;
            }

            if (!$file || !file_exists($file)) {
                continue;
            }

            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if ($ext == 'pdf') {
                $pageCount = $pdf->setSourceFile($file);
                for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                    $pdf->AddPage();
                    $pdfIdx = $pdf->importPage($pageNo);
                    $size = $pdf->getTemplateSize($pdfIdx);
                    $width = min($size['width'], $maxImageWidth);
                    // $height = $size['height'] * ($width / $size['width']);

                    $x = ($pageWidth - $width) / 2;
                    $pdf->useTemplate($pdfIdx, $x, $y, $width);
                }
            } else {
                if ($y + $imageHeight + $marginBottom > $pageHeight) {
                    $pdf->AddPage();
                    $y = 20;
                } else if ($pdf->PageNo() == 0) {
                    $pdf->AddPage();
                    $y = 20;
                }
                $pdf->SetFont('Arial', '', 22);
                $pdf->Text(90, 12, 'Lampiran');
                $pdf->Image($file, 15, $y, 160);
                $y += $imageHeight + 5;
            }
        }

        // Define Output
        $outputPath = public_path('uploads/pdf/' . $outputFilename);
        $pdf->Output($outputPath, 'F');
        try {
            $response = Http::withHeaders([
                'x-api-key' => config('services.service_x.api_key'),
                'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
            ])->get(config('services.service_x.url') . '/api/checkfile', [
                'category' => 'FileIDMergingPdf',
                'filename' => $outputFilename
            ]);

            $result = $response->json();
            if ($result['status'] == true) {
                $category = 'FileIDMergingPdf';
                $response = Http::withHeaders([
                    'x-api-key' => config('services.service_x.api_key'),
                    'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                ])->delete(config('services.service_x.url') . "/api/deletefile/$category/$outputFilename", []);
                $result = $response->json();
            }

            $response = Http::withHeaders([
                'x-api-key' => config('services.service_x.api_key'),
                'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
            ])->attach(
                'file',
                fopen($outputPath, 'r'),
                $outputFilename
            )->post(config('services.service_x.url') . '/api/uploadfile', [
                'category' => 'FileIDMergingPdf',
                'filename' => substr($outputFilename, 0, strrpos($outputFilename, '.'))
            ]);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            abort(403, 'Server tidak bisa diakses, silahkan hubungi pihak yang bersangkutan.');
        }

        return $outputPath;
    }

    public function pengkinian($menu, $status, $status2 = NULL, $param = NULL)
    {
        if (strlen($param) != 15 && strlen($param) != 16) {
            return ['status' => false, 'error' => 'NIK / NPWP tidak valid!'];
        } else {
            $data = IdentitasPerusahaan::with('informasi_bank', 'data_identitas', 'cabang')->where('nomor_ktp', $param)->OrWhere('nomor_npwp', $param)->first();
            $enkripsi = Crypt::encryptString($param);
            if ($data) {
                $data->makeHidden(
                    'id',
                    'created_at',
                    'updated_at'
                );

                $data->informasi_bank->makeHidden(
                    'id',
                    'created_at',
                    'updated_at',
                    'identitas_perusahaan_id'
                );

                $data->data_identitas->makeHidden(
                    'id',
                    'created_at',
                    'updated_at',
                    'identitas_perusahaan_id'
                );

                $data->cabang->makeHidden(
                    'id',
                    'created_at',
                    'updated_at',
                    'identitas_perusahaan_id'
                );
                return ['status' => true, 'dataa' => $data, 'datID' => $enkripsi];
            } else {
                return ['status' => false, 'error' => 'Data tidak ditemukan'];
            }
        }
    }

    public function getFiles($category, $filename)
    {
        try {
            $response = Http::withHeaders([
                'x-api-key' => config('services.service_x.api_key'),
                'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
            ])->get(config('services.service_x.url') . "/api/getfile/$category/$filename", []);
            return response($response->body(), 200)
                ->header('Content-Type', $response->header('Content-Type'));
        } catch (\Illuminate\Http\Client\ConnectionException) {
            abort(403, 'Server tidak bisa diakses, silahkan hubungi pihak yang bersangkutan.');
        }
    }
}
