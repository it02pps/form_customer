@extends('layouts.main_app')

@section('title')
    <title>Detail Data Customer | PT. PAPASARI</title>
@endsection

@section('css')
@endsection

@section('content')
    @php
        // FOTO KTP
        $fotoKTP = $data['foto_ktp'] ?? null;
        $urlKTP = url('/form-customer/getFiles/FileIDCompanyOrPersonal/' . $fotoKTP);
        $extKTP = File::extension($fotoKTP);

        // FOTO PENANGGUNG
        $fotoPenanggung = $data['data_identitas']['foto'] ?? null;
        $urlPenanggung = url('/form-customer/getFiles/FileIDPersonCharge/' . $fotoPenanggung);
        $extPenanggung = File::extension($fotoPenanggung);
    @endphp

    <div class="px-4 py-3 px-md-5">
        <div class="header d-flex justify-content-between align-items-center mb-4">
            <div class="logo">
                <img src="{{ asset('images/PNG 4125 x 913.png') }}" class="img-fluid" alt="Logo">
            </div>
            <div class="d-flex gap-3 justify-content-end w-100">
                <img id="logoutBtn" src="{{ asset('images/Log Out.png') }}" class="img-fluid" style="width: 40px; cursor: pointer;" title="Logout" alt="Logout">
                <form id="logout-form" action="{{ route('form_customer.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
        <h1 class="text-center text-md-start">Detail Data Customer</h1>
        <hr>
        <div class="py-2">
            <h1 class="text-center text-md-start">Identitas Perseorangan</h1>
            <div class="d-flex flex-column gap-3">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group p-0">
                            <label for="">Sales</label>
                            <input type="text" name="nama_sales" id="nama_sales" class="form-control" autocomplete="off" readonly value="{{ $data['nama_sales'] ?: '-' }}">
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Nama Group Usaha</label>
                            <input type="text" name="nama_group_perusahaan" id="nama_group_perusahaan" class="form-control" autocomplete="off" readonly value="{{ $data['nama_group_perusahaan'] }}">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Alamat Email Usaha</label>
                            <input type="text" name="alamat_email_perusahaan" id="alamat_email_perusahaan" class="form-control" autocomplete="off" readonly value="{{ $data['alamat_email'] ?: '-' }}">
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Alamat Group Usaha</label>
                            <textarea name="alamat_group_lengkap" id="alamat_group_lengkap" class="form-control" rows="6" autocomplete="off" readonly>{{ $data['alamat_group_lengkap'] }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Kota/Kabupaten</label>
                            <input type="text" name="kota_kabupaten" id="kota_kabupaten" class="form-control" autocomplete="off" readonly value="{{ $data['kota_kabupaten'] }}">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Nomor Handphone Contact Person</label>
                            <input type="text" name="no_hp" id="no_hp" class="form-control" autocomplete="off" readonly value="{{ $data['nomor_handphone'] }}">
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Tahun Berdiri</label>
                            <input type="text" name="tahun_berdiri" id="tahun_berdiri" autocomplete="off" class="form-control" readonly value="{{ $data['tahun_berdiri'] ?: '-' }}">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Lama Usaha (Tahun)</label>
                            <input type="text" name="lama_usaha" id="lama_usaha" class="form-control" autocomplete="off" readonly value="{{ $data['lama_usaha'] ?: '-' }}">
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Bidang Usaha</label>
                            <input type="text" name="bidang_usaha" id="bidang_usaha" autocomplete="off" class="form-control" readonly value="{{ strtoupper(str_replace('_', ' ', $data['bidang_usaha'])) }}">
                            <div class="bidang_lain p-0 @if($data['bidang_usaha'] != 'lainnya') d-none @endif">
                                <input type="text" class="form-control" name="bidang_usaha_lain" id="bidang_usaha_lain" readonly autocomplete="off" value="{{ $data['bidang_usaha_lain'] ?: '-'  }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Status Kepemilkan Tempat Usaha</label>
                            <input type="text" name="status_kepemilikan" id="status_kepemilikan" autocomplete="off" class="form-control" readonly value="{{ ucwords(str_replace('_', ' ', $data['status_kepemilikan'])) }}">
                            <div class="group p-0 @if($data['status_kepemilikan'] != 'group') d-none @endif">
                                <input type="text" class="form-control" name="nama_group" id="nama_group" autocomplete="off" readonly value="{{ $data['nama_group'] ?: '-' }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">NIK</label>
                            <input type="text" id="nomor_ktp" name="nomor_ktp" autocomplete="off" class="form-control" readonly value="{{ $data['nomor_ktp'] ?: $data['nomor_npwp'] }}">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Nama Lengkap Sesuai Identitas</label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" autocomplete="off" class="form-control" readonly value="{{ $data['nama_lengkap'] ?: '-' }}">
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Alamat Lengkap Sesuai KTP</label>
                            <textarea name="alamat_ktp" id="alamat_ktp" rows="6" class="form-control" autocomplete="off" readonly>{{ $data['alamat_ktp'] }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group p-0">
                            <label for="">Foto KTP <span class="text-danger">*</span></label>
                            @if($fotoKTP)
                                <div class="form-group {{ $extKTP === 'pdf' ? 'd-flex justify-content-between align-items-center py-2 px-3 m-0' : 'p-0' }}" id="preview_ktp" style="height: {{ $extKTP === 'pdf' ? 'auto' : '271px' }};">
                                    @if($extKTP === 'pdf')
                                        <p style="font-size: 18px;">Preview file KTP</p>
                                        <a href="{{ $urlKTP }}" target="_blank" id="previewPDF">Preview PDF</a>
                                    @else
                                        <img id="preview_foto_ktp" src="{{ $urlKTP }}" alt="Belum ada file" data-action="zoom">
                                    @endif
                                </div>
                            @else
                                <div id="preview_ktp" class="form-group">
                                    <p class="text-center">File tidak ditemukan</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group" id="cabang">
                            <label for="">Cabang</label>
                            <input type="text" class="form-control" autocomplete="off" readonly placeholder="{{ App\Models\Cabang::where('identitas_perusahaan_id', $data['id'])->count() }} Cabang">
                            <button type="button" class="btnDetailCabang btn btn-primary w-100" title="Detail Cabang" data-bs-target="#modalCabang" data-bs-toggle="modal">Detail Cabang</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <h1 class="text-center text-md-start">Informasi Bank</h1>
            <div class="d-flex flex-column gap-3">
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Nomor Rekening</label>
                            <input type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" autocomplete="off" readonly value="{{ $data['informasi_bank'] ? ($data['informasi_bank']['nomor_rekening'] ?: '-') : '-' }}">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Nama Rekening</label>
                            <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" autocomplete="off" readonly value="{{ $data['informasi_bank'] ? ($data['informasi_bank']['nama_rekening'] ?: '-') : '-' }}">
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Nama Bank</label>
                            <input type="text" name="nama_bank" id="nama_bank" class="form-control" autocomplete="off" readonly value="{{ $data['informasi_bank'] ? ($data['informasi_bank']['nama_bank'] ?: '-' ) : '-' }}">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Pemilik Rekening</label>
                            <input type="text" name="pemilik_rekening" id="pemilik_rekening" class="form-control" autocomplete="off" readonly value="{{ $data['informasi_bank'] ? (ucwords(str_replace('_', ' ', $data['informasi_bank']['status'])) ?: '-') : '-' }}">
                            <div class="rekening_lain @if($data['informasi_bank'] && $data['informasi_bank']['status'] != 'lainnya') d-none @endif">
                                <input type="text" class="form-control" name="rekening_lain" id="rekening_lain" autocomplete="off" readonly value="{{ $data['informasi_bank'] ? ($data['informasi_bank']['rekening_lain'] ?: '-') : '-' }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Nama Finance</label>
                            <input type="text" name="nama_finance" id="nama_finance" class="form-control" autocomplete="off" readonly value="{{ $data['data_finance'] ? ($data['data_finance']['nama'] ?: '-') : '-' }}">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">No HP Finance</label>
                            <input type="text" name="no_hp_finance" id="no_hp_finance" class="form-control" maxlength="20" autocomplete="off" readonly value="{{ $data['data_finance'] ? ($data['data_finance']['no_hp'] ?: '-') : '-' }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Email Finance</label>
                    <input type="text" name="email_finance" id="email_finance" class="form-control" autocomplete="off" readonly value="{{ $data['data_finance'] ? ($data['data_finance']['email'] ?: '-') : '-' }}">
                </div>
            </div>
            <hr>
            <h1 class="text-center text-md-start">Data Identitas Penanggung Jawab</h1>
            <div class="d-flex flex-column gap-3">
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Nama Penanggung Jawab</label>
                            <input type="text" name="nama_penanggung_jawab" id="nama_penanggung_jawab" autocomplete="off" class="form-control" readonly value="{{ $data['data_identitas'] ? ($data['data_identitas']['nama'] ?: '-') : '-' }}">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control" autocomplete="off" readonly value="{{ $data['data_identitas'] ? ($data['data_identitas']['jabatan'] ?: '-') : '-' }}">
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group" >
                            <label for="">Identitas Penanggung Jawab</label>
                            <input type="text" name="identitas_penanggung_jawab" id="identitas_penanggung_jawab" class="form-control" autocomplete="off" readonly value="{{ $data['data_identitas'] ? (strtoupper($data['data_identitas']['identitas']) ?: '-') : '-' }}">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Nomor Handphone</label>
                            <input type="text" name="nomor_hp_penanggung_jawab" id="nomor_hp_penanggung_jawab" autocomplete="off" class="form-control" readonly value="{{ $data['data_identitas'] ? ($data['data_identitas']['no_hp'] ?: '-') : '-' }}">
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Foto Identitas (KTP / NPWP)</label>
                            @if($fotoPenanggung)
                                <div class="form-group {{ $extPenanggung === 'pdf' ? 'd-flex justify-content-between align-items-center py-2 px-3 m-0' : 'p-0' }}" id="preview_penanggung" style="height: {{ $extPenanggung === 'pdf' ? 'auto' : '271px' }};">
                                    @if($extPenanggung === 'pdf')
                                        <p style="font-size: 18px;">Preview file identitas</p>
                                        <a href="{{ $urlPenanggung }}" target="_blank" id="previewPDF">Preview PDF</a>
                                    @else
                                        <img id="preview_foto_penanggung" src="{{ $urlPenanggung }}" alt="Belum ada file" data-action="zoom">
                                    @endif
                                </div>
                            @else
                                <div id="preview_penanggung" class="form-group">
                                    <p class="text-center">File tidak ditemukan</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        {{-- Signature --}}
                        <div class="form-group" id="ttd_credit">
                            <label for="">Tanda Tangan</label>
                            <div id="signature">
                                @if ($data['data_identitas'] && $data['data_identitas']['status_upload_ttd'] === 'success')
                                    <img src="{{ url('/form-customer/getFiles/FileIDSignature/' . $data['data_identitas']['ttd']) }}" alt="Belum ada tanda tangan" data-action="zoom">
                                @elseif ($data['data_identitas'] && $data['data_identitas']['status_upload_ttd'] === 'pending')
                                    <img src="{{ asset('public/temp_files/' . $data['data_identitas']['ttd']) }}" alt="Belum ada tanda tangan" data-action="zoom">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <h1 class="text-center text-md-start">Tipe Customer</h1>
            <div class="d-flex flex-column gap-3">
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Jenis Transaksi</label>
                            <input type="text" name="jenis_transaksi" id="jenis_transaksi" readonly autocomplete="off" class="form-control" value="{{ $data['tipe_customer'] ? ucwords(str_replace('_', ' ', $data['tipe_customer']['jenis_transaksi'])) : '-' }}">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Tipe Harga</label>
                            <input type="text" name="tipe_harga" id="tipe_harga" class="form-control" autocomplete="off" readonly value="{{ $data['tipe_customer'] ? ucwords(str_replace('_', ' ', $data['tipe_customer']['tipe_harga'])) : '-' }}">
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group" >
                            <label for="">Kategori Customer</label>
                            <input type="text" name="kategori_customer" id="kategori_customer" class="form-control" autocomplete="off" readonly value="{{ $data['tipe_customer'] ? ucwords(str_replace('_', ' ', $data['tipe_customer']['kategori_customer'])) : '-' }}">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Plafond</label>
                            <input type="text" name="plafond" id="plafond" readonly autocomplete="off" class="form-control" value="{{ $data['tipe_customer'] ? 'Rp ' . number_format($data['tipe_customer']['plafond'], 0, ',', '.') : '-' }}">
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Term of Payment</label>
                            <input type="text" name="plafond" id="plafond" readonly autocomplete="off" class="form-control" value="{{ $data['tipe_customer'] ? $data['tipe_customer']['payment_term'] : '-' }}">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Channel Distributor</label>
                            @if($data['tipe_customer'])
                                @if($data['tipe_customer']['channel_distributor'] == 'allptk')
                                    <input type="text" name="channel_distributor" id="channel_distributor" readonly autocomplete="off" class="form-control" value="Semua Jalur Pontianak">
                                @else
                                    <input type="text" name="channel_distributor" id="channel_distributor" readonly autocomplete="off" class="form-control" value="Semua Jalur Jakarta">
                                @endif
                            @else
                                <input type="text" name="channel_distributor" id="channel_distributor" readonly autocomplete="off" class="form-control" value="-">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" readonly autocomplete="off" class="form-control" value="{{ $data['tipe_customer'] ? $data['tipe_customer']['keterangan'] : '-' }}">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Kode Customer</label>
                            <input type="text" name="kode_customer" id="kode_customer" readonly autocomplete="off" class="form-control" value="{{ $data['tipe_customer'] ? $data['tipe_customer']['kode_customer'] : '-' }}">
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group" id="select">
                            <label for="">Apakah Terbaca Sebagai NPWP?</label>
                            <input type="text" name="npwp_perseorangan" id="npwp_perseorangan" readonly autocomplete="off" class="form-control" value="{{ $data['npwp_perseorangan'] == 0 ? 'Tidak' : 'Iya' }}">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">New Bill To Code</label>
                            <input type="text" name="new_bill_to_code" id="new_bill_to_code" readonly autocomplete="off" class="form-control" value="{{ $data['tipe_customer'] ? ($data['tipe_customer']['new_bill_to_code'] ?? '') : '-' }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column-reverse flex-md-row gap-2 justify-content-md-end w-100 mt-4" id="footer">
            <button type="button" class="btnKembali btn btn-outline-danger" title="Kembali">Kembali</button>
            <button type="submit" class="btnEditData btn btn-warning" title="Edit Data Customer" data-url="{{ $url }}">Edit Data Customer</button>
            <button type="button" class="btnUploadFile btn btn-primary" title="Upload File" data-bs-toggle="modal" data-bs-target="#modalUpload">Upload File</button>
            @if($data['file_customer_external'] != '' && $data['status_upload'] == '1')
                <a type="button" href="{{ route('home.getPdf', ['id' => $enkripsi]) }}" target="_blank" class="btnDownloadPdf btn btn-dark" title="Download PDF">Download PDF</a>
            @endif
        </div>
    </div>

    {{-- START: Modal upload file --}}
    <div class="modal fade" id="modalUpload" tabindex="-1" aria-labelledby="modalUpload" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload PDF</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formUploadPdf" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="menu" id="menu" value="{{ str_replace('_', '-', $data['bentuk_usaha']) }}">
                        <input type="hidden" name="data" id="data" value="{{ $enkripsi }}">
                        <label for="">Upload PDF <span class="text-danger">*</span></label>
                        <input type="file" name="file_pdf" id="file_pdf" accept=".pdf" class="form-control" required>

                        <div class="d-flex flex-column-reverse flex-md-row gap-2 justify-content-md-end w-100 mt-4">
                            <button type="button" class="btnBatal btn btn-outline-danger" data-bs-dismiss="modal" title="Batal">Batal</button>
                            <button type="submit" class="btnUpload btn btn-primary">Upload File</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- END: Modal upload file --}}

    {{-- START: Branch modal --}}
    <div class="modal fade" id="modalCabang" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cabang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="dynamic-row">
                        @if(count($data['cabang']) > 0)
                            @foreach($data['cabang'] as $key => $value)
                            <div class="w-100">
                                <div class="d-flex flex-column gap-3">
                                    <div class="row g-3">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group-modal">
                                                <label for="">Nomor NITKU (22 digit)</label>
                                                <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="22" autocomplete="off" readonly placeholder="Masukkan nomor NITKU" value="{{ $value['nitku'] }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group-modal">
                                                <label for="">Nama Cabang</label>
                                                <input type="text" class="form-control" autocomplete="off" readonly placeholder="Masukkan nama cabang" value="{{ $value['nama'] }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-group-modal">
                                                <label for="">Alamat NITKU</label>
                                                <textarea cols="30" rows="5" class="form-control" autocomplete="off" placeholder="Masukkan alamat NITKU" readonly>{{ $value['alamat'] }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @endforeach
                        @else
                            <h4>Tidak ada cabang</h4>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    {{-- END: Branch Modal --}}
@endsection

@section('js')
    <script>
        // START: Logout submit
        document.getElementById('logoutBtn').addEventListener('click', logout);
        function logout() {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        }
        // END: Logout submit

        $(document).ready(function() {
            // START: Footer button
            $(document).on('click', '.btnEditData', function() {
                let url = $(this).data('url');
                window.location.href = url;
            });

            $(document).on('click', '.btnKembali', function() {
                window.location.href = '{{ route("home") }}';
            });
            // END: Footer button

            // START: Form upload PDF
            $(document).on('submit', '#formUploadPdf', function(e) {
                e.preventDefault();
                let menu = $('#menu').val();
                let id = $('#data').val();
                $.ajax({
                    url: '/form-customer/'+ menu +'/detail/upload/' + id,
                    type: 'POST',
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: () => {
                        Swal.fire({
                            title: 'Loading...',
                            text: 'Harap Menunggu',
                            icon: 'info',
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                    },
                    success: res => {
                        if(res.status == true) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'PDF berhasil diupload',
                                icon: 'success'
                            });
                            $('#modalUpload').modal('hide');
                            window.location.reload();
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: res.error,
                                icon: 'error'
                            });
                        }
                    }
                });
            });
            // END: Form upload PDF
        });
    </script>
@endsection
