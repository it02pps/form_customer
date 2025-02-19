<?php

namespace App\Http\Controllers;

use App\Models\IdentitasPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\DataIdentitas;
use App\Models\InformasiBank;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Helper\ApiStorage;
use App\Helper\base30ToImage;
use App\Models\Cabang;
use App\Models\Sales;
use App\Models\TipeCustomer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Visibility;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\MockObject\Builder\Identity;
use Yajra\DataTables\Facades\DataTables;

use function PHPUnit\Framework\isEmpty;

class HomeController extends Controller
{
    public $apiKey;
    public $apiUrl;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->apiKey = 'Telor-Asin-951357-Papasari';
        $this->apiUrl = env('API_URL') . 'upload';
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $data = IdentitasPerusahaan::orderBy('created_at', 'DESC')->get();
        return view('panel.fix_home', compact('data'));
    }

    public function datatable() {
        $data = IdentitasPerusahaan::orderBy('created_at', 'DESC')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('bentuk_usaha', function($e) {
                return ucwords(str_replace('_', ' ', $e->bentuk_usaha));
            })
            ->editColumn('alamat_lengkap', function($e) {
                return $e->alamat_lengkap . ', ' . $e->kota_kabupaten;
            })
            ->addColumn('aksi', function($e) {
                $edit = '<button type="button" id="editCustomer" title="Edit Data Customer" data-id="'.Crypt::encryptString($e->id).'">Edit</button>';
                $detail = '<button type="button" id="detailCustomer" title="Detail Data Customer" data-id="'.Crypt::encryptString($e->id).'">Detail</button>';
                $aksi = $edit . ' ' . $detail;
                return $aksi;
            })
            ->addColumn('status', function($e) {
                if ($e->status_upload == 0) {
                    return '<span class="badge bg-danger px-3 py-2">Belum Upload</span>';
                } else {
                    return '<span class="badge bg-success px-3 py-2">Sudah Upload</span>';
                }
            })
            ->rawColumns(['aksi', 'status'])
            ->make(true);
    }

    public function detail($id) {
        $data = IdentitasPerusahaan::with('data_identitas', 'informasi_bank', 'tipe_customer')->where('id', Crypt::decryptString($id))->first();
        // dd($data);
        $enkripsi = $id;
        $url = route('home.edit', ['id' => $enkripsi]);

        if ($data->bentuk_usaha == 'perseorangan') {
            return view('panel.fix_home_detail_perseorangan', compact('data', 'enkripsi', 'url'));
        } else {
            return view('panel.fix_home_detail_badan_usaha', compact('data', 'enkripsi', 'url'));
        }
    }

    public function edit($id) {
        $data = IdentitasPerusahaan::with('data_identitas', 'informasi_bank', 'tipe_customer')->where('id', Crypt::decryptString($id))->first();
        $enkripsi = $id;

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

        $url = route('home');
        if ($data->bentuk_usaha == 'perseorangan') {
            return view('panel.fix_home_edit_perseorangan', compact('data', 'enkripsi', 'bidang_usaha', 'url', 'sales'));
        } else {
            return view('panel.fix_home_edit_badan_usaha', compact('data', 'enkripsi', 'bidang_usaha', 'url', 'sales'));
        }
    }

    protected function validator($data)
    {
        $rules = [
            // Identitas Perusahaan
            'nama_perusahaan' => 'required',
            'nama_group_perusahaan' => 'required',
            'alamat_lengkap' => 'required',
            'kota_kabupaten' => 'required',
            'no_hp' => 'required',
            'bidang_usaha' => 'required',
            'alamat_email_perusahaan' => $data['alamat_email_perusahaan'] != '' ? ($data['alamat_email_perusahaan'] != '-' ? 'email' : '') : '',
            'status_kepemilikan' => 'required',
            'nama_lengkap' => $data['bentuk_usaha'] == 'perseorangan' ? 'required' : '',
            'nomor_ktp' => $data['bentuk_usaha'] == 'perseorangan' ? 'required|numeric|digits:16' : '',
            'foto_ktp' => $data['update_id'] ? 'mimes:jpg,jpeg,pdf' : ($data['bentuk_usaha'] == 'perseorangan' ? 'required|mimes:jpg,jpeg,pdf' : ''),
            'nomor_npwp' => $data['bentuk_usaha'] == 'badan_usaha' ? 'required' : '',
            'nama_npwp' => $data['bentuk_usaha'] == 'badan_usaha' ? 'required' : '',
            'badan_usaha' => $data['bentuk_usaha'] == 'badan_usaha' ? 'required' : '',
            'email_faktur' => $data['bentuk_usaha'] == 'badan_usaha' ? 'required|email' : '',
            'foto_npwp' => $data['update_id'] ? 'mimes:jpg,jpeg,pdf' : ($data['bentuk_usaha'] == 'badan_usaha' ? 'required|mimes:jpg,jpeg,pdf' : ''),
            'foto_sppkp' => $data['update_id'] ? 'mimes:jpg,jpeg,pdf' : ($data['bentuk_usaha'] == 'badan_usaha' ? ($data['status_pkp'] == 'pkp' ? 'required|mimes:jpg,jpeg,pdf' : '') : ''),
            'alamat_npwp' => $data['bentuk_usaha'] == 'badan_usaha' ? 'required' : '',
            'kota_npwp' => $data['bentuk_usaha'] == 'badan_usaha' ? 'required' : '',
            'nama_group' => ($data['status_kepemilikan'] == 'group') ? 'required' : '',
            'bidang_usaha_lain' => ($data['bidang_usaha'] == 'lainnya') ? 'required' : '',
            'jenis_cust' => 'required',

            // Informasi Bank
            'nomor_rekening' => 'required|numeric|digits_between:10,16',
            'nama_rekening' => 'required',
            'status_rekening' => 'required',
            'nama_bank' => 'required',
            'rekening_lain' => ($data['status_rekening'] == 'lainnya') ? 'required' : '',

            // Identitas Penanggung Jawab
            'foto_penanggung' => $data['update_id'] ? 'mimes:jpg,jpeg,pdf' : 'required|mimes:jpg,jpeg,pdf',
            'nama_penanggung_jawab' => 'required',
            'jabatan' => 'required',
            'identitas_penanggung_jawab' => 'required',
            'nomor_hp_penanggung_jawab' => 'required',

            // Cabang
            'nitku_cabang.*' => 'required|digits:22',
            'nama_cabang.*' => 'required',
            'alamat_nitku.*' => 'required',
        ];

        $message = [
            // Identitas Perusahaan
            'nama_perusahaan.required' => 'Nama perusahaan harus diisi',
            'nama_group_perusahaan.required' => 'Nama group perusahaan harus diisi',
            'alamat_lengkap.required' => 'Alamat lengkap harus diisi',
            'kota_kabupaten.required' => 'Kota/Kabupaten harus diisi',
            'no_hp.required' => 'Nomor handphone harus diisi',
            'no_hp.numeric' => 'Nomor handphone harus berupa angka',
            'no_hp.digits_between' => 'Nomor Handphone harus diantara 10 - 13 digit',
            'bidang_usaha.required' => 'Bidang usaha harus diisi',
            'alamat_email_perusahaan.email' => 'Email perusahaan harus valid',
            'status_kepemilikan.required' => 'Status kepemilikan harus diisi',
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'nomor_ktp.required' => 'Nomor KTP harus diisi',
            'nomor_ktp.numeric' => 'Nomor KTP harus berupa angka',
            'nomor_ktp.digits' => 'Nomor KTP harus 16 digit',
            'foto_ktp.required' => 'Foto KTP harus diisi',
            'foto_ktp.mimes' => 'Format file harus berupa JPG, JPEG, atau PDF',
            'nomor_npwp.required' => 'Nomor NPWP harus diisi',
            'nomor_npwp.digits_between' => 'Nomor NPWP harus diantara 15 - 16 digit',
            'nama_npwp.required' => 'Nama NPWP harus diisi',
            'badan_usaha.required' => 'Badan usaha harus diisi',
            'email_faktur.required' => 'Email faktur harus diisi',
            'email_faktur.email' => 'Format email harus valid',
            'foto_npwp.required' => 'Foto NPWP harus diisi',
            'foto_npwp.mimes' => 'Format file harus berupa JPG, JPEG, atau PDF',
            'foto_sppkp.required' => 'Foto SPPKP harus diisi',
            'foto_sppkp.mimes' => 'Format file harus berupa JPG, JPEG, atau PDF',
            'alamat_npwp.required' => 'Alamat NPWP harus diisi',
            'kota_npwp.required' => 'Kota NPWP harus diisi',
            'nama_group.required' => 'Nama group harus diisi',
            'bidang_usaha_lain.required' => 'Bidang usaha harus diisi',
            'jenis_cust.required' => 'Jenis customer harus diisi',
            
            // Informasi Bank
            'nomor_rekening.required' => 'Nomor rekening harus diisi',
            'nomor_rekening.numeric' => 'Nomor rekening harus berupa angka',
            'nomor_rekening.digits_between' => 'Nomor rekening harus diantara 10 - 16 digit',
            'nama_rekening.required' => 'Nama rekening harus diisi',
            'status_rekening' => 'Status rekening harus diisi',
            'nama_bank.required' => 'Nama bank harus diisi',
            'rekening_lain.required' => 'Rekening lain wajib diisi',
            
            // Identitas Penanggung Jawab
            'nama_penanggung_jawab.required' => 'Nama penanggung jawab harus diisi',
            'jabatan.required' => 'Jabatan harus diisi',
            'identitas_penanggung_jawab.required' => 'Identitas penanggung jawab harus diisi',
            'foto_penanggung.required' => 'Foto identitas penanggung jawab harus diisi',
            'foto_penanggung.mimes' => 'Format file identitas penanggung jawab harus berupa JPG, JPEG, atau PDF',
            'nomor_hp_penanggung_jawab.required' => 'Nomor HP penanggung jawab harus diisi',
            'nomor_hp_penanggung_jawab.numeric' => 'Nomor HP penanggung jawab harus berupa angka',
            'nomor_hp_penanggung_jawab.digits_between' => 'Nomor HP penanggung jawab harus diantara 10 - 13 digit',

            // Cabang
            'nitku_cabang.*.required' => 'NITKU harus diisi',
            'nitku_cabang.*.digits' => 'NITKU harus 22 digit',
            'nama_cabang.*.required' => 'Nama cabang harus diisi',
            'alamat_nitku.*.required' => 'Alamat cabang harus diisi',
        ];

        return Validator::make($data, $rules, $message);
    }

    public function edit_store(Request $request)
    {
        // dd($request->all());
        try {
            $validator = $this->validator($request->all());
            if ($validator->fails()) {
                return ['status' => false, 'error' => $validator->errors()->all()];
            }

            // Cek id
            $dekripsi = $request->update_id ? Crypt::decryptString($request->update_id) : '';

            // Identitas perusahaan
            $identitas_perusahaan = IdentitasPerusahaan::findOrNew($dekripsi);
            $identitas_perusahaan->nama_perusahaan = $request->nama_perusahaan;
            $identitas_perusahaan->nama_group_perusahaan = $request->nama_group_perusahaan;
            $identitas_perusahaan->alamat_lengkap = $request->alamat_lengkap;
            $identitas_perusahaan->kota_kabupaten = $request->kota_kabupaten;
            $identitas_perusahaan->bidang_usaha = $request->bidang_usaha;
            $identitas_perusahaan->status_cust = $request->jenis_cust;
            $identitas_perusahaan->identitas = ($request->bentuk_usaha == 'badan_usaha') ? 'npwp' : 'ktp';

            // Buat kode customer
            $lastest_cust = IdentitasPerusahaan::latest('id')->first();
            $lastSerialNumber = $lastest_cust ? $lastest_cust->kode_customer : 'K-00001';
            $serial_number = (int) substr($lastSerialNumber, 2);
            $number = str_pad($serial_number + 1, 5, '0', STR_PAD_LEFT);
            $kode_cust = 'K-' . $number;
            $identitas_perusahaan->kode_customer = $kode_cust;

            if($request->bidang_usaha == 'lainnya') {
                $identitas_perusahaan->bidang_usaha_lain = $request->bidang_usaha_lain;
            }

            // Hitung lama usaha berdasarkan tahun berdiri dengan tahun sekarang
            // $sekarang = Carbon::now()->format('Y');
            // $tahun_berdiri = Carbon::parse($request->tahun_berdiri)->format('Y');
            // $hasil = $sekarang - $tahun_berdiri;

            $identitas_perusahaan->tahun_berdiri = $request->tahun_berdiri;
            $identitas_perusahaan->lama_usaha = ($request->tahun_berdiri ? Str::replace(' tahun', '', $request->lama_usaha) : '');
            $identitas_perusahaan->alamat_email = $request->alamat_email_perusahaan;
            $identitas_perusahaan->nomor_handphone = $request->no_hp;
            $identitas_perusahaan->status_kepemilikan = $request->status_kepemilikan;
            $identitas_perusahaan->nama_sales = $request->sales;
            $identitas_perusahaan->bentuk_usaha = $request->bentuk_usaha;
            if($request->status_kepemilikan == 'group') {
                $identitas_perusahaan->nama_group = $request->nama_group;
            }

            // Kondisi jika identitas perusahaan yang dipakai KTP / NPWP
            if ($request->bentuk_usaha == 'perseorangan') {
                $identitas_perusahaan->nama_lengkap = $request->nama_lengkap;

                if($request->nomor_ktp == '-') {
                    return ['status' => false, 'error' => 'Nomor KTP harus diisi'];
                }
                $identitas_perusahaan->nomor_ktp = $request->nomor_ktp;
                if ($request->hasFile('foto_ktp')) {
                    if (File::exists('uploads/identitas_perusahaan/' . $identitas_perusahaan->foto_ktp)) {
                        File::delete('uploads/identitas_perusahaan/' . $identitas_perusahaan->foto_ktp);
                    }
                    $foto = $request->file('foto_ktp');
                    $ext = $foto->getClientOriginalExtension();
                    $filename = uniqid() . '-' . 'KTP-' . Str::slug($request->nama_lengkap, '-') . '.' . $ext;
                    $foto->move('uploads/identitas_perusahaan/', $filename);
                    $identitas_perusahaan->foto_ktp = $filename;

                    // $foto_ktp = fopen($request->file('foto_ktp')->getPathname(), 'r');
                    // $response = Http::withHeaders([
                    //     'x-api-key' => $this->apiKey,
                    // ])->attach(
                    //     'file',
                    //     $foto_ktp,
                    //     $request->file('foto_ktp')->getClientOriginalName()
                    // )->post($this->apiUrl, [
                    //     'category' => 'ktp',
                    //     'filename' => $filename,
                    // ]);

                    // fclose($foto_ktp);

                    // if ($response->successful()) {
                    //     $filename = $response->json('filename');
                    //     $filepath = $response->json('filepath');
                    //     $identitas_perusahaan->foto_ktp = $filename;
                    // }
                }
                // Clear NPWP column
                $identitas_perusahaan->badan_usaha = null;
                $identitas_perusahaan->nama_npwp = null;
                $identitas_perusahaan->nomor_npwp = null;
                $identitas_perusahaan->foto_npwp = null;
                $identitas_perusahaan->email_khusus_faktur_pajak = null;
                $identitas_perusahaan->status_pkp = 'non_pkp';
                $identitas_perusahaan->sppkp = null;
            } else {
                $identitas_perusahaan->badan_usaha = $request->badan_usaha;
                $identitas_perusahaan->nama_npwp = $request->nama_npwp;

                if($request->nomor_npwp == '-') {
                    return ['status' => false, 'error' => 'Nomor NPWP harus diisi'];
                }
                $identitas_perusahaan->nomor_npwp = $request->nomor_npwp;
                if ($request->hasFile('foto_npwp')) {
                    if (File::exists('uploads/identitas_perusahaan/' . $identitas_perusahaan->foto_npwp)) {
                        File::delete('uploads/identitas_perusahaan/' . $identitas_perusahaan->foto_npwp);
                    }
                    $foto = $request->file('foto_npwp');
                    $ext = $foto->getClientOriginalExtension();
                    $filename = uniqid() . '-' . 'NPWP-' . Str::slug($request->nama_npwp, '-') . '.' . $ext;
                    $foto->move('uploads/identitas_perusahaan/', $filename);
                    $identitas_perusahaan->foto_npwp = $filename;


                    // $foto_npwp = fopen($request->file('foto_npwp')->getPathname(), 'r');
                    // $response = Http::withHeaders([
                    //     'x-api-key' => $this->apiKey,
                    // ])->attach(
                    //     'file',
                    //     $foto_npwp,
                    //     $request->file('foto_npwp')->getClientOriginalName()
                    // )->post($this->apiUrl, [
                    //     'category' => 'npwp',
                    //     'filename' => $filename,
                    // ]);

                    // fclose($foto_npwp);
                    // if ($response->successful()) {
                    //     $filename = $response->json('filename');
                    //     $filepath = $response->json('filepath');
                    //     $identitas_perusahaan->foto_npwp = $filename;
                    // }
                }

                // Validasi email faktur pajak
                if($request->email_faktur == '-') {
                    return ['error' => 'Email faktur pajak wajib diisi dengan format yang benar'];
                }

                $identitas_perusahaan->email_khusus_faktur_pajak = $request->email_faktur;
                $identitas_perusahaan->status_pkp = $request->status_pkp;
                $identitas_perusahaan->alamat_npwp = $request->alamat_npwp;
                $identitas_perusahaan->kota_npwp = $request->kota_npwp;

                if ($request->status_pkp == 'pkp') {
                    if ($request->hasFile('foto_sppkp')) {
                        if (File::exists('uploads/identitas_perusahaan/' . $identitas_perusahaan->sppkp)) {
                            File::delete('uploads/identitas_perusahaan/' . $identitas_perusahaan->sppkp);
                        }
                        $foto = $request->file('foto_sppkp');
                        $ext = $foto->getClientOriginalExtension();
                        $filename = uniqid() . '-SPPKP' . '.' . $ext;
                        $foto->move('uploads/identitas_perusahaan/', $filename);
                        $identitas_perusahaan->sppkp = $filename;

                        // $foto_sppkp = fopen($request->file('foto_sppkp')->getPathname(), 'r');
                        // $response = Http::withHeaders([
                        //     'x-api-key' => $this->apiKey,
                        // ])->attach(
                        //     'file',
                        //     $foto_sppkp,
                        //     $request->file('foto_sppkp')->getClientOriginalName()
                        // )->post($this->apiUrl, [
                        //     'category' => 'sppkp',
                        //     'filename' => $filename,
                        // ]);

                        // fclose($foto_sppkp);

                        // if ($response->successful()) {
                        //     $filename = $response->json('filename');
                        //     $filepath = $response->json('filepath');
                        //     $identitas_perusahaan->sppkp = $filename;
                        // }
                    }
                }

                // Clear KTP column
                $identitas_perusahaan->nama_lengkap = null;
                $identitas_perusahaan->nomor_ktp = null;
                $identitas_perusahaan->foto_ktp = null;
            }
            $identitas_perusahaan->save();

            // Cabang
            $cabang = Cabang::where('identitas_perusahaan_id', $dekripsi);
            if($cabang->count() > 0) {
                $cabang->delete();
                // if(!isEmpty($request->nitku_cabang)) {
                    if($request->nitku_cabang) {
                        return ['status' => false, 'error' => 'NITKU cabang harus diisi'];
                    }

                    for($i = 0; $i < count($request->nitku_cabang); $i++) {
                        Cabang::insert([
                            'identitas_perusahaan_id' => $identitas_perusahaan->id,
                            'nitku' => $request->nitku_cabang[$i],
                            'nama' => $request->nama_cabang[$i],
                            'alamat' => $request->alamat_nitku[$i],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                // }
            } else {
                // if(!isEmpty($request->nitku_cabang)) {
                    if($request->nitku_cabang) {
                        return ['status' => false, 'error' => 'NITKU cabang harus diisi'];
                    }

                    for($i = 0; $i < count($request->nitku_cabang); $i++) {
                        Cabang::insert([
                            'identitas_perusahaan_id' => $identitas_perusahaan->id,
                            'nitku' => $request->nitku_cabang[$i],
                            'nama' => $request->nama_cabang[$i],
                            'alamat' => $request->alamat_nitku[$i],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                // }
            }

            // Identitas penanggung jawab
            $identitas_penanggung_jawab = DataIdentitas::firstOrNew([
                'identitas_perusahaan_id' => $dekripsi
            ]);
            $identitas_penanggung_jawab->identitas_perusahaan_id = $identitas_perusahaan->id;
            $identitas_penanggung_jawab->nama = $request->nama_penanggung_jawab;
            $identitas_penanggung_jawab->jabatan = $request->jabatan;
            $identitas_penanggung_jawab->identitas = $request->identitas_penanggung_jawab;
            $identitas_penanggung_jawab->no_hp = $request->nomor_hp_penanggung_jawab;

            if ($request->bentuk_usaha == 'perseorangan') {
                if($request->hasil_ttd) {
                    // Konversi base30 menjadi koordinat asli
                    $JSignatureTools = new base30ToImage;
                    $rawData = $JSignatureTools->base64ToNative($request->hasil_ttd);
    
                    // Membuat canvas gambar
                    $img = imagecreatetruecolor(367.2, 198);
                    $white = imagecolorallocate($img, 255, 255, 255);
                    $black = imagecolorallocate($img, 0, 0, 0);
                    imagefill($img, 0, 0, $white);
    
                    // Membuat fungsi untuk menggambar garis yang lebih tebal (bold)
                    function drawBoldLine($image, $x1, $y1, $x2, $y2, $penColor, $thickness = 3)
                    {
                        // Loop untuk menggambar garis dengan ketebalan
                        for ($i = -$thickness; $i <= $thickness; $i++) {
                            for ($j = -$thickness; $j <= $thickness; $j++) {
                                imageline($image, $x1 + $i, $y1 + $j, $x2 + $i, $y2 + $j, $penColor);
                            }
                        }
                    }
    
                    // Menggambar tanda tangan ke canvas
                    foreach ($rawData as $stroke) {
                        for ($i = 0; $i < count($stroke['x']); $i++) {
                            if ($i > 0) {
                                drawBoldLine(
                                    $img,
                                    $stroke['x'][$i - 1],
                                    $stroke['y'][$i - 1],
                                    $stroke['x'][$i],
                                    $stroke['y'][$i],
                                    $black,
                                    0.5 // ketebalan garis
                                );
                            }
                        }
                    }
                    if(!is_dir('uploads/ttd')) {
                        mkdir('uploads/ttd/', 0777, true);
                    }
                    
                    // Nama file untuk menyimpan gambar
                    $imageName = str_replace(' ', '-', $request->nama_penanggung_jawab) . '.png';
                    $filePath = 'uploads/ttd/' . $imageName;
                    
                    // Menyimpan gambar ke storage
                    $fullPath = public_path($filePath);
                    imagepng($img, $fullPath);
                    imagedestroy($img);
                    $identitas_penanggung_jawab->ttd = $imageName;
    
                    // Mengirim gambar ke API
                    // $foto_ttd = fopen($filePath, 'r');
                    // // dd($foto_ttd);
                    // $response = Http::withHeaders([
                    //     'x-api-key' => $this->apiKey,
                    // ])->attach(
                    //     'file',
                    //     $foto_ttd,
                        //     $imageName
                        // )->post($this->apiUrl, [
                        //     'category' => 'sign',
                        //     'filename' => $imageName,
                        // ]);
        
                        // fclose($foto_ttd);
    
                    // // dd($response);
                    // if ($response->successful()) {
                    //     $filename = $response->json('filename');
                    //     $filepath = $response->json('filepath');
                    //     $identitas_penanggung_jawab->ttd = $filename;
                    // }
                }
            }

            if ($request->hasFile('foto_penanggung')) {
                if (File::exists('uploads/penanggung_jawab/' . $identitas_penanggung_jawab->foto)) {
                    File::delete('uploads/penanggung_jawab/' . $identitas_penanggung_jawab->foto);
                }
                $foto = $request->file('foto_penanggung');
                $ext = $foto->getClientOriginalExtension();
                $filename = uniqid() . '-' . Str::slug($request->nama_penanggung_jawab, '-') . '.' . $ext;
                // Storage::disk('custom_path')->putFileAs($this->path, $foto, $filename);
                $foto->move('uploads/penanggung_jawab/', $filename);
                $identitas_penanggung_jawab->foto = $filename;

                // $foto_ktp_penanggung = fopen($request->file('foto_ktp_penanggung')->getPathname(), 'r');
                // // dd($request->file('foto_ktp_penanggung')->getClientOriginalName());
                // $response = Http::withHeaders([
                //     'x-api-key' => $this->apiKey,
                // ])->attach(
                //     'file',
                //     $foto_ktp_penanggung,
                //     $request->file('foto_ktp_penanggung')->getClientOriginalName()
                // )->post($this->apiUrl, [
                //     'category' => 'ktp_responsible',
                //     'filename' => $filename,
                // ]);

                // fclose($foto_ktp_penanggung);

                // if ($response->successful()) {
                //     $filename = $response->json('filename');
                //     $filepath = $response->json('filepath');
                //     $identitas_penanggung_jawab->foto = $filename;
                // }
            }
            $identitas_penanggung_jawab->save();

            // Informasi Bank
            $bank = InformasiBank::firstOrNew([
                'identitas_perusahaan_id' => $dekripsi
            ]);
            $bank->identitas_perusahaan_id = $identitas_perusahaan->id;
            $bank->nomor_rekening = $request->nomor_rekening;
            $bank->nama_rekening = $request->nama_rekening;
            $bank->status = $request->status_rekening;
            $bank->nama_bank = $request->nama_bank;
            if($request->status_rekening == 'lainnya') {
                $bank->rekening_lain = $request->rekening_lain;
            }
            $bank->save();

            $tipe_customer = TipeCustomer::firstOrNew([
                'identitas_perusahaan_id' => $dekripsi
            ]);
            $tipe_customer->identitas_perusahaan_id = $identitas_perusahaan->id;
            $tipe_customer->jenis_transaksi = $request->jenis_transaksi;
            $tipe_customer->tipe_harga = $request->tipe_harga;
            $tipe_customer->kategori_customer = $request->kategori_customer;
            $tipe_customer->plafond = floatval(str_replace('Rp ', '', str_replace('.', '', $request->plafond)));
            $tipe_customer->payment_term = $request->payment_term;
            $tipe_customer->channel_distributor = $request->channel_distributor;
            $tipe_customer->keterangan = $request->keterangan;
            $tipe_customer->save();

            $link = route('home.detail', ['id' => Crypt::encryptString($identitas_perusahaan->id)]);
            return ['status' => true, 'link' => $link];
        } catch (\Exception $e) {
            return ['status' => false, 'error' => 'Terjadi kesalahan'];
        }
    }

    public function select(Request $request)
    {
        if ($request->id) {
            $dekripsi = Crypt::decryptString($request->id);
            $data = IdentitasPerusahaan::with('data_identitas', 'informasi_bank', 'tipe_customer')->where('id', $dekripsi)->first();

            return ['status' => true, 'data' => $data];
        } else {
            return ['status' => false];
        }
    }

    protected function validasi_profil($data) {
        $rules = [
            'nama' => 'required',
            'username' => 'required',
        ];

        $message = [
            'nama.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
        ];

        return Validator::make($data, $rules, $message);
    }

    public function update_profil(Request $request) {
        try {
            $validation = $this->validasi_profil($request->all());
            if ($validation->fails()) {
                return ['status' => false, 'error' => $validation->errors()->all()];
            }

            $profil = User::find(Auth::user()->id);
            $profil->name = $request->nama;
            $profil->username = $request->username;
            $profil->save();

            return ['status' => true];
        } catch(\Exception $e) {
            return ['status' => false, 'error' => 'Terjadi Kesalahan'];
        }
    }

    protected function validasi_password($data) {
        $rules = [
            'password' => 'required|confirmed',
        ];

        $message = [
            'password.required' => 'Password harus diisi',
            'password.confirm' => 'Konfirmasi password tidak sesuai'
        ];

        return Validator::make($data, $rules, $message);
    }

    public function forgot_password(Request $request) {
        try {
            $validation = $this->validasi_password($request->all());
            if ($validation->fails()) {
                return ['status' => false, 'error' => $validation->errors()->all()];
            }

            if($request->username != Auth::user()->username) {
                return ['status' => false, 'error' => 'Username yang anda masukan tidak sesuai!'];
            }

            $data = User::find(Auth::user()->id);
            $data->password = Hash::make($request->password);
            $data->save();

            return ['status' => true];
        } catch(\Exception $e) {
            return ['status' => false, 'error' => 'Terjadi Kesalahan'];
        }
    }

    public function getPdf($id) {
        $data = IdentitasPerusahaan::find(Crypt::decryptString($id));
        $path = public_path() . '/uploads/identitas_perusahaan/final/' . $data->file_customer_external;
        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($path, $data->file_customer_external, $headers);
    }
}
