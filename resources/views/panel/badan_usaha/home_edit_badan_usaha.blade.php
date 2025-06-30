@extends('layouts.main_app')

@section('title')
    <title>Badan Usaha | PT. PAPASARI</title>
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

    .group-column .form-group {
        padding: 0 0 16px 0;
    }

    .content-body .section1, .section2, .section3, .section4, .section5 {
        display: flex;
        flex-wrap: wrap;
        row-gap: 16px;
    }

    #preview_npwp, #preview_sppkp, #preview_penanggung {
        border: 1px solid #D2D0D8;
        border-radius: 5px;
        height: 271px;
        width: 100%;
    }

    #preview_npwp img, #preview_sppkp img, #preview_penanggung img {
        width: 100%;
        height: 269px;
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
        padding: 0 5px;
        width: 180px;
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

    #preview_penanggung .zoom-img-wrap .zoom-img, .zoom-img, #preview_npwp .zoom-img-wrap .zoom-img, #preview_sppkp .zoom-img-wrap .zoom-img {
        width: 100%;
        height: 100%;
        transition: 1s;
    }

    .form-group {
        width: 100%;
    }

    .form-group input {
        padding: 16px;
    }

    .form-group select {
        padding: 16px;
    }

    .form-group textarea {
        padding: 16px;
        height: 164px;
    }

    .row {
        width: 100vw;
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
                    <h5>Silahkan isi data terkini anda, kemudian tanda tangan. Testing123</h5>
                </div>
                <form id="formCustomer" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="update_id" id="update_id" value="{{ $enkripsi }}">
                    <input type="hidden" name="bentuk_usaha" id="bentuk_usaha" value="badan_usaha">
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
                            <h1>Identitas Perusahaan</h1>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Perusahaan <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" placeholder="Masukkan nama perusahaan" autocomplete="off" required value="{{ $data ? $data['nama_perusahaan'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Group Perusahaan <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_group_perusahaan" id="nama_group_perusahaan" class="form-control" placeholder="Masukkan nama group perusahaan" autocomplete="off" required value="{{ $data ? $data['nama_group_perusahaan'] : '' }}">
                                        <span class="text-danger" style="color: #FF0000;">*Jika tidak ada maka diisi dengan nama perusahaan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    {{-- <div class="group-column"> --}}
                                        <div class="form-group">
                                            <label for="">Alamat Perusahaan <span class="text-danger">*</span></label>
                                            <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" rows="6" placeholder="Masukkan alamat lengkap perusahaan" autocomplete="off" required>{{ $data ? $data['alamat_lengkap'] : '' }}</textarea>
                                        </div>
                                    {{-- </div> --}}
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="group-column">
                                        <div class="form-group">
                                            <label for="">Alamat Group Perusahaan <span class="text-danger">*</span></label>
                                            <textarea name="alamat_group_lengkap" id="alamat_group_lengkap" class="form-control" rows="6" placeholder="Masukkan alamat group perusahaan" autocomplete="off" required>{{ $data ? $data['alamat_lengkap'] : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Kota/Kabupaten <span class="text-danger">*</span></label>
                                        <input type="text" name="kota_kabupaten" id="kota_kabupaten" class="form-control" placeholder="Masukkan Kota/Kabupaten" autocomplete="off" required value="{{ $data ? $data['kota_kabupaten'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Alamat Email Perusahaan</label>
                                        <input type="text" name="alamat_email_perusahaan" id="alamat_email_perusahaan" class="form-control" autocomplete="off" placeholder="Contoh: perusahaan@gmail.com" value="{{ $data ? ($data['alamat_email'] ? $data['alamat_email'] : '') : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nomor Handphone Contact Person <span class="text-danger">*</span></label>
                                        <input type="text" name="no_hp" id="no_hp" oninput="this.value = this.value.replace(/[^0-9+]/g, '')" maxlength="14" class="form-control" autocomplete="off" placeholder="Contoh: 012345678910" required value="{{ $data ? $data['nomor_handphone'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Tahun Berdiri</label>
                                        <input type="date" name="tahun_berdiri" id="tahun_berdiri" autocomplete="off" class="form-control" value="{{ $data ? ($data['tahun_berdiri'] ? $data['tahun_berdiri'] : '') : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Lama Usaha (Tahun)</label>
                                        <input type="text" name="lama_usaha" id="lama_usaha" class="form-control" autocomplete="off" readonly value="{{ $data ? ($data['lama_usaha'] ? $data['lama_usaha'] : '') : '' }}">
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
                                            <input type="text" class="form-control" name="bidang_usaha_lain" id="bidang_usaha_lain" placeholder="Masukkan bidang usaha lain" autocomplete="off" value="{{ $data ? ($data['bidang_usaha_lain'] ? $data['bidang_usaha_lain'] : '') : '' }}">
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
                                            <input type="text" class="form-control" name="nama_group" id="nama_group" placeholder="Masukkan nama group" autocomplete="off" value="{{ $data ? ($data['nama_group'] ? $data['nama_group'] : '') : '' }}">
                                        </div>
                                        <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group" id="select">
                                        <label for="">Jenis Badan Usaha <span class="text-danger">*</span></label>
                                        <select name="badan_usaha" id="badan_usaha" class="form-control" required>
                                            <option value="">Pilih Jenis Usaha</option>
                                            <option value="pt">PT</option>
                                            <option value="cv">CV</option>
                                            <option value="pd">PD</option>
                                            <option value="pribadi">PRIBADI</option>
                                            <option value="yayasan">YAYASAN</option>
                                            <option value="lainnya">LAINNYA</option>
                                        </select>
                                        <div class="badan_usaha_lain d-none">
                                            <input type="text" class="form-control" name="badan_usaha_lain" id="badan_usaha_lain" placeholder="Masukkan badan usaha lain" autocomplete="off" value="{{ $data ? ($data['badan_usaha_lain'] ? $data['badan_usaha_lain'] : '') : '' }}">
                                        </div>
                                        <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama NPWP <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_npwp" id="nama_npwp" class="form-control" autocomplete="off" placeholder="Masukkan Nama NPWP" required value="{{ $data ? $data['nama_npwp'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nomor NPWP (16 digit) <span class="text-danger">*</span></label>
                                        <input type="text" name="nomor_npwp" id="nomor_npwp" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="16" class="form-control" autocomplete="off" placeholder="Masukkan Nomor NPWP" required value="{{ $data ? $data['nomor_npwp'] : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Alamat NPWP <span class="text-danger">*</span></label>
                                        <textarea name="alamat_npwp" id="alamat_npwp" cols="70" rows="10" autocomplete="off" class="form-control" required placeholder="Masukkan Alamat NPWP">{{ $data ? $data['alamat_npwp'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="group-column">
                                        <div class="form-group">
                                            <label for="">Kota Sesuai NPWP <span class="text-danger">*</span></label>
                                            <input type="text" name="kota_npwp" id="kota_npwp" class="form-control" autocomplete="off" placeholder="Masukkan kota sesuai NPWP" required value="{{ $data ? $data['kota_npwp'] : '' }}">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="">Email Khusus Untuk Faktur Pajak <span class="text-danger">*</span></label>
                                            <input type="email" name="email_faktur" id="email_faktur" class="form-control" autocomplete="off" placeholder="Contoh: faktur@gmail.com" required value="{{ $data ? $data['email_khusus_faktur_pajak'] : '' }}">
                                        </div>
                                    </div>
                               </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="group-column">
                                        <div class="form-group">
                                            <label for="">Nomor Aktif Untuk Faktur Pajak</label>
                                            <input type="text" name="no_wa" id="no_wa" oninput="this.value = this.value.replace(/[^0-9+]/g, '')" maxlength="14" class="form-control" autocomplete="off" placeholder="Contoh: 012345678910" value="{{ $data ? $data['nomor_whatsapp'] : '' }}">
                                        </div>

                                        <div class="form-group pt-3" id="select">
                                            <label for="">Status Pengusaha Kena Pajak (PKP) <span class="text-danger">*</span></label>
                                            <select name="status_pkp" id="status_pkp" class="form-control" required>
                                                <option value="non_pkp">Non PKP</option>
                                                <option value="pkp">PKP</option>
                                            </select>
                                            <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                        </div>
                                        <div class="pkp d-none p-0">
                                            <div class="form-group">
                                                <input type="file" name="foto_sppkp" id="foto_sppkp" onchange="previewFileSppkp(this);" accept=".jpg, .png, .pdf, .jpeg" class="form-control">
                                            </div>
                
                                            @if($data)
                                                @if($data['sppkp'] && File::extension($data['sppkp']) == 'pdf')
                                                    <div id="preview_sppkp" class="form-group d-flex justify-content-between align-items-center py-2 px-3 m-0" style="height: auto;">
                                                        <p style="font-size: 18px;">Preview file SPPKP</p>
                                                        <a href="{{ asset('../../../uploads/identitas_perusahaan/' . $data['sppkp']) }}" target="_blank" id="previewPDF">Preview PDF</a>
                                                    </div>
                                                @elseif($data['sppkp'] && File::extension($data['sppkp']) != 'pdf')
                                                    <div id="preview_sppkp" class="form-group">
                                                        <img id="preview_foto_sppkp" src="{{ asset('../../../uploads/identitas_perusahaan/' . $data['sppkp']) }}" alt="Belum ada file" data-action="zoom">
                                                    </div>
                                                @else
                                                    <div id="preview_sppkp" class="form-group">
                                                        <p class="text-center">Belum ada file</p>
                                                    </div>
                                                @endif
                                            @else
                                                <div id="preview_sppkp" class="form-group">
                                                    <p class="text-center">Belum ada file</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="group-column">
                                        <div class="form-group">
                                            <label for="">Foto NPWP <span class="text-danger">*</span></label>
                                            <input type="file" name="foto_npwp" id="foto_npwp" onchange="previewFileNpwp(this);" accept=".jpg, .png, .pdf, .jpeg" class="form-control">
                                        </div>
                
                                        @if($data)
                                            @if($data['foto_npwp'] && File::extension($data['foto_npwp']) == 'pdf')
                                                <div id="preview_npwp" class="form-group d-flex justify-content-between align-items-center py-2 px-3 m-0" style="height: auto;">
                                                    <p style="font-size: 18px;">Preview file NPWP</p>
                                                    <a href="{{ asset('../../../uploads/identitas_perusahaan/' . $data['foto_npwp']) }}" target="_blank" id="previewPDF">Preview PDF</a>
                                                </div>
                                            @elseif($data['foto_npwp'] && File::extension($data['foto_npwp']) != 'pdf')
                                                <div id="preview_npwp" class="form-group">
                                                    <img id="preview_foto_npwp" src="{{ asset('../../../uploads/identitas_perusahaan/' . $data['foto_npwp']) }}" alt="Belum ada file" data-action="zoom">
                                                </div>
                                            @else
                                                <div id="preview_npwp" class="form-group">
                                                    <p class="text-center">Belum ada file</p>
                                                </div>
                                            @endif
                                        @else
                                            <div id="preview_npwp" class="form-group">
                                                <p class="text-center">Belum ada file</p>
                                            </div>
                                        @endif

                                        <div class="branch-section mt-4 p-0">
                                            <div >
                                                <span class="text-danger">*Jika terdapat cabang, silahkan tekan tombol disamping. Apabila tidak ada, dapat diabaikan</span>
                                            </div>
                                            <div>
                                                <button type="button" class="btnCabang" data-bs-toggle="modal" data-bs-target="#modalCabang">Tambah Cabang</button>
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
                                        <input type="text" name="nomor_rekening" id="nomor_rekening" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="15" class="form-control" autocomplete="off" placeholder="Masukkan nomor rekening" required value="{{ $data ? ($data['informasi_bank']['nomor_rekening']) : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Rekening <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" autocomplete="off" placeholder="Masukkan nama rekening" required value="{{ $data ? ($data['informasi_bank']['nama_rekening']) : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Bank <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_bank" id="nama_bank" class="form-control" autocomplete="off" placeholder="Masukkan nama bank" required value="{{ $data ? ($data['informasi_bank']['nama_bank']) : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="group-column">
                                        <div class="form-group" id="select">
                                            <label for="">Pemilik Rekening <span class="text-danger">*</span></label>
                                            <select name="status_rekening" id="status_rekening" class="form-control" required>
                                                <option value="">Pilih Pemilik Rekening</option>
                                                <option value="rekening_perusahaan">Rekening Perusahaan</option>
                                                <option value="lainnya">Lainnya</option>
                                            </select>
                                            <div class="rekening_lain d-none">
                                                <input type="text" class="form-control" name="rekening_lain" id="rekening_lain" placeholder="Masukkan pemilik rekening lain" autocomplete="off" value="{{ $data ? ($data['informasi_bank']['rekening_lain'] ? $data['informasi_bank']['rekening_lain'] : '') : '' }}">
                                            </div>
                                            <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                        </div>
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
                                        <input type="text" name="nama_penanggung_jawab" id="nama_penanggung_jawab" autocomplete="off" class="form-control" placeholder="Masukkan nama penanggung jawab" required value="{{ $data ? ($data['data_identitas']['nama']) : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Jabatan <span class="text-danger">*</span></label>
                                        <input type="text" name="jabatan" id="jabatan" class="form-control" autocomplete="off" placeholder="Masukkan jabatan" required value="{{ $data ? ($data['data_identitas']['jabatan']) : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group" id="select">
                                        <label for="">Identitas Penanggung Jawab <span class="text-danger">*</span></label>
                                        <select name="identitas_penanggung_jawab" id="identitas_penanggung_jawab" autocomplete="off" class="form-control" required value="{{ $data ? (strtoupper($data['data_identitas']['identitas'])) : '' }}">
                                            <option value="ktp">KTP</option>
                                            <option value="npwp">NPWP</option>
                                        </select>
                                        <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nomor Handphone <span class="text-danger">*</span></label>
                                        <input type="text" name="nomor_hp_penanggung_jawab" id="no_hp_penanggung_jawab" oninput="this.value = this.value.replace(/[^0-9+]/g, '')" maxlength="14" autocomplete="off" class="form-control" required placeholder="Contoh: 012345678910" value="{{ $data ? ($data['data_identitas']['no_hp']) : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="group-column p-0">
                                        <div class="form-group">
                                            <label for="">Foto Identitas (KTP / NPWP) <span class="text-danger">*</span></label>
                                            <input type="file" name="foto_penanggung" id="foto_penanggung" class="form-control" onchange="previewFilePenanggung(this);" accept=".jpg, .png, .pdf, .jpeg">
                                        </div>
            
                                        @if($data)
                                            @if($data['data_identitas']['foto'] && File::extension($data['data_identitas']['foto']) == 'pdf')
                                                <div id="preview_penanggung" class="form-group d-flex justify-content-between align-items-center py-2 px-3 m-0" style="height: auto;">
                                                    <p style="font-size: 18px;">Preview file identitas</p>
                                                    <a href="{{ asset('../../../uploads/penanggung_jawab/' . $data['data_identitas']['foto']) }}" target="_blank" id="previewPDF">Preview PDF</a>
                                                </div>
                                            @elseif($data['data_identitas']['foto'] && File::extension($data['data_identitas']['foto']) != 'pdf')
                                                <div id="preview_penanggung" class="form-group">
                                                    <img id="preview_foto_penanggung" src="{{ asset('../../../uploads/penanggung_jawab/' . $data['data_identitas']['foto']) }}" alt="Belum ada file" data-action="zoom">
                                                </div>
                                            @else
                                                <div id="preview_penanggung" class="form-group">
                                                    <p class="text-center">Belum ada file</p>
                                                </div>
                                            @endif
                                        @else
                                            <div id="preview_penanggung" class="form-group">
                                                <p class="text-center">Belum ada file</p>
                                            </div>
                                        @endif
                                    </div>
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
                                        <input type="text" name="plafond" id="plafond" oninput="this.value = this.value.replace(/[^0-9+]/g, '')" class="form-control" placeholder="Masukkan plafond" autocomplete="off" value="{{ $data['tipe_customer'] ? 'Rp ' . number_format($data['tipe_customer']['plafond'], 0, ',', '.') : '' }}">
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
                                        <select name="keterangan" id="keterangan" class="form-control">
                                            <option value="New Customer">New Customer</option>
                                            <option value="New Bill To">New Bill To</option>
                                            <option value="Update Data">Update Data</option>
                                        </select>
                                        <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Kode Customer</label>
                                        <input type="text" name="kode_customer" id="kode_customer" class="form-control" placeholder="Masukkan kode customer" autocomplete="off" value="{{ $data['tipe_customer'] ? $data['tipe_customer']['kode_customer'] ? $data['tipe_customer']['kode_customer'] : '-' : '-' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">New Bill To Code</label>
                                        <input type="text" name="new_bill_to_code" id="new_bill_to_code" class="form-control" placeholder="Masukkan new bill to code" autocomplete="off" value="{{ $data['tipe_customer'] ? $data['tipe_customer']['new_bill_to_code'] : '-' }}">
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
                    $("#preview_sppkp").css('height', '197px');
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
            } else {
                $("#preview_penanggung").html('<p class="text-center">Belum ada file</p>');
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

            $('#keterangan').on('change', function() {
                if($(this).val() == 'New Customer') {
                    $('#kode_customer').prop('required', false).prop('readonly', true);
                    $('#kode_customer').val('');
                } else {
                    $('#kode_customer').prop('required', true).prop('readonly', false);
                }
            });
            // END: Change input properties

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

            // START: Submit Form Customer
            $(document).on('submit', '#formCustomer', function(e) {
                e.preventDefault();
                const badan_usaha = $('#bentuk_usaha').val();
                $.ajax({
                    url: '{{ route('home.edit_store') }}',
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
                                text: 'Data berhasil diubah!',
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
                        $('#status_pkp').val(res.data.status_pkp).change();
                        $('#badan_usaha').val(res.data.badan_usaha).change();
                        $('#status_rekening').val(res.data.informasi_bank.status).change();
                        $('#identitas_penanggung_jawab').val(res.data.data_identitas.identitas).change();
                        $('#sales').val(res.data.nama_sales).change();
                        
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
                        $('input[name="jenis_cust"]').val('lama').prop('checked', true);
                        $('#bidang_usaha').val('').change();
                        $('#status_kepemilikan').val('').change();
                        $('#badan_usaha').val('').change();
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
                        $('#jenis_cust').val('lama');
                        $('#sales').val('').change();
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
                                    <label for="">Nomor NITKU (22 digit) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nitku_cabang[]" id="nitku_cabang" placeholder="Masukkan nomor NITKU" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="22">
                                </div>
                                <div class="form-group-modal">
                                    <label for="">Nama Cabang <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama_cabang[]" id="nama_cabang" placeholder="Masukkan nama cabang" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group-modal">
                                <label for="">Alamat NITKU <span class="text-danger">*</span></label>
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
        });
    </script>
@endsection