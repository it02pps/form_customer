@extends('layouts.main_app')

@section('title')
    <title>Badan Usaha | PT. PAPASARI</title>
@endsection

@section('css')
@endsection

@section('content')
    @php
        // FOTO NPWP
        $foto_npwp = $data['foto_npwp'] ?? null;
        $url_npwp = url('/form-customer/getFiles/FileIDCompanyOrPersonal/' . $foto_npwp);
        $ext_npwp = File::extension($foto_npwp);

        // FOTO SPPKP
        $foto_sppkp = $data['sppkp'] ?? null;
        $url_sppkp = url('/form-customer/getFiles/FileSPPKPCompany/' . $foto_sppkp);
        $ext_sppkp = File::extension($foto_sppkp);

        // FOTO PENANGGUNG
        $foto_penanggung = $data['data_identitas']['foto'] ?? null;
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
            <div
                class="profile"
                onclick="login()"
            >
                <img
                    src="{{ asset('images/Profile.svg') }}"
                    class="img-fluid"
                    alt="Profile"
                >
            </div>
        </div>
        <div class="d-flex flex-column gap-3">
            <h1 class="text-center text-md-start m-0 p-0">Formulir Data Customer</h1>
            <h5 class="text-center text-md-start p-0">Silahkan isi data terkini anda, kemudian tanda tangan.</h5>
            <div
                class="alert alert-primary fade show"
                role="alert"
            >
                Mohon untuk mengisi data dengan lengkap dan sebenar-benarnya sesuai dengan dokumen identitas resmi yang digunakan.
                Data yang Anda berikan akan digunakan untuk keperluan verifikasi dan kelancaran proses transaksi.
                Segala bentuk ketidaksesuaian atau ketidakakuratan data menjadi tanggung jawab pihak yang mengisi.
                PT PAPASARI berkomitmen untuk menjaga kerahasiaan dan keamanan seluruh data pribadi pelanggan sesuai dengan ketentuan yang berlaku.
            </div>
        </div>
        <form
            id="formCustomer"
            enctype="multipart/form-data"
        >
            @csrf
            <input
                type="hidden"
                name="update_id"
                id="update_id"
                value="{{ $enkripsi }}"
            >
            <input
                type="hidden"
                name="opsi"
                id="opsi"
                value="pengkinian_data"
            >
            <input
                type="hidden"
                name="bentuk_usaha"
                id="bentuk_usaha"
                value="badan_usaha"
            >
            <div class="section4">
                <div class="row g-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div
                            class="form-group p-0 position-relative"
                            id="select"
                        >
                            <label for="">Sales</label>
                            <select
                                name="sales"
                                id="sales"
                                autocomplete="off"
                                class="form-control"
                            >
                                <option value="">-</option>
                                @foreach ($sales as $loop_sales)
                                    <option value="{{ $loop_sales->nama_sales }}">{{ $loop_sales->nama_sales }}</option>
                                @endforeach
                            </select>
                            <span
                                class="caret position-absolute top-50 pe-auto"
                                style="right: 15px !important;"
                            >
                                <i class="fa-solid fa-caret-down text-secondary"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="py-2">
                <h1 class="text-center text-md-start">Hasil Scan</h1>
                <div class="d-flex flex-column gap-3">
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nomor NPWP (16 digit) <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="nomor_npwp"
                                    id="nomor_npwp"
                                    oninput="this.value = this.value.replace(/\D+/g, '')"
                                    maxlength="16"
                                    class="form-control"
                                    autocomplete="off"
                                    placeholder="Masukkan Nomor NPWP"
                                    value="{{ old('npwp16', $ocrData['npwp16'] ?? '') }}"
                                    required
                                >
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama NPWP <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="nama_npwp"
                                    id="nama_npwp"
                                    class="form-control" 
                                    autocomplete="off"
                                    placeholder="Masukkan Nama NPWP"
                                    value="{{ old('nama', $ocrData['nama'] ?? '') }}"
                                    required
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Alamat NPWP <span class="text-danger">*</span></label>
                                <textarea
                                    name="alamat_npwp"
                                    id="alamat_npwp"
                                    cols="70"
                                    rows="6"
                                    autocomplete="off"
                                    class="form-control"
                                    required
                                    placeholder="Masukkan Alamat NPWP"
                                >{{ old('alamat', $ocrData['alamat'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Kota Sesuai NPWP <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="kota_npwp"
                                    id="kota_npwp"
                                    class="form-control"
                                    autocomplete="off"
                                    placeholder="Masukkan kota sesuai NPWP"
                                    value="{{ old('tax_office', $ocrData['tax_office'] ?? '') }}"
                                    required
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="group-column">
                                <div class="form-group">
                                    <label for="">Foto NPWP <span class="text-danger">*</span></label>
                                    <input
                                        type="file"
                                        name="foto_npwp"
                                        id="foto_npwp"
                                        onchange="previewFileNpwp(this);"
                                        accept=".jpg, .png, .pdf, .jpeg"
                                        class="form-control"
                                        @if (!$ocrPhoto) required @endif
                                    >
                                </div>
                                <div id="preview_npwp" class="form-group">
                                    @if ($ocrPhoto)
                                        <div class="text-center">
                                            <img
                                                src="{{ route('form_customer.ocr_photo', ['filename' => basename($ocrPhoto)]) }}"
                                                class="img-fluid rounded"
                                                style="max-height: 300px;"
                                                alt="Preview NPWP"
                                            >
                                        </div>
                                    @else
                                        <p class="text-center">Belum ada file</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <h1 class="text-center text-md-start">Identitas Perusahaan</h1>
                <div class="d-flex flex-column gap-3">
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Group Perusahaan <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="nama_group_perusahaan"
                                    id="nama_group_perusahaan"
                                    class="form-control"
                                    placeholder="Masukkan nama group perusahaan"
                                    autocomplete="off"
                                    required
                                    value="{{ $data ? $data['nama_group_perusahaan'] : '' }}"
                                >
                                <span class="text-danger">*Jika tidak ada maka diisi dengan nama NPWP</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group pb-0">
                                <label for="" class="additional-label">Alamat Email Perusahaan</label>
                                <input
                                    type="text"
                                    name="alamat_email_perusahaan"
                                    id="alamat_email_perusahaan"
                                    class="form-control"
                                    autocomplete="off"
                                    placeholder="Contoh: perusahaan@gmail.com"
                                    value="{{ $data ? ($data['alamat_email'] ?: '') : '' }}"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Alamat Group Perusahaan <span class="text-danger">*</span></label>
                            <textarea
                                name="alamat_group_lengkap"
                                id="alamat_group_lengkap"
                                class="form-control"
                                rows="6"
                                placeholder="Masukkan alamat group perusahaan"
                                autocomplete="off"
                                required
                            >{{ $data ? $data['alamat_group_lengkap'] : '' }}</textarea>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nomor Handphone Contact Person <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="no_hp"
                                    id="no_hp"
                                    oninput="this.value = this.value.replace(/[^0-9+-]/g, '')"
                                    maxlength="20"
                                    class="form-control"
                                    autocomplete="off"
                                    placeholder="Contoh: 012345678910"
                                    required
                                    value="{{ $data ? $data['nomor_handphone'] : '' }}"
                                >
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group" id="select">
                                <label for="">Bidang Usaha <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <select
                                        name="bidang_usaha"
                                        id="bidang_usaha"
                                        class="form-control"
                                        required
                                    >
                                        <option value="">Pilih Bidang Usaha</option>
                                        @foreach ($bidang_usaha as $loop_bidang_usaha)
                                            <option value="{{ $loop_bidang_usaha }}">{{ strtoupper(str_replace('_', ' ', $loop_bidang_usaha)) }}</option>
                                        @endforeach
                                    </select>
                                    <div class="bidang_lain d-none">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="bidang_usaha_lain"
                                            id="bidang_usaha_lain"
                                            placeholder="Masukkan bidang usaha lain"
                                            autocomplete="off"
                                            value="{{ $data ? ($data['bidang_usaha_lain'] ?: '') : '' }}"
                                        >
                                    </div>
                                    <span
                                        class="caret position-absolute"
                                        style="right: 15px; top: 14px;"
                                    ><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Tahun Berdiri</label>
                                <input
                                    type="date"
                                    name="tahun_berdiri"
                                    id="tahun_berdiri"
                                    autocomplete="off"
                                    class="form-control"
                                    value="{{ $data ? ($data['tahun_berdiri'] ?: '') : '' }}"
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
                                    value="{{ $data ? ($data['lama_usaha'] ?: '') : '' }}"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group" id="select">
                                <label for="">Status Kepemilkan Tempat Usaha <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <select
                                        name="status_kepemilikan"
                                        id="status_kepemilikan"
                                        class="form-control"
                                        required
                                    >
                                        <option value="">Pilih Status Kepemilikan</option>
                                        <option value="milik_sendiri">Milik Sendiri</option>
                                        <option value="sewa">Sewa</option>
                                        <option value="group">Group</option>
                                    </select>
                                    <div class="group d-none">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="nama_group"
                                            id="nama_group"
                                            placeholder="Masukkan nama group"
                                            autocomplete="off"
                                            value="{{ $data ? ($data['nama_group'] ?: '') : '' }}"
                                        >
                                    </div>
                                    <span
                                        class="caret position-absolute"
                                        style="right: 15px; top: 14px;"
                                    ><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group" id="select">
                                <label for="">Jenis Badan Usaha <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <select
                                        name="badan_usaha"
                                        id="badan_usaha"
                                        class="form-control"
                                        required
                                    >
                                        <option value="">Pilih Jenis Usaha</option>
                                        <option value="pt">PT</option>
                                        <option value="cv">CV</option>
                                        <option value="pd">PD</option>
                                        <option value="pribadi">PRIBADI</option>
                                        <option value="yayasan">YAYASAN</option>
                                        <option value="lainnya">LAINNYA</option>
                                    </select>
                                    <div class="badan_usaha_lain d-none">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="badan_usaha_lain"
                                            id="badan_usaha_lain"
                                            placeholder="Masukkan badan usaha lain"
                                            autocomplete="off"
                                        >
                                    </div>
                                    <span
                                        class="caret position-absolute"
                                        style="right: 15px; top: 14px;"
                                    ><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="" class="additional-label">Email Khusus Untuk Faktur Pajak</label>
                                <input
                                    type="email"
                                    name="email_faktur"
                                    id="email_faktur"
                                    class="form-control"
                                    autocomplete="off"
                                    placeholder="Contoh: faktur@gmail.com"
                                    value="{{ $data ? ($data['email_khusus_faktur_pajak'] ?: '') : '' }}"
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
                                    oninput="this.value = this.value.replace(/[^0-9+-]/g, '')"
                                    maxlength="20"
                                    class="form-control"
                                    autocomplete="off"
                                    placeholder="Contoh: 012345678910"
                                    value="{{ $data ? ($data['nomor_whatsapp'] ?: '') : '' }}"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group pb-0 position-relative" id="select">
                                <label for="">Status Pengusaha Kena Pajak (PKP) <span class="text-danger">*</span></label>
                                <select
                                    name="status_pkp"
                                    id="status_pkp"
                                    class="form-control"
                                    required
                                >
                                    <option value="non_pkp">Non PKP</option>
                                    <option value="pkp">PKP</option>
                                </select>
                                <span class="caret position-absolute top-50" style="right: 15px;"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                            </div>
                            <div class="pkp d-none p-0">
                                <div class="form-group">    
                                    <input
                                        type="file"
                                        name="foto_sppkp"
                                        id="foto_sppkp"
                                        onchange="previewFileSppkp(this);"
                                        accept=".jpg, .png, .pdf, .jpeg"
                                        class="form-control"
                                    >
                                </div>
                                @if($foto_sppkp)
                                    <div class="form-group {{ $ext_sppkp === 'pdf' ? 'd-flex justify-content-center align-items-center py-2 px-3 m-0' : 'p-0' }}" id="preview_sppkp" style="Height: {{ $ext_sppkp ? 'auto' : '271px' }};">
                                        @if($ext_sppkp === 'pdf')
                                            <p style="font-size: 18px;">Preview file SPPKP</p>
                                            <a
                                                href="{{ $url_sppkp }}"
                                                target="_blank"
                                                id="previewPDF"
                                            >
                                                Preview PDF
                                            </a>
                                        @else
                                            <img id="preview_foto_sppkp" src="{{ $url_sppkp }}" alt="Belum ada file" data-action="zoom">
                                        @endif
                                    </div>
                                @else
                                    <div id="preview_sppkp" class="form-group">
                                        <p class="text-center">Belum ada file</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="branch-section mt-4 p-0 d-flex flex-column gap-2">
                                <span class="text-danger">*Jika terdapat cabang, silahkan tekan tombol disamping. Apabila tidak ada, dapat diabaikan</span>
                                <button
                                    type="button"
                                    class="btnCabang w-100 btn btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalCabang"
                                >
                                    Tambah Cabang
                                </button>
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
                                <label for="">Nomor Rekening <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="nomor_rekening"
                                    id="nomor_rekening"
                                    oninput="this.value = this.value.replace(/\D+/g, '')"
                                    maxlength="15"
                                    class="form-control"
                                    autocomplete="off"
                                    placeholder="Masukkan nomor rekening"
                                    required
                                    value="{{ $data ? ($data['informasi_bank']['nomor_rekening'] ?: '') : '' }}"
                                >
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Rekening <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="nama_rekening"
                                    id="nama_rekening"
                                    class="form-control"
                                    autocomplete="off"
                                    placeholder="Masukkan nama rekening"
                                    required
                                    value="{{ $data ? ($data['informasi_bank']['nama_rekening'] ?: '') : '' }}"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Bank <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="nama_bank"
                                    id="nama_bank"
                                    class="form-control"
                                    autocomplete="off"
                                    placeholder="Masukkan nama bank"
                                    required
                                    value="{{ $data ? ($data['informasi_bank']['nama_bank'] ?: '') : '' }}"
                                >
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="group-column">
                                <div class="form-group" id="select">
                                    <label for="">Pemilik Rekening <span class="text-danger">*</span></label>
                                    <div class="position-relative">
                                        <select
                                            name="status_rekening"
                                            id="status_rekening"
                                            class="form-control"
                                            required
                                        >
                                            <option value="">Pilih Pemilik Rekening</option>
                                            <option value="rekening_perusahaan">Rekening Perusahaan</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                        <div class="rekening_lain d-none">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="rekening_lain"
                                                id="rekening_lain"
                                                placeholder="Masukkan pemilik rekening lain"
                                                autocomplete="off"
                                                value="{{ $data ? ($data['informasi_bank']['rekening_lain'] ?: '') : '' }}"
                                            >
                                        </div>
                                        <span
                                            class="caret position-absolute"
                                            style="right: 15px; top: 14px;"
                                        ><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Finance <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="nama_finance"
                                    id="nama_finance"
                                    placeholder="Masukkan nama finance"
                                    class="form-control"
                                    autocomplete="off"
                                    required
                                    value="{{ $data ? ($data['data_finance'] ? ($data['data_finance']['nama'] ?: '') : '') : '' }}"
                                >
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">No HP Finance <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="no_hp_finance"
                                    id="no_hp_finance"
                                    oninput="this.value = this.value.replace(/[^0-9+]/g, '')"
                                    class="form-control"
                                    autocomplete="off"
                                    placeholder="Masukkan no HP finance"
                                    maxlength="20"
                                    required
                                    value="{{ $data ? ($data['data_finance'] ? ($data['data_finance']['no_hp'] ?: '') : '') : '' }}"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Email Finance <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="email_finance"
                                id="email_finance"
                                placeholder="Masukkan email finance"
                                autocomplete="off"
                                class="form-control"
                                required
                                value="{{ $data ? ($data['data_finance'] ? ($data['data_finance']['email'] ?: '') : '') : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <hr>
                <h1 class="text-center text-md-start">Data Identitas Penanggung Jawab</h1>
                <div class="d-flex flex-column gap-3">
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Penanggung Jawab <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="nama_penanggung_jawab"
                                    id="nama_penanggung_jawab"
                                    autocomplete="off"
                                    class="form-control"
                                    placeholder="Masukkan nama penanggung jawab"
                                    required
                                    value="{{ $data ? ($data['data_identitas'] ? $data['data_identitas']['nama'] : '') : '' }}"
                                >
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Jabatan <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="jabatan"
                                    id="jabatan"
                                    class="form-control"
                                    autocomplete="off"
                                    placeholder="Masukkan jabatan"
                                    required
                                    value="{{ $data ? ($data['data_identitas'] ? $data['data_identitas']['jabatan'] : '') : '' }}"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group position-relative" id="select">
                                <label for="">Identitas Penanggung Jawab <span class="text-danger">*</span></label>
                                <select
                                    name="identitas_penanggung_jawab"
                                    id="identitas_penanggung_jawab"
                                    autocomplete="off"
                                    class="form-control"
                                    required
                                >
                                    <option value="ktp">KTP</option>
                                    <option value="npwp">NPWP</option>
                                </select>
                                <span
                                    class="caret position-absolute top-50"
                                    style="right: 15px;"
                                >
                                    <i class="fa-solid fa-caret-down text-secondary"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nomor Handphone <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="nomor_hp_penanggung_jawab"
                                    id="nomor_hp_penanggung_jawab"
                                    oninput="this.value = this.value.replace(/[^0-9+]/g, '')"
                                    maxlength="20"
                                    autocomplete="off"
                                    class="form-control"
                                    required
                                    placeholder="Contoh: 012345678910"
                                    value="{{ $data ? ($data['data_identitas'] ? $data['data_identitas']['no_hp'] : '') : '' }}"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Foto Identitas (KTP / NPWP) <span class="text-danger">*</span></label>
                            <input
                                type="file"
                                name="foto_penanggung"
                                id="foto_penanggung"
                                class="form-control"
                                onchange="previewFilePenanggung(this);"
                                accept=".jpg, .png, .pdf, .jpeg"
                            >
                        </div>
                        @if($foto_penanggung)
                            <div class="form-group {{ $ext_penanggung === 'pdf' ? 'd-flex justify-content-center align-items-center py-2 px-3 m-0' : 'p-0' }}" id="preview_penanggung" style="height: {{ $ext_penanggung ? 'auto' : '271px' }};">
                                @if($ext_penanggung === 'pdf')
                                    <p style="font-size: 18px;">Preview file identitas</p>
                                    <a
                                        href="{{ $url_penanggung }}"
                                        target="_blank"
                                        id="previewPDF"
                                    >Preview PDF</a>
                                @else
                                    <img id="preview_foto_penanggung" src="{{ $url_penanggung }}" alt="Belum ada file" data-action="zoom">
                                @endif
                            </div>
                        @else
                            <div id="preview_penanggung" class="form-group">
                                <p class="text-center">Belum ada file</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column-reverse flex-md-row gap-2 justify-content-md-end w-100 mt-4" id="footer">
                <button
                    type="button"
                    class="btnKembali btn btn-outline-danger w-100"
                    title="Kembali"
                >
                    Kembali
                </button>
                <button
                    type="submit"
                    class="btnSubmit btn btn-primary w-100"
                    title="Submit"
                >
                    Submit
                </button>
            </div>

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
                            <div class="w-100 text-end">
                                <button
                                    type="button"
                                    id="addRow"
                                    class="btn btn-primary w-auto"
                                >
                                    <i class="fa-solid fa-plus text-light"></i>
                                </button>
                            </div>
                            <div class="dynamic-row">
                                @if($data)
                                    @if(count($data['cabang']) > 0)
                                        @foreach($data['cabang'] as $key => $value)
                                            <hr class="line-{{ $key + 1 }}">
                                            <div class="w-100">
                                                <div class="d-flex flex-column gap-3">
                                                    <div class="row g-3 counter-{{ $key + 1 }} numDiv">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                            <div class="d-flex flex-column gap-3">
                                                                <div class="form-group-modal">
                                                                    <label for="">Nomor NITKU (22 digit) <span class="text-danger">*</span></label>
                                                                    <input
                                                                        type="text"
                                                                        class="form-control"
                                                                        name="nitku_cabang[]"
                                                                        id="nitku_cabang"
                                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                                        maxlength="22"
                                                                        autocomplete="off"
                                                                        placeholder="Masukkan nomor NITKU"
                                                                        value="{{ $value['nitku'] }}"
                                                                    >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                            <div class="form-group-modal">
                                                                <label for="">Nama Cabang <span class="text-danger">*</span></label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    name="nama_cabang[]"
                                                                    id="nama_cabang"
                                                                    autocomplete="off"
                                                                    placeholder="Masukkan nama cabang"
                                                                    value="{{ $value['nama'] }}"
                                                                >
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group-modal">
                                                                <label for="">Alamat NITKU <span class="text-danger">*</span></label>
                                                                <textarea
                                                                    name="alamat_nitku[]"
                                                                    id="alamat_nitku"
                                                                    cols="30"
                                                                    rows="5"
                                                                    class="form-control"
                                                                    autocomplete="off"
                                                                    placeholder="Masukkan alamat NITKU"
                                                                >{{ $value['alamat'] }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            <button
                                                                type="button"
                                                                id="delRow"
                                                                class="delRow btn btn-danger w-100"
                                                                data-id="{{ $key + 1 }}"
                                                            ><i class="fa-solid fa-minus text-light"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <hr class="line-1">
                                        <div class="w-100">
                                            <div class="d-flex flex-column gap-3">
                                                <div class="row g-3 counter-1 numDiv">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                        <div class="d-flex flex-column gap-3">
                                                            <div class="form-group-modal">
                                                                <label for="">Nomor NITKU (22 digit) <span class="text-danger">*</span></label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    name="nitku_cabang[]"
                                                                    id="nitku_cabang"
                                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                                    maxlength="22"
                                                                    autocomplete="off"
                                                                    placeholder="Masukkan nomor NITKU"
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                        <div class="form-group-modal">
                                                            <label for="">Nama Cabang <span class="text-danger">*</span></label>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="nama_cabang[]"
                                                                id="nama_cabang"
                                                                autocomplete="off"
                                                                placeholder="Masukkan nama cabang"
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group-modal">
                                                            <label for="">Alamat NITKU <span class="text-danger">*</span></label>
                                                            <textarea
                                                                name="alamat_nitku[]"
                                                                id="alamat_nitku"
                                                                cols="30"
                                                                rows="5"
                                                                class="form-control"
                                                                autocomplete="off"
                                                                placeholder="Masukkan alamat NITKU"
                                                            ></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <button
                                                            type="button"
                                                            id="delRow"
                                                            class="delRow btn btn-danger w-100"
                                                            data-id="1"
                                                        ><i class="fa-solid fa-minus text-light"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <hr class="line-1">
                                    <div class="w-100">
                                        <div class="d-flex flex-column gap-3">
                                            <div class="row g-3 counter-1 numDiv">
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="d-flex flex-column gap-3">
                                                        <div class="form-group-modal">
                                                            <label for="">Nomor NITKU (22 digit) <span class="text-danger">*</span></label>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="nitku_cabang[]"
                                                                id="nitku_cabang"
                                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                                maxlength="22"
                                                                autocomplete="off"
                                                                placeholder="Masukkan nomor NITKU"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="form-group-modal">
                                                        <label for="">Nama Cabang <span class="text-danger">*</span></label>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="nama_cabang[]"
                                                            id="nama_cabang"
                                                            autocomplete="off"
                                                            placeholder="Masukkan nama cabang"
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group-modal">
                                                        <label for="">Alamat NITKU <span class="text-danger">*</span></label>
                                                        <textarea
                                                            name="alamat_nitku[]"
                                                            id="alamat_nitku"
                                                            cols="30"
                                                            rows="5"
                                                            class="form-control"
                                                            autocomplete="off"
                                                            placeholder="Masukkan alamat NITKU"
                                                        ></textarea>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <button
                                                        type="button"
                                                        id="delRow"
                                                        class="delRow btn btn-danger w-100"
                                                        data-id="1"
                                                    ><i class="fa-solid fa-minus text-light"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal"
                            >Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- END: Branch Modal --}}
        </form>
    </div>
@endsection

@section('js')
    <script>
        // START: Preview foto
        function previewFileNpwp(input) {
            var file = $("#foto_npwp").prop('files');
            if(file){
                let ext = file[0].type.split('/')[1];
                var reader = new FileReader();
                $("#preview_npwp").removeClass('d-none');
                if(ext == 'pdf') {
                    $('#preview_foto_npwp').find('img').remove();
                    reader.onload = function() {
                        let filename = reader.result.split(',')[1];
                        $('#preview_npwp').html('File PDF telah ditambahkan!').css({
                            'height': '50px',
                            'padding': '16px',
                            'font-weight': 'bold'
                        });
                    }
                } else {
                    $("#preview_npwp").css({
                        'height': 'auto',
                        'padding-top': '0'
                    });
                    $('#preview_npwp').html('<img id="preview_foto_npwp" src="" alt="Preview" data-action="zoom">');
                    reader.onload = function() {
                        $("#preview_foto_npwp").attr("src", reader.result);
                    }
                }
                reader.readAsDataURL(file[0]);
            } else {
                $("#preview_npwp").html('<p class="text-center">Belum ada file</p>');
            }
        }

        function previewFileSppkp(input) {
            var file = $("#foto_sppkp").prop('files');
            if(file){
                let ext = file[0].type.split('/')[1];
                var reader = new FileReader();
                $("#preview_sppkp").removeClass('d-none');
                if(ext == 'pdf') {
                    $('#preview_foto_sppkp').find('img').remove();
                    reader.onload = function() {
                        let filename = reader.result.split(',')[1];
                        $('#preview_sppkp').html('File PDF telah ditambahkan!').css({
                            'height': '50px',
                            'padding': '16px',
                            'font-weight': 'bold'
                        });
                    }
                } else {
                    $("#preview_sppkp").css({
                        'height': 'auto',
                        'padding-top': '0'
                    });
                    $('#preview_sppkp').html('<img id="preview_foto_sppkp" src="" alt="Preview" data-action="zoom">');
                    reader.onload = function() {
                        $("#preview_foto_sppkp").attr("src", reader.result);
                    }
                }
                reader.readAsDataURL(file[0]);
            } else {
                $("#preview_sppkp").html('<p class="text-center">Belum ada file</p>');
            }
        }

        function previewFilePenanggung(input) {
            var file = $("#foto_penanggung").prop('files');
            if(file){
                let ext = file[0].type.split('/')[1];
                var reader = new FileReader();
                $("#preview_penanggung").removeClass('d-none');
                if(ext == 'pdf') {
                    $('#preview_penanggung').find('img').remove();
                    reader.onload = function() {
                        let filename = reader.result.split(',')[1];
                        $('#preview_penanggung').html('File PDF telah ditambahkan!').css({
                            'height': '50px',
                            'padding': '16px',
                            'font-weight': 'bold'
                        });
                    }
                } else {
                    $("#preview_penanggung").css({
                        'height': 'auto',
                        'padding-top': '0'
                    });
                    $('#preview_penanggung').html('<img id="preview_foto_penanggung" src="" alt="Preview" data-action="zoom">');
                    reader.onload = function() {
                        $("#preview_foto_penanggung").attr("src", reader.result);
                    }
                }
                reader.readAsDataURL(file[0]);
            } else {
                $("#preview_penanggung").html('<p class="text-center">Belum ada file</p>');
            }
        }
        // END: Preview foto

        // START: Sembunyikan tombol remove
        function updateDeleteButtonVisibility() {
            if ($('.numDiv').length <= 1) {
                $('#delRow').hide();
            } else {
                $('#delRow').show();
            }
        }
        updateDeleteButtonVisibility();
        // END: Sembunyikan tombol remove

        // START: Direct login page
        function login() {
            window.location.href = '{{ route("form_customer.login") }}';
        }
        // END: Direct login page

        $(document).ready(function() {
            // START: Tombol Kembali
            $('.btnKembali').on('click', function() {
                window.location.href = '{{ route("form_customer.menu") }}';
            });

            $('#btnKembaliDetail').on('click', function() {
                let url = $(this).data('url');
                window.location.href = url;
            });
            // END: Tombol Kembali

            // START: Change input properties
            $('#bidang_usaha').on('change', function() {
                if($(this).val() == 'lainnya') {
                    $('.bidang_lain').removeClass('d-none').prop('required', true);
                    $('.bidang_lain').find('input').prop('required', true);
                } else {
                    $('.bidang_lain').addClass('d-none').prop('required', false);
                    $('.bidang_lain').find('input').val('').prop('required', false);
                }
            });
            
            $('#badan_usaha').on('change', function() {
                if($(this).val() == 'lainnya') {
                    $('.badan_usaha_lain').removeClass('d-none').prop('required', true);
                    $('.badan_usaha_lain').find('input').prop('required', true);
                } else {
                    $('.badan_usaha_lain').addClass('d-none').prop('required', false);
                    $('.badan_usaha_lain').find('input').val('').prop('required', false);
                }
            });

            $('#badan_usaha').on('change', function() {
                if($(this).val() == 'lainnya') {
                    $('.badan_usaha_lain').removeClass('d-none').prop('required', true);
                    $('.badan_usaha_lain').find('input').prop('required', true);
                } else {
                    $('.badan_usaha_lain').addClass('d-none').prop('required', false);
                    $('.badan_usaha_lain').find('input').val('').prop('required', false);
                }
            });

            $('#status_kepemilikan').on('change', function() {
                if($(this).val() == 'group') {
                    $('.group').removeClass('d-none').prop('required', true);
                    $('.group').find('input').prop('required', true);
                } else {
                    $('.group').addClass('d-none').prop('required', false);
                    $('.group').find('input').val('').prop('required', false);
                }
            });

            $('#status_pkp').on('change', function() {
                if($(this).val() == 'pkp') {
                    $('.pkp').removeClass('d-none').prop('required', true);
                    $('.pkp').find('input').prop('required', false);
                } else {
                    $('.pkp').addClass('d-none').prop('required', false);
                    $('.pkp').find('input').val('').prop('required', false);
                }
            });

            $('#status_rekening').on('change', function() {
                if($(this).val() == 'lainnya') {
                    $('.rekening_lain').removeClass('d-none').prop('required', true);
                    $('.rekening_lain').find('input').prop('required', true);
                } else {
                    $('.rekening_lain').addClass('d-none').prop('required', false);
                    $('.rekening_lain').find('input').val('').prop('required', false);
                }
            });
            // END: Change input properties

            // START: Submit Form Customer
            $(document).on('submit', '#formCustomer', function(e) {
                e.preventDefault();
                const badan_usaha = $('#bentuk_usaha').val();
                $.ajax({
                    url: '/form-customer/'+badan_usaha+'/store',
                    type: 'POST',
                    timeout: 120000,
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: () => {
                        Swal.fire({
                            title: 'Loading...',
                            text: 'Harap Menunggu',
                            icon: 'info',
                            allowOutsideClick: false,
                            showConfirmButton: false
                        });
                    },
                    success: res => {
                        if(res.status == true) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: 'Data berhasil ditambahkan!',
                                icon: 'success'
                            });
                            $('#formCustomer')[0].reset();
                            // console.log(res.link);   
                            window.location.href = res.link;
                        } else {
                            Swal.fire({
                                title: 'Gagal',
                                html: res.error,
                                icon: 'error'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        if(error === 'timeout') {
                            Swal.fire({
                                title: 'Gagal',
                                text: 'Permintaan terlalu lama (Lebih dari 2 menit). Silahkan coba lagi.',
                                icon: 'error'
                            });
                        } else {
                            Swal.fire({
                                title: 'Gagal',
                                text: 'Terjadi kesalahan ' + error,
                                icon: 'error'
                            });
                        }
                    }
                })
            });
            // END: Submit Form Customer
            
            // START: Tahun berdiri
            $(document).on('change', '#tahun_berdiri', function(e) {
                if(e.target.value != '') {
                    let tgl = new Date();
                    let tgl_berdiri = new Date($(this).val());
    
                    let thn_berdiri = tgl_berdiri.getFullYear();
                    let thn_sekarang = tgl.getFullYear();
                    let result = thn_sekarang - thn_berdiri;
                    
                    $('#lama_usaha').val(result + ' tahun');
                    $('#lama_usaha_hide').val(result);
                } else {
                    $('#lama_usaha').val('');
                    $('#lama_usaha_hide').val('');
                }
            });
            // END: Tahun berdiri

            // START: Get data untuk select
            var enkripsi = $('#update_id').val();
            if(enkripsi != '') {
                let url = '/form-customer/select/badan-usaha/' + enkripsi;
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: res => {
                        // console.log(res);
                        if(res.status == true) {
                            $('#status_kepemilikan').val(res.data.status_kepemilikan).change();
                            $('#badan_usaha').val(res.data.badan_usaha).change();
                            $('#bidang_usaha').val(res.data.bidang_usaha).change();
                            $('#status_pkp').val(res.data.status_pkp).change();
                            $('#status_rekening').val(res.data.informasi_bank.status).change();
                            if(res.data.data_identitas) {
                                $('#identitas_penanggung_jawab').val(res.data.data_identitas.identitas).change();
                            }
                            let upperIdentitas = res.data.identitas.toUpperCase();
                            $('#identitas_perusahaan').val(upperIdentitas).change();

                            $('#jenis_cust').val(res.data.status_cust).change();
                            $('#status_cabang').val(res.data.status_cabang).change();
                            $('#sales').val(res.data.nama_sales).change();
                        } else {
                            $('#status_kepemilikan').val('').change();
                            $('#badan_usaha').val('').change();
                            $('#bidang_usaha').val('').change();
                            $('#identitas_perusahaan').val('ktp').change();
                            $('#status_pkp').val('non_pkp').change();
                            $('#status_rekening').val('').change();
                            $('#identitas_penanggung_jawab').val('').change();
                            $('#status_cabang').val('').change();
                            $('#jenis_cust').val('').change();
                            $('#sales').val('').change();
                        }
                    }
                });
            }
            // END: Get data untuk select

            // START: Dynamic row
            let counter = 1;
            $('#addRow').on('click', function() {
                counter++;
                $('#counter').val(counter);
                $('.dynamic-row').append(`
                    <hr class="line-${counter}">
                    <div class="w-100">
                        <div class="d-flex flex-column gap-3">
                            <div class="row g-3 counter-${counter} numDiv">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="d-flex flex-column gap-3">
                                        <div class="form-group-modal">
                                            <label for="">Nomor NITKU (22 digit) <span class="text-danger">*</span></label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="nitku_cabang[]"
                                                id="nitku_cabang"
                                                placeholder="Masukkan nomor NITKU"
                                                required
                                                autocomplete="off"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                maxlength="22"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group-modal">
                                        <label for="">Nama Cabang <span class="text-danger">*</span></label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="nama_cabang[]"
                                            id="nama_cabang"
                                            placeholder="Masukkan nama cabang"
                                            required
                                            autocomplete="off"
                                        >
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group-modal">
                                        <label for="">Alamat NITKU <span class="text-danger">*</span></label>
                                        <textarea
                                            name="alamat_nitku[]"
                                            id="alamat_nitku"
                                            cols="30"
                                            rows="5"
                                            class="form-control"
                                            placeholder="Masukkan alamat NITKU"
                                            required
                                            autocomplete="off"
                                        ></textarea>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button
                                        type="button"
                                        id="delRow"
                                        data-id="${counter}"
                                        class="delRow btn btn-danger w-100"
                                    ><i class="fa-solid fa-minus text-light"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
                updateDeleteButtonVisibility();
            });

            $(document).on('click', '#delRow', function() {
                let id = $(this).data('id');

                $('.dynamic-row').find('.line-'+id).remove();
                $('.dynamic-row').find('.counter-'+id).remove();
                counter--;
                $('#counter').val(counter);
                updateDeleteButtonVisibility();
            });
            // END: Dynamic row

            // START: AUTO CAPITAL TEXT
            $(document).on('keyup', '#nama_finance, #nama_perusahaan, #nama_group_perusahaan, #alamat_lengkap, #alamat_group_lengkap, #bidang_usaha_lain, #nama_group, #nama_npwp, #badan_usaha_lain, #alamat_npwp, #kota_npwp, #nama_rekening, #nama_bank, #rekening_lain, #nama_penanggung_jawab, #jabatan, #kota_kabupaten, #nama_cabang, #alamat_nitku', function() {
                $(this).val($(this).val().toUpperCase());
            });
            // END: AUTO CAPITAL TEXT
        });
    </script>
@endsection
