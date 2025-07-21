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
use App\Models\Cabang;
use App\Models\Sales;
use App\Models\TipeCustomer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

use function PHPUnit\Framework\isEmpty;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = IdentitasPerusahaan::orderBy('created_at', 'DESC')->get();
        return view('panel.home', compact('data'));
    }

    public function datatable(Request $request)
    {
        $data = IdentitasPerusahaan::with('tipe_customer')->where('status_aktif', '1')->orderBy('kode_customer', 'DESC')->orderBy('nama_group_perusahaan');
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('bentuk_usaha', function ($e) {
                if ($e->bentuk_usaha == 'perseorangan') {
                    $stat = 'O';
                } else {
                    $stat = 'U';
                }
                return $stat;
            })
            ->addColumn('bill_to_name', function ($e) {
                if ($e->bentuk_usaha == 'perseorangan') {
                    return $e->nama_lengkap ? $e->nama_lengkap : '-';
                } else {
                    return $e->nama_npwp ? $e->nama_npwp : '-';
                }
            })
            ->addColumn('bill_to_address', function ($e) {
                if ($e->bentuk_usaha == 'perseorangan') {
                    return $e->alamat_ktp ? $e->alamat_ktp : '-';
                } else {
                    return $e->alamat_npwp ? $e->alamat_npwp : '-';
                }
            })
            ->filterColumn('bill_to_address', function ($e, $keyword) {
                $e->where(function ($q) use ($keyword) {
                    $q->where('alamat_ktp', 'LIKE', "%{$keyword}%")->orWhere('alamat_npwp', 'LIKE', "%{$keyword}%");
                });
            })
            ->addColumn('aksi', function ($e) {
                $edit = '<button type="button" id="editCustomer" title="Edit Data Customer" data-id="' . Crypt::encryptString($e->id) . '">Edit</button>';
                $detail = '<button type="button" id="detailCustomer" title="Detail Data Customer" data-id="' . Crypt::encryptString($e->id) . '">Detail</button>';
                $delete = '<button type="button" id="hapusCustomer" title="Hapus Data Customer" data-id="' . Crypt::encryptString($e->id) . '">Delete</button>';
                $aksi = $edit . ' ' . $detail . ' ' . $delete;
                return $aksi;
            })
            ->addColumn('sales', function ($e) {
                return $e->nama_sales != '' ? $e->nama_sales : '-';
            })
            ->addColumn('status', function ($e) {
                if ($e->status_upload == 0) {
                    return '<span class="badge bg-danger px-3 py-2">Belum Upload</span>';
                } else {
                    return '<span class="badge bg-success px-3 py-2">Sudah Upload</span>';
                }
            })
            ->addColumn('checklist', function ($e) {
                if ($e->tipe_customer) {
                    if ($e->tipe_customer->new_bill_to_code != '' || $e->tipe_customer->new_bill_to_code != '-') {
                        return '<i class="fa-solid fa-square-check text-success fs-5"></i>';
                    } else {
                        return '<i class="fa-solid fa-square-xmark text-danger fs-5"></i>';
                    }
                } else {
                    return '<i class="fa-solid fa-square-xmark text-danger fs-5"></i>';
                }
            })
            ->rawColumns(['aksi', 'status', 'checklist'])
            ->make(true);
    }

    public function detail($id)
    {
        $data = IdentitasPerusahaan::with('data_identitas', 'informasi_bank', 'tipe_customer')->where('id', Crypt::decryptString($id))->first();
        // dd($data);
        $enkripsi = $id;
        $url = route('home.edit', ['id' => $enkripsi]);

        if ($data->bentuk_usaha == 'perseorangan') {
            return view('panel.perseorangan.home_detail_perseorangan', compact('data', 'enkripsi', 'url'));
        } else {
            return view('panel.badan_usaha.home_detail_badan_usaha', compact('data', 'enkripsi', 'url'));
        }
    }

    public function edit($id)
    {
        $data = IdentitasPerusahaan::with('data_identitas', 'informasi_bank', 'tipe_customer')->where('id', Crypt::decryptString($id))->first();
        $enkripsi = $id;
        // dd($data);

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
            return view('panel.perseorangan.home_edit_perseorangan', compact('data', 'enkripsi', 'bidang_usaha', 'url', 'sales'));
        } else {
            return view('panel.badan_usaha.home_edit_badan_usaha', compact('data', 'enkripsi', 'bidang_usaha', 'url', 'sales'));
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
            'badan_usaha_lain' => $data['bentuk_usaha'] == 'badan_usaha' ? ($data['badan_usaha'] == 'lainnya' ? 'required' : '') : '',

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
            'nitku_cabang.*' => $data['bentuk_usaha'] == 'badan_usaha' ? 'required|digits:22' : '',
            'nama_cabang.*' => $data['bentuk_usaha'] == 'badan_usaha' ? 'required' : '',
            'alamat_nitku.*' => $data['bentuk_usaha'] == 'badan_usaha' ? 'required' : '',
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
            // 'email_faktur.required' => 'Email faktur harus diisi',
            // 'email_faktur.email' => 'Format email harus valid',
            'foto_npwp.required' => 'Foto NPWP harus diisi',
            'foto_npwp.mimes' => 'Format file harus berupa JPG, JPEG, atau PDF',
            'foto_sppkp.required' => 'Foto SPPKP harus diisi',
            'foto_sppkp.mimes' => 'Format file harus berupa JPG, JPEG, atau PDF',
            'alamat_npwp.required' => 'Alamat NPWP harus diisi',
            'kota_npwp.required' => 'Kota NPWP harus diisi',
            'nama_group.required' => 'Nama group harus diisi',
            'bidang_usaha_lain.required' => 'Bidang usaha lain harus diisi',
            'badan_usaha_lain.required' => 'Badan usaha lain harus diisi',

            // Informasi Bank
            'nomor_rekening.required' => 'Nomor rekening harus diisi',
            'nomor_rekening.numeric' => 'Nomor rekening harus berupa angka',
            // 'nomor_rekening.digits_between' => 'Nomor rekening harus diantara 10 - 16 digit',
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
            // dd($dekripsi);

            // Identitas perusahaan
            $identitas_perusahaan = IdentitasPerusahaan::findOrNew($dekripsi);
            $identitas_perusahaan->nama_perusahaan = $request->nama_perusahaan;
            $identitas_perusahaan->nama_group_perusahaan = $request->nama_group_perusahaan;
            $identitas_perusahaan->alamat_lengkap = $request->alamat_lengkap;
            $identitas_perusahaan->alamat_group_lengkap = $request->alamat_group_lengkap;
            $identitas_perusahaan->kota_kabupaten = $request->kota_kabupaten;
            $identitas_perusahaan->bidang_usaha = $request->bidang_usaha;
            $identitas_perusahaan->identitas = ($request->bentuk_usaha == 'badan_usaha') ? 'npwp' : 'ktp';

            if ($request->bidang_usaha == 'lainnya') {
                $identitas_perusahaan->bidang_usaha_lain = $request->bidang_usaha_lain;
            }

            $identitas_perusahaan->tahun_berdiri = $request->tahun_berdiri;
            $identitas_perusahaan->lama_usaha = ($request->tahun_berdiri ? Str::replace(' tahun', '', $request->lama_usaha) : '');
            $identitas_perusahaan->alamat_email = $request->alamat_email_perusahaan;
            $identitas_perusahaan->nomor_handphone = $request->no_hp;
            $identitas_perusahaan->status_kepemilikan = $request->status_kepemilikan;
            $identitas_perusahaan->nama_sales = $request->sales;
            $identitas_perusahaan->bentuk_usaha = $request->bentuk_usaha;
            if ($request->status_kepemilikan == 'group') {
                $identitas_perusahaan->nama_group = $request->nama_group;
            }

            // Kondisi jika identitas perusahaan yang dipakai KTP / NPWP
            if ($request->bentuk_usaha == 'perseorangan') {
                $identitas_perusahaan->identitas = 'ktp';
                $identitas_perusahaan->nama_lengkap = $request->nama_lengkap;
                $identitas_perusahaan->alamat_ktp = $request->alamat_ktp;

                if ($request->nomor_ktp == '-') {
                    return ['status' => false, 'error' => 'Nomor KTP harus diisi'];
                }
                if ($request->hasFile('foto_ktp')) {
                    $foto = $request->file('foto_ktp');
                    $ext = $foto->getClientOriginalExtension();
                    $filename = uniqid() . '-KTP-' . Str::slug($request->nama_lengkap, '-') . '.' . $ext;
                    $foto->move('uploads/identitas_perusahaan/', $filename);

                    // try {
                    //     $response = Http::withHeaders([
                    //         'x-api-key' => config('services.service_x.api_key'),
                    //         'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                    //     ])->get(config('services.service_x.url') . '/api/checkfile', [
                    //         'category' => 'FileIDCompanyOrPersonal',
                    //         'filename' => $identitas_perusahaan->foto_ktp
                    //     ]);

                    //     $result = $response->json();
                    //     if ($result['status'] == true) {
                    //         $category = 'FileIDCompanyOrPersonal';
                    //         $response = Http::withHeaders([
                    //             'x-api-key' => config('services.service_x.api_key'),
                    //             'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                    //         ])->delete(config('services.service_x.url') . "/api/deletefile/$category/$identitas_perusahaan->foto_ktp", []);
                    //         $result = $response->json();
                    //     }

                    $identitas_perusahaan->foto_ktp = $filename;
                    //     $response = Http::withHeaders([
                    //         'x-api-key' => config('services.service_x.api_key'),
                    //         'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                    //     ])->attach(
                    //         'file',
                    //         file_get_contents($foto->getRealPath()),
                    //         $filename
                    //     )->post(config('services.service_x.url') . '/api/uploadfile', [
                    //         'category' => 'FileIDCompanyOrPersonal',
                    //         'filename' => substr($filename, 0, strrpos($filename, '.'))
                    //     ]);
                    // } catch (\Illuminate\Http\Client\ConnectionException) {
                    //     abort(403, 'Server tidak bisa diakses, silahkan hubungi pihak yang bersangkutan.');
                    // }
                }
                // Clear NPWP column
                $identitas_perusahaan->badan_usaha = null;
                $identitas_perusahaan->nama_npwp = null;
                $identitas_perusahaan->foto_npwp = null;
                $identitas_perusahaan->email_khusus_faktur_pajak = null;
                $identitas_perusahaan->status_pkp = 'non_pkp';
                $identitas_perusahaan->sppkp = null;
            } else {
                $identitas_perusahaan->identitas = 'npwp';
                $identitas_perusahaan->badan_usaha = $request->badan_usaha;
                $identitas_perusahaan->nama_npwp = $request->nama_npwp;
                if ($request->badan_usaha == 'lainnya') {
                    $identitas_perusahaan->badan_usaha_lain = $request->badan_usaha_lain;
                }

                if ($request->nomor_npwp == '-') {
                    return ['status' => false, 'error' => 'Nomor NPWP harus diisi'];
                }
                $identitas_perusahaan->nomor_npwp = $request->nomor_npwp;
                if ($request->hasFile('foto_npwp')) {
                    $foto = $request->file('foto_npwp');
                    $ext = $foto->getClientOriginalExtension();
                    $filename = uniqid() . '-NPWP-' . Str::slug($request->nama_npwp, '-') . '.' . $ext;
                    $foto->move('uploads/identitas_perusahaan/', $filename);

                    // try {
                    //     $response = Http::withHeaders([
                    //         'x-api-key' => config('services.service_x.api_key'),
                    //         'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                    //     ])->get(config('services.service_x.url') . '/api/checkfile', [
                    //         'category' => 'FileIDCompanyOrPersonal',
                    //         'filename' => $identitas_perusahaan->foto_npwp
                    //     ]);

                    //     $result = $response->json();
                    //     if ($result['status'] == true) {
                    //         $category = 'FileIDCompanyOrPersonal';
                    //         $response = Http::withHeaders([
                    //             'x-api-key' => config('services.service_x.api_key'),
                    //             'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                    //         ])->delete(config('services.service_x.url') . "/api/deletefile/$category/$identitas_perusahaan->foto_npwp", []);
                    //         $result = $response->json();
                    //     }

                    $identitas_perusahaan->foto_npwp = $filename;
                    //     $response = Http::withHeaders([
                    //         'x-api-key' => config('services.service_x.api_key'),
                    //         'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                    //     ])->attach(
                    //         'file',
                    //         file_get_contents($foto->getRealPath()),
                    //         $filename
                    //     )->post(config('services.service_x.url') . '/api/uploadfile', [
                    //         'category' => 'FileIDCompanyOrPersonal',
                    //         'filename' => substr($filename, 0, strrpos($filename, '.'))
                    //     ]);
                    // } catch (\Illuminate\Http\Client\ConnectionException) {
                    //     abort(403, 'Server tidak bisa diakses, silahkan hubungi pihak yang bersangkutan.');
                    // }
                }

                // Validasi email faktur pajak
                if ($request->email_faktur == '-') {
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
                        $filename = uniqid() . '-SPPKP-' . Str::slug($identitas_perusahaan->nama_group, '-') . '.' . $ext;
                        $foto->move('uploads/identitas_perusahaan/', $filename);

                        // try {
                        //     $response = Http::withHeaders([
                        //         'x-api-key' => config('services.service_x.api_key'),
                        //         'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                        //     ])->get(config('services.service_x.url') . '/api/checkfile', [
                        //         'category' => 'FileSPPKPCompany',
                        //         'filename' => $identitas_perusahaan->sppkp
                        //     ]);

                        //     $result = $response->json();
                        //     if ($result['status'] == true) {
                        //         $category = 'FileSPPKPCompany';
                        //         $response = Http::withHeaders([
                        //             'x-api-key' => config('services.service_x.api_key'),
                        //             'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                        //         ])->delete(config('services.service_x.url') . "/api/deletefile/$category/$identitas_perusahaan->sppkp", []);
                        //         $result = $response->json();
                        //     }

                        $identitas_perusahaan->sppkp = $filename;
                        //     $response = Http::withHeaders([
                        //         'x-api-key' => config('services.service_x.api_key'),
                        //         'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                        //     ])->attach(
                        //         'file',
                        //         file_get_contents($foto->getRealPath()),
                        //         $filename
                        //     )->post(config('services.service_x.url') . '/api/uploadfile', [
                        //         'category' => 'FileSPPKPCompany',
                        //         'filename' => substr($filename, 0, strrpos($filename, '.'))
                        //     ]);
                        // } catch (\Illuminate\Http\Client\ConnectionException) {
                        //     abort(403, 'Server tidak bisa diakses, silahkan hubungi pihak yang bersangkutan.');
                        // }
                    }
                }

                // Clear KTP column
                $identitas_perusahaan->nama_lengkap = null;
                $identitas_perusahaan->nomor_ktp = null;
                $identitas_perusahaan->foto_ktp = null;
            }
            $identitas_perusahaan->npwp_perseorangan = $request->npwp_perseorangan;
            $identitas_perusahaan->save();

            // Cabang
            $cabang = Cabang::where('identitas_perusahaan_id', $dekripsi);
            if ($cabang->count() > 0) {
                $cabang->delete();
                if ($request['nitku_cabang'][0] != null) {
                    for ($i = 0; $i < count($request->nitku_cabang); $i++) {
                        if ($request->nitku_cabang[$i] == '-') {
                            return ['status' => false, 'error' => 'NITKU Cabang wajib diisi dengan format yang benar'];
                        }

                        Cabang::insert([
                            'identitas_perusahaan_id' => $identitas_perusahaan->id,
                            'nitku' => $request->nitku_cabang[$i],
                            'nama' => $request->nama_cabang[$i],
                            'alamat' => $request->alamat_nitku[$i],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                }
            } else {
                if ($request['nitku_cabang'][0] != null) {
                    for ($i = 0; $i < count($request->nitku_cabang); $i++) {
                        if ($request->nitku_cabang[$i] == '-') {
                            return ['status' => false, 'error' => 'NITKU Cabang wajib diisi dengan format yang benar'];
                        }

                        Cabang::insert([
                            'identitas_perusahaan_id' => $identitas_perusahaan->id,
                            'nitku' => $request->nitku_cabang[$i],
                            'nama' => $request->nama_cabang[$i],
                            'alamat' => $request->alamat_nitku[$i],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                }
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
            if ($request->hasFile('foto_penanggung')) {
                $foto = $request->file('foto_penanggung');
                $ext = $foto->getClientOriginalExtension();
                $filename = uniqid() . '-PIC-' . strtoupper($request->identitas_penanggung_jawab) . '-' . Str::slug($request->nama_penanggung_jawab, '-') . '.' . $ext;
                $foto->move('uploads/penanggung_jawab/', $filename);

                // try {
                //     $response = Http::withHeaders([
                //         'x-api-key' => config('services.service_x.api_key'),
                //         'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                //     ])->get(config('services.service_x.url') . '/api/checkfile', [
                //         'category' => 'FileIDPersonCharge',
                //         'filename' => $identitas_penanggung_jawab->foto
                //     ]);

                //     $result = $response->json();
                //     if ($result['status'] == true) {
                //         $category = 'FileIDPersonCharge';
                //         $response = Http::withHeaders([
                //             'x-api-key' => config('services.service_x.api_key'),
                //             'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                //         ])->delete(config('services.service_x.url') . "/api/deletefile/$category/$identitas_penanggung_jawab->foto", []);
                //         $result = $response->json();
                //     }

                $identitas_penanggung_jawab->foto = $filename;
                //     $response = Http::withHeaders([
                //         'x-api-key' => config('services.service_x.api_key'),
                //         'Host' => parse_url(config('services.service_x.url'), PHP_URL_HOST)
                //     ])->attach(
                //         'file',
                //         file_get_contents($foto->getRealPath()),
                //         $filename
                //     )->post(config('services.service_x.url') . '/api/uploadfile', [
                //         'category' => 'FileIDPersonCharge',
                //         'filename' => substr($filename, 0, strrpos($filename, '.'))
                //     ]);
                // } catch (\Illuminate\Http\Client\ConnectionException) {
                //     abort(403, 'Server tidak bisa diakses, silahkan hubungi pihak yang bersangkutan.');
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
            if ($request->status_rekening == 'lainnya') {
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
            $tipe_customer->kode_customer = $request->kode_customer;
            $tipe_customer->new_bill_to_code = $request->new_bill_to_code;
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

    protected function validasi_profil($data)
    {
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

    public function update_profil(Request $request)
    {
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
        } catch (\Exception $e) {
            return ['status' => false, 'error' => 'Terjadi Kesalahan'];
        }
    }

    protected function validasi_password($data)
    {
        $rules = [
            'password' => 'required|confirmed',
        ];

        $message = [
            'password.required' => 'Password harus diisi',
            'password.confirm' => 'Konfirmasi password tidak sesuai'
        ];

        return Validator::make($data, $rules, $message);
    }

    public function forgot_password(Request $request)
    {
        try {
            $validation = $this->validasi_password($request->all());
            if ($validation->fails()) {
                return ['status' => false, 'error' => $validation->errors()->all()];
            }

            if ($request->username != Auth::user()->username) {
                return ['status' => false, 'error' => 'Username yang anda masukan tidak sesuai!'];
            }

            $data = User::find(Auth::user()->id);
            $data->password = Hash::make($request->password);
            $data->save();

            return ['status' => true];
        } catch (\Exception $e) {
            return ['status' => false, 'error' => 'Terjadi Kesalahan'];
        }
    }

    public function getPdf($id)
    {
        $data = IdentitasPerusahaan::find(Crypt::decryptString($id));
        $path = public_path() . '/uploads/identitas_perusahaan/final/' . $data->file_customer_external;
        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($path, $data->file_customer_external, $headers);
    }

    public function hapusCustomer(Request $request)
    {
        try {
            $dekripsi = Crypt::decryptString($request->id);
            IdentitasPerusahaan::where('id', $dekripsi)->delete();
            DataIdentitas::where('identitas_perusahaan_id', $dekripsi)->delete();
            InformasiBank::where('identitas_perusahaan_id', $dekripsi)->delete();
            TipeCustomer::where('identitas_perusahaan_id', $dekripsi)->delete();

            $cabangCount = Cabang::where('identitas_perusahaan_id', $dekripsi)->count();
            if ($cabangCount > 0) {
                Cabang::where('identitas_perusahaan_id', $dekripsi)->delete();
            }

            return ['status' => true, 'pesan' => 'Data berhasil dihapus'];
        } catch (\Exception $e) {
            // dd($e);
            return ['status' => false, 'error' => 'Terjadi Kesalahan'];
        }
    }
}
