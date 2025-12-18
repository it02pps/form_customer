<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IdentitasPerusahaan;
use Illuminate\Support\Facades\Crypt;
use App\Models\Sales;
use App\Services\FileFetcherServices;
use App\Services\getFiles;
use App\Services\PdfMergerServices;
use App\Services\PerusahaanServices;
use App\Services\UploaderServices;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Services\pdfGeneratorServices;

class FormCustomerController extends Controller
{
    public $apiKey;
    public $apiUrl;
    public $path;
    protected $perusahaanServices;

    public function __construct(perusahaanServices $perusahaanServices)
    {
        $this->perusahaanServices = $perusahaanServices;
    }

    public function menu()
    {
        try {
            $response = Http::withHeaders([
                'x-api-key' => config('services.service_v.api_key'),
            ])->get(config('services.service_v.url') . '/api/checkstatus');

            // dd($response->body());
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

    public function store(Request $request)
    {
        try {
            $perusahaan = $this->perusahaanServices->handleFormPerusahaan($request);
            // dd($perusahaan);
            if ($perusahaan['status'] == false) {
                return ['status' => false, 'error' => $perusahaan['error']];
            }

            return ['status' => true, 'link' => $perusahaan['link']];
        } catch (\Exception $e) {
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
            $oldData = $data->file_customer_external ?: null;

            if ($request->hasFile('file_pdf')) {
                $file = $request->file('file_pdf');
                $ext = $file->getClientOriginalExtension();
                $filename = uniqid() . '-FORMULIR-CUSTOMER-' . $data->nama_perusahaan . '.' . $ext;

                $file->move(public_path('temp_files'), $filename);
                $tempPath = public_path('temp_files/' . $filename);

                $services = [
                    'service_l' => config('services.service_l'),
                    'service_v' => config('services.service_v')
                ];

                foreach($services as $service) {
                    try {
                        $response = Http::withHeaders([
                            'x-api-key' => $service['api_key'],
                        ])->get($service['url'] . '/api/checkfile', [
                            'category' => 'FilePDFCustomer',
                            'filename' => $oldData
                        ]);

                        if($response->ok()) {
                            Http::withHeaders([
                                'x-api-key' => $service['api_key'],
                            ])->delete($service['url'] . "/api/deletefile/FilePDFCustomer/$oldData". []);
                            break;
                        }
                    } catch(\Exception  $e) {
                        continue;
                    }
                }

                $resUpload = Http::withHeaders([
                    'x-api-key' => $services['service_v']['api_key'],
                ])->attach(
                    'file',
                    file_get_contents($tempPath),
                    $filename
                )->post($services['service_v']['url'] . '/api/uploadfile', [
                    'category' => 'FilePDFCustomer',
                    'filename' => substr($filename, 0, strrpos($filename, '.'))
                ]);

                if($resUpload->ok()) {
                    DB::table('identitas_perusahaan')->where('id', $data->id)->update([
                        'file_customer_external' => $filename,
                        'status_upload' => '1'
                    ]);
                    @unlink($tempPath);
                }
            }

            return ['status' => true, 'url' => 'https://papasari.com'];
        } catch (\Exception $e) {
            return ['status' => false, 'error' => 'Terjadi Kesalahan'];
        }
    }

    public function download_pdf($menu, Request $request)
    {
        $decrypt = Crypt::decryptString($request->id);
        $data = IdentitasPerusahaan::with('data_identitas', 'informasi_bank')->findOrFail($decrypt);
        $bentukUsaha = $data->bentuk_usaha;

        if($bentukUsaha == 'perseorangan') {
            $mappingFileCategories = [
                'FileIDCompanyOrPersonal' => [
                    $data->foto_ktp
                ],
                'FileIDPersonCharge' => [
                    $data->data_identitas->foto
                ],
                'FileIDSignature' => [
                    $data->data_identitas->ttd
                ]
            ];
        } else {
            $mappingFileCategories = [
                'FileIDCompanyOrPersonal' => [
                    $data->foto_npwp
                ],
                'FileSPPKPCompany' => [
                    $data->sppkp
                ],
                'FileIDPersonCharge' => [
                    $data->data_identitas->foto
                ]
            ];
        }

        $fileFetcher = new FileFetcherServices();
        $collected = $fileFetcher->fetch($mappingFileCategories);

        $pdfGenerator = new pdfGeneratorServices();
        $mainPdf = $pdfGenerator->generate($data, $collected['signature'] ?? null);

        $pdfMerger = new PdfMergerServices();
        $mergedPDF = $pdfMerger->merge(
            array_merge([$mainPdf], $collected['files']),
            $data->nama_perusahaan
        );

        (new UploaderServices())->upload($mergedPDF);

        return response()->download($mergedPDF)->deleteFileAfterSend();
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
        return getFiles::fetchFiles($category, $filename);
    }
}
