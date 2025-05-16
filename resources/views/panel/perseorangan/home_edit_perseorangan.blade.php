@extends('layouts.main_app')

@section('title')
    <title>Perseorangan | PT. PAPASARI</title>
@endsection

@section('css')
<style>
    .container {
        padding: 64px 32px;
        overflow-x: hidden;
    }
    
    .container-fluid {
        background-color: #fff;
        border-radius: 16px;
        box-shadow: 2px 2px 20px rgba(0, 0, 0, 0.25);
    }
    
    .content {
        width: 100%;
        padding: 64px 32px;
    }

    .header .logo img {
        height: 96px;
        padding-bottom: 32px;
    }

    .header .profile img {
        height: 72px;
        padding-bottom: 32px;
    }

    .title {
        padding-bottom: 16px;
    }

    label {
        font-weight: 500;
    }

    .content-body {
        padding: 16px 0;
    }

    .form-group label {
        padding-bottom: 8px;
    }

    .form-group input {
        padding: 16px;
    }

    .form-group textarea {
        padding: 16px;
        height: 164px;
    }

    .form-group select {
        padding: 16px;
    }

    .group-column .form-group {
        padding: 0 0 16px 0;
    }

    .content-body .section1, .section2, .section3, .section4, .section5 {
        display: flex;
        flex-wrap: wrap;
        row-gap: 16px;
    }

    #ktp-section, #npwp-section {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        width: 100%;
    }


    #preview_ktp, #preview_npwp, #preview_sppkp, #preview_penanggung {
        border: 1px solid #D2D0D8;
        border-radius: 5px;
        height: 233px;
        width: 100%;
    }

    #preview_ktp img, #preview_npwp img, #preview_sppkp img, #preview_penanggung img {
        width: 100%;
        height: 230px;
        border-radius: 7px;
    }

    .section1, .section5 {
        padding: 0 0 16px 0;
    }
    
    .section2, .section3, .section4 {
        padding: 16px 0;
    }

    .footer {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        gap: 16px;
        width: 100%;
    }

    .btnSubmit {
        width: 144px;
        height: 48px;
        border-radius: 8px;
        background-color: #0063ee;
        border: none;
        color: #fff;
    }

    .btnKembali {
        width: 144px;
        height: 48px;
        border-radius: 8px;
        background-color: #E7E6EB;
        border: none;
        color: #000;
    }

    #previewPDF {
        padding: 8px 16px;
        border-radius: 8px;
        background-color: #424242;
        border: none;
        color: #fff;
        text-decoration: none;
    }

    .btnCabang {
        padding: 0 24px;
        height: 48px;
        border-radius: 8px;
        background-color: #0063ee;
        border: none;
        color: #fff;
    }

    #addRow {
        padding: 0 24px;
        height: 48px;
        border-radius: 8px;
        background-color: #0063ee;
        border: none;
    }

    #delRow {
        padding: 0 24px;
        height: 48px;
        border-radius: 8px;
        background-color: #FF0000;
        border: none;
    }

    #select {
        position: relative;
    }

    #select .caret {
        position: absolute;
        top: 50px;
        right: 23px;
    }

    .profile {
        cursor: pointer;
    }

    #preview_penanggung .zoom-img-wrap .zoom-img, #preview_ktp .zoom-img-wrap .zoom-img, #preview_npwp .zoom-img-wrap .zoom-img, #preview_sppkp .zoom-img-wrap .zoom-img {
        width: 100%;
        height: 100%;
        transition: 1s;
    }

    .form-group {
        width: 100%;
    }

    .row {
        width: 100vw;
    }

    .row div:first-child {
        padding: 0;
    }

    .row div:last-child {
        padding-left: 16px;
    }

    .row div .group-column .form-group:last-child {
        padding-top: 16px;
        padding-left: 0;
    }

    .row div .group-column .form-group:first-child {
        padding: 0;
    }

    .form-group-modal input {
        padding: 16px;
    }

    .form-group-modal textarea {
        padding: 16px;
    }

    .form-group-modal {
        padding: 0 !important;
    }

    .dynamic-row .row {
        width: 100% !important;
    }

    .group-column-modal {
        display: flex;
        flex-direction: column;
        padding: 0 !important;
        gap: 16px;
    }

    .modal-content {
        padding: 16px;
    }

    .branch-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0;
        height: 100%;
    }

    @media screen and (max-width: 475px) {
        .container {
            padding: 0;
        }
        
        .container-fluid {
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 2px 2px 20px rgba(0, 0, 0, 0.25);
        }

        .content {
            width: 100%;
            padding: 32px 16px;
        }

        .header .logo img {
            height: 72px;
            padding-bottom: 32px;
        }

        .header .profile img {
            height: 64px;
            padding-bottom: 32px;
        }

        .form-group input {
            width: 100%;
            padding: 16px;
        }

        .form-group select {
            width: 100%;
            padding: 16px;
        }

        .form-group textarea {
            height: 165px;
            width: 100%;
        }

        .row {
            gap: 16px;
        }

        .row div {
            padding: 0 !important;
        }

        .footer {
            display: flex;
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
    <div class="container">
        <div class="container-fluid">
            <div class="content">
                <div class="header d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <img src="{{ asset('../../../images/PNG 4125 x 913.png') }}" alt="Logo">
                    </div>
                    <div class="profile">
                        <img id="Edit Profile" src="{{ asset('../../../images/Profile.svg') }}" title="Edit Profile" alt="Profile">
                        <img id="logoutBtn" src="{{ asset('../../../images/Log Out.png') }}" title="Logout" alt="Logout">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
                <div class="title">
                    <h1>Formulir Data Customer</h1>
                    <h5>Silahkan isi data terkini anda, kemudian tanda tangan.</h5>
                </div>
                <form id="formCustomer" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="update_id" id="update_id" value="{{ $enkripsi }}">
                    <input type="hidden" name="bentuk_usaha" id="bentuk_usaha" value="perseorangan">
                    <div class="section5">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group p-0" id="select">
                                    <label for="">Sales</label>
                                    <select name="sales" id="sales" autocomplete="off" class="form-control">
                                        <option value="">-</option>
                                        @foreach ($sales as $loop_sales)
                                            <option value="{{ $loop_sales->nama_sales }}">{{ $loop_sales->nama_sales }}</option>
                                        @endforeach
                                    </select>
                                    <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="content-body">
                        <div class="section1">
                            <h1>Identitas Perseorangan</h1>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Usaha <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" placeholder="Masukkan nama usaha" autocomplete="off" required value="{{ $data['nama_perusahaan'] ? $data['nama_perusahaan'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Group Usaha <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_group_perusahaan" id="nama_group_perusahaan" class="form-control" placeholder="Masukkan nama group usaha" autocomplete="off" required value="{{ $data['nama_group_perusahaan'] ? $data['nama_group_perusahaan'] : '' }}">
                                        <span class="text-danger" style="color: #FF0000;">*Jika tidak ada maka diisi dengan nama usaha</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Alamat Usaha <span class="text-danger">*</span></label>
                                        <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" rows="6" placeholder="Masukkan alamat lengkap usaha" autocomplete="off" required>{{ $data['alamat_lengkap'] ? $data['alamat_lengkap'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Alamat Group Usaha <span class="text-danger">*</span></label>
                                        <textarea name="alamat_group_lengkap" id="alamat_group_lengkap" class="form-control" rows="6" placeholder="Masukkan alamat group usaha" autocomplete="off" required>{{ $data['alamat_lengkap'] ? $data['alamat_lengkap'] : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Kota/Kabupaten <span class="text-danger">*</span></label>
                                        <input type="text" name="kota_kabupaten" id="kota_kabupaten" class="form-control" placeholder="Masukkan Kota/Kabupaten" autocomplete="off" required value="{{ $data['kota_kabupaten'] ? $data['kota_kabupaten'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Alamat Email Usaha</label>
                                        <input type="text" name="alamat_email_perusahaan" id="alamat_email_perusahaan" class="form-control" autocomplete="off" placeholder="Masukkan alamat email usaha" value="{{ $data['alamat_email'] ? $data['alamat_email'] : '' }}">
                                    </div>    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nomor Handphone Contact Person <span class="text-danger">*</span></label>
                                        <input type="text" name="no_hp" id="no_hp" class="form-control" autocomplete="off" placeholder="Contoh: 012345678910" required value="{{ $data['nomor_handphone'] ? $data['nomor_handphone'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Tahun Berdiri</label>
                                        <input type="date" name="tahun_berdiri" id="tahun_berdiri" autocomplete="off" class="form-control" value="{{ $data['tahun_berdiri'] ? $data['tahun_berdiri'] : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Lama Usaha (Tahun)</label>
                                        <input type="text" name="lama_usaha" id="lama_usaha" class="form-control" autocomplete="off" readonly value="{{ $data['lama_usaha'] ? $data['lama_usaha'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group" id="select">
                                        <label for="">Bidang Usaha <span class="text-danger">*</span></label>
                                        <select name="bidang_usaha" id="bidang_usaha" class="form-control" required>
                                            <option value="">Pilih Bidang Usaha</option>
                                            @foreach ($bidang_usaha as $loop_bidang_usaha)
                                                <option value="{{ $loop_bidang_usaha }}">{{ strtoupper(str_replace('_', ' ', $loop_bidang_usaha)) }}</option>
                                            @endforeach
                                        </select>
                                        <div class="bidang_lain d-none">
                                            <input type="text" class="form-control" name="bidang_usaha_lain" id="bidang_usaha_lain" placeholder="Masukkan bidang usaha lain" autocomplete="off" value="{{ $data['bidang_usaha_lain'] ? $data['bidang_usaha_lain'] : '' }}">
                                        </div>
                                        <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group" id="select">
                                        <label for="">Status Kepemilkan Tempat Usaha <span class="text-danger">*</span></label>
                                        <select name="status_kepemilikan" id="status_kepemilikan" class="form-control" required>
                                            <option value="">Pilih Status Kepemilikan</option>
                                            <option value="milik_sendiri">Milik Sendiri</option>
                                            <option value="sewa">Sewa</option>
                                            <option value="group">Group</option>
                                        </select>
                                        <div class="group d-none">
                                            <input type="text" class="form-control" name="nama_group" id="nama_group" placeholder="Masukkan nama group" autocomplete="off" value="{{ $data['nama_group'] ? $data['nama_group'] : '' }}">
                                        </div>
                                        <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">NIK <span class="text-danger">*</span></label>
                                        <input type="text" id="nomor_ktp" name="nomor_ktp" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="16" placeholder="Masukkan NIK" autocomplete="off" class="form-control" value="{{ $data['nomor_ktp'] ? $data['nomor_ktp'] : $data['nomor_npwp'] }}">
                                    </div>
                                </div>
                            </div>
                            <div id="ktp-section">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="group-column">
                                            <div class="form-group">
                                                <label for="">Nama Lengkap Sesuai Identitas <span class="text-danger">*</span></label>
                                                <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" autocomplete="off" class="form-control" value="{{ $data['nama_lengkap'] ? $data['nama_lengkap'] : '' }}">
                                            </div>

                                            <div class="group-column p-0 mt-3">
                                                <div class="form-group">
                                                    <label for="">Foto KTP / NPWP <span class="text-danger">*</span></label>
                                                    <input type="file" name="foto_ktp" id="foto_ktp" class="form-control" onchange="previewFileKtp(this);" accept=".jpg, .png, .pdf, .jpeg">
                                                </div>
                        
                                                @if($data)
                                                    @if($data['foto_ktp'] && File::extension($data['foto_ktp']) == 'pdf')
                                                        <div class="form-group d-flex justify-content-between align-items-center py-2 px-3 m-0" style="height: auto;" id="preview_ktp">
                                                            <p style="font-size: 18px;">Preview file KTP</p>
                                                            <a href="{{ asset('../../../uploads/identitas_perusahaan/' . $data['foto_ktp']) }}" target="_blank" id="previewPDF">Preview PDF</a>
                                                        </div>
                                                    @elseif($data['foto_ktp'] && File::extension($data['foto_ktp']) != 'pdf')
                                                        <div class="form-group" id="preview_ktp">
                                                            <img id="preview_foto_ktp" src="{{ asset('../../../uploads/identitas_perusahaan/' . $data['foto_ktp']) }}" alt="Belum ada file" data-action="zoom">
                                                        </div>
                                                    @else
                                                        <div class="form-group" id="preview_ktp">
                                                            <img id="preview_foto_ktp" src="" alt="Belum ada file" data-action="zoom">
                                                        </div>
                                                    @endif
                                                @else
                                                    <div class="form-group" id="preview_ktp">
                                                        <img id="preview_foto_ktp" src="" alt="Belum ada file" data-action="zoom">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="group-column">
                                            <div class="form-group">
                                                <label for="">Alamat Lengkap Sesuai Identitas <span class="text-danger">*</span></label>
                                                <textarea name="alamat_ktp" id="alamat_ktp" class="form-control" rows="6" placeholder="Masukkan alamat lengkap KTP" autocomplete="off" required>{{ $data['alamat_lengkap'] ? $data['alamat_lengkap'] : '' }}</textarea>
                                            </div>

                                            <div class="branch-section mt-5 p-0">
                                                <div >
                                                    <span class="text-danger">*Harap diisi cabang dengan <br> menekan tombol dibawah ini</span>
                                                </div>
                                                <div>
                                                    <button type="button" class="btnCabang" data-bs-toggle="modal" data-bs-target="#modalCabang">Tambah Cabang</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="section2">
                            <h1>Informasi Bank</h1>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nomor Rekening <span class="text-danger">*</span></label>
                                        <input type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="15" placeholder="Masukkan nomor rekening" required value="{{ $data['informasi_bank']['nomor_rekening'] ? $data['informasi_bank']['nomor_rekening'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Rekening <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" autocomplete="off" placeholder="Masukkan nama rekening" required value="{{ $data['informasi_bank']['nama_rekening'] ? $data['informasi_bank']['nama_rekening'] : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Bank <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_bank" id="nama_bank" class="form-control" autocomplete="off" placeholder="Masukkan nama bank" required value="{{ $data['informasi_bank']['nama_bank'] ? $data['informasi_bank']['nama_bank'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group" id="select">
                                        <label for="">Pemilik Rekening <span class="text-danger">*</span></label>
                                        <select name="status_rekening" id="status_rekening" class="form-control" required>
                                            <option value="">Pilih Pemilik Rekening</option>
                                            <option value="rekening_usaha">Rekening usaha</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                        <div class="rekening_lain d-none">
                                            <input type="text" class="form-control" name="rekening_lain" id="rekening_lain" placeholder="Masukkan pemilik rekening lain" autocomplete="off" value="{{ $data['informasi_bank']['rekening_lain'] ? $data['informasi_bank']['rekening_lain'] : '' }}">
                                        </div>
                                        <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="section3">
                            <h1>Data Identitas Penanggung Jawab</h1>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Penanggung Jawab <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_penanggung_jawab" id="nama_penanggung_jawab" autocomplete="off" class="form-control" placeholder="Masukkan nama penanggung jawab" required value="{{ $data['data_identitas']['nama'] ? $data['data_identitas']['nama'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Jabatan <span class="text-danger">*</span></label>
                                        <input type="text" name="jabatan" id="jabatan" class="form-control" autocomplete="off" placeholder="Masukkan jabatan" required value="{{ $data['data_identitas']['jabatan'] ? $data['data_identitas']['jabatan'] : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group" id="select">
                                        <label for="">Identitas Penanggung Jawab <span class="text-danger">*</span></label>
                                        <select name="identitas_penanggung_jawab" id="identitas_penanggung_jawab" autocomplete="off" class="form-control" required>
                                            <option value="ktp">KTP</option>
                                            <option value="npwp">NPWP</option>
                                        </select>
                                        <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nomor Handphone <span class="text-danger">*</span></label>
                                        <input type="text" name="nomor_hp_penanggung_jawab" id="nomor_hp_penanggung_jawab" autocomplete="off" class="form-control" required placeholder="Contoh: 012345678910" value="{{ $data['data_identitas']['no_hp'] ? $data['data_identitas']['no_hp'] : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Foto Identitas (KTP / NPWP) <span class="text-danger">*</span></label>
                                        <input type="file" name="foto_penanggung" id="foto_penanggung" class="form-control" onchange="previewFilePenanggung(this);" accept=".jpg, .png, .pdf, .jpeg">
                                    </div>
        
                                    @if($data)
                                        @if($data['data_identitas']['foto'] && File::extension($data['data_identitas']['foto']) == 'pdf')
                                            <div id="preview_penanggung" class="form-group d-flex justify-content-between align-items-center py-2 px-3 m-0" style="height: auto;">
                                                <p style="font-size: 18px">Preview file identitas</p>
                                                <a href="{{ asset('../../../uploads/penanggung_jawab/' . $data['data_identitas']['foto']) }}" target="_blank" id="previewPDF">Preview PDF</a>
                                            </div>
                                        @elseif($data['data_identitas']['foto'] && File::extension($data['data_identitas']['foto']) != 'pdf')
                                            <div id="preview_penanggung" class="form-group">
                                                <img id="preview_foto_penanggung" src="{{ asset('../../../uploads/penanggung_jawab/' . $data['data_identitas']['foto']) }}" alt="Belum ada file" data-action="zoom">
                                            </div>
                                        @else
                                            <div id="preview_penanggung" class="form-group">
                                                <img id="preview_foto_penanggung" src="" alt="Belum ada file" data-action="zoom">
                                            </div>
                                        @endif
                                    @else
                                        <div id="preview_penanggung" class="form-group">
                                            <img id="preview_foto_penanggung" src="" alt="Belum ada file" data-action="zoom">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h1 class="pt-2 pb-2">Tipe Customer</h1>
                        <div class="section4">
                            <div class="row mb-2">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group" id="select">
                                        <label for="">Jenis Transaksi</label>
                                        <select name="jenis_transaksi" id="jenis_transaksi" class="form-control" required>
                                            <option value="cash">Cash</option>
                                            <option value="credit">Credit</option>
                                        </select>
                                        <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group" id="select">
                                        <label for="">Tipe Harga</label>
                                        <select name="tipe_harga" id="tipe_harga" class="form-control" required>
                                            <option value="end_user">End User</option>
                                            <option value="retail">Retail</option>
                                        </select>
                                        <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group" id="select">
                                        <label for="">Kategori Customer</label>
                                        <select name="kategori_customer" id="kategori_customer" class="form-control">
                                            <option value="">Pilih kategori customer</option>
                                            @foreach($bidang_usaha as $loop_bidang_usaha)
                                                <option value="{{ $loop_bidang_usaha }}">{{ str_replace('_', ' ', strtoupper($loop_bidang_usaha)) }}</option>
                                            @endforeach
                                        </select>
                                        <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Plafond</label>
                                        <input type="text" name="plafond" id="plafond" oninput="this.value = this.value.replace(/[^0-9+]/g, '')" class="form-control" placeholder="Masukkan plafond" autocomplete="off" value="{{ $data['tipe_customer'] ? $data['tipe_customer']['plafond'] : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Term of Payment</label>
                                        <input type="text" name="payment_term" id="payment_term" class="form-control" placeholder="Masukkan term of payment" autocomplete="off" value="{{ $data['tipe_customer'] ? $data['tipe_customer']['payment_term'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group" id="select">
                                        <label for="">Channel Distributor</label>
                                        <select name="channel_distributor" id="channel_distributor" class="form-control">
                                            <option value="">Pilih channel distributor</option>
                                            <option value="allptk">Semua Jalur Pontianak</option>
                                            <option value="alljkt">Semua Jalur Jakarta</option>
                                        </select>
                                        <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group" id="select">
                                        <label for="">Keterangan</label>
                                        <select name="keterangan" id="keterangan" class="form-control" required>
                                            <option value="New Customer">New Customer</option>
                                            <option value="New Bill To">New Bill To</option>
                                            <option value="Update Data">Update Data</option>
                                        </select>
                                        <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group d-none">
                                        <label for="">Kode Customer</label>
                                        <input type="text" name="kode_customer" id="kode_customer" class="form-control" placeholder="Masukkan kode customer" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <div class="button1">
                            <button type="button" class="btnKembali" title="Kembali">Kembali</button>
                        </div>
                        <div class="button2">
                            <button type="submit" class="btnSubmit" title="Submit">Submit</button>
                        </div>
                    </div>

                    {{-- START: Branch modal --}}
                    <div class="modal fade" id="modalCabang" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cabang</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="delRow-section">
                                        <button type="button" id="addRow"><i class="fa-solid fa-plus text-light"></i></button>
                                    </div>
                                    <div class="dynamic-row">
                                        @if($data)
                                            @if(count($data['cabang']) > 0)
                                                @foreach($data['cabang'] as $key => $value)
                                                    <hr class="line-{{ $key + 1 }}">
                                                    <div class="row align-items-center counter-{{ $key + 1 }} numDiv">
                                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-12 d-flex justify-content-center">
                                                            <button type="button" id="delRow" class="delRow" data-id="{{ $key + 1 }}"><i class="fa-solid fa-minus text-light"></i></button>
                                                        </div>
                                                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                                                            <div class="group-column-modal">
                                                                <div class="form-group-modal">
                                                                    <label for="">Nomor NITKU (22 digit) <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" name="nitku_cabang[]" id="nitku_cabang" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="22" autocomplete="off" placeholder="Masukkan nomor NITKU" value="{{ $value['nitku'] }}">
                                                                </div>
                                                                <div class="form-group-modal">
                                                                    <label for="">Nama Cabang <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" name="nama_cabang[]" id="nama_cabang" autocomplete="off" placeholder="Masukkan nama cabang" value="{{ $value['nama'] }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                            <div class="form-group-modal">
                                                                <label for="">Alamat NITKU <span class="text-danger">*</span></label>
                                                                <textarea name="alamat_nitku[]" id="alamat_nitku" cols="30" rows="5" class="form-control" autocomplete="off" placeholder="Masukkan alamat NITKU">{{ $value['alamat'] }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <hr class="line-1">
                                                <div class="row align-items-center counter-1 numDiv">
                                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-12 d-flex justify-content-center">
                                                        <button type="button" id="delRow" class="delRow" data-id="1"><i class="fa-solid fa-minus text-light"></i></button>
                                                    </div>
                                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                                                        <div class="group-column-modal">
                                                            <div class="form-group-modal">
                                                                <label for="">Nomor NITKU (22 digit) <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="nitku_cabang[]" id="nitku_cabang" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="22" autocomplete="off" placeholder="Masukkan nomor NITKU">
                                                            </div>
                                                            <div class="form-group-modal">
                                                                <label for="">Nama Cabang <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="nama_cabang[]" id="nama_cabang" autocomplete="off" placeholder="Masukkan nama cabang">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                        <div class="form-group-modal">
                                                            <label for="">Alamat NITKU <span class="text-danger">*</span></label>
                                                            <textarea name="alamat_nitku[]" id="alamat_nitku" cols="30" rows="5" class="form-control" autocomplete="off" placeholder="Masukkan alamat NITKU"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <hr class="line-1">
                                            <div class="row align-items-center counter-1 numDiv">
                                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-12 d-flex justify-content-center">
                                                    <button type="button" id="delRow" class="delRow" data-id="1"><i class="fa-solid fa-minus text-light"></i></button>
                                                </div>
                                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                                                    <div class="group-column-modal">
                                                        <div class="form-group-modal">
                                                            <label for="">Nomor NITKU (22 digit) <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="nitku_cabang[]" id="nitku_cabang" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="22" autocomplete="off" placeholder="Masukkan nomor NITKU">
                                                        </div>
                                                        <div class="form-group-modal">
                                                            <label for="">Nama Cabang <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="nama_cabang[]" id="nama_cabang" autocomplete="off" placeholder="Masukkan nama cabang">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="form-group-modal">
                                                        <label for="">Alamat NITKU <span class="text-danger">*</span></label>
                                                        <textarea name="alamat_nitku[]" id="alamat_nitku" cols="30" rows="5" class="form-control" autocomplete="off" placeholder="Masukkan alamat NITKU"></textarea>
                                                    </div>
                                                </div>
                                            </div>
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
                </form>
            </div>
        </div>
    </div>
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

        // START: Preview foto
        function previewFileKtp(input) {
            var file = $("#foto_ktp").prop('files');
            if(file){
                let ext = file[0].type.split('/')[1];
                var reader = new FileReader();
                $("#preview_ktp").removeClass('d-none');
                if(ext == 'pdf') {
                    $('#preview_foto_ktp').find('img').remove();
                    reader.onload = function() {
                        let filename = reader.result.split(',')[1];
                        $('#preview_ktp').html('File PDF telah ditambahkan!').css({
                            'height': '50px',
                            'padding': '16px',
                            'font-weight': 'bold'
                        });
                    }
                } else {
                    $("#preview_ktp").css('height', '197px');
                    $('#preview_ktp').html('<img id="preview_foto_ktp" src="" alt="Preview" data-action="zoom">');
                    reader.onload = function() {
                        $("#preview_foto_ktp").attr("src", reader.result);
                    }
                }
                reader.readAsDataURL(file[0]);
            }
        }

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
                    $("#preview_npwp").css('height', '197px');
                    $('#preview_npwp').html('<img id="preview_foto_npwp" src="" alt="Preview" data-action="zoom">');
                    reader.onload = function() {
                        $("#preview_foto_npwp").attr("src", reader.result);
                    }
                }
                reader.readAsDataURL(file[0]);
            }
        }

        function previewFileSppkp(input) {
            var file = $("#sppkp").prop('files');
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
                    $("#preview_sppkp").css('height', '197px');
                    $('#preview_sppkp').html('<img id="preview_foto_sppkp" src="" alt="Preview" data-action="zoom">');
                    reader.onload = function() {
                        $("#preview_foto_sppkp").attr("src", reader.result);
                    }
                }
                reader.readAsDataURL(file[0]);
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
                        $('#preview_foto_penanggung').html('File PDF telah ditambahkan!').css({
                            'height': '50px',
                            'padding': '16px',
                            'font-weight': 'bold'
                        });
                    }
                } else {
                    $("#preview_penanggung").css('height', '197px');
                    $('#preview_penanggung').html('<img id="preview_foto_penanggung" src="" alt="Preview" data-action="zoom">');
                    reader.onload = function() {
                        $("#preview_foto_penanggung").attr("src", reader.result);
                    }
                }
                reader.readAsDataURL(file[0]);
            }
        }
        // END: Preview foto

        // START: Format rupiah
        var rupiah = document.getElementById('plafond');
        rupiah.addEventListener('keyup', function(e)
        {
            rupiah.value = formatRupiah(this.value, 'Rp ');
        });
        
        /* Fungsi */
        function formatRupiah(angka, prefix)
        {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split    = number_string.split(','),
                sisa     = split[0].length % 3,
                rupiah     = split[0].substr(0, sisa),
                ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
                
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
        }
        // END: Format rupiah

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

        $(document).ready(function() {
            // START: Tombol Kembali
            $('.btnKembali').on('click', function() {
                window.location.href = '/internal/panel';
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
                    $('.pkp').find('input').prop('required', true);
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

            $('#keterangan').on('change', function() {
                if($(this).val() == 'New Customer') {
                    $('#kode_customer').parent().addClass('d-none').prop('required', false);
                } else {
                    $('#kode_customer').parent().removeClass('d-none').prop('required', true);
                }
            });
            // END: Change input properties

            // START: Submit Form Customer
            $(document).on('submit', '#formCustomer', function(e) {
                e.preventDefault();
                const badan_usaha = $('#bentuk_usaha').val();
                $.ajax({
                    url: '/internal/panel/edit-store',
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
                            window.location.href = res.link;
                        } else {
                            Swal.fire({
                                title: 'Gagal',
                                text: res.error,
                                icon: 'error'
                            });
                        }
                    }
                })
            });
            // END: Submit Form Customer

            // START: Get data untuk select
            $.ajax({
                url: '/internal/panel/select/' + $('#update_id').val(),
                type: 'GET',
                success: res => {
                    if(res.status == true) {
                        if(res.data.tipe_customer) {
                            $('#jenis_transaksi').val(res.data.tipe_customer.jenis_transaksi).change();
                            $('#tipe_harga').val(res.data.tipe_customer.tipe_harga).change();
                            $('#kategori_customer').val(res.data.tipe_customer.kategori_customer).change();
                            $('#channel_distributor').val(res.data.tipe_customer.channel_distributor).change();
                            $('#keterangan').val(res.data.tipe_customer.keterangan).change();
                        }
                        
                        $('#jenis_cust').val(res.data.status_cust).change();
                        $('#status_cabang').val(res.data.status_cabang).change();
                        $('#bidang_usaha').val(res.data.bidang_usaha).change();
                        $('#status_kepemilikan').val(res.data.status_kepemilikan).change();
                        $('#sales').val(res.data.nama_sales).change();
                        $('#status_pkp').val(res.data.status_pkp).change();
                        $('#status_rekening').val(res.data.informasi_bank.status).change();
                        $('#identitas_penanggung_jawab').val(res.data.data_identitas.identitas).change();

                        let upperIdentitas = res.data.identitas.toUpperCase();
                        $('#identitas_perusahaan').val(upperIdentitas).change();

                        if(res.data.bidang_usaha == 'lainnya') {
                            $('#bidang_usaha_lain').removeClass('d-none');
                        } else {
                            $('#bidang_usaha_lain').addClass('d-none');
                        }

                        if(res.data.status_kepemilikan == 'lainnya') {
                            $('#nama_group').removeClass('d-none');
                        } else {
                            $('#nama_group').addClass('d-none');
                        }

                        if(res.data.informasi_bank.status == 'lainnya') {
                            $('#rekening_lain').removeClass('d-none');
                        } else {
                            $('#rekening_lain').addClass('d-none');
                        }
                    } else {
                        $('#jenis_cust').val('').change();
                        $('#bidang_usaha').val('').change();
                        $('#status_kepemilikan').val('').change();
                        $('#identitas_perusahaan').val('').change();
                        $('#status_pkp').val('').change();
                        $('#status_rekening').val('').change();
                        $('#identitas_penanggung_jawab').val('').change();
                        $('input[name="jenis_transaksi"]').val('cash').prop('checked', true);
                        $('input[name="tipe_harga"]').val('end_user').prop('checked', true);
                        $('#kategori_customer').val('').change();
                        $('#channel_distributor').val('').change();
                        $('#keterangan').val('').change();
                        $('#status_cabang').val('0').change();
                        $('#sales').val('').change();
                        $('#npwp_perseorangan').val('').change();
                    }
                }
            });
            // END: Get data untuk select

            // START: Dynamic row
            let counter = 1;
            $('#addRow').on('click', function() {
                counter++;
                $('#counter').val(counter);
                $('.dynamic-row').append(`
                    <hr class="line-`+counter+`">
                    <div class="row align-items-center counter-`+counter+` numDiv">
                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-12 d-flex justify-content-center">
                            <button type="button" id="delRow" data-id="`+counter+`"><i class="fa-solid fa-minus text-light"></i></button>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                            <div class="group-column-modal">
                                <div class="form-group-modal">
                                    <label for="">Nomor NITKU (22 digit)</label>
                                    <input type="text" class="form-control" name="nitku_cabang[]" id="nitku_cabang" placeholder="Masukkan nomor NITKU" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="22">
                                </div>
                                <div class="form-group-modal">
                                    <label for="">Nama Cabang</label>
                                    <input type="text" class="form-control" name="nama_cabang[]" id="nama_cabang" placeholder="Masukkan nama cabang" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group-modal">
                                <label for="">Alamat NITKU</label>
                                <textarea name="alamat_nitku[]" id="alamat_nitku" cols="30" rows="5" class="form-control" placeholder="Masukkan alamat NITKU" autocomplete="off"></textarea>
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
        });
    </script>
@endsection