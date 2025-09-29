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
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.25);
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

    #ktp-section, #npwp-section {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        width: 100%;
    }

    #preview_ktp, #preview_npwp, #preview_penanggung {
        border: 1px solid #D2D0D8;
        border-radius: 5px;
        height: 271px;
        width: 100%;
        padding: 0;
    }

    #preview_ktp img, #preview_npwp img, #preview_penanggung img {
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

    .profile {
        cursor: pointer;
    }

    #preview_penanggung .zoom-img-wrap .zoom-img, #preview_ktp .zoom-img-wrap .zoom-img, #preview_npwp .zoom-img-wrap .zoom-img {
        width: 100%;
        height: 100%;
        transition: 1s;
    }

    #signature {
        height: 271px;
        width: 100%;
        border: 1px solid #cccccc;
        border-radius: 7px;
        padding: 0;
    }

    #signature img {
        height: 268px;
        width: 100%;
        border-radius: 7px;
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

    .form-group {
        width: 100%;
    }

    .form-group input {
        padding: 16px;
    }

    .form-group textarea {
        padding: 16px;
        height: 164px;
    }

    .row {
        width: 100vw;
    }

    .row div .group-column .form-group:first-child {
        padding: 0;
    }

    .row div .group-column .form-group:last-child {
        padding-top: 16px;
        padding-left: 0;
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

    #cabang {
        position: relative;
    }

    #cabang button {
        position: absolute;
        right: 0;
        top: 55px;
    }

    .btnDetailCabang {
        padding: 8px 16px;
        border-radius: 8px;
        background-color: #424242;
        border: none;
        color: #fff;
    }

    .btnUploadFile {
        padding: 0 24px;
        height: 48px;
        border-radius: 8px;
        background-color: #424242;
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

    .btnKembali {
        padding: 0 24px;
        height: 48px;
        border-radius: 8px;
        background-color: #E7E6EB;
        border: none;
        color: #000;
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

        .content-body {
            width: 100%;
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
            padding: 16px;
        }

        .form-group textarea {
            height: 165px;
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

        #signature {
            width: 100%;
            height: 180px;
            border: 1px solid #cccccc;
            border-radius: 7px;
        }

        #signature canvas {
            border-radius: 7px;
            height: 177px !important;
        }

        #preview_ktp, #preview_npwp, #preview_penanggung {
            border: 1px solid #D2D0D8;
            border-radius: 5px;
            height: 205px;
            width: 333px;
        }

        #preview_ktp img, #preview_npwp img, #preview_penanggung img {
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
                <hr>
                <div class="content-body">
                    <div class="section1">
                        <h1>Identitas Perseorangan</h1>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group p-0">
                                    <label for="">Sales</label>
                                    <input type="text" name="nama_sales" id="nama_sales" class="form-control" autocomplete="off" readonly value="{{ $perusahaan['nama_sales'] ? $perusahaan['nama_sales'] : '-' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="group-column">
                                    <div class="form-group">
                                        <label for="">Nama Usaha</label>
                                        <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" autocomplete="off" readonly value="{{ $perusahaan['nama_perusahaan'] }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Alamat Usaha</label>
                                        <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" rows="6" autocomplete="off" readonly>{{ $perusahaan['alamat_lengkap'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="group-column">
                                    <div class="form-group">
                                        <label for="">Nama Group Usaha</label>
                                        <input type="text" name="nama_group_perusahaan" id="nama_group_perusahaan" class="form-control" autocomplete="off" readonly value="{{ $perusahaan['nama_group_perusahaan'] }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Alamat Group Usaha</label>
                                        <textarea name="alamat_group_usaha" id="alamat_group_usaha" class="form-control" rows="6" autocomplete="off" readonly>{{ $perusahaan['alamat_group_lengkap'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Kota/Kabupaten</label>
                                    <input type="text" name="kota_kabupaten" id="kota_kabupaten" class="form-control" autocomplete="off" readonly value="{{ $perusahaan['kota_kabupaten'] }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Alamat Email Usaha</label>
                                    <input type="text" name="alamat_email_perusahaan" id="alamat_email_perusahaan" class="form-control" autocomplete="off" readonly value="{{ $perusahaan['alamat_email'] ? $perusahaan['alamat_email'] : '-' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nomor Handphone Contact Person</label>
                                    <input type="text" name="no_hp" id="no_hp" class="form-control" autocomplete="off" readonly value="{{ $perusahaan['nomor_handphone'] }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Tahun Berdiri</label>
                                    <input type="text" name="tahun_berdiri" id="tahun_berdiri" autocomplete="off" class="form-control" readonly value="{{ $perusahaan['tahun_berdiri'] ? $perusahaan['tahun_berdiri'] : '-' }}">
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
                                    <input type="text" name="bidang_usaha" id="bidang_usaha" autocomplete="off" class="form-control" readonly value="{{ strtoupper(str_replace('_', ' ', $perusahaan['bidang_usaha'])) }}">
                                    <div class="bidang_lain p-0 @if($perusahaan['bidang_usaha'] != 'lainnya') d-none @endif">
                                        <input type="text" class="form-control" name="bidang_usaha_lain" id="bidang_usaha_lain" readonly autocomplete="off" value="{{ $perusahaan['bidang_usaha_lain'] ? $perusahaan['bidang_usaha_lain'] : '-'  }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Status Kepemilkan Tempat Usaha</label>
                                    <input type="text" name="status_kepemilikan" id="status_kepemilikan" autocomplete="off" class="form-control" readonly value="{{ ucwords(str_replace('_', ' ', $perusahaan['status_kepemilikan'])) }}">
                                    <div class="group p-0 @if($perusahaan['status_kepemilikan'] != 'group') d-none @endif">
                                        <input type="text" class="form-control" name="nama_group" id="nama_group" autocomplete="off" readonly value="{{ $perusahaan['nama_group'] ? $perusahaan['nama_group'] : '-' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">NIK</label>
                                    <input type="text" id="nomor_ktp" name="nomor_ktp" autocomplete="off" class="form-control" readonly value="{{ $perusahaan['npwp_perseorangan'] == '1' ? $perusahaan['nomor_npwp'] : $perusahaan['nomor_ktp'] }}">
                                </div>
                            </div>
                        </div>
                        <div id="ktp-section">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="group-column">
                                        <div class="form-group">
                                            <label for="">Nama Lengkap Sesuai Identitas</label>
                                            <input type="text" id="nama_lengkap" name="nama_lengkap" autocomplete="off" class="form-control" readonly value="{{ $perusahaan['nama_lengkap'] ? $perusahaan['nama_lengkap'] : '-' }}">
                                        </div>
                                        <div class="group-column p-0 mt-2">
                                            <div class="form-group">
                                                <label for="">Foto KTP <span class="text-danger">*</span></label>
                                                @if(File::extension($perusahaan['foto_ktp']) == 'pdf')
                                                    <div class="form-group d-flex justify-content-between align-items-center py-2 px-3 m-0" style="height: auto;" id="preview_ktp">
                                                        <p style="font-size: 18px;">Preview file KTP</p>
                                                        @if ($perusahaan['status_upload_nik'] === 'success')
                                                            <a href="{{ url('/form-customer/getFiles/FileIDCompanyOrPersonal/' . $perusahaan['foto_ktp']) }}" target="_blank" id="previewPDF">Preview PDF</a>
                                                        @elseif ($perusahaan['status_upload_nik'] === 'pending')
                                                            <a href="{{ asset('storage/temp_files/' . $perusahaan['foto_ktp']) }}" target="_blank" id="previewPDF">Preview PDF</a>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div id="preview_ktp" class="form-group">
                                                        @if ($perusahaan['status_upload_nik'] === 'success')
                                                            <img id="preview_foto_ktp" src="{{ url('/form-customer/getFiles/FileIDCompanyOrPersonal/' . $perusahaan['foto_ktp']) }}" alt="Belum ada file" data-action="zoom">
                                                        @elseif ($perusahaan['status_upload_nik'] === 'pending')
                                                            <img id="preview_foto_ktp" src="{{ asset('storage/temp_files/' . $perusahaan['foto_ktp']) }}" alt="Belum ada file" data-action="zoom">
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="group-column">
                                        <div class="form-group">
                                            <label for="">Alamat Lengkap Sesuai Identitas</label>
                                            <textarea name="alamat_ktp" id="alamat_ktp" class="form-control" rows="6" autocomplete="off" readonly>{{ $perusahaan['alamat_ktp'] }}</textarea>
                                        </div>
                                    
                                        <div class="form-group" id="cabang">
                                            <label for="">Cabang</label>
                                            <input type="text" class="form-control" autocomplete="off" readonly placeholder="{{ App\Models\Cabang::where('identitas_perusahaan_id', $perusahaan['id'])->count() }} Cabang">
                                            <button type="button" class="btnDetailCabang" title="Detail Cabang" data-bs-target="#modalCabang" data-bs-toggle="modal">Detail Cabang</button>
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
                                    <input type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" autocomplete="off" readonly value="{{ $perusahaan['informasi_bank']['nomor_rekening'] }}">
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
                                <div class="form-group">
                                    <label for="">Pemilik Rekening</label>
                                    <input type="text" name="pemilik_rekening" id="pemilik_rekening" class="form-control" autocomplete="off" readonly value="{{ ucwords(str_replace('_', ' ', $perusahaan['informasi_bank']['status'])) }}">
                                    <div class="rekening_lain p-0 @if($perusahaan['informasi_bank']['status'] != 'lainnya') d-none @endif">
                                        <input type="text" class="form-control" name="rekening_lain" id="rekening_lain" autocomplete="off" readonly value="{{ $perusahaan['informasi_bank']['rekening_lain'] ? $perusahaan['informasi_bank']['rekening_lain'] : '-' }}">
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
                                    <input type="text" name="nama_penanggung_jawab" id="nama_penanggung_jawab" autocomplete="off" class="form-control" readonly value="{{ $perusahaan['data_identitas']['nama'] }}">
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
                                    <input type="text" name="nomor_hp_penanggung_jawab" id="nomor_hp_penanggung_jawab" autocomplete="off" class="form-control" readonly value="{{ $perusahaan['data_identitas']['no_hp'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Foto Identitas (KTP / NPWP)</label>
                                    @if(File::extension($perusahaan['data_identitas']['foto']) == 'pdf')
                                        <div id="preview_penanggung" class="form-group d-flex justify-content-between align-items-center py-2 px-3 m-0" style="height: auto;">
                                            <p style="font-size: 18px;">Preview file identitas</p>
                                            @if ($perusahaan['data_identitas']['status_upload_foto'] === 'success')
                                                <a href="{{ url('/form-customer/getFiles/FileIDPersonCharge/' . $perusahaan['data_identitas']['foto']) }}" target="_blank" id="previewPDF">Preview PDF</a>
                                            @elseif ($perusahaan['data_identitas']['status_upload_foto'] === 'pending')
                                                <a href="{{ asset('storage/temp_files/' . $perusahaan['data_identitas']['foto']) }}" target="_blank" id="previewPDF">Preview PDF</a>
                                            @endif
                                        </div>
                                    @else
                                        <div id="preview_penanggung" class="form-group">
                                            @if ($perusahaan['data_identitas']['status_upload_foto'] === 'success')
                                                <img id="preview_foto_penanggung" src="{{ url('/form-customer/getFiles/FileIDPersonCharge/' . $perusahaan['data_identitas']['foto']) }}" alt="Preview" data-action="zoom">
                                            @elseif ($perusahaan['data_identitas']['status_upload_foto'] === 'pending')
                                                <img id="preview_foto_penanggung" src="{{ asset('storage/temp_files/' . $perusahaan['data_identitas']['foto']) }}" alt="Preview" data-action="zoom">
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                {{-- Signature --}}
                                <div class="form-group" id="ttd_credit">
                                    <label for="">Tanda Tangan</label>
                                    <div id="signature">
                                        @if ($perusahaan['data_identitas']['status_upload_ttd'] === 'success')
                                            <img src="{{ url('/form-customer/getFiles/FileIDSignature/' . $perusahaan['data_identitas']['ttd']) }}" alt="Preview" data-action="zoom">
                                        @elseif ($perusahaan['data_identitas']['status_upload_ttd'] === 'pending')
                                            <img src="{{ url('storage/temp_files/' . $perusahaan['data_identitas']['ttd']) }}" alt="Preview" data-action="zoom">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <div class="button2">
                        <button type="submit" class="btnEditData" title="Edit Data" data-url="{{ $url }}">Edit Data</button>
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
                    timeout: 8000,
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