@extends('layouts.main_app')

@section('title')
    <title>Badan Usaha Detail | PT. PAPASARI</title>
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

    .content-body {
        padding: 16px 0;
    }

    .form-group {
        width: 100%;
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

    .group-column .form-group {
        padding: 0 0 16px 0;
    }

    .content-body .section1, .section2, .section3 {
        display: flex;
        flex-wrap: wrap;
        row-gap: 16px;
    }

    #preview_npwp, #preview_sppkp, #preview_penanggung {
        border: 1px solid #D2D0D8;
        border-radius: 5px;
        height: 271px;
        width: 100%;
        padding: 0;
    }

    #preview_npwp img, #preview_sppkp img, #preview_penanggung img {
        width: 100%;
        height: 269px;
        border-radius: 7px;
    }

    .section1 {
        padding: 0 0 16px 0;
    }
    
    .section2, .section3 {
        padding: 16px 0;
    }

    .footer {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        gap: 16px;
        width: 100%;
    }

    .btnEditData {
        padding: 0 24px;
        height: 48px;
        border-radius: 8px;
        background-color: #0063ee;
        border: none;
        color: #fff;
    }

    .btnUploadFile {
        padding: 0 24px;
        height: 48px;
        border-radius: 8px;
        background-color: #0063ee;
        border: none;
        color: #fff;
    }

    .btnUpload {
        padding: 0 24px;
        height: 48px;
        border-radius: 8px;
        background-color: #0063ee;
        border: none;
        color: #fff;
    }

    .btnDetailCabang {
        padding: 8px 16px;
        border-radius: 8px;
        background-color: #424242;
        border: none;
        color: #fff;
    }

    #previewPDF {
        padding: 8px 16px;
        border-radius: 8px;
        background-color: #424242;
        border: none;
        color: #fff;
        text-decoration: none;
    }

    .btnDownloadPdf {
        padding: 12px 24px;
        height: 48px;
        border-radius: 8px;
        background-color: #ffc107;
        border: none;
        color: #000;
        text-decoration: none;
    }

    .btnDownloadPdf:hover {
        color: #000;
        text-decoration: none;
    }

    .btnDataBaru {
        padding: 0 24px;
        height: 48px;
        border-radius: 8px;
        background-color: #E7E6EB;
        border: none;
        color: #000;
    }

    .btnKembali {
        padding: 0 24px;
        height: 48px;
        border-radius: 8px;
        background-color: #E7E6EB;
        border: none;
        color: #000;
    }

    .profile {
        cursor: pointer;
    }

    input.form-control:read-only {
        background-color: #f3f3f3;
    }

    textarea.form-control:read-only {
        background-color: #f3f3f3;
    }

    #preview_penanggung .zoom-img-wrap .zoom-img, .zoom-img, #preview_npwp .zoom-img-wrap .zoom-img, #preview_sppkp .zoom-img-wrap .zoom-img {
        width: 100%;
        height: 100%;
        transition: 1s;
    }

    label {
        font-weight: 500;
    }

    #cabang {
        position: relative;
    }

    #cabang button {
        position: absolute;
        right: 0;
        top: 37px;
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

    .form-group-modal textarea{
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

        #preview_npwp, #preview_sppkp, #preview_penanggung {
            border: 1px solid #D2D0D8;
            border-radius: 5px;
            height: 185px;
            width: 100%;
        }

        #preview_npwp img, #preview_sppkp img, #preview_penanggung img {
            height: 180px;
            border-radius: 7px;
        }
        
        .form-group {
            margin: 0 12px;
            width: auto;
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

        .row div {
            padding: 0 !important;
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
                </div>
                <hr>
                <div class="content-body">
                    <div class="section1">
                        <h1>Identitas Perusahaan</h1>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group p-0">
                                    <label for="">Sales</label>
                                    <input type="text" name="sales" id="sales" class="form-control" readonly autocomplete="off" value="{{ $perusahaan['sales'] ? $perusahaan['sales'] : '-' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="group-column">
                                    <div class="form-group">
                                        <label for="">Nama Perusahaan</label>
                                        <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" readonly autocomplete="off" value="{{ $perusahaan['nama_perusahaan'] }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Alamat Perusahaan</label>
                                        <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" rows="6" readonly autocomplete="off">{{ $perusahaan['alamat_lengkap'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="group-column">
                                    <div class="form-group">
                                        <label for="">Nama Group Perusahaan</label>
                                        <input type="text" name="nama_group_perusahaan" id="nama_group_perusahaan" class="form-control" readonly autocomplete="off" value="{{ $perusahaan['nama_group_perusahaan'] }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Alamat Group Perusahaan</label>
                                        <textarea name="alamat_group_lengkap" id="alamat_group_lengkap" class="form-control" rows="6" readonly autocomplete="off">{{ $perusahaan['alamat_group_lengkap'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Kota/Kabupaten</label>
                                    <input type="text" name="kota_kabupaten" id="kota_kabupaten" class="form-control" readonly autocomplete="off" value="{{ $perusahaan['kota_kabupaten'] }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Alamat Email Perusahaan</label>
                                    <input type="email" name="alamat_email_perusahaan" id="alamat_email_perusahaan" readonly class="form-control" autocomplete="off" value="{{ $perusahaan['alamat_email'] ? $perusahaan['alamat_email'] : '-' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nomor Handphone Contact Person</label>
                                    <input type="text" name="no_hp" id="no_hp" readonly class="form-control" autocomplete="off" value="{{ $perusahaan['nomor_handphone'] }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Tahun Berdiri</label>
                                    <input type="text" name="tahun_berdiri" id="tahun_berdiri" autocomplete="off" readonly class="form-control" value="{{ $perusahaan['tahun_berdiri'] ? $perusahaan['tahun_berdiri'] : '-' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Lama Usaha (Tahun)</label>
                                    <input type="text" name="lama_usaha" id="lama_usaha" class="form-control" autocomplete="off" readonly value="{{ $perusahaan['lama_usaha'] ? $perusahaan['lama_usaha'] : '-' }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Bidang Usaha</label>
                                    <input type="text" name="bidang_usaha" id="bidang_usaha" class="form-control" autocomplete="off" readonly value="{{ strtoupper(str_replace('_', ' ', $perusahaan['bidang_usaha']))}}">
                                    <div class="bidang_lain p-0 @if($perusahaan['bidang_usaha'] != 'lainnya') d-none @endif">
                                        <input type="text" class="form-control" name="bidang_usaha_lain" id="bidang_usaha_lain" readonly autocomplete="off" value="{{ $perusahaan['bidang_usaha_lain'] ? $perusahaan['bidang_usaha_lain'] : '-' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Status Kepemilkan Tempat Usaha</label>
                                    <input type="text" name="status_kepemilikan" id="status_kepemilikan" class="form-control" autocomplete="off" readonly value="{{ $perusahaan['status_kepemilikan'] ? ucwords(str_replace('_', ' ', $perusahaan['status_kepemilikan'])) : '-' }}">
                                    <div class="group p-0 @if($perusahaan['status_kepemilikan'] != 'group') d-none @endif">
                                        <input type="text" class="form-control" name="nama_group" id="nama_group" readonly autocomplete="off" value="{{ $perusahaan['nama_group'] ? $perusahaan['nama_group'] : '-' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group" >
                                    <label for="">Jenis Badan Usaha</label>
                                    <input type="text" name="badan_usaha" id="badan_usaha" class="form-control" autocomplete="off" readonly value="{{ strtoupper($perusahaan['badan_usaha'])}}">
                                    <div class="badan_usaha_lain p-0 @if($perusahaan['badan_usaha'] != 'lainnya') d-none @endif">
                                        <input type="text" class="form-control" name="badan_usaha_lain" id="badan_usaha_lain" readonly autocomplete="off" value="{{ $perusahaan['badan_usaha_lain'] ? $perusahaan['badan_usaha_lain'] : '-' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama NPWP</label>
                                    <input type="text" name="nama_npwp" id="nama_npwp" class="form-control" autocomplete="off" readonly value="{{ $perusahaan['nama_npwp']}}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nomor NPWP (16 digit)</label>
                                    <input type="text" name="nomor_npwp" id="nomor_npwp" readonly class="form-control" autocomplete="off" value="{{ $perusahaan['nomor_npwp'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Alamat NPWP</label>
                                    <textarea name="alamat_npwp" id="alamat_npwp" cols="70" rows="6" autocomplete="off" class="form-control" readonly>{{ $perusahaan['alamat_npwp'] }}</textarea>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="group-column">
                                    <div class="form-group">
                                        <label for="">Kota Sesuai NPWP</label>
                                        <input type="text" name="kota_npwp" id="kota_npwp" class="form-control" autocomplete="off" readonly value="{{ $perusahaan['kota_npwp'] }}">
                                    </div>

                                    <div class="form-group pt-3">
                                        <label for="">Email Khusus Untuk Faktur Pajak</label>
                                        <input type="text" name="email_faktur" id="email_faktur" class="form-control" autocomplete="off" readonly value="{{ $perusahaan['email_khusus_faktur_pajak'] }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="group-column">
                                    <div class="form-group" id="cabang">
                                        <label for="">Cabang</label>
                                        <input type="text" class="form-control" autocomplete="off" readonly placeholder="{{ App\Models\Cabang::where('identitas_perusahaan_id', $perusahaan['id'])->count() }} Cabang">
                                        <button type="button" class="btnDetailCabang" title="Detail Cabang" data-bs-target="#modalCabang" data-bs-toggle="modal">Detail Cabang</button>
                                    </div>
    
                                    <div class="form-group">
                                        <label for="">Foto NPWP</label>
                                        @if(File::extension($perusahaan['foto_npwp']) == 'pdf')
                                            <div id="preview_npwp" class="form-group d-flex justify-content-between align-items-center py-2 px-3 m-0" style="height: auto;">
                                                <p style="font-size: 18px;">Preview file NPWP</p>
                                                <a href="{{ url('/form-customer/getFiles/FileIDCompanyOrPersonal/' . $perusahaan['foto_npwp']) }}" target="_blank" id="previewPDF">Preview PDF</a>
                                                {{-- <a href="{{ asset('/uploads/identitas_perusahaan/' . $perusahaan['foto_npwp']) }}" target="_blank" id="previewPDF">Preview PDF</a> --}}
                                            </div>
                                        @else
                                            <div id="preview_npwp" class="form-group">
                                                <img id="preview_foto_npwp" src="{{ url('/form-customer/getFiles/FileIDCompanyOrPersonal/' . $perusahaan['foto_npwp']) }}" alt="Preview" data-action="zoom">
                                                {{-- <img id="preview_foto_npwp" src="{{ asset('/uploads/identitas_perusahaan/' . $perusahaan['foto_npwp']) }}" alt="Preview" data-action="zoom"> --}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="group-column">
                                    <div class="form-group">
                                        <label for="">Nomor Aktif Untuk Faktur Pajak</label>
                                        <input type="text" name="no_wa" id="no_wa" class="form-control" autocomplete="off" readonly value="{{ $perusahaan['nomor_whatsapp'] }}">
                                    </div>
    
                                    <div class="form-group pt-3">
                                        <label for="">Status Pengusaha Kena Pajak (PKP)</label>
                                        <input type="text" name="status_pkp" id="status_pkp" class="form-control" autocomplete="off" readonly value="{{ strtoupper(str_replace('_', ' ', $perusahaan['status_pkp'])) }}">
                                    </div>
        
                                    <div class="pkp p-0 @if($perusahaan['status_pkp'] != 'pkp') d-none @endif">
                                        <div class="form-group">
                                            @if(File::extension($perusahaan['sppkp']) == 'pdf')
                                                <div id="preview_sppkp" class="form-group d-flex justify-content-between align-items-center py-2 px-3 m-0" style="height: auto;">
                                                    <p style="font-size: 18px;">Preview file SPPKP</p>
                                                    <a href="{{ url('/form-customer/getFiles/FileSPPKPCompany/' . $perusahaan['sppkp']) }}" target="_blank" id="previewPDF">Preview PDF</a>
                                                    {{-- <a href="{{ asset('/uploads/identitas_perusahaan/' . $perusahaan['sppkp']) }}" target="_blank" id="previewPDF">Preview PDF</a> --}}
                                                </div>
                                            @else
                                                <div id="preview_sppkp" class="form-group">
                                                    <img id="preview_foto_sppkp" src="{{ url('/form-customer/getFiles/FileSPPKPCompany/' . $perusahaan['sppkp']) }}" alt="Preview" data-action="zoom">
                                                    {{-- <img id="preview_foto_sppkp" src="{{ asset('/uploads/identitas_perusahaan/' . $perusahaan['sppkp']) }}" alt="Preview" data-action="zoom"> --}}
                                                </div>
                                            @endif
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
                                    <label for="">Nomor Rekening</label>
                                    <input type="text" name="nomor_rekening" id="nomor_rekening" readonly class="form-control" autocomplete="off" value="{{ $perusahaan['informasi_bank']['nomor_rekening'] }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Rekening</label>
                                    <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" autocomplete="off" readonly value="{{ $perusahaan['informasi_bank']['nama_rekening'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Bank</label>
                                    <input type="text" name="nama_bank" id="nama_bank" class="form-control" autocomplete="off" readonly value="{{ $perusahaan['informasi_bank']['nama_bank'] }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="group-column">
                                    <div class="form-group">
                                        <label for="">Pemilik Rekening</label>
                                        <input type="text" name="status" id="pemilik_rekening" class="form-control" autocomplete="off" readonly value="{{ ucwords(str_replace('_', ' ', $perusahaan['informasi_bank']['status'])) }}">
                                        <div class="rekening_lain p-0 @if($perusahaan['informasi_bank']['status'] != 'lainnya') d-none @endif">
                                            <input type="text" class="form-control" name="rekening_lain" id="rekening_lain" readonly autocomplete="off" value="{{ $perusahaan['informasi_bank']['rekening_lain'] ? $perusahaan['informasi_bank']['rekening_lain'] : '-' }}">
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
                                    <input type="text" name="nama_penanggung_jawab" id="nama_penanggung_jawab" readonly autocomplete="off" class="form-control" value="{{ $perusahaan['data_identitas']['nama'] }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Jabatan</label>
                                    <input type="text" name="jabatan" id="jabatan" class="form-control" autocomplete="off" readonly value="{{ $perusahaan['data_identitas']['jabatan'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group" >
                                    <label for="">Identitas Penanggung Jawab</label>
                                    <input type="text" name="identitas_penanggung_jawab" id="identitas_penanggung_jawab" class="form-control" autocomplete="off" readonly value="{{ strtoupper($perusahaan['data_identitas']['identitas']) }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nomor Handphone</label>
                                    <input type="text" name="nomor_hp_penanggung_jawab" id="no_hp_penanggung_jawab" readonly autocomplete="off" class="form-control" value="{{ $perusahaan['data_identitas']['no_hp'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group p-0">
                                    <label for="">Foto Identitas (KTP / NPWP)</label>
                                    @if(File::extension($perusahaan['data_identitas']['foto']) == 'pdf')
                                        <div id="preview_penanggung" class="form-group d-flex justify-content-between align-items-center py-2 px-3 m-0" style="height: auto;">
                                            <p style="font-size: 18px;">Preview file identitas</p>
                                            <a href="{{ url('/form-customer/getFiles/FileIDPersonCharge/' . $perusahaan['data_identitas']['foto']) }}" target="_blank" id="previewPDF">Preview PDF</a>
                                            {{-- <a href="{{ asset('/uploads/penanggung_jawab/' . $perusahaan['data_identitas']['foto']) }}" target="_blank" id="previewPDF">Preview PDF</a> --}}
                                        </div>
                                    @else
                                        <div id="preview_penanggung" class="form-group">
                                            <img id="preview_foto_penanggung" src="{{ url('/form-customer/getFiles/FileIDPersonCharge/' . $perusahaan['data_identitas']['foto']) }}" alt="Preview" data-action="zoom">
                                            {{-- <img id="preview_foto_penanggung" src="{{ asset('/uploads/penanggun_jawab/' . $perusahaan['data_identitas']['foto']) }}" alt="Preview" data-action="zoom"> --}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <div class="button2">
                        <button type="button" class="btnEditData" title="Edit Data" data-url="{{ $url }}">Edit Data</button>
                    </div>
                    <div class="button3">
                        <a type="button" href="{{ route('form_customer.pdf', ['menu' => str_replace('_', '-', $perusahaan['bentuk_usaha']), 'id' => $enkripsi]) }}" target="_blank" class="btnDownloadPdf" title="Download PDF">Download PDF</a>
                    </div>
                    <div class="button4">
                        <button type="button" class="btnUploadFile" title="Upload File" data-bs-toggle="modal" data-bs-target="#modalUpload">Upload File</button>
                    </div>
                </div>
            </div>
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
                        <input type="hidden" name="menu" id="menu" value="{{ str_replace('_', '-', $perusahaan['bentuk_usaha']) }}">
                        <input type="hidden" name="data" id="data" value="{{ $enkripsi }}">
                        <label for="">Upload PDF <span class="text-danger">*</span></label>
                        <input type="file" name="file_pdf" id="file_pdf" accept=".pdf" class="form-control" required>

                        <div class="modal-footer">
                            <button type="button" class="btnKembali" data-bs-dismiss="modal" title="Batal">Batal</button>
                            <button type="submit" class="btnUpload">Upload File</button>
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
                        @if(count($perusahaan['cabang']) > 0)
                            @foreach($perusahaan['cabang'] as $key => $value)
                                <div class="row align-items-center">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="group-column-modal">
                                            <div class="form-group-modal">
                                                <label for="">Nomor NITKU (22 digit)</label>
                                                <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="22" autocomplete="off" readonly placeholder="Masukkan nomor NITKU" value="{{ $value['nitku'] }}">
                                            </div>
                                            <div class="form-group-modal">
                                                <label for="">Nama Cabang</label>
                                                <input type="text" class="form-control" autocomplete="off" readonly placeholder="Masukkan nama cabang" value="{{ $value['nama'] }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group-modal">
                                            <label for="">Alamat NITKU</label>
                                            <textarea cols="30" rows="5" class="form-control" autocomplete="off" placeholder="Masukkan alamat NITKU" readonly>{{ $value['alamat'] }}</textarea>
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
                    }
                });
            });
            // END: Form upload PDF
        });
    </script>
@endsection