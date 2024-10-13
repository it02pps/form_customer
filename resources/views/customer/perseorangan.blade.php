
@extends('layouts.app')

@section('title')
    <title>Form Customer | PT Papasari</title>
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
            justify-content: space-between;
            border-radius: 8px;
            width: 60%;
            margin-left: auto;
            margin-right: auto;
        }

        .section1 h4, .section2 h4, .section3 h4 {
            text-align: center;
        }

        hr {
            border-top: 2px solid #1C4A9C;
            opacity: 1;
        }

        #signature {
            width: 100%;
            height: 200px;
            border: 1px solid #1C4A9C;
            border-radius: 7px;
        }

        #signature canvas {
            height: 198px !important;
            border-radius: 7px;
        }

        #preview_ktp, #preview_npwp, #preview_sppkp, #preview_ktp_penanggung,  #preview_npwp_penanggung {
            border: 1px solid #1C4A9C;
            border-radius: 7px;
            margin-top: 2px;
            height: 180px;
            display: flex;
            align-items: center;
        }

        #preview_ktp img, #preview_npwp img, #preview_sppkp img, #preview_ktp_penanggung img,  #preview_npwp_penanggung img {
            width: 100%;
            height: 180px;
            object-fit: fill;
            border-radius: 7px;
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
                /* position: relative; */
                display: flex;
                justify-content: right;
                border-radius: 8px;
                width: 95%;
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

            #signature {
                width: 100%;
                height: 200px;
                border: 1px solid #1C4A9C;
                border-radius: 7px;
            }

            #signature canvas {
                border-radius: 7px;
                height: 198px !important;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="content-header text-center mb-4">
                <h2>FORMULIR DATA CUSTOMER PT PAPASARI</h2>
            </div>
        
            
            <form id="form_customer" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="update_id" id="update_id" value="{{ $enkripsi }}">
                <input type="hidden" name="bentuk_usaha" id="bentuk_usaha" value="perseorangan">
                <div class="content-body">
                    <div class="alert alert-danger" role="alert">
                        <p style="font-size: 18px; font-weight: bold;" class="text-center mb-0">Silahkan mengisi data terkini, kemudian ditanda tangan</p>
                    </div>
                    <div class="section1 mb-4">
                        <div class="opsi">
                            <div class="form-group mb-4">
                                <label for="">Jenis Transaksi <span class="text-danger">*</span></label>
                                <br>
                                <input type="radio" name="jenis_transaksi" id="cash" value="cash">
                                <label for="">Cash</label>
                                <br>
                                <input type="radio" name="jenis_transaksi" id="credit" value="credit">
                                <label for="">Credit</label>
                            </div>
                        </div>
                        <h4>IDENTITAS PERSEORANGAN</h4>
                        <div class="section1-body">
                            <div class="row mb-2">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Merk Usaha <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" placeholder="Masukkan nama merk usaha" autocomplete="off" required value="{{ $data_perusahaan ? $data_perusahaan['nama_perusahaan'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Group Usaha <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_group_perusahaan" id="nama_group_perusahaan" class="form-control" placeholder="Masukkan nama group usaha" autocomplete="off" required value="{{ $data_perusahaan ? $data_perusahaan['nama_group_perusahaan'] : '' }}">
                                        <span class="text-danger">*Jika tidak ada, maka diisi dengan nama merk usaha</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Alamat Lengkap <span class="text-danger">*</span></label>
                                        <textarea name="alamat_lengkap" id="alamat_lengkap" cols="30" rows="5" class="form-control" required autocomplete="off" placeholder="Masukkan alamat lengkap perusahaan">{{ $data_perusahaan ? $data_perusahaan['alamat_lengkap'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group mb-2">
                                        <label for="">Kota / Kabupaten <span class="text-danger">*</span></label>
                                        <input type="text" name="kota_kabupaten" id="kota_kabupaten" class="form-control" placeholder="Masukkan kota / kabupaten" autocomplete="off" required value="{{ $data_perusahaan ? $data_perusahaan['kota_kabupaten'] : '' }}">
                                    </div>
                                    <div class="form-gorup">
                                        <label for="">Kecamatan <span class="text-danger">*</span></label>
                                        <input type="text" name="kecamatan" id="kecamatan" class="form-control" placeholder="Masukkan kecamatan" autocomplete="off" required value="{{ $data_perusahaan ? $data_perusahaan['kecamatan'] : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Alamat Email Koresponden<span class="text-danger">*</span></label>
                                        <input type="email" name="email_perusahaan" id="email_perusahaan" class="form-control" autocomplete="off" required placeholder="Masukkan alamat email" value="{{ $data_perusahaan ? $data_perusahaan['alamat_email'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nomor Handphone Contact Person <span class="text-danger">*</span></label>
                                        <input type="text" name="no_hp" id="no_hp" max="13" class="form-control" placeholder="Masukkan nomor handphone" required autocomplete="off" value="{{ $data_perusahaan ? $data_perusahaan['nomor_handphone'] : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Tahun Berdiri</label>
                                        <input type="date" name="tahun_berdiri" id="tahun_berdiri" class="form-control" value="{{ $data_perusahaan ? $data_perusahaan['tahun_berdiri'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Lama Usaha (Tahun)</label>
                                        <input type="text" name="lama_usaha" id="lama_usaha" class="form-control" autocomplete="off" readonly value="{{ $data_perusahaan ? $data_perusahaan['lama_usaha'] : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Bidang Usaha <span class="text-danger">*</span></label>
                                        <select name="bidang_usaha" class="form-control" id="bidang_usaha" required>
                                            <option value="">-- Pilih bidang usaha --</option>
                                            @foreach ($bidang_usaha as $loop_bidang_usaha)
                                                <option value="{{ $loop_bidang_usaha }}">{{ str_replace('_', ' ', strtoupper($loop_bidang_usaha)) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="">Status Kepemilikan Tempat Usaha <span class="text-danger">*</span></label>
                                    <select name="status_kepemilikan" id="status_kepemilikan" class="form-control" required>
                                        <option value="">-- Pilih status kepemilikan --</option>
                                        <option value="milik_sendiri">Milik Sendiri</option>
                                        <option value="sewa">Sewa</option>
                                        <option value="group">Group</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-2">
                                    <label for="">Identitas Perseorangan <span class="text-danger">*</span></label>
                                    <select name="identitas_perusahaan" id="identitas_perusahaan" class="form-control" required>
                                        <option value="ktp">KTP</option>
                                        <option value="npwp">NPWP</option>
                                    </select>
                                </div>
                            </div>
        
                            {{-- KTP section --}}
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ktp-section">
                                <div class="form-group mb-2">
                                    <label for="">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" autocomplete="off" placeholder="Masukkan nama lengkap" value="{{ $data_perusahaan ? ($data_perusahaan['identitas'] == 'ktp' ? $data_perusahaan['nama_lengkap'] : '') : '' }}">
                                </div>
                            </div>
                            <div class="ktp-section">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <label for="">Nomor KTP <span class="text-danger">*</span></label>
                                        <input type="text" name="nomor_ktp" id="nomor_ktp" class="form-control" autocomplete="off" placeholder="Masukkan nomor KTP" value="{{ $data_perusahaan ? ($data_perusahaan['identitas'] == 'ktp' ? $data_perusahaan['nomor_ktp'] : '') : '' }}">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <label for="">Foto KTP <span class="text-danger">*</span></label>
                                        <input type="file" name="foto_ktp" id="foto_ktp" class="form-control" onchange="previewFileKtp(this);" accept=".jpg, .png, .pdf, .jpeg" autocomplete="off" {{ $data_perusahaan ? ($data_perusahaan['identitas'] == 'ktp' ? $data_perusahaan['foto_ktp'] : '') : '' }}>
        
                                        <div id="preview_ktp" class="@if($data_perusahaan) @if($data_perusahaan['identitas'] != 'ktp') d-none @endif @else d-none @endif">
                                            <img id="preview_foto_ktp" src="{{ $data_perusahaan ? asset('uploads/identitas_perusahaan/'.$data_perusahaan['foto_ktp']) : '' }}" alt="Preview" data-action="zoom">
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            {{-- NPWP section --}}
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 npwp-section d-none">
                                <div class="form-group mb-3">
                                    <label for="">Badan Usaha <span class="text-danger">*</span></label>
                                    <select name="badan_usaha" id="badan_usaha" class="form-control">
                                        <option value="">-- Pilih bidang usaha --</option>
                                        <option value="pt">PT</option>
                                        <option value="cv">CV</option>
                                        <option value="pd">PD</option>
                                        {{-- <option value="pribadi">Pribadi</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="npwp-section d-none">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group mb-3">
                                            <label for="">Nama NPWP <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_npwp" id="nama_npwp" class="form-control" autocomplete="off" placeholder="Masukkan nama NPWP" value="{{ $data_perusahaan ? ($data_perusahaan['identitas'] == 'npwp' ? $data_perusahaan['nama_npwp'] : '') : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group mb-3">
                                            <label for="">Nomor NPWP <span class="text-danger">*</span></label>
                                            <input type="text" name="nomor_npwp" id="nomor_npwp" class="form-control" autocomplete="off" placeholder="Masukkan nomor NPWP" value="{{ $data_perusahaan ? ($data_perusahaan['identitas'] == 'npwp' ? $data_perusahaan['nomor_npwp'] : '' ) : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group mt-3">
                                            <label for="">Alamat NPWP <span class="text-danger">*</span></label>
                                            <textarea name="alamat_npwp" id="alamat_npwp" cols="30" rows="5" class="form-control" autocomplete="off" placeholder="Masukkan alamat NPWP">{{ $data_perusahaan ? $data_perusahaan['alamat_npwp'] : '' }}</textarea>
                                        </div>

                                        <div class="form-group mb-3 mt-3">
                                            <label for="">Kota sesuai NPWP <span class="text-danger">*</span></label>
                                            <input type="text" name="kota_npwp" id="kota_npwp" class="form-control" placeholder="Masukkan kota" autocomplete="off" value="{{ $data_perusahaan ? $data_perusahaan['kota_npwp'] : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="">Foto NPWP <span class="text-danger">*</span></label>
                                            <input type="file" name="foto_npwp" id="foto_npwp" class="form-control" onchange="previewFileNpwp(this);" accept=".jpg, .png, .pdf, .jpeg" autocomplete="off">
                                        </div>
        
                                        <div id="preview_npwp" class="@if($data_perusahaan) @if($data_perusahaan['identitas'] != 'npwp') d-none @endif @else d-none @endif">
                                            <img id="preview_foto_npwp" src="{{ $data_perusahaan ? asset('uploads/identitas_perusahaan/'.$data_perusahaan['foto_npwp']) : '' }}" alt="Preview" data-action="zoom">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group mb-3">
                                            <label for="">Email Khusus Untuk Faktur Pajak <span class="text-danger">*</span></label>
                                            <input type="email" name="email_faktur" id="email_faktur" class="form-control" autocomplete="off" placeholder="Masukkan email faktur" value="{{ $data_perusahaan ? ($data_perusahaan['identitas'] == 'npwp' ? $data_perusahaan['email_khusus_faktur_pajak'] : '') : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group mb-3">
                                            <label for="">Status Pengusaha Kena Pajak (PKP) <span class="text-danger">*</span></label>
                                            <select name="status_pkp" id="status_pkp" class="form-control">
                                                <option value="non_pkp">Non PKP</option>
                                                <option value="pkp">PKP</option>
                                            </select>
                                        </div>

                                        <div class="form-group mt-3 @if($data_perusahaan) @if($data_perusahaan['status_pkp'] !=  'pkp') d-none @endif @else d-none @endif" id="sppkp-section">
                                            <label for="">Foto SPPKP <span class="text-danger">*</span></label>
                                            <input type="file" name="foto_sppkp" id="foto_sppkp" onchange="previewFileSppkp(this);" accept=".jpg, .png, .pdf, .jpeg" class="form-control">
        
                                            <div id="preview_sppkp">
                                                <img id="preview_foto_sppkp" src="{{ $data_perusahaan ? asset('uploads/identitas_perusahaan/'.$data_perusahaan['sppkp']) : '' }}" alt="Preview" data-action="zoom">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                        <input type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" autocomplete="off" required placeholder="Masukkan nomor rekening" value="{{ $data_perusahaan ? $data_perusahaan['informasi_bank']['nomor_rekening'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Rekening <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" autocomplete="off" required placeholder="Masukkan nama rekening" value="{{ $data_perusahaan ? $data_perusahaan['informasi_bank']['nama_rekening'] : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Bank <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_bank" id="nama_bank" class="form-control" autocomplete="off" required placeholder="Masukkan nama bank" value="{{ $data_perusahaan ? $data_perusahaan['informasi_bank']['nama_bank'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Status Rekening <span class="text-danger">*</span></label>
                                        <select name="status_rekening" id="status_rekening" class="form-control" required>
                                            <option value="rekening_perusahaan">Rekening Perusahaan</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 d-none" id="div_rekening_lainnya">
                                {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"> --}}
                                    <div class="form-group">
                                        <label for="">Lainnya <span class="text-danger">*</span></label>
                                        <select name="rekening_lain" id="rekening_lain" class="form-control" required>
                                            <option value="rekening_suami_istri">Rekening Suami / Istri</option>
                                            <option value="rekening_anak_saudara">Rekening Anak / Saudara</option>
                                            <option value="rekening_karyawan">Rekening Karyawan</option>
                                        </select>
                                    </div>
                                {{-- </div> --}}
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
                                        <label for="">Nama Penanggung Jawab</label>
                                        <input type="text" name="nama_penanggung_jawab" id="nama_penanggung_jawab" class="form-control" autocomplete="off" placeholder="Masukkan nama penanggung jawab" value="{{ $data_perusahaan ? $data_perusahaan['data_identitas']['nama'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Jabatan</label>
                                        <input type="text" name="jabatan" id="jabatan" class="form-control" autocomplete="off" placeholder="Masukkan jabatan" value="{{ $data_perusahaan ? $data_perusahaan['data_identitas']['jabatan'] : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group mb-3">
                                        <label for="">Identitas Penanggung Jawab</label>
                                        <select name="identitas_penanggung_jawab" id="identitas_penanggung_jawab" class="form-control" accept=".jpg, .png, .pdf, .jpeg">
                                            <option value="">-- Pilih identitas penanggung jawab --</option>
                                            <option value="ktp">KTP</option>
                                            <option value="npwp">NPWP</option>
                                        </select>
                                    </div>
        
                                    <div class="form-group mb-2" id="penanggung_ktp">
                                        <label for="">Foto KTP</label>
                                        <input type="file" name="foto_ktp_penanggung" id="foto_ktp_penanggung" onchange="previewFileKtpPenanggung(this);" accept=".jpg, .png, .pdf, .jpeg" class="form-control">
        
                                        <div id="preview_ktp_penanggung" class="@if($data_perusahaan) @if($data_perusahaan['data_identitas']['identitas'] != 'ktp') d-none @endif @else d-none @endif">
                                            <img id="preview_foto_ktp_penanggung" src="{{ $data_perusahaan ? asset('uploads/penanggung_jawab/'.$data_perusahaan['data_identitas']['foto']) : '' }}" alt="Preview" data-action="zoom">
                                        </div>
                                    </div>
        
                                    <div class="form-group @if($data_perusahaan) @if($data_perusahaan['data_identitas']['identitas'] != 'npwp') d-none @endif @else d-none @endif" id="penanggung_npwp">
                                        <label for="">Foto NPWP</label>
                                        <input type="file" name="foto_npwp_penanggung" id="foto_npwp_penanggung" onchange="previewFileNpwpPenanggung(this);" accept=".jpg, .png, .pdf, .jpeg" class="form-control">
        
                                        <div id="preview_npwp_penanggung" class="d-none">
                                            <img id="preview_foto_npwp_penanggung" src="{{ $data_perusahaan ? asset('uploads/penanggung_jawab/'.$data_perusahaan['data_identitas']['foto']) : '' }}" alt="Preview" data-action="zoom">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nomor Handphone</label>
                                        <input type="text" name="nomor_hp_penanggung_jawab" id="nomor_hp_penanggung_jawab" class="form-control" placeholder="Masukkan no hp penanggung jawab" autocomplete="off" required>
                                    </div>
                                    {{-- Signature --}}
                                    <div class="mt-2">
                                        <label for="">Tanda Tangan</label>
                                        <div id="signature"></div>
                                        <input type="button" id="clear_signature" class="btn btn-outline-primary mt-2" value="Bersihkan">
                                        {{-- <input type="button" id="preview" class="btn btn-primary mt-2" value="Konfirmasi"> --}}
                                        <input type="hidden" name="hasil_ttd" id="hasil_ttd" value="{{ $data_perusahaan ? $data_perusahaan['data_identitas']['ttd'] : '' }}">
                                        
                                        {{-- <textarea name="hasil_ttd" id="hasil_ttd"></textarea> --}}
        
                                        {{-- <img src="" id="sign_prev" style="display: none;"> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-footer mt-2">
                    <div>
                        @if(!$data_perusahaan)
                            <button type="button" class="btn waves-effect btn-danger waves-light rounded btn-md rounded" id="back" onclick="kembali()">Back</button>
                        @endif
                    </div>
                    <div>
                        @if($data_perusahaan)
                            <button type="button" class="btn waves-effect btn-outline-danger waves-light rounded btn-md rounded" id="cancel" data-url="{{ $url }}">Cancel</button>
                        @endif
                        <button type="submit" class="btn waves-effect waves-light btn-primary rounded btn-md rounded submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function kembali() {
            window.location.href = '/form-customer';
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

        function previewFileKtpPenanggung(input) {
            var file = $("#foto_ktp_penanggung").prop('files');
            if(file){
                var reader = new FileReader();
                $("#preview_ktp_penanggung").removeClass('d-none');
                reader.onload = function() {
                    $("#preview_foto_ktp_penanggung").attr("src", reader.result);
                }
                reader.readAsDataURL(file[0]);
            }
        }

        function previewFileNpwpPenanggung(input) {
            var file = $("#foto_npwp_penanggung").prop('files');
            if(file){
                var reader = new FileReader();
                $("#preview_npwp_penanggung").removeClass('d-none');
                reader.onload = function() {
                    $("#foto_npwp_penanggung").attr("src", reader.result);
                }
                reader.readAsDataURL(file[0]);
            }
        }
        
        $(document).ready(function() {
            // Signature
            var $sigDiv = $('#signature').jSignature({'undoButton': true});
            var data = $sigDiv.jSignature('getData', 'image');

            $('#preview').on('click', function() {
                var data = $sigDiv.jSignature('getData', 'image');

                // Masukkan ke textarea
                $('#hasil_ttd').val(data);

                // $('#sign_prev').attr('src', "data:" + data);
                // $('#sign_prev').show();
            });

            $('#clear_signature').on('click', function() {
                $sigDiv.jSignature('reset');
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#bidang_usaha').select2({
                placeholder: 'Pilih bidang usaha',
                allowClear: true
            });

            $('#status_kepemilikan').select2({
                placeholder: 'Pilih status kepemilikan',
                allowClear: true
            });

            $('#identitas_penanggung_jawab').select2({
                placeholder: 'Pilih identitas penanggung jawab'
            });

            $('#identitas_perusahaan').select2({
                placeholder: 'Pilih identitas'
            });

            $('#status_rekening').select2({
                placeholder: 'Pilih status rekening'
            });

            $(document).on('change', '#status_rekening', function() {
                let value = $(this).val();
                if(value == 'lainnya') {
                    $('#div_rekening_lainnya').removeClass('d-none');
                    $('#rekening_lain').select2({
                        placeholder: 'Pilih rekening lainnya'
                    });
                } else {
                    $('#div_rekening_lainnya').addClass('d-none');
                }
            });

            $(document).on('change', '#identitas_penanggung_jawab', function() {
                let identitas = $(this).val();
                if(identitas == 'ktp') {
                    $('#penanggung_ktp').removeClass('d-none');
                    $('#penanggung_npwp').addClass('d-none');
                } else {
                    $('#penanggung_ktp').addClass('d-none');
                    $('#penanggung_npwp').removeClass('d-none');
                }
            });

            $(document).on('change', '#identitas_perusahaan', function() {
                let identitas = $(this).val();
                if(identitas == 'ktp') {
                    $('.ktp-section').removeClass('d-none');
                    $('.npwp-section').addClass('d-none');
                    $("#preview_ktp").removeClass('d-none');
                    $("#preview_npwp").addClass('d-none');
                    $("#preview_sppkp").addClass('d-none');

                    $('#badan_usaha').val('').change();
                    $('#nomor_npwp').val('');
                    $('#nama_npwp').val('');
                    $('#alamat_npwp').val('');
                    $('#email_faktur').val('');
                    $('#status_pkp').val('non_pkp').change();
                    // $('#foto_sppkp').val('');
                    // $('#foto_npwp').val('');
                    $('#alamat_npwp').val('');
                    $('#kota_npwp').val('');
                } else {
                    $('.ktp-section').addClass('d-none');
                    $('.npwp-section').removeClass('d-none');
                    $("#preview_ktp").addClass('d-none');
                    $("#preview_npwp").removeClass('d-none');
                    $("#preview_sppkp").removeClass('d-none');
                    $('#badan_usaha').select2({
                        placeholder: 'Pilih badan usaha',
                        allowClear: true
                    });

                    $('#status_pkp').select2({
                        placeholder: 'Pilih status PKP',
                        allowClear: true
                    });

                    $('#nomor_ktp').val('');
                    // $('#foto_ktp').val('');
                    $('#nama_lengkap').val('');
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

            $(document).on('submit', '#form_customer', function(e) {
                e.preventDefault();
                var data = $sigDiv.jSignature('getData', 'image');

                // Masukkan ke textarea
                $('#hasil_ttd').val(data);
                const bentuk_usaha = $('#bentuk_usaha').val();
                $.ajax({
                    url: '/form-customer/'+bentuk_usaha+'/store',
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
                            window.location.href = res.link;
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

            $(document).on('click', '#cancel', function() {
                let url = $(this).data('url');
                window.location.href = url;
            });

            // Get data untuk select
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
                        $('#identitas_penanggung_jawab').val(res.data.data_identitas.identitas).change();
                    } else {
                        $('#status_kepemilikan').val('').change();
                        $('#badan_usaha').val('').change();
                        $('#bidang_usaha').val('').change();
                        $('#identitas_perusahaan').val('ktp').change();
                        $('#status_pkp').val('non_pkp').change();
                        $('#status_rekening').val('').change();
                        $('#identitas_penanggung_jawab').val('ktp').change();
                    }
                }
            });

            $('input[name="jenis_transaksi"]').change(function() {
                let rad_val = $(this).val();
                if(rad_val == 'cash') {
                    $('#nama_penanggung_jawab').prop('required', false);
                    $('#jabatan').prop('required', false);
                    $('#identitas_penanggung_jawab').prop('required', false);
                    $('#nomor_hp_penanggung_jawab').prop('required', false);
                    $('.section3-body .row label').find('span').remove();
                } else {
                    $('#nama_penanggung_jawab').prop('required', true);
                    $('#jabatan').prop('required', true);
                    $('#identitas_penanggung_jawab').prop('required', true);
                    $('#nomor_hp_penanggung_jawab').prop('required', true);
                    $('.section3-body .row').find('label').append(' <span class="text-danger">*</span>');
                }
            });
        });
    </script>
@endsection
