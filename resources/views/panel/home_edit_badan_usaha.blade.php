@extends('layouts.app')

@section('title')
<title>Edit Data Customer | PT Papasari</title>
@endsection

@section('css')
<style>
    body {
        overflow-x: hidden;
    }

    .content-body {
        border: 2px solid #1C4A9C;
        border-radius: 8px;
        width: 60%;
        height: auto;
        padding: 15px 20px;
        margin-left: auto;
        margin-right: auto;
    }

    .content-footer {
        /* position: relative; */
        display: flex;
        justify-content: end;
        border-radius: 8px;
        width: 60%;
        margin-left: auto;
        margin-right: auto;
    }

    .section1 h4, .section2 h4, .section3 h4, .section4 h4 {
        text-align: center;
    }

    hr {
        border-top: 2px solid #1C4A9C;
        opacity: 1;
    }

    #preview_ktp, #preview_npwp, #preview_sppkp, #preview_penanggung{
        border: 1px solid #1C4A9C;
        border-radius: 7px;
        margin-top: 2px;
        height: 180px;
        display: flex;
        align-items: center;
    }

    #preview_ktp img, #preview_npwp img, #preview_sppkp img, #preview_penanggung img {
        width: 100%;
        height: 180px;
        object-fit: fill;
        border-radius: 7px;
    }

    .select2-selection__rendered {
        line-height: 31px !important;
    }

    .select2-container .select2-selection--single {
        height: 37px !important;
    }
    
    .select2-selection__arrow {
        height: 37px !important;
    }

    @media only screen and (max-width: 500px) {
        .content-header h2 {
            font-size: 22px;
        }

        .content-body {
            border: 2px solid #1C4A9C !important;
            border-radius: 8px;
            width: 90%;
            height: auto;
            padding: 15px 20px;
            margin-left: auto;
            margin-right: auto;
        }

        .content-footer {
            display: flex;
            justify-content: right;
            border-radius: 8px;
            width: 62%;
        }

        .section1-body .row .col-xl-6:nth-of-type(1) {
            margin-bottom: 12px;
        }

        .section2-body .row .col-xl-6:nth-of-type(1) {
            margin-bottom: 12px;
        }

        .section3-body .row .col-xl-6:nth-of-type(1) {
            margin-bottom: 12px;
        }

        .section4-body .row .col-xl-6:nth-of-type(1) {
            margin-bottom: 12px;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="content-header text-center mb-4">
            <h2>EDIT DATA CUSTOMER</h2>
        </div>
    
        
        <form id="form_customer" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="update_id" id="update_id" value="{{ $enkripsi }}">
            <input type="hidden" name="bentuk_usaha" id="bentuk_usaha" value="badan_usaha">
            <div class="content-body">
                <div class="alert alert-danger" role="alert">
                    <p style="font-size: 18px; font-weight: bold;" class="text-center mb-0">Silahkan mengisi data terkini, kemudian ditanda tangan dan cap perusahaan</p>
                </div>
                <div class="section1 mb-4">
                    <h4>IDENTITAS PERUSAHAAN</h4>
                    <div class="section1-body">
                        <div class="form-group mb-3">
                            <label for="">Jenis Customer <span class="text-danger">*</span></label>
                            <br>
                            <input type="radio" name="jenis_cust" id="cust_lama" value="lama" checked> 
                            <label for="">Customer Lama</label>
                            <br>
                            <input type="radio" name="jenis_cust" id="cust_baru" value="baru"> 
                            <label for="">Customer Baru</label>
                        </div>
                        <div class="row mb-2">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Perusahaan <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" placeholder="Masukkan nama perusahaan" autocomplete="off" required value="{{ $data['nama_perusahaan'] }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Group Perusahaan <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_group_perusahaan" id="nama_group_perusahaan" class="form-control" placeholder="Masukkan nama group perusahaan" autocomplete="off" required value="{{ $data['nama_group_perusahaan'] }}">
                                    <span class="text-danger">*Jika tidak ada, maka diisi dengan nama perusahaan</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Alamat Lengkap Perusahaan<span class="text-danger">*</span></label>
                                    <textarea name="alamat_lengkap" id="alamat_lengkap" cols="30" rows="5" class="form-control" required autocomplete="off" placeholder="Masukkan alamat lengkap perusahaan">{{ $data['alamat_lengkap'] }}</textarea>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-2">
                                    <label for="">Kota / Kabupaten <span class="text-danger">*</span></label>
                                    <input type="text" name="kota_kabupaten" id="kota_kabupaten" class="form-control" placeholder="Masukkan kota / kabupaten" autocomplete="off" required value="{{ $data['kota_kabupaten'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat Email Perusahaan</label>
                                    <input type="email" name="email_perusahaan" id="email_perusahaan" class="form-control" autocomplete="off" placeholder="Contoh: perusahaan@gmail.com" value="{{ $data ? $data['alamat_email'] : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nomor Handphone Contact Person <span class="text-danger">*</span></label>
                                    {{-- <input type="text" name="no_hp" id="no_hp" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="13" class="form-control" placeholder="Masukkan nomor handphone" required autocomplete="off" value="{{ $data ? $data['nomor_handphone'] : '' }}"> --}}
                                    <input type="text" name="no_hp" id="no_hp" oninput="this.value = this.value.replace(/[^0-9+]/g, '')" maxlength="14" class="form-control" placeholder="Masukkan nomor handphone" required autocomplete="off" value="{{ $data['nomor_handphone'] }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Tahun Berdiri</label>
                                    <input type="date" name="tahun_berdiri" id="tahun_berdiri" class="form-control" value="{{ $data ? $data['tahun_berdiri'] : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Lama Usaha (Tahun)</label>
                                    <input type="text" name="lama_usaha" id="lama_usaha" class="form-control" autocomplete="off" readonly value="{{ $data ? $data['lama_usaha'] : '' }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Bidang Usaha <span class="text-danger">*</span></label>
                                    <select name="bidang_usaha" class="form-control" id="bidang_usaha" required>
                                        @foreach ($bidang_usaha as $loop_bidang_usaha)
                                            <option value="{{ $loop_bidang_usaha }}">{{ str_replace('_', ' ', strtoupper($loop_bidang_usaha)) }}</option>
                                        @endforeach
                                    </select>
                                    @if($data['bidang_usaha'] == 'lainnya')
                                        <input type="text" class="form-control" placeholder="Masukkan bidang usaha lain" id="bidang_usaha_lain" name="bidang_usaha_lain" autocomplete="off" value="{{ $data ? $data['bidang_usaha'] ? $data['bidang_usaha_lain'] : '' : '' }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <label for="">Status Kepemilikan Tempat Usaha <span class="text-danger">*</span></label>
                                <select name="status_kepemilikan" id="status_kepemilikan" class="form-control" required>
                                    <option value="milik_sendiri">Milik Sendiri</option>
                                    <option value="sewa">Sewa</option>
                                    <option value="group">Group</option>
                                </select>
                                @if($data['status_kepemilikan'] == 'lainnya')
                                    <input type="text" class="form-control" autocomplete="off" placeholder="Masukkan nama group" id="nama_group" name="nama_group" value="{{ $data ? $data['status_kepemilikan'] ? $data['nama_group'] : '' : '' }}">
                                @endif
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-3">
                                    <label for="">Jenis Badan Usaha <span class="text-danger">*</span></label>
                                    <select name="badan_usaha" id="badan_usaha" class="form-control">
                                        <option value="pt">PT</option>
                                        <option value="cv">CV</option>
                                        <option value="pd">PD</option>
                                        {{-- <option value="pribadi">Pribadi</option> --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-3">
                                    <label for="">Nama NPWP <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_npwp" id="nama_npwp" class="form-control" autocomplete="off" placeholder="Masukkan nama NPWP" value="{{ $data['nama_npwp'] }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-3">
                                    <label for="">Nomor NPWP <span class="text-danger">*</span></label>
                                    <input type="text" name="nomor_npwp" id="nomor_npwp" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="20" class="form-control" autocomplete="off" placeholder="Masukkan nomor NPWP" value="{{ $data['nomor_npwp'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-3">
                                    <label for="">Apakah ada cabang? <span class="text-danger">*</span></label>
                                    <select name="status_cabang" id="status_cabang" class="form-control" required>
                                        <option value="0">Tidak</option>
                                        <option value="1">Ada</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Foto NPWP <span class="text-danger">*</span></label>
                                    <input type="file" name="foto_npwp" id="foto_npwp" class="form-control" onchange="previewFileNpwp(this);" accept=".jpg, .png, .pdf, .jpeg" autocomplete="off">
                                </div>

                                <div id="preview_npwp" class="@if($data) @if($data['identitas'] != 'npwp') d-none @endif @else d-none @endif">
                                    <img id="preview_foto_npwp" src="{{ $data ? asset('../../uploads/identitas_perusahaan/'.$data['foto_npwp']) : '' }}" alt="Preview" data-action="zoom">
                                </div>

                                {{-- Kota NPWP --}}
                                <div class="form-group mt-3">
                                    <label for="">Kota Sesuai NPWP <span class="text-danger">*</span></label>
                                    <input type="text" name="kota_npwp" id="kota_npwp" class="form-control" placeholder="Masukkan kota" autocomplete="off" value="{{ $data ? $data['kota_npwp'] : '' }}">
                                </div>

                                {{-- Email Faktur Pajak --}}
                                <div class="form-group">
                                    <div class="form-group mt-3">
                                        <label for="">Email Khusus Untuk Faktur Pajak <span class="text-danger">*</span></label>
                                        <input type="email" name="email_faktur" id="email_faktur" class="form-control" autocomplete="off" placeholder="Contoh: faktur@gmail.com" value="{{ $data ? ($data['identitas'] == 'npwp' ? $data['email_khusus_faktur_pajak'] : '') : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-3">
                                    <label for="">NITKU <span class="text-danger">*</span></label>
                                    <input type="text" name="nitku" id="nitku" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="22" class="form-control" placeholder="Masukkan NITKU" readonly autocomplete="off" value="{{ $data ? $data['nitku'] : '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Alamat NPWP <span class="text-danger">*</span></label>
                                    <textarea name="alamat_npwp" id="alamat_npwp" cols="30" rows="5" class="form-control" autocomplete="off" placeholder="Masukkan alamat NPWP">{{ $data ? $data['alamat_npwp'] : '' }}</textarea>
                                </div>
    
                                <div class="form-group mt-3">
                                    <label for="">Status Pengusaha Kena Pajak (PKP) <span class="text-danger">*</span></label>
                                    <select name="status_pkp" id="status_pkp" class="form-control">
                                        <option value="non_pkp">Non PKP</option>
                                        <option value="pkp">PKP</option>
                                    </select>
                                </div>

                                <div class="form-group mt-3 @if($data) @if($data['status_pkp'] !=  'pkp') d-none @endif @else d-none @endif" id="sppkp-section">
                                    <label for="">Foto SPPKP <span class="text-danger">*</span></label>
                                    <input type="file" name="foto_sppkp" id="foto_sppkp" onchange="previewFileSppkp(this);" accept=".jpg, .png, .pdf, .jpeg" class="form-control">

                                    <div id="preview_sppkp">
                                        <img id="preview_foto_sppkp" src="{{ $data ? asset('../../uploads/identitas_perusahaan/'.$data['sppkp']) : '' }}" alt="Preview" data-action="zoom">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                
                            </div>
                        </div> --}}
                    </div>
                </div>
                <hr>
                <div class="section2 mt-4 mb-4">
                    <h4>INFORMASI BANK</h4>
                    <div class="section2-body">
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nomor Rekening <span class="text-danger">*</span></label>
                                    <input type="text" name="nomor_rekening" oninput="this.value = this.value.replace(/\D+/g, '')" id="nomor_rekening" maxlength="15" class="form-control" autocomplete="off" required placeholder="Masukkan nomor rekening" value="{{ $data['informasi_bank']['nomor_rekening'] }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Rekening <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" autocomplete="off" required placeholder="Masukkan nama rekening" value="{{ $data['informasi_bank']['nama_rekening'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Bank <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_bank" id="nama_bank" class="form-control" autocomplete="off" required placeholder="Masukkan nama bank" value="{{ $data['informasi_bank']['nama_bank'] }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Pemilik Rekening <span class="text-danger">*</span></label>
                                    <select name="status_rekening" id="status_rekening" class="form-control" required>
                                        <option value="rekening_perusahaan">Rekening Perusahaan</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                    @if($data['informasi_bank']['status'] == 'lainnya')
                                        <input type="text" class="form-control" id="rekening_lain" name="rekening_lain" placeholder="Masukkan pemilik rekening" autocomplete="off" value="{{ $data ? $data['informasi_bank'] ? $data['informasi_bank']['status'] == 'lainnya' ? $data['informasi_bank']['rekening_lain'] : '' : '' : '' }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="section3 mt-4">
                    <h4>DATA IDENTITAS PENANGGUNG JAWAB</h4>
                    <div class="section3-body">
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Penanggung Jawab <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_penanggung_jawab" id="nama_penanggung_jawab" class="form-control" autocomplete="off" placeholder="Masukkan nama penanggung jawab" value="{{ $data['data_identitas']['nama'] }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Jabatan <span class="text-danger">*</span></label>
                                    <input type="text" name="jabatan" id="jabatan" class="form-control" autocomplete="off" placeholder="Masukkan jabatan" value="{{ $data['data_identitas']['jabatan'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-3">
                                    <label for="">Identitas Penanggung Jawab <span class="text-danger">*</span></label>
                                    <select name="identitas_penanggung_jawab" id="identitas_penanggung_jawab" class="form-control">
                                        <option value=""></option>
                                        <option value="ktp">KTP</option>
                                        <option value="npwp">NPWP</option>
                                    </select>
                                </div>
    
                                <div class="form-group mb-2">
                                    <label for="">Foto <span class="text-danger">*</span></label>
                                    <input type="file" name="foto_penanggung" id="foto_penanggung" onchange="previewFilePenanggung(this);" accept=".jpg, .png, .pdf, .jpeg" class="form-control">
    
                                    <div id="preview_penanggung">
                                        <img id="preview_foto_penanggung" src="{{ asset('../../uploads/penanggung_jawab/'.$data['data_identitas']['foto']) }}" alt="Preview" data-action="zoom">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nomor Handphone <span class="text-danger">*</span></label>
                                    {{-- <input type="text" name="nomor_hp_penanggung_jawab" id="nomor_hp_penanggung_jawab" oninput="this.value = this.value.replace(/\D+/g, '')" class="form-control" autocomplete="off" maxlength="13" placeholder="Masukkan no hp penanggung jawab" value="{{ $data ? ($data['data_identitas'] ? $data['data_identitas']['no_hp'] : '') : '' }}"> --}}
                                    <input type="text" name="nomor_hp_penanggung_jawab" id="nomor_hp_penanggung_jawab" oninput="this.value = this.value.replace(/[^0-9+]/g, '')" class="form-control" autocomplete="off" maxlength="14" placeholder="Masukkan no hp penanggung jawab" value="{{ $data['data_identitas']['no_hp'] }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section4 mt-4">
                    <hr>
                    <h4>TIPE CUSTOMER</h4>
                    <div class="section4-body" >
                        <div class="row mb-2">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-3">
                                    <label for="">Jenis Transaksi <span class="text-danger">*</span></label>
                                    <br>
                                    <input type="radio" name="jenis_transaksi" id="transaksi_cash" value="cash" checked> 
                                    <label for="">Cash</label>
                                    <br>
                                    <input type="radio" name="jenis_transaksi" id="transaksi_credit" value="credit"> 
                                    <label for="">Credit</label>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-3">
                                    <label for="">Tipe Harga <span class="text-danger">*</span></label>
                                    <br>
                                    <input type="radio" name="tipe_harga" id="end_user" value="end_user" checked> 
                                    <label for="">End User</label>
                                    <br>
                                    <input type="radio" name="tipe_harga" id="retail" value="retail"> 
                                    <label for="">Retail</label>
                                </div>
                            </div>
                        </div>
                        {{-- <hr> --}}
                        <div class="row mb-2">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-3">
                                    <label for="">Kategori Customer <span class="text-danger">*</span></label>
                                    <select name="kategori_customer" id="kategori_customer" class="form-control">
                                        <option value="">-- Pilih kategori customer --</option>
                                        @foreach($bidang_usaha as $loop_bidang_usaha)
                                            <option value="{{ $loop_bidang_usaha }}">{{ str_replace('_', ' ', strtoupper($loop_bidang_usaha)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Plafond <span class="text-danger">*</span></label>
                                    <input type="text" name="plafond" id="plafond" oninput="this.value = this.value.replace(/[^0-9+]/g, '')" class="form-control" placeholder="Masukkan plafond" autocomplete="off" value="{{ $data['tipe_customer'] ? $data['tipe_customer']['plafond'] : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-3">
                                    <label for="">Term of Payment <span class="text-danger">*</span></label>
                                    <input type="text" name="payment_term" id="payment_term" class="form-control" placeholder="Masukkan term of payment" autocomplete="off" value="{{ $data['tipe_customer'] ? $data['tipe_customer']['payment_term'] : '' }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-3">
                                    <label for="">Channel Distributor <span class="text-danger">*</span></label>
                                    <select name="channel_distributor" id="channel_distributor" class="form-control">
                                        <option value="">-- Pilih channel distributor --</option>
                                        <option value="allptk">Semua Jalur Pontianak</option>
                                        <option value="alljkt">Semua Jalur Jakarta</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan <span class="text-danger">*</span></label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Masukkan keterangan" autocomplete="off" required value="{{ $data['tipe_customer'] ? $data['tipe_customer']['keterangan'] : '' }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-footer mt-2">
                <div>
                    <button type="button" class="btn waves-effect btn-danger waves-light rounded btn-md rounded" id="back" onclick="kembali()">Back</button>
                </div>
                &nbsp;&nbsp;
                <div>
                    <button type="submit" class="btn waves-effect waves-light btn-primary rounded btn-md rounded submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
    <script>
        function preview_pdf(that) {
            window.open(that,'_blank');
        }

        function kembali() {
            window.location.href = '/internal/panel';
        }

        function previewFileKtp(input) {
            var file = $('#foto_ktp').prop('files');
            if(file){
                var reader = new FileReader();
                $("#preview_ktp").removeClass('d-none');
                reader.onload = function() {
                    $("#preview_foto_ktp").attr("src", reader.result);
                }
                reader.readAsDataURL(file[0]);
            }
        }

        function previewFileNpwp(input) {
            var file = $("#foto_npwp").prop('files');
            if(file){
                var reader = new FileReader();
                $("#preview_npwp").removeClass('d-none');
                reader.onload = function() {
                    $("#preview_foto_npwp").attr("src", reader.result);
                }
                reader.readAsDataURL(file[0]);
            }
        }

        function previewFileSppkp(input) {
            var file = $("#foto_sppkp").prop('files');
            if(file){
                var reader = new FileReader();
                $("#preview_sppkp").removeClass('d-none');
                reader.onload = function() {
                    $("#preview_foto_sppkp").attr("src", reader.result);
                }
                reader.readAsDataURL(file[0]);
            }
        }

        function previewFilePenanggung(input) {
            var file = $("#foto_penanggung").prop('files');
            if(file){
                var reader = new FileReader();
                $("#preview_penanggung").removeClass('d-none');
                reader.onload = function() {
                    $("#preview_foto_penanggung").attr("src", reader.result);
                }
                reader.readAsDataURL(file[0]);
            }
        }

        // Auto format NPWP
        const npwp = document.getElementById('nomor_npwp');
        npwp.oninput = (e) => {
            e.target.value = autoFormatNPWP(e.target.value);
        }
        function autoFormatNPWP(NPWPString) {
            try {
                var cleaned = ("" + NPWPString).replace(/\D/g, "");
                var match = cleaned.match(/(\d{0,2})?(\d{0,3})?(\d{0,3})?(\d{0,1})?(\d{0,3})?(\d{0,3})$/);
                return [      
                        match[1], 
                        match[2] ? ".": "",
                        match[2], 
                        match[3] ? ".": "",
                        match[3],
                        match[4] ? ".": "",
                        match[4],
                        match[5] ? "-": "",
                        match[5],
                        match[6] ? ".": "",
                        match[6]].join("")
                
            } catch(err) {
                return "";
            }
        }

        // Format rupiah
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

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#status_pkp').select2({
                placeholder: 'Pilih status PKP'
            });

            $('#bidang_usaha').select2({
                placeholder: 'Pilih bidang usaha',
            });

            $('#status_kepemilikan').select2({
                placeholder: 'Pilih status kepemilikan',
            });

            $('#status_rekening').select2({
                placeholder: 'Pilih pemilik rekening',
            });

            $('#kategori_customer').select2({
                placeholder: 'Pilih kategori customer',
            });

            $('#channel_distributor').select2({
                placeholder: 'Pilih channel distributor',
            });

            $('#identitas_penanggung_jawab').select2({
                placeholder: 'Pilih identitas penanggung jawab',
            });

            $('#identitas_perusahaan').select2({
                placeholder: 'Pilih identitas perseorangan'
            });

            $('#status_cabang').select2({
                placeholder: 'Apakah ada cabang',
            });

            // Bidang usaha
            $('#bidang_usaha').on('change', function() {
                let val = $(this).val();
                if(val == 'lainnya') {
                    $('#bidang_usaha_lain').removeClass('d-none').prop('required', true);
                } else {
                    $('#bidang_usaha_lain').addClass('d-none').prop('required', false);
                }
            });

            // Status kepemilikan
            $('#status_kepemilikan').on('change', function() {
                let val = $(this).val();
                if(val == 'group') {
                    $('#nama_group').removeClass('d-none').prop('required', true);
                } else {
                    $('#nama_group').addClass('d-none').prop('required', false);
                }
            });

            $('#identitas_penanggung_jawab').select2({
                placeholder: 'Pilih identitas penanggung jawab',
                allowClear: true
            });

            $('#status_rekening').select2({
                placeholder: 'Pilih status rekening',
            });

            $(document).on('change', '#status_rekening', function() {
                let value = $(this).val();
                if(value == 'lainnya') {
                    $('#rekening_lain').removeClass('d-none').prop('required', true);
                    // $('#rekening_lain').prop('required', true);
                    // $('#rekening_lain').select2({
                    //     placeholder: 'Pilih rekening lainnya'
                    // });
                } else {
                    $('#rekening_lain').addClass('d-none').prop('required', false);
                    // $('#rekening_lain').prop('required', false);
                }
            });

            $(document).on('change', '#status_pkp', function() {
                let status = $(this).val();
                if(status == 'pkp') {
                    $('#sppkp-section').removeClass('d-none');
                    $('#preview_sppkp').removeClass('d-none');
                } else {
                    $('#sppkp-section').addClass('d-none');
                    $('#preview_sppkp').addClass('d-none');
                }
            });

            $(document).on('change', '#tahun_berdiri', function() {
                let tgl = new Date();
                let tgl_berdiri = new Date($(this).val());

                let thn_berdiri = tgl_berdiri.getFullYear();
                let thn_sekarang = tgl.getFullYear();
                let result = thn_sekarang - thn_berdiri;
                
                $('#lama_usaha').val(result + ' tahun');
                $('#lama_usaha_hide').val(result);
            });

            $(document).on('change', '#status_cabang', function() {
                let val = $(this).val();
                if(val == '0') {
                    $('#nitku').val('').prop('readonly', true).prop('required', false);
                } else {
                    $('#nitku').prop('readonly', false).prop('required', true);
                }
            });

            // Get data untuk select
            $.ajax({
                url: '/internal/panel/select/' + $('#update_id').val(),
                type: 'GET',
                success: res => {
                    if(res.status == true) {
                        if(res.data.status_cust == 'lama') {
                            $('#cust_lama').prop('checked', true);
                        } else {
                            $('#cust_baru').prop('checked', true);
                        }

                        if(res.data.tipe_customer) {
                            if(res.data.tipe_customer.jenis_transaksi == 'cash') {
                                $('#transaksi_cash').prop('checked', true);
                            } else {
                                $('#transaksi_credit').prop('checked', true);
                            }

                            if(res.data.tipe_customer.tipe_harga == 'end_user') {
                                $('#end_user').prop('checked', true);
                            } else {
                                $('#retail').prop('checked', true);
                            }
                            $('#kategori_customer').val(res.data.tipe_customer.kategori_customer).change();
                            $('#channel_distributor').val(res.data.tipe_customer.channel_distributor).change();
                        }

                        $('#status_cabang').val(res.data.status_cabang).change();
                        $('#bidang_usaha').val(res.data.bidang_usaha).change();
                        $('#status_kepemilikan').val(res.data.status_kepemilikan).change();
                        $('#identitas_perusahaan').val(res.data.identitas).change();
                        $('#status_pkp').val(res.data.status_pkp).change();
                        $('#status_rekening').val(res.data.informasi_bank.status).change();
                        $('#identitas_penanggung_jawab').val(res.data.data_identitas.identitas).change();

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
                        $('#identitas_perusahaan').val('').change();
                        $('#status_pkp').val('').change();
                        $('#status_rekening').val('').change();
                        $('#identitas_penanggung_jawab').val('').change();
                        $('input[name="jenis_transaksi"]').val('cash').prop('checked', true);
                        $('input[name="tipe_harga"]').val('end_user').prop('checked', true);
                        $('#kategori_customer').val('').change();
                        $('#channel_distributor').val('').change();
                        $('#status_cabang').val('0').change();
                    }
                }
            });

            $(document).on('submit', '#form_customer', function(e) {
                e.preventDefault();
                // var data = $sigDiv.jSignature('getData', 'base30');
                // Masukkan ke textarea
                // $('#hasil_ttd').val(data[1]);
                $.ajax({
                    url: '/internal/panel/edit-store',
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: () => {
                        Swal.fire({
                            icon: 'info',
                            title: 'Loading...',
                            text: 'Harap Menunggu',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                        });
                    },
                    success: res => {
                        if(res.status == true) {
                            Swal.fire({
                                title: 'Berhasil!',
                                icon: 'success',
                                html: 'Berhasil!'
                            });
                            window.location.href = '/internal/panel';
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                icon: 'error',
                                html: res.error
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection