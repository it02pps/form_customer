@extends('layouts.main_app')

@section('title')
    <title>Detail Data Customer | PT. PAPASARI</title>
@endsection

@section('css')
<style>
    .container {
        padding: 64px 0;
    }
    
    .container-fluid {
        background-color: #fff;
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

    .content-body .section1, .section2, .section3, .section4 {
        display: flex;
        flex-wrap: wrap;
        row-gap: 16px;
    }

    #ktp-section, #npwp-section {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
    }

    /* input::placeholder {
        color: #FF0000;   
    } */

    #preview_ktp, #preview_npwp, #preview_sppkp, #preview_penanggung {
        border: 1px solid #D2D0D8;
        border-radius: 5px;
        height: 271px;
        width: 592px;
    }

    #preview_ktp img, #preview_npwp img, #preview_sppkp img, #preview_penanggung img {
        width: 590px;
        height: 269px;
        border-radius: 7px;
    }

    .section1 {
        padding: 0 0 16px 0;
    }
    
    .section2, .section3, .section4 {
        padding: 16px 0 0 0;
    }

    .footer {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        gap: 16px;
    }

    .btnEditData {
        width: 185px;
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

    .profile {
        cursor: pointer;
    }

    #preview_penanggung .zoom-img-wrap .zoom-img, #preview_ktp .zoom-img-wrap .zoom-img, #preview_npwp .zoom-img-wrap .zoom-img, #preview_sppkp .zoom-img-wrap .zoom-img {
        width: 100%;
        height: 100%;
        transition: 1s;
    }

    input.form-control:read-only {
        background-color: #f3f3f3;
    }

    textarea.form-control:read-only {
        background-color: #f3f3f3;
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

    .btnUploadFile {
        padding: 0 24px;
        height: 48px;
        border-radius: 8px;
        background-color: #0063ee;
        border: none;
        color: #fff;
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

        #preview_ktp, #preview_npwp, #preview_sppkp, #preview_penanggung {
            border: 1px solid #D2D0D8;
            border-radius: 5px;
            height: 205px;
            width: 333px;
        }

        #preview_ktp img, #preview_npwp img, #preview_sppkp img, #preview_penanggung img {
            width: 330px;
            height: 200px;
            border-radius: 7px;
        }

        #ktp-section, #npwp-section {
            display: inline;
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
                    <h1>Detail Data Customer</h1>
                </div>
                <hr>
                <div class="content-body">
                    <div class="section1">
                        <h1>Identitas Perseorangan</h1>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Jenis Customer</label>
                                    <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" autocomplete="off" readonly value="{{ strtoupper($data['status_cust']) }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Usaha</label>
                                    <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" autocomplete="off" readonly value="{{ $data['nama_perusahaan'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="group-column">
                                    <div class="form-group">
                                        <label for="">Nama Group Usaha</label>
                                        <input type="text" name="nama_group_perusahaan" id="nama_group_perusahaan" class="form-control" autocomplete="off" readonly value="{{ $data['nama_group_perusahaan'] }}">
                                    </div>
    
                                    <div class="form-group">
                                        <label for="">Kota/Kabupaten</label>
                                        <input type="text" name="kota_kabupaten" id="kota_kabupaten" class="form-control" autocomplete="off" readonly value="{{ $data['kota_kabupaten'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Alamat usaha</label>
                                    <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" rows="6" autocomplete="off" readonly>{{ $data['alamat_lengkap'] }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Alamat Email usaha</label>
                                    <input type="text" name="alamat_email_perusahaan" id="alamat_email_perusahaan" class="form-control" autocomplete="off" readonly value="{{ $data['alamat_email'] ? $data['alamat_email'] : '-' }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nomor Handphone Contact Person</label>
                                    <input type="text" name="no_hp" id="no_hp" class="form-control" autocomplete="off" readonly value="{{ $data['nomor_handphone'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Tahun Berdiri</label>
                                    <input type="text" name="tahun_berdiri" id="tahun_berdiri" autocomplete="off" class="form-control" readonly value="{{ $data['tahun_berdiri'] ? $data['tahun_berdiri'] : '-' }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Lama Usaha (Tahun)</label>
                                    <input type="text" name="lama_usaha" id="lama_usaha" class="form-control" autocomplete="off" readonly value="{{ $data['lama_usaha'] ? $data['lama_usaha'] : '-' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Bidang Usaha</label>
                                    <input type="text" name="bidang_usaha" id="bidang_usaha" autocomplete="off" class="form-control" readonly value="{{ strtoupper(str_replace('_', ' ', $data['bidang_usaha'])) }}">
                                    <div class="bidang_lain @if($data['bidang_usaha'] != 'lainnya') d-none @endif">
                                        <input type="text" class="form-control" name="bidang_usaha_lain" id="bidang_usaha_lain" autocomplete="off" value="{{ $data['bidang_usaha_lain'] ? $data['bidang_usaha_lain'] : '-'  }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Status Kepemilkan Tempat Usaha</label>
                                    <input type="text" name="status_kepemilikan" id="status_kepemilikan" autocomplete="off" class="form-control" readonly value="{{ ucwords(str_replace('_', ' ', $data['status_kepemilikan'])) }}">
                                    <div class="group @if($data['status_kepemilikan'] != 'group') d-none @endif">
                                        <input type="text" class="form-control" name="nama_group" id="nama_group" autocomplete="off" value="{{ $data['nama_group'] ? $data['nama_group'] : '-' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Identitas Perseorangan</label>
                                    <input type="text" name="identitas_perusahaan" id="identitas_perusahaan" autocomplete="off" class="form-control" readonly value="{{ strtoupper($data['identitas']) }}">
                                </div>
                            </div>
                            <div id="ktp-section" class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 @if($data['identitas'] != 'ktp') d-none @endif">
                                <div class="form-group">
                                    <label for="">NIK</label>
                                    <input type="text" id="nomor_ktp" name="nomor_ktp" autocomplete="off" class="form-control" readonly value="{{ $data['nomor_ktp'] ? $data['nomor_ktp'] : '-' }}">
                                </div>
                            </div>
                        </div>
                        {{-- START: KTP --}}
                        <div id="ktp-section" class="@if($data['identitas'] != 'ktp') d-none @endif">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Lengkap Sesuai Identitas</label>
                                        <input type="text" id="nama_lengkap" name="nama_lengkap" autocomplete="off" class="form-control" readonly value="{{ $data['nama_lengkap'] ? $data['nama_lengkap'] : '-' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Foto KTP <span class="text-danger">*</span></label>
                                        <div class="form-group" id="preview_ktp">
                                            <img id="preview_foto_ktp" src="{{ $data['foto_ktp'] ? asset('../../../uploads/identitas_perusahaan/' . $data['foto_ktp']) : '-' }}" alt="Preview" data-action="zoom">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END: KTP --}}
                        {{-- START: NPWP --}}
                        <div id="npwp-section" class="@if($data['identitas'] != 'npwp') d-none @endif">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama NPWP</label>
                                        <input type="text" name="nama_npwp" id="nama_npwp" class="form-control" autocomplete="off" readonly value="{{ $data['nama_npwp'] ? $data['nama_npwp'] : '-' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nomor NPWP</label>
                                        <input type="text" name="nomor_npwp" id="nomor_npwp" class="form-control" autocomplete="off" readonly value="{{ $data['nomor_npwp'] ? $data['nomor_npwp'] : '-' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="group-column">
                                        <div class="form-group">
                                            <label for="">NITKU untuk penerbitan Faktur Pajak (22 digit)</label>
                                            <input type="text" name="nitku" id="nitku" class="form-control" autocomplete="off" readonly value="{{ $data['nitku'] ? $data['nitku'] : '-' }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Kota Sesuai NPWP</label>
                                            <input type="text" name="kota_npwp" id="kota_npwp" class="form-control" autocomplete="off" readonly value="{{ $data['kota_npwp'] ? $data['kota_npwp'] : '-' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Alamat NPWP</label>
                                        <textarea name="alamat_npwp" id="alamat_npwp" cols="70" rows="10" autocomplete="off" class="form-control" readonly>{{ $data['alamat_npwp'] ? $data['alamat_npwp'] : '-' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="group-column">
                                        <div class="form-group">
                                            <label for="">Email Khusus Untuk Faktur Pajak</label>
                                            <input type="text" name="email_faktur" id="email_faktur" class="form-control" autocomplete="off" readonly value="{{ $data['email_khusus_faktur_pajak'] ? $data['email_khusus_faktur_pajak'] : '-' }}">
                                        </div>

                                        <div class="form-group" >
                                            <label for="">Status Pengusaha Kena Pajak (PKP)</label>
                                            <input type="text" name="status_pkp" id="status_pkp" class="form-control" autocomplete="off" readonly value="{{ $data['status_pkp'] ? strtoupper(str_replace('_', ' ', $data['status_pkp'])) : '-' }}">
                                        </div>
        
                                        <div class="pkp @if($data['status_pkp'] != 'pkp') d-none @endif">
                                            <div id="preview_sppkp" class="form-group">
                                                <img id="preview_foto_sppkp" src="{{ $data['sppkp'] ? asset('../../../uploads/identitas_perusahaan/' . $data['sppkp']) : '-' }}" alt="Preview" data-action="zoom">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Foto NPWP</label>
                                        <div class="form-group" id="preview_npwp">
                                            <img id="preview_foto_npwp" src="{{ $data['foto_npwp'] ? asset('../../../uploads/identitas_perusahaan/' . $data['foto_npwp']) : '-' }}" alt="Preview" data-action="zoom">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END: NPWP --}}
                    </div>
                    <hr>
                    <div class="section2">
                        <h1>Informasi Bank</h1>

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nomor Rekening</label>
                                    <input type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" autocomplete="off" readonly value="{{ $data['informasi_bank']['nomor_rekening'] }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Rekening</label>
                                    <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" autocomplete="off" readonly value="{{ $data['informasi_bank']['nama_rekening'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Bank</label>
                                    <input type="text" name="nama_bank" id="nama_bank" class="form-control" autocomplete="off" readonly value="{{ $data['informasi_bank']['nama_bank'] }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="group-column">
                                    <div class="form-group">
                                        <label for="">Pemilik Rekening</label>
                                        <input type="text" name="pemilik_rekening" id="pemilik_rekening" class="form-control" autocomplete="off" readonly value="{{ ucwords(str_replace('_', ' ', $data['informasi_bank']['status'])) }}">
                                        <div class="rekening_lain @if($data['informasi_bank']['status'] != 'lainnya') d-none @endif">
                                            <input type="text" class="form-control" name="rekening_lain" id="rekening_lain" autocomplete="off" readonly value="{{ $data['informasi_bank']['rekening_lain'] ? $data['informasi_bank']['rekening_lain'] : '-' }}">
                                        </div>
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
                                    <label for="">Nama Penanggung Jawab</label>
                                    <input type="text" name="nama_penanggung_jawab" id="nama_penanggung_jawab" autocomplete="off" class="form-control" readonly value="{{ $data['data_identitas']['nama'] }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Jabatan</label>
                                    <input type="text" name="jabatan" id="jabatan" class="form-control" autocomplete="off" readonly value="{{ $data['data_identitas']['jabatan'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group" >
                                    <label for="">Identitas Penanggung Jawab</label>
                                    <input type="text" name="identitas_penanggung_jawab" id="identitas_penanggung_jawab" class="form-control" autocomplete="off" readonly value="{{ strtoupper($data['data_identitas']['identitas']) }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nomor Handphone</label>
                                    <input type="text" name="nomor_hp_penanggung_jawab" id="nomor_hp_penanggung_jawab" autocomplete="off" class="form-control" readonly value="{{ $data['data_identitas']['no_hp'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Foto Identitas</label>
                                    <div id="preview_penanggung" class="form-group">
                                        <img id="preview_foto_penanggung" src="{{ $data['data_identitas']['foto'] ? asset('../../../uploads/penanggung_jawab/' . $data['data_identitas']['foto']) : '-' }}" alt="Preview" data-action="zoom">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="section4">
                        <h1>Tipe Customer</h1>
                        <div class="row">
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
                        <div class="row">
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
                        <div class="row">
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
                        <div class="row" style="width: 100%;">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="" class="mb-2">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" readonly autocomplete="off" class="form-control" value="{{ $data['tipe_customer'] ? $data['tipe_customer']['keterangan'] : '-' }}" style="padding: 16px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <div class="button1">
                        <button type="button" class="btnKembali" title="Kembali">Kembali</button>
                    </div>
                    <div class="button2">
                        <button type="submit" class="btnEditData" title="Edit Data Customer" data-url="{{ $url }}">Edit Data Customer</button>
                    </div>
                </div>
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

        $(document).ready(function() {
            // START: Footer button
            $(document).on('click', '.btnEditData', function() {
                let url = $(this).data('url');
                window.location.href = url;
            });

            $(document).on('click', '.btnKembali', function() {
                window.location.href = '/internal/panel/fix';
            });
            // END: Footer button
        });
    </script>
@endsection