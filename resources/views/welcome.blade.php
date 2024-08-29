<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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

            .section1 h4, .section2 h4, .section3 h4, .section4 h4 {
                text-align: center;
            }

            hr {
                border-top: 2px solid #1C4A9C;
                opacity: 1;
            }

            .cancel {
                background-color: #fff;
                color: #1C4A9C;
                border: 1px solid #1C4A9C;
            }

            .submit {
                background-color: #1C4A9C;
                color: #fff;
            }

            .submit:hover {
                color: #fff;
            }

            @media only screen and (max-width: 384px) {
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

                .section4-body .row .col-xl-6:nth-of-type(1) {
                    margin-bottom: 12px;
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
            <input type="hidden" name="lama_usaha_hide" id="lama_usaha_hide">
            <div class="content-body">
                <div class="section1 mb-4">
                    <h4>IDENTITAS PERUSAHAAN</h4>
                    <div class="section1-body">
                        <div class="row mb-2">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Perusahaan <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" placeholder="Masukkan nama perusahaan" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Group Perusahaan <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_group_perusahaan" id="nama_group_perusahaan" class="form-control" placeholder="Masukkan nama group perusahaan" autocomplete="off" required>
                                    <span class="text-danger">*Jika tidak ada, maka diisi dengan nama perusahaan</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Alamat Lengkap <span class="text-danger">*</span></label>
                                    <textarea name="alamat_lengkap" id="alamat_lengkap" cols="30" rows="5" class="form-control" required autocomplete="off" placeholder="Masukkan alamat lengkap perusahaan"></textarea>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-2">
                                    <label for="">Kota / Kabupaten <span class="text-danger">*</span></label>
                                    <input type="text" name="kota_kabupaten" id="kota_kabupaten" class="form-control" placeholder="Masukkan kota / kabupaten" autocomplete="off" required>
                                </div>
                                <div class="form-gorup">
                                    <label for="">Kecamatan <span class="text-danger">*</span></label>
                                    <input type="text" name="kecamatan" id="kecamatan" class="form-control" placeholder="Masukkan kecamatan" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Alamat Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email_perusahaan" id="email_perusahaan" class="form-control" autocomplete="off" required placeholder="Masukkan alamat email">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nomor Handphone <span class="text-danger">*</span></label>
                                    <input type="text" name="no_hp" id="no_hp" max="13" class="form-control" placeholder="Masukkan nomor handphone" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Tahun Berdiri <span class="text-danger">*</span></label>
                                    <input type="date" name="tahun_berdiri" id="tahun_berdiri" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Lama Usaha (Tahun) <span class="text-danger">*</span></label>
                                    <input type="text" name="lama_usaha" id="lama_usaha" class="form-control" autocomplete="off" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Bidang Usaha <span class="text-danger">*</span></label>
                                    <select name="bidang_usaha" class="form-control" id="bidang_usaha" required>
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
                </div>
                <hr>
                <div class="section2 mt-4 mb-4">
                    <h4>DATA IDENTITAS</h4>
                    <div class="section2-body">
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Penanggung Jawab <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_penanggung_jawab" id="nama_penanggung_jawab" class="form-control" autocomplete="off" required placeholder="Masukkan nama penanggung jawab">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Jabatan <span class="text-danger">*</span></label>
                                    <input type="text" name="jabatan" id="jabatan" class="form-control" required autocomplete="off" placeholder="Masukkan jabatan">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Identitas Penanggung Jawab <span class="text-danger">*</span></label>
                                    <select name="identitas_penanggung_jawab" id="identitas_penanggung_jawab" class="form-control" accept=".jpg, .png, .pdf, .jpeg" required>
                                        {{-- <option value="">-- Pilih identitas penanggung jawab --</option> --}}
                                        <option value="ktp">KTP</option>
                                        <option value="npwp">NPWP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group" id="penanggung_ktp">
                                    <label for="">Foto KTP <span class="text-danger">*</span></label>
                                    <input type="file" name="foto_ktp_penanggung" id="foto_ktp_penanggung" accept=".jpg, .png, .pdf, .jpeg" class="form-control">
                                </div>
                                <div class="form-group d-none" id="penanggung_npwp">
                                    <label for="">Foto NPWP <span class="text-danger">*</span></label>
                                    <input type="file" name="foto_npwp_penanggung" id="foto_npwp_penanggung" accept=".jpg, .png, .pdf, .jpeg" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="section3 mt-4 mb-4">
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
                                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" autocomplete="off" placeholder="Masukkan nama lengkap">
                            </div>
                        </div>
                        <div class="ktp-section">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="">Nomor KTP <span class="text-danger">*</span></label>
                                    <input type="text" name="nomor_ktp" id="nomor_ktp" class="form-control" autocomplete="off" placeholder="Masukkan nomor KTP">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="">Foto KTP <span class="text-danger">*</span></label>
                                    <input type="file" name="foto_ktp" id="foto_ktp" class="form-control" accept=".jpg, .png, .pdf, .jpeg" autocomplete="off">
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
                                        <input type="text" name="nomor_npwp" id="nomor_npwp" class="form-control" autocomplete="off" placeholder="Masukkan nomor NPWP">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group mb-2">
                                        <label for="">Nama NPWP <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_npwp" id="nama_npwp" class="form-control" autocomplete="off" placeholder="Masukkan nama NPWP">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group mb-2">
                                        <label for="">Email Khusus Untuk Faktur Pajak <span class="text-danger">*</span></label>
                                        <input type="email" name="email_faktur" id="email_faktur" class="form-control" autocomplete="off" placeholder="Masukkan email faktur">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group mb-2">
                                        <label for="">Foto NPWP <span class="text-danger">*</span></label>
                                        <input type="file" name="foto_npwp" id="foto_npwp" class="form-control" accept=".jpg, .png, .pdf, .jpeg" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group mb-2">
                                        <label for="">Status Pengusaha Kena Pajak (PKP) <span class="text-danger">*</span></label>
                                        <select name="status_pkp" id="status_pkp" class="form-control">
                                            <option value="">-- Pilih status PKP --</option>
                                            <option value="pkp">PKP</option>
                                            <option value="non_pkp">Non PKP</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" id="sppkp-section">
                                    <div class="form-group mb-2">
                                        <label for="">Foto SPPKP <span class="text-danger">*</span></label>
                                        <input type="file" name="foto_sppkp" id="foto_sppkp" accept=".jpg, .png, .pdf, .jpeg" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="section4 mt-4">
                    <h4>INFORMASI BANK</h4>
                    <div class="section4-body">
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nomor Rekening <span class="text-danger">*</span></label>
                                    <input type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" autocomplete="off" required placeholder="Masukkan nomor rekening">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Rekening <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" autocomplete="off" required placeholder="Masukkan nama rekening">
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
                                    <input type="text" name="nama_bank" id="nama_bank" class="form-control" autocomplete="off" required placeholder="Masukkan nama bank">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-footer mt-4">
                <button type="button" class="btn waves-effect waves-light rounded btn-md rounded cancel">Cancel</button>
                &nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn waves-effect waves-light rounded btn-md rounded submit">Submit</button>
            </div>
        </form>

        <script>
            $(document).ready(function() {
                $('#bidang_usaha').select2({
                    placeholder: 'Pilih bidang usaha',
                    allowClear: true
                });

                $('#status_kepemilikan').select2({
                    placeholder: 'Pilih status kepemilikan',
                    allowClear: true
                });

                $('#identitas_penanggung_jawab').select2({
                    placeholder: 'Pilih identitas penanggung jawab',
                    allowClear: true
                });

                $('#identitas_perusahaan').select2({
                    placeholder: 'Pilih identitas',
                    allowClear: true
                });

                $('#status_rekening').select2({
                    placeholder: 'Pilih status rekening',
                    allowClear: true
                });

                $('#status_pkp').select2({
                    placeholder: 'Pilih status PKP',
                    allowClear: true
                });

                $('#badan_usaha').select2({
                    placeholder: 'Pilih badan usaha',
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
                    } else {
                        $('.ktp-section').addClass('d-none');
                        $('.npwp-section').removeClass('d-none');
                    }
                });

                $(document).on('change', '#status_pkp', function() {
                    let status = $(this).val();
                    if(status == 'pkp') {
                        $('#sppkp-section').removeClass('d-none');
                    } else {
                        $('#sppkp-section').addClass('d-none');
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
            })
        </script>
    </body>
</html>
