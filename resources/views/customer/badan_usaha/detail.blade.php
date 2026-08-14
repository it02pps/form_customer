@extends('layouts.main_app')

@section('title')
    <title>Badan Usaha Detail | PT. PAPASARI</title>
@endsection

@section('css')
@endsection

@section('content')
    @php
        // FOTO NPWP
        $foto_npwp = $perusahaan['foto_npwp'] ?? null;
        $url_npwp = url('/form-customer/getFiles/FileIDCompanyOrPersonal/' . $foto_npwp);
        $ext_npwp = File::extension($foto_npwp);
            
        // FOTO SPPKP
        $foto_sppkp = $perusahaan['sppkp'] ?? null;
        $url_sppkp = url('/form-customer/getFiles/FileSPPKPCompany/' . $foto_sppkp);
        $ext_sppkp = File::extension($foto_sppkp);

        // FOTO PENANGGUNG
        $foto_penanggung = $perusahaan['data_identitas']['foto'] ?? null;
        $url_penanggung = url('/form-customer/getFiles/FileIDPersonCharge/' . $foto_penanggung);
        $ext_penanggung = File::extension($foto_penanggung);
    @endphp

    <div class="px-4 py-3 px-md-5">
        <div class="header d-flex justify-content-between align-items-center mb-4">
            <div class="logo">
                <img
                    src="{{ asset('images/PNG 4125 x 913.png') }}"
                    class="img-fluid"
                    alt="Logo"
                >
            </div>
            <div class="profile" onclick="login()">
                <img
                    src="{{ asset('images/Profile.svg') }}"
                    class="img-fluid"
                    alt="Profile"
                >
            </div>
        </div>
        <h1 class="text-center text-md-start mt-3">Formulir Data Customer</h1>
        <hr>
        <div class="py-2">
            <h1 class="text-center text-md-start">Identitas Perusahaan</h1>
            <div class="d-flex flex-column gap-3">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group p-0">
                            <label for="">Sales</label>
                            <input
                                type="text"
                                name="sales"
                                id="sales"
                                class="form-control"
                                readonly
                                autocomplete="off"
                                value="{{ $perusahaan['sales'] ?: '-' }}"
                            >
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Nama Group Perusahaan</label>
                            <input
                                type="text"
                                name="nama_group_perusahaan"
                                id="nama_group_perusahaan"
                                class="form-control"
                                readonly
                                autocomplete="off"
                                value="{{ $perusahaan['nama_group_perusahaan'] }}"
                            >
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Alamat Email Perusahaan</label>
                            <input
                                type="email"
                                name="alamat_email_perusahaan"
                                id="alamat_email_perusahaan"
                                readonly
                                class="form-control"
                                autocomplete="off"
                                value="{{ $perusahaan['alamat_email'] ?: '-' }}"
                            >
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Alamat Group Perusahaan</label>
                        <textarea
                            name="alamat_group_lengkap"
                            id="alamat_group_lengkap"
                            class="form-control"
                            rows="6"
                            readonly
                            autocomplete="off"
                        >{{ $perusahaan['alamat_group_lengkap'] }}</textarea>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Kota/Kabupaten</label>
                            <input
                                type="text"
                                name="kota_kabupaten"
                                id="kota_kabupaten"
                                class="form-control"
                                readonly
                                autocomplete="off"
                                value="{{ $perusahaan['kota_kabupaten'] }}"
                            >
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Nomor Handphone Contact Person</label>
                            <input
                                type="text"
                                name="no_hp"
                                id="no_hp"
                                readonly
                                class="form-control"
                                autocomplete="off"
                                value="{{ $perusahaan['nomor_handphone'] }}"
                            >
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Tahun Berdiri</label>
                            <input
                                type="text"
                                name="tahun_berdiri"
                                id="tahun_berdiri"
                                autocomplete="off"
                                readonly
                                class="form-control"
                                value="{{ $perusahaan['tahun_berdiri'] ?: '-' }}"
                            >
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Lama Usaha (Tahun)</label>
                            <input
                                type="text"
                                name="lama_usaha"
                                id="lama_usaha"
                                class="form-control"
                                autocomplete="off"
                                readonly
                                value="{{ $perusahaan['lama_usaha'] ?: '-' }}"
                            >
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Bidang Usaha</label>
                            <input
                                type="text"
                                name="bidang_usaha"
                                id="bidang_usaha"
                                class="form-control"
                                autocomplete="off"
                                readonly
                                value="{{ strtoupper(str_replace('_', ' ', $perusahaan['bidang_usaha']))}}"
                            >
                            <div class="bidang_lain p-0 @if($perusahaan['bidang_usaha'] != 'lainnya') d-none @endif">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="bidang_usaha_lain"
                                    id="bidang_usaha_lain"
                                    readonly
                                    \autocomplete="off"
                                    value="{{ $perusahaan['bidang_usaha_lain'] ?: '-' }}"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Status Kepemilkan Tempat Usaha</label>
                            <input
                                type="text"
                                name="status_kepemilikan"
                                id="status_kepemilikan"
                                class="form-control"
                                autocomplete="off"
                                readonly
                                value="{{ ucwords(str_replace('_', ' ', $perusahaan['status_kepemilikan'])) ?: '-' }}"
                            >
                            <div class="group p-0 @if($perusahaan['status_kepemilikan'] != 'group') d-none @endif">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="nama_group"
                                    id="nama_group"
                                    readonly
                                    autocomplete="off"
                                    value="{{ $perusahaan['nama_group'] ?: '-' }}"
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group" >
                            <label for="">Jenis Badan Usaha</label>
                            <input
                                type="text"
                                name="badan_usaha"
                                id="badan_usaha"
                                class="form-control"
                                autocomplete="off"
                                readonly
                                value="{{ strtoupper($perusahaan['badan_usaha']) }}"
                            >
                            <div class="badan_usaha_lain p-0 @if($perusahaan['badan_usaha'] != 'lainnya') d-none @endif">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="badan_usaha_lain"
                                    id="badan_usaha_lain"
                                    readonly
                                    autocomplete="off"
                                    value="{{ $perusahaan['badan_usaha_lain'] ?: '-' }}"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Nama NPWP</label>
                            <input
                                type="text"
                                name="nama_npwp"
                                id="nama_npwp"
                                class="form-control"
                                autocomplete="off"
                                readonly
                                value="{{ $perusahaan['nama_npwp'] }}"
                            >
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Nomor NPWP (16 digit)</label>
                            <input
                                type="text"
                                name="nomor_npwp"
                                id="nomor_npwp"
                                readonly
                                class="form-control"
                                autocomplete="off"
                                value="{{ $perusahaan['nomor_npwp'] }}"
                            >
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group pt-3">
                            <label for="">Email Khusus Untuk Faktur Pajak</label>
                            <input
                                type="text"
                                name="email_faktur"
                                id="email_faktur"
                                class="form-control"
                                autocomplete="off"
                                readonly
                                value="{{ $perusahaan['email_khusus_faktur_pajak'] ? $perusahaan['email_khusus_faktur_pajak'] : '-' }}"
                            >
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Alamat NPWP</label>
                        <textarea
                            name="alamat_npwp"
                            id="alamat_npwp"
                            rows="6"
                            autocomplete="off"
                            class="form-control"
                            readonly
                        >{{ $perusahaan['alamat_npwp'] }}</textarea>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Kota Sesuai NPWP</label>
                            <input
                                type="text"
                                name="kota_npwp"
                                id="kota_npwp"
                                class="form-control"
                                autocomplete="off"
                                readonly
                                value="{{ $perusahaan['kota_npwp'] }}"
                            >
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Nomor Aktif Untuk Faktur Pajak</label>
                            <input
                                type="text"
                                name="no_wa"
                                id="no_wa"
                                class="form-control"
                                autocomplete="off"
                                readonly
                                value="{{ $perusahaan['nomor_whatsapp'] }}"
                            >
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group pb-0">
                            <label for="">Status Pengusaha Kena Pajak (PKP)</label>
                            <input
                                type="text"
                                name="status_pkp"
                                id="status_pkp"
                                class="form-control"
                                autocomplete="off"
                                readonly
                                value="{{ strtoupper(str_replace('_', ' ', $perusahaan['status_pkp'])) }}"
                            >
                        </div>

                        <div class="pkp p-0  @if($perusahaan['status_pkp'] != 'pkp') d-none @endif">
                            <div class="form-group">
                                <div class="form-group {{ $ext_sppkp === 'pdf' ? 'd-flex justify-content-center align-items-center py-2 px-3 m-0' : 'p-0' }}" id="preview_sppkp" style="height: {{ $ext_sppkp === 'pdf' ? 'auto' : '271px' }};">
                                    @if($ext_sppkp === 'pdf')
                                        <a
                                            href="{{ $url_sppkp }}"
                                            target="_blank"
                                            id="previewPDF"
                                        >Preview PDF</a>
                                    @else
                                        <img
                                            id="preview_foto_sppkp"
                                            src="{{ $url_sppkp }}"
                                            alt="Preview"
                                            data-action="zoom"
                                        >
                                    @endif
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Cabang</label>
                            <input
                                type="text"
                                class="form-control"
                                autocomplete="off"
                                readonly
                                placeholder="{{ App\Models\Cabang::where('identitas_perusahaan_id', $perusahaan['id'])->count() }} Cabang"
                            >
                            <button
                                type="button"
                                class="btn btn-primary w-100"
                                title="Detail Cabang"
                                data-bs-target="#modalCabang"
                                data-bs-toggle="modal"
                            >
                                Detail Cabang
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Foto NPWP</label>
                        <div class="form-group {{ $ext_npwp === 'pdf' ? 'd-flex justify-content-center align-items-center py-2 px-3 m-0' : 'p-0' }}" id="preview_npwp" style="height: {{ $ext_npwp === 'pdf' ? 'auto' : '271px' }};">
                            @if($ext_npwp === 'pdf')
                                <p style="font-size: 18px;">Preview file NPWP</p>
                                <a
                                    href="{{ $url_npwp }}"
                                    target="_blank"
                                    id="previewPDF"
                                >Preview PDF</a>
                            @else
                                <img
                                    id="preview_foto_npwp"
                                    src="{{ $url_npwp }}"
                                    alt="Preview"
                                    data-action="zoom"
                                >
                            @endif
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
                            <input
                                type="text"
                                name="nomor_rekening"
                                id="nomor_rekening"
                                readonly
                                class="form-control"
                                autocomplete="off"
                                value="{{ $perusahaan['informasi_bank']['nomor_rekening'] }}"
                            >
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Nama Rekening</label>
                            <input
                                type="text"
                                name="nama_rekening"
                                id="nama_rekening"
                                class="form-control"
                                autocomplete="off"
                                readonly
                                value="{{ $perusahaan['informasi_bank']['nama_rekening'] }}"
                            >
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Nama Bank</label>
                            <input
                                type="text"
                                name="nama_bank"
                                id="nama_bank"
                                class="form-control"
                                autocomplete="off"
                                readonly
                                value="{{ $perusahaan['informasi_bank']['nama_bank'] }}"
                            >
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="group-column">
                            <div class="form-group">
                                <label for="">Pemilik Rekening</label>
                                <input
                                    type="text"
                                    name="status"
                                    id="pemilik_rekening"
                                    class="form-control"
                                    autocomplete="off"
                                    readonly
                                    value="{{ ucwords(str_replace('_', ' ', $perusahaan['informasi_bank']['status'])) }}"
                                >
                                <div class="rekening_lain p-0 @if($perusahaan['informasi_bank']['status'] != 'lainnya') d-none @endif">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="rekening_lain"
                                        id="rekening_lain"
                                        readonly
                                        autocomplete="off"
                                        value="{{ $perusahaan['informasi_bank']['rekening_lain'] ?: '-' }}"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Nama Finance</label>
                            <input
                                type="text"
                                name="nama_finance"
                                id="nama_finance"
                                class="form-control"
                                placeholder="Masukkan nama finance"
                                autocomplete="off"
                                readonly
                                value="{{ $perusahaan['data_finance']['nama'] ?: '-' }}"
                            >
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">No HP Finance</label>
                            <input
                                type="text"
                                name="no_hp_finance"
                                id="no_hp_finance"
                                class="form-control"
                                placeholder="Masukkan no HP finance"
                                maxlength="14"
                                autocomplete="off"
                                readonly
                                value="{{ $perusahaan['data_finance']['no_hp'] ?: '-' }}"
                            >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Email Finance</label>
                    <input
                        type="text"
                        name="email_finance"
                        id="email_finance"
                        class="form-control"
                        placeholder="Masukkan email finance"
                        autocomplete="off"
                        readonly
                        value="{{ $perusahaan['data_finance']['email'] ?: '-' }}"
                    >
                </div>
            </div>
            <hr>
            <h1 class="text-center text-md-start">Data Identitas Penanggung Jawab</h1>
            <div class="d-flex flex-column gap-3">
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Nama Penanggung Jawab</label>
                            <input
                                type="text"
                                name="nama_penanggung_jawab"
                                id="nama_penanggung_jawab"
                                readonly
                                autocomplete="off"
                                class="form-control"
                                value="{{ $perusahaan['data_identitas']['nama'] }}"
                            >
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Jabatan</label>
                            <input
                                type="text"
                                name="jabatan"
                                id="jabatan"
                                class="form-control"
                                autocomplete="off"
                                readonly
                                value="{{ $perusahaan['data_identitas']['jabatan'] }}"
                            >
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group" >
                            <label for="">Identitas Penanggung Jawab</label>
                            <input
                                type="text"
                                name="identitas_penanggung_jawab"
                                id="identitas_penanggung_jawab"
                                class="form-control"
                                autocomplete="off"
                                readonly
                                value="{{ strtoupper($perusahaan['data_identitas']['identitas']) }}"
                            >
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Nomor Handphone</label>
                            <input
                                type="text"
                                name="nomor_hp_penanggung_jawab"
                                id="no_hp_penanggung_jawab"
                                readonly
                                autocomplete="off"
                                class="form-control"
                                value="{{ $perusahaan['data_identitas']['no_hp'] }}"
                            >
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group p-0">
                        <label for="">Foto Identitas (KTP / NPWP)</label>
                        <div class="form-group {{ $ext_penanggung === 'pdf' ? 'd-flex justify-content-center align-items-center py-2 px-3 m-0' : 'p-0' }}" id="preview_penanggung" style="height: {{ $ext_penanggung === 'pdf' ? 'auto' : '271px' }};">
                            @if($ext_penanggung === 'pdf')
                                <a
                                    href="{{ $url_penanggung }}"
                                    target="_blank"
                                    id="previewPDF"
                                >
                                    Preview PDF
                                </a>
                            @else
                                <img
                                    id="preview_foto_penanggung"
                                    src="{{ $url_penanggung }}"
                                    alt="Preview"
                                    data-action="zoom"
                                >
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column flex-md-row gap-2 justify-content-md-end w-100 mt-4" id="footer">
            <button
                type="button"
                class="btnEditData btn btn-warning"
                title="Edit Data"
                data-url="{{ $url }}"
            >
                Edit Data
            </button>
            <a
                type="button"
                href="{{ route('form_customer.pdf', ['menu' => str_replace('_', '-', $perusahaan['bentuk_usaha']), 'id' => $enkripsi]) }}"
                target="_blank"
                class="btnDownloadPdf btn btn-dark"
                title="Download PDF"
            >
                Download PDF
            </a>
            <button
                type="button"
                class="btnUploadFile btn btn-primary"
                title="Upload File"
                data-bs-toggle="modal"
                data-bs-target="#modalUpload"
            >
                Upload File
            </button>
        </div>
    </div>

    {{-- START: Modal upload file --}}
    <div
        class="modal fade"
        id="modalUpload"
        tabindex="-1"
        aria-labelledby="modalUpload"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload PDF</h5>
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    >
                        <i class="fa-solid fa-xmark text-light"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formUploadPdf" enctype="multipart/form-data">
                        @csrf
                        <input
                            type="hidden"
                            name="menu"
                            id="menu"
                            value="{{ str_replace('_', '-', $perusahaan['bentuk_usaha']) }}"
                        >
                        <input
                            type="hidden"
                            name="data"
                            id="data"
                            value="{{ $enkripsi }}"
                        >
                        <label for="">Upload PDF <span class="text-danger">*</span></label>
                        <input
                            type="file"
                            name="file_pdf"
                            id="file_pdf"
                            accept=".pdf"
                            class="form-control"
                            required
                        >

                        <div class="d-flex flex-column-reverse flex-md-row gap-2 justify-content-md-end w-100 mt-4">
                            <button
                                type="button"
                                class="btnKembali btn btn-outline-danger"
                                data-bs-dismiss="modal"
                                title="Batal"
                            >
                                Batal
                            </button>
                            <button
                                type="submit"
                                class="btnUpload btn btn-primary"
                                title="Upload"
                            >
                                Upload File
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- END: Modal upload file --}}

    {{-- START: Branch modal --}}
    <div
        class="modal fade"
        id="modalCabang"
        data-bs-keyboard="false"
        data-bs-backdrop="static"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cabang</h5>
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    >
                        <i class="fa-solid fa-xmark text-light"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="dynamic-row">
                        @if(count($perusahaan['cabang']) > 0)
                            @foreach($perusahaan['cabang'] as $key => $value)
                                <div class="row g-3 align-items-center">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group-modal">
                                            <label for="">Nomor NITKU (22 digit)</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                maxlength="22"
                                                autocomplete="off"
                                                readonly
                                                placeholder="Masukkan nomor NITKU"
                                                value="{{ $value['nitku'] }}"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group-modal">
                                            <label for="">Nama Cabang</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                autocomplete="off"
                                                readonly
                                                placeholder="Masukkan nama cabang"
                                                value="{{ $value['nama'] }}"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group-modal">
                                            <label for="">Alamat NITKU</label>
                                            <textarea
                                                rows="6"
                                                class="form-control"
                                                autocomplete="off"
                                                placeholder="Masukkan alamat NITKU"
                                                readonly
                                            >{{ $value['alamat'] }}</textarea>
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
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- END: Branch Modal --}}
@endsection

@section('js')
    <script>
        // START: Direct login page
        function login() {
            window.location.href = '{{ route("form_customer.login") }}';
        }
        // END: Direct login page

        $(document).ready(function() {
            // START: Footer button
            $(document).on('click', '.btnEditData', function() {
                let url = $(this).data('url');
                window.location.href = url;
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
                            window.location.href = res.url;
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: res.error,
                                icon: 'error'
                            });
                        }
                    },
                    error: function(textStatus) {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Terjadi kesalahan. Silahkan dicoba lagi',
                            icon: 'error'
                        });
                    }
                });
            });
            // END: Form upload PDF
        });
    </script>
@endsection
