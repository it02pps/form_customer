<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Form Customer</title>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        {{-- Bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        {{-- Select2 --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        {{-- Sweetalert2 --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        {{-- Signature --}}
        <!-- jSignature -->
        <script src="{{ asset('js/jSignature.min.js') }}"></script>
        <script src="{{ asset('js/modernizr.js') }}"></script>

        {{-- Zoom --}}
        <link rel="stylesheet" href="{{ asset('css/zoom.css') }}">
        <script src="{{ asset('js/zoom.js') }}"></script>

        <style>
            body {
                padding: 30px 0;
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
                border-radius: 8px;
                width: 10%;
                display: flex;
                justify-content: center;
                margin-left: auto;
                margin-right: 302px;
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
                    border-radius: 8px;
                    width: 10%;
                    display: flex;
                    justify-content: center;
                    margin-left: auto;
                    margin-right: auto;
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
    </head>
    <body class="antialiased">
        <div class="content-header text-center mb-4">
            <h2>FORMULIR DATA CUSTOMER PT PAPASARI</h2>
        </div>

        <form id="form_customer" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="update_id" id="update_id" value="{{ $enkripsi }}">
            <div class="content-body">
                <div class="section1 mb-4">
                    <h4>IDENTITAS PERUSAHAAN</h4>
                    <div class="section1-body">
                        <div class="row mb-2">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Perusahaan <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" placeholder="Masukkan nama perusahaan" autocomplete="off" required value="{{ $response ? $response[0]['nama_perusahaan'] : '' }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Group Perusahaan <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_group_perusahaan" id="nama_group_perusahaan" class="form-control" placeholder="Masukkan nama group perusahaan" autocomplete="off" required value="{{ $response ? $response[0]['nama_group_perusahaan'] : '' }}">
                                    <span class="text-danger">*Jika tidak ada, maka diisi dengan nama perusahaan</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Alamat Lengkap <span class="text-danger">*</span></label>
                                    <textarea name="alamat_lengkap" id="alamat_lengkap" cols="30" rows="5" class="form-control" required autocomplete="off" placeholder="Masukkan alamat lengkap perusahaan">{{ $response ? $response[0]['alamat_lengkap'] : '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-2">
                                    <label for="">Kota / Kabupaten <span class="text-danger">*</span></label>
                                    <input type="text" name="kota_kabupaten" id="kota_kabupaten" class="form-control" placeholder="Masukkan kota / kabupaten" autocomplete="off" required value="{{ $response ? $response[0]['kota_kabupaten'] : '' }}">
                                </div>
                                <div class="form-gorup">
                                    <label for="">Kecamatan <span class="text-danger">*</span></label>
                                    <input type="text" name="kecamatan" id="kecamatan" class="form-control" placeholder="Masukkan kecamatan" autocomplete="off" required value="{{ $response ? $response[0]['kecamatan'] : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Alamat Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email_perusahaan" id="email_perusahaan" class="form-control" autocomplete="off" required placeholder="Masukkan alamat email" value="{{ $response ? $response[0]['alamat_email'] : '' }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nomor Handphone <span class="text-danger">*</span></label>
                                    <input type="text" name="no_hp" id="no_hp" max="13" class="form-control" placeholder="Masukkan nomor handphone" required autocomplete="off" value="{{ $response ? $response[0]['nomor_handphone'] : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Tahun Berdiri <span class="text-danger">*</span></label>
                                    <input type="date" name="tahun_berdiri" id="tahun_berdiri" class="form-control" required value="{{ $response ? $response[0]['tahun_berdiri'] : '' }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Lama Usaha (Tahun) <span class="text-danger">*</span></label>
                                    <input type="text" name="lama_usaha" id="lama_usaha" class="form-control" autocomplete="off" required readonly value="{{ $response ? $response[0]['lama_usaha'] : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Bidang Usaha <span class="text-danger">*</span></label>
                                    <select name="bidang_usaha" class="form-control" id="bidang_usaha" required >
                                        <option value="">-- Pilih bidang usaha --</option>
                                        <option value="b1">Toko Retail</option>
                                        <option value="b2">BUMN</option>
                                        <option value="b3">End User</option>
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
                                <label for="">Identitas Perusahaan <span class="text-danger">*</span></label>
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
                                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" autocomplete="off" placeholder="Masukkan nama lengkap" value="{{ $response ? ($response[0]['identitas'] == 'ktp' ? $response[0]['nama_lengkap'] : '') : '' }}">
                            </div>
                        </div>
                        <div class="ktp-section">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="">Nomor KTP <span class="text-danger">*</span></label>
                                    <input type="text" name="nomor_ktp" id="nomor_ktp" class="form-control" autocomplete="off" placeholder="Masukkan nomor KTP" value="{{ $response ? ($response[0]['identitas'] == 'ktp' ? $response[0]['nomor_ktp'] : '') : '' }}">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="">Foto KTP <span class="text-danger">*</span></label>
                                    <input type="file" name="foto_ktp" id="foto_ktp" class="form-control" onchange="previewFileKtp(this);" accept=".jpg, .png, .pdf, .jpeg" autocomplete="off" {{ $response ? ($response[0]['identitas'] == 'ktp' ? $response[0]['foto_ktp'] : '') : '' }}>

                                    <div id="preview_ktp" class="@if($response) @if($response[0]['identitas'] != 'ktp') d-none @endif @else d-none @endif">
                                        <img id="preview_foto_ktp" src="{{ $response ? asset('uploads/identitas_perusahaan/'.$response[0]['foto_ktp']) : '' }}" alt="Preview" data-action="zoom">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- NPWP section --}}
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 npwp-section d-none">
                            <div class="form-group mb-2">
                                <label for="">Badan Usaha <span class="text-danger">*</span></label>
                                <select name="badan_usaha" id="badan_usaha" class="form-control">
                                    <option value="">-- Pilih bidang usaha --</option>
                                    <option value="pt">PT</option>
                                    <option value="cv">CV</option>
                                    <option value="pd">PD</option>
                                    <option value="pribadi">Pribadi</option>
                                </select>
                            </div>
                        </div>
                        <div class="npwp-section d-none">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group mb-2">
                                        <label for="">Nomor NPWP <span class="text-danger">*</span></label>
                                        <input type="text" name="nomor_npwp" id="nomor_npwp" class="form-control" autocomplete="off" placeholder="Masukkan nomor NPWP" value="{{ $response ? ($response[0]['identitas'] == 'npwp' ? $response[0]['nomor_npwp'] : '' ) : '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group mb-2">
                                        <label for="">Nama NPWP <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_npwp" id="nama_npwp" class="form-control" autocomplete="off" placeholder="Masukkan nama NPWP" value="{{ $response ? ($response[0]['identitas'] == 'npwp' ? $response[0]['nama_npwp'] : '') : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group mb-2">
                                        <label for="">Email Khusus Untuk Faktur Pajak <span class="text-danger">*</span></label>
                                        <input type="email" name="email_faktur" id="email_faktur" class="form-control" autocomplete="off" placeholder="Masukkan email faktur" value="{{ $response ? ($response[0]['identitas'] == 'npwp' ? $response[0]['email_khusus_faktur_pajak'] : '') : '' }}">
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="">Status Pengusaha Kena Pajak (PKP) <span class="text-danger">*</span></label>
                                        <select name="status_pkp" id="status_pkp" class="form-control">
                                            <option value="non_pkp">Non PKP</option>
                                            <option value="pkp">PKP</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-2 @if($response) @if($response[0]['status_pkp'] !=  'pkp') d-none @endif @else d-none @endif" id="sppkp-section">
                                        <label for="">Foto SPPKP <span class="text-danger">*</span></label>
                                        <input type="file" name="foto_sppkp" id="foto_sppkp" onchange="previewFileSppkp(this);" accept=".jpg, .png, .pdf, .jpeg" class="form-control">

                                        <div id="preview_sppkp">
                                            <img id="preview_foto_sppkp" src="{{ $response ? asset('uploads/identitas_perusahaan/'.$response[0]['sppkp']) : '' }}" alt="Preview" data-action="zoom">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group mb-2">
                                        <label for="">Foto NPWP <span class="text-danger">*</span></label>
                                        <input type="file" name="foto_npwp" id="foto_npwp" class="form-control" onchange="previewFileNpwp(this);" accept=".jpg, .png, .pdf, .jpeg" autocomplete="off">
                                    </div>

                                    <div id="preview_npwp" class="@if($response) @if($response[0]['identitas'] != 'npwp') d-none @endif @else d-none @endif">
                                        <img id="preview_foto_npwp" src="{{ $response ? asset('uploads/identitas_perusahaan/'.$response[0]['foto_npwp']) : '' }}" alt="Preview" data-action="zoom">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 d-none" id="sppkp-section">
                                    
                                </div>
                            </div> --}}
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
                                    <input type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" autocomplete="off" required placeholder="Masukkan nomor rekening" value="{{ $response ? $response[1]['nomor_rekening'] : '' }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Rekening <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" autocomplete="off" required placeholder="Masukkan nama rekening" value="{{ $response ? $response[1]['nama_rekening'] : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Status Rekening <span class="text-danger">*</span></label>
                                    <select name="status_rekening" id="status_rekening" class="form-control" required>
                                        <option value="">-- Pilih status rekening --</option>
                                        <option value="rekening_perusahaan">Rekening Perusahaan</option>
                                        <option value="rekening_pribadi">Rekening Pribadi</option>
                                        <option value="rekening_suami">Rekening Suami</option>
                                        <option value="rekening_istri">Rekening Istri</option>
                                        <option value="rekening_anak">Rekening Anak</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Bank <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_bank" id="nama_bank" class="form-control" autocomplete="off" required placeholder="Masukkan nama bank" value="{{ $response ? $response[1]['nama_bank'] : '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="section3 mt-4">
                    <h4>DATA IDENTITAS</h4>
                    <div class="section3-body">
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Penanggung Jawab <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_penanggung_jawab" id="nama_penanggung_jawab" class="form-control" autocomplete="off" required placeholder="Masukkan nama penanggung jawab" value="{{ $response ? $response[2]['nama'] : '' }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Jabatan <span class="text-danger">*</span></label>
                                    <input type="text" name="jabatan" id="jabatan" class="form-control" required autocomplete="off" placeholder="Masukkan jabatan" value="{{ $response ? $response[2]['jabatan'] : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-2">
                                    <label for="">Identitas Penanggung Jawab <span class="text-danger">*</span></label>
                                    <select name="identitas_penanggung_jawab" id="identitas_penanggung_jawab" class="form-control" accept=".jpg, .png, .pdf, .jpeg" required>
                                        {{-- <option value="">-- Pilih identitas penanggung jawab --</option> --}}
                                        <option value="ktp">KTP</option>
                                        <option value="npwp">NPWP</option>
                                    </select>
                                </div>

                                <div class="form-group mb-2" id="penanggung_ktp">
                                    <label for="">Foto KTP <span class="text-danger">*</span></label>
                                    <input type="file" name="foto_ktp_penanggung" id="foto_ktp_penanggung" onchange="previewFileKtpPenanggung(this);" accept=".jpg, .png, .pdf, .jpeg" class="form-control">

                                    <div id="preview_ktp_penanggung" class="@if($response) @if($response[2]['identitas'] != 'ktp') d-none @endif @else d-none @endif">
                                        <img id="preview_foto_ktp_penanggung" src="{{ $response ? asset('uploads/penanggung_jawab/'.$response[2]['foto']) : '' }}" alt="Preview" data-action="zoom">
                                    </div>
                                </div>

                                <div class="form-group @if($response) @if($response[2]['identitas'] != 'npwp') d-none @endif @else d-none @endif" id="penanggung_npwp">
                                    <label for="">Foto NPWP <span class="text-danger">*</span></label>
                                    <input type="file" name="foto_npwp_penanggung" id="foto_npwp_penanggung" onchange="previewFileNpwpPenanggung(this);" accept=".jpg, .png, .pdf, .jpeg" class="form-control">

                                    <div id="preview_npwp_penanggung" class="d-none">
                                        <img id="preview_foto_npwp_penanggung" src="{{ $response ? asset('uploads/penanggung_jawab/'.$response[2]['foto']) : '' }}" alt="Preview" data-action="zoom">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                {{-- Signature --}}
                                <div class="mt-2">
                                    <label for="">Tanda Tangan <span class="text-danger">*</span></label>
                                    <div id="signature"></div>
                                    <input type="button" id="clear_signature" class="btn btn-outline-primary mt-2" value="Bersihkan">
                                    <input type="button" id="preview" class="btn btn-primary mt-2" value="Konfirmasi">
                                    <input type="hidden" name="hasil_ttd" id="hasil_ttd" value="{{ $response ? $response[2]['ttd'] : '' }}">
                                    
                                    {{-- <textarea name="hasil_ttd" id="hasil_ttd"></textarea> --}}

                                    {{-- <img src="" id="sign_prev" style="display: none;"> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-footer mt-4">
                @if($response)
                    <button type="button" class="btn waves-effect btn-outline-primary waves-light rounded btn-md rounded" id="cancel" data-url="{{ $url }}">Cancel</button>
                @endif
                &nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn waves-effect waves-light btn-primary rounded btn-md rounded submit">Submit</button>
            </div>
        </form>

        <script>
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
                    placeholder: 'Pilih status rekening',
                    allowClear: true
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
                    $.ajax({
                        url: '{{ route('form_customer.store') }}',
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

                // Get data untuk select
                var enkripsi = {!! json_encode($enkripsi) !!};
                let url = '{{ route('form_customer.select', ':id') }}';
                url = url.replace(':id', enkripsi);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: res => {
                        $('#status_kepemilikan').val(res.data[0].status_kepemilikan).change();
                        $('#badan_usaha').val(res.data[0].badan_usaha).change();
                        $('#bidang_usaha').val(res.data[0].bidang_usaha).change();
                        $('#identitas').val(res.data[0].identitas).change();
                        $('#status_pkp').val(res.data[0].status_pkp).change();
                        $('#status_rekening').val(res.bank[0]).change();
                    }
                });
            });
        </script>
    </body>
</html>
