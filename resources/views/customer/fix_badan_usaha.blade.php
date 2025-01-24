@extends('layouts.main_app')

@section('title')
    <title>Badan Usaha | PT. PAPASARI</title>
@endsection

@section('css')
<style>
    .container {
        padding: 64px 0;
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

    .content-body {
        padding: 16px 0;
    }

    .form-group label {
        padding-bottom: 8px;
    }

    .group-column .form-group {
        padding: 0 0 16px 0;
    }

    .content-body .section1, .section2, .section3 {
        display: flex;
        flex-wrap: wrap;
        row-gap: 16px;
    }

    /* input::placeholder {
        color: #FF0000;   
    } */

    #preview_npwp, #preview_sppkp, #preview_penanggung {
        border: 1px solid #D2D0D8;
        border-radius: 5px;
        height: 271px;
        width: 592px;
    }

    #preview_npwp img, #preview_sppkp img, #preview_penanggung img {
        width: 590px;
        height: 269px;
        border-radius: 7px;
    }

    .section1 {
        padding: 0 0 16px 0;
    }
    
    .section2, .section3 {
        padding: 16px 0 0 0;
    }

    .footer {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        gap: 16px;
    }

    .btnSubmit {
        padding: 0 24px;
        height: 48px;
        border-radius: 8px;
        background-color: #0063ee;
        border: none;
        color: #fff;
    }

    .btnCabang {
        padding: 0 24px;
        height: 48px;
        border-radius: 8px;
        background-color: #0063ee;
        border: none;
        color: #fff;
    }

    .btnKembali {
        padding: 0 24px;
        height: 48px;
        border-radius: 8px;
        background-color: #E7E6EB;
        border: none;
        color: #000;
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

    label {
        font-weight: 500;
    }

    .form-group input {
        width: 592px;
        padding: 16px;
    }

    .form-group textarea {
        width: 592px;
        padding: 16px;
    }

    .form-group select {
        width: 592px;
        padding: 16px;
    }

    .form-group-modal input {
        /* width: 515px; */
        padding: 16px;
    }

    .form-group-modal textarea {
        /* width: 515px; */
        padding: 16px;
    }

    @media screen and (max-width: 475px) {
        .container {
            padding: 0;
        }
        
        .container-fluid {
            background-color: #fff;
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

        .footer {
            display: flex;
            justify-content: center;
        }

        #preview_npwp, #preview_sppkp, #preview_penanggung {
            border: 1px solid #D2D0D8;
            border-radius: 5px;
            height: 205px;
            width: 333px;
        }

        #preview_npwp img, #preview_sppkp img, #preview_penanggung img {
            width: 330px;
            height: 200px;
            border-radius: 7px;
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
                    <div class="profile" onclick="login()">
                        <img src="{{ asset('../../../images/Profile.svg') }}" alt="Profile">
                    </div>
                </div>
                <div class="title">
                    <h1>Formulir Data Customer</h1>
                    <h5>Silahkan isi data terkini anda, kemudian tanda tangan.</h5>
                </div>
                <form id="formCustomer" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="update_id" id="update_id" value="{{ $enkripsi }}">
                    <input type="hidden" name="bentuk_usaha" id="bentuk_usaha" value="badan_usaha">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <label for="" class="mb-2">Jenis Customer <span class="text-danger">*</span></label>
                            <br>
                            <input type="radio" name="jenis_cust" id="cust_lama" value="lama" checked>
                            <label for="">Customer Lama</label>
                            <br>
                            <input type="radio" name="jenis_cust" id="cust_baru" value="baru">
                            <label for="">Customer Baru</label>
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
                                    <div class="form-group">
                                        <label for="">Alamat Perusahaan <span class="text-danger">*</span></label>
                                        <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" rows="6" placeholder="Masukkan alamat lengkap perusahaan" autocomplete="off" required>{{ $data ? $data['alamat_lengkap'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="group-column">
                                        <div class="form-group">
                                            <label for="">Kota/Kabupaten <span class="text-danger">*</span></label>
                                            <input type="text" name="kota_kabupaten" id="kota_kabupaten" class="form-control" placeholder="Masukkan Kota/Kabupaten" autocomplete="off" required value="{{ $data ? $data['kota_kabupaten'] : '' }}">
                                        </div>
                
                                        <div class="form-group">
                                            <label for="">Alamat Email Perusahaan</label>
                                            <input type="text" name="alamat_email_perusahaan" id="alamat_email_perusahaan" class="form-control" autocomplete="off" placeholder="Contoh: perusahaan@gmail.com" value="{{ $data ? ($data['alamat_email'] ? $data['alamat_email'] : '') : '' }}">
                                        </div>
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
                                        </select>
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
                                        <label for="">Nomor NPWP <span class="text-danger">*</span></label>
                                        <input type="text" name="nomor_npwp" id="nomor_npwp" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="16" class="form-control" autocomplete="off" placeholder="Masukkan Nomor NPWP" required value="{{ $data ? $data['nomor_npwp'] : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="group-column">
                                        <div class="form-group">
                                            <label for="">NITKU untuk penerbitan Faktur Pajak (22 digit) <span class="text-danger">*</span></label>
                                            <input type="text" name="nitku" id="nitku" class="form-control" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="22" autocomplete="off" required placeholder="Masukkan NITKU untuk penerbitan Faktur Pajak" value="{{ $data ? ($data['nitku'] ? $data['nitku'] : '') : '' }}">
                                        </div>
    
                                        <div class="form-group">
                                            <label for="">Alamat NPWP <span class="text-danger">*</span></label>
                                            <textarea name="alamat_npwp" id="alamat_npwp" cols="70" rows="6" autocomplete="off" class="form-control" required placeholder="Masukkan Alamat NPWP">{{ $data ? $data['alamat_npwp'] : '' }}</textarea>
                                        </div>

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
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="group-column">
                                        <div class="form-group">
                                            <label for="">Foto NPWP <span class="text-danger">*</span></label>
                                            <input type="file" name="foto_npwp" id="foto_npwp" onchange="previewFileNpwp(this);" accept=".jpg, .png, .pdf, .jpeg" class="form-control">
                                        </div>
                
                                        <div id="preview_npwp" class="form-group">
                                            <img id="preview_foto_npwp" src="{{ $data ? asset('../../../uploads/identitas_perusahaan/' . $data['foto_npwp']) : '' }}" alt="Preview" data-action="zoom">
                                        </div>

                                        {{-- <div class="branch-section mt-3">
                                            <button type="button" class="btnCabang" data-bs-toggle="modal" data-bs-target="#modalCabang">Tambah Cabang</button>
                                        </div> --}}

                                        <div class="form-group mt-3" id="select">
                                            <label for="">Status Pengusaha Kena Pajak (PKP) <span class="text-danger">*</span></label>
                                            <select name="status_pkp" id="status_pkp" class="form-control" required>
                                                <option value="non_pkp">Non PKP</option>
                                                <option value="pkp">PKP</option>
                                            </select>
                                            <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                        </div>
                                        <div class="pkp d-none">
                                            <div class="form-group">
                                                <input type="file" name="foto_sppkp" id="foto_sppkp" onchange="previewFileSppkp(this);" accept=".jpg, .png, .pdf, .jpeg" class="form-control">
                                            </div>
                
                                            <div id="preview_sppkp" class="form-group">
                                                <img id="preview_foto_sppkp" src="{{ $data ? ($data['sppkp'] ? asset('../../../uploads/identitas_perusahaan/' . $data['sppkp']) : '') : '' }}" alt="Preview" data-action="zoom">
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
                            <div class="group-column">
                                <div class="form-group">
                                    <label for="">Foto Identitas <span class="text-danger">*</span></label>
                                    <input type="file" name="foto_penanggung" id="foto_penanggung" class="form-control" onchange="previewFilePenanggung(this);" accept=".jpg, .png, .pdf, .jpeg">
                                </div>
    
                                <div id="preview_penanggung" class="form-group">
                                    <img id="preview_foto_penanggung" src="{{ $data ? asset('../../../uploads/penanggung_jawab/' . $data['data_identitas']['foto']) : '' }}" alt="Preview" data-action="zoom">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <div class="button1">
                            @if($enkripsi)
                                <button type="button" class="btnKembali" id="btnKembaliDetail" title="Kembali" data-url="{{ $url }}">Kembali</button>
                            @else
                                <button type="button" class="btnKembali" title="Kembali">Kembali</button>
                            @endif
                        </div>
                        <div class="button2">
                            <button type="submit" class="btnSubmit" title="Submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
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
                    <hr>
                    <div class="dynamic-row">
                        <div class="row align-items-center counter-1">
                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-12">
                                <button type="button" id="delRow"><i class="fa-solid fa-minus text-light"></i></button>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="group-column">
                                    <div class="form-group-modal mb-2">
                                        <label for="">Nomor NITKU <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nitku" id="nitku" required placeholder="Masukkan nomor NITKU" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="22">
                                    </div>
                                    <div class="form-group-modal">
                                        <label for="">Nama Cabang <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nama_cabang" id="nama_cabang" required placeholder="Masukkan nama cabang">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                                <div class="form-group-modal">
                                    <label for="">Alamat NITKU</label>
                                    <textarea name="alamat_nitku" id="alamat_nitku" cols="30" rows="5" class="form-control" placeholder="Masukkan alamat NITKU" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    {{-- <button type="button" class="btn btn-primary">Simpan</button> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- END: Branch modal --}}
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
                        $('#preview_npwp').html('<iframe src="'+reader.result+'" style="width: 100%; height: 271px;" target="_blank">'+file[0].name+'</iframe>');
                    }
                } else {
                    $("#preview_npwp").css('height', '271px');
                    $('#preview_npwp').html('<img id="preview_foto_npwp" src="" alt="Preview" data-action="zoom">');
                    reader.onload = function() {
                        $("#preview_foto_npwp").attr("src", reader.result);
                    }
                }
                reader.readAsDataURL(file[0]);
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
                        $('#preview_sppkp').html('<iframe src="'+reader.result+'" style="width: 100%; height: 271px;" target="_blank">'+file[0].name+'</iframe>');
                    }
                } else {
                    $("#preview_sppkp").css('height', '271px');
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
                        $('#preview_foto_penanggung').html('<iframe src="'+reader.result+'" style="width: 100%; height: 271px;" target="_blank">'+file[0].name+'</iframe>');
                    }
                } else {
                    $("#preview_penanggung").css('height', '271px');
                    $('#preview_penanggung').html('<img id="preview_foto_penanggung" src="" alt="Preview" data-action="zoom">');
                    reader.onload = function() {
                        $("#preview_foto_penanggung").attr("src", reader.result);
                    }
                }
                reader.readAsDataURL(file[0]);
            }
        }
        // END: Preview foto

        // START: Direct login page
        function login() {
            window.location.href = '/login';
        }
        // END: Direct login page

        // START: Auto format NPWP
        // const npwp = document.getElementById('nomor_npwp');
        // npwp.oninput = (e) => {
        //     e.target.value = autoFormatNPWP(e.target.value);
        // }
        // function autoFormatNPWP(NPWPString) {
        //     try {
        //         var cleaned = ("" + NPWPString).replace(/\D/g, "");
        //         var match = cleaned.match(/(\d{0,2})?(\d{0,3})?(\d{0,3})?(\d{0,1})?(\d{0,3})?(\d{0,3})$/);
        //         return [      
        //                 match[1], 
        //                 match[2] ? ".": "",
        //                 match[2], 
        //                 match[3] ? ".": "",
        //                 match[3],
        //                 match[4] ? ".": "",
        //                 match[4],
        //                 match[5] ? "-": "",
        //                 match[5],
        //                 match[6] ? ".": "",
        //                 match[6]].join("")
                
        //     } catch(err) {
        //         return "";
        //     }
        // }
        // END: Auto format NPWP
        $(document).ready(function() {
            // START: Tombol Kembali
            $('.btnKembali').on('click', function() {
                window.location.href = '/form-customer';
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
            // END: Change input properties

            // START: Submit Form Customer
            $(document).on('submit', '#formCustomer', function(e) {
                e.preventDefault();
                const badan_usaha = $('#bentuk_usaha').val();
                $.ajax({
                    url: '/form-customer/'+badan_usaha+'/store',
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
                            $('#formCustomer')[0].reset();
                            window.location.href = res.link_test;
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
            var enkripsi = $('#update_id').val();
            let url = '{{ route('form_customer.select', ':id') }}';
            url = url.replace(':id', enkripsi);
            $.ajax({
                url: url,
                type: 'GET',
                success: res => {
                    if(res.status == true) {
                        $('#status_kepemilikan').val(res.data.status_kepemilikan).change();
                        $('#badan_usaha').val(res.data.badan_usaha).change();
                        $('#bidang_usaha').val(res.data.bidang_usaha).change();
                        $('#identitas_perusahaan').val(res.data.identitas).change();
                        $('#status_pkp').val(res.data.status_pkp).change();
                        $('#status_rekening').val(res.data.informasi_bank.status).change();
                        if(res.data.data_identitas) {
                            $('#identitas_penanggung_jawab').val(res.data.data_identitas.identitas).change();
                        }
                        if(res.data.status_cust == 'lama') {
                            $('#cust_lama').prop('checked', true);
                        } else {
                            $('#cust_baru').prop('checked', true);
                        }
                        $('#status_cabang').val(res.data.status_cabang).change();
                    } else {
                        $('#status_kepemilikan').val('').change();
                        $('#badan_usaha').val('').change();
                        $('#bidang_usaha').val('').change();
                        $('#identitas_perusahaan').val('ktp').change();
                        $('#status_pkp').val('non_pkp').change();
                        $('#status_rekening').val('').change();
                        $('#identitas_penanggung_jawab').val('').change();
                        $('#cust_lama').prop('checked', true);
                        $('#status_cabang').val('').change();
                    }
                }
            });
            // END: Get data untuk select

            // START: Dynamic row
            // let counter = 1;
            // $('#addRow').on('click', function() {
            //     counter++;
            //     $('.dynamic-row').append(`
            //         <hr>
            //         <div class="row align-items-center counter-`+counter+`">
            //             <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-12">
            //                 <button type="button" id="delRow"><i class="fa-solid fa-minus text-light"></i></button>
            //             </div>
            //             <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            //                 <div class="group-column">
            //                     <div class="form-group-modal mb-2">
            //                         <label for="">Nomor NITKU <span class="text-danger">*</span></label>
            //                         <input type="text" class="form-control" name="nitku" id="nitku" required placeholder="Masukkan nomor NITKU" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="22">
            //                     </div>
            //                     <div class="form-group-modal">
            //                         <label for="">Nama Cabang <span class="text-danger">*</span></label>
            //                         <input type="text" class="form-control" name="nama_cabang" id="nama_cabang" required placeholder="Masukkan nama cabang">
            //                     </div>
            //                 </div>
            //             </div>
            //             <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
            //                 <div class="form-group-modal">
            //                     <label for="">Alamat NITKU</label>
            //                     <textarea name="alamat_nitku" id="alamat_nitku" cols="30" rows="5" class="form-control" placeholder="Masukkan alamat NITKU" required></textarea>
            //                 </div>
            //             </div>
            //         </div>
            //     `);
            // });

            // $('#delRow').on('click', function() {
            //     $(this).parent().parent().find('counter-'+counter).remove();
            //     counter--;
            // });
            // END: Dynamic row
        });
    </script>
@endsection