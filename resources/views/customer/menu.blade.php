@extends('layouts.main_app')

@section('title')
    <title>Menu | PT. PAPASARI</title>
@endsection

@section('css')
<style>
    body {
        overflow: hidden;
    }
    
    .header img {
        width: 100%;
    }

    .content-menu {
        width: 100%;
    }

    .badan_usaha,
    .perseorangan,
    .cust_baru,
    .cust_lama,
    .pengkininan_data,
    .cabang_baru {
        transition: background-color 0.3s;
    }

    .badan_usaha:hover,
    .perseorangan:hover,
    .cust_baru:hover,
    .cust_lama:hover,
    .pengkininan_data:hover,
    .cabang_baru:hover {
        background-color: #0d6efd20;
    }

    .badan_usaha img, .perseorangan img {
        width: 100px;
    }

    .active1, .active2 {
        background-color: #0d6efd20;
    }

    .cust_baru,
    .cust_lama,
    .pengkininan_data,
    .cabang_baru {
        min-height: 56px;
        cursor: pointer;
    }

    @media (min-width: 768px) {
        .content-menu {
            width: 50% !important;
        }

        .badan_usaha img {
            width: 140px !important;
        }

        .perseorangan img {
            width: 128px !important;
        }

        .header > div img {
            width: 35% !important;
        }

        .cust_baru,
        .cust_lama,
        .pengkininan_data,
        .cabang_baru {
            min-height: 64px !important;
        }
    }
</style>
@endsection

@section('content')
    <div class="px-4 py-3 px-md-5 d-flex flex-column align-items-center justify-content-center position-relative gap-4 min-vh-100">
        <div class="header">
            <img src="{{ asset('images/Profile.svg') }}" style="width: 40px; cursor: pointer; right: 24px !important; top: 16px !important;" class="profile-icon position-absolute" onclick="login()">
            <div class="d-flex flex-column justify-content-center align-items-center gap-4">
                <img src="{{ asset('images/PNG 4125 x 913.png') }}">
                <div class="title text-center lh-base">
                    <h1 class="m-0">Pilih Menu</h1>
                    <p class="m-0">Silahkan pilih menu dibawah ini untuk mengisi data customer.<br> Bentuk Usaha Customer:</p>
                </div>
            </div>
        </div>
        <div class="content-menu row justify-content-center g-4 text-center">
            <div class="col-12 col-md-6">
                <div
                    class="badan_usaha d-flex flex-column align-items-center gap-3 w-100 border rounded px-md-5 py-3"
                    data-bs-toggle="modal"
                    data-bs-target="#modalMenuBadanUsaha"
                    style="cursor: pointer;"
                >
                    <img src="{{ asset('images/enterprise 1.svg') }}">
                    <p class="m-0 fw-normal">Badan Usaha</p>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div
                    class="perseorangan d-flex flex-column align-items-center gap-3 w-100 border rounded px-md-5 py-3"
                    data-bs-toggle="modal"
                    data-bs-target="#modalMenuPerseorangan"
                    style="cursor: pointer;"
                >
                    <img src="{{ asset('images/Single Entity 1.svg') }}">
                    <p class="m-0 fw-normal">Perseorangan</p>
                </div>
            </div>
        </div>
    </div>

    {{-- START: Modal Menu Perseorangan Option --}}
    <div class="modal fade" id="modalMenuPerseorangan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Menu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Apakah sudah pernah bertransaksi di PT Papasari?</h6>
                    <div class="row g-3 pb-4 opsi1Perseorangan text-center">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card active1 cust_baru d-flex align-items-center justify-content-center">
                                <span><i class="fa-solid fa-person-circle-plus"></i> Belum</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card cust_lama d-flex align-items-center justify-content-center">
                                <span><i class="fa-solid fa-rotate-left"></i> Sudah</span>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 pb-4 opsi2Perseorangan text-center">
                        
                    </div>
                    <div class="row g-3 identityPerseorangan">
                            
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="nextPerseorangan">Selanjutnya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END: Modal Menu Perseorangan Option --}}

    {{-- START: Modal Menu Badan Usaha Option --}}
    <div class="modal fade" id="modalMenuBadanUsaha" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Menu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Apakah sudah pernah bertransaksi di PT Papasari?</h6>
                    <div class="row g-3 pb-4 opsi1BadanUsaha text-center">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card active1 cust_baru d-flex align-items-center justify-content-center">
                                <span><i class="fa-solid fa-person-circle-plus"></i> Belum</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card cust_lama d-flex align-items-center justify-content-center">
                                <span><i class="fa-solid fa-rotate-left"></i> Sudah</span>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 pb-4 opsi2BadanUsaha text-center">
                        
                    </div>
                    <div class="row g-3 identityBadanUsaha">
                            
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="nextBadanUsaha">Selanjutnya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END: Modal Menu Badan Usaha Option --}}
@endsection

@section('js')
    <script>
        var statusPerseorangan = 'customer-baru/';
        var statusPerseorangan2 = '';
        var statusBadanUsaha = 'customer-baru/';
        var statusBadanUsaha2 = '';

        // START: Direct login page
        function login() {
            window.location.href = '{{ route("form_customer.login") }}';
        }
        // END: Direct login page

        $(document).ready(function() {
            $('.modal-body .opsi2Perseorangan').children().remove();
            $('.identityPerseorangan').children().remove();
            $('.modal-body .opsi2BadanUsaha').children().remove();
            $('.identityBadanUsaha').children().remove();

            // Modal Perseorangan
            $('.modal-body .opsi1Perseorangan .card').on('click', function() {
                $('.modal-body .opsi2Perseorangan').children().remove();
                $('.identityPerseorangan').children().remove();
                $('.modal-body .opsi2BadanUsaha').children().remove();
                $('.identityBadanUsaha').children().remove();
                $('.modal-body .opsi1Perseorangan .card').removeClass('active1');
                $(this).addClass('active1');

                if($(this).hasClass('cust_baru')) {
                    $('#nik').attr('required', false);
                    $('#nik').val(null);
                    $('.modal-body .opsi2Perseorangan').children().remove().removeClass('pb-4');
                    $('.identityPerseorangan').children().remove().removeClass('pb-4');
                    $('.modal-body .opsi2Perseorangan').empty();
                    statusPerseorangan = 'customer-baru/';
                    statusPerseorangan2 = '';
                } else {
                    $('.modal-body .opsi2Perseorangan').empty();
                    $('#nik').attr('required', true);
                    $('.modal-body .opsi2Perseorangan').append(`
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card active2 pengkininan_data d-flex align-items-center justify-content-center" style="cursor: pointer;">
                                <span><i class="fa-solid fa-rotate-left"></i> Pengkinian Data</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card cabang_baru d-flex align-items-center justify-content-center" style="cursor: pointer;">
                                <span><i class="fa-solid fa-building"></i> Cabang Baru</span>
                            </div>
                        </div>
                    `).addClass('pb-4');
                    $('.identityPerseorangan').empty();
                    $('.identityPerseorangan').append(`
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <label for="">Nomor NIK <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Masukkan nomor NIK" class="form-control" name="nik" id="nik" autocomplete="off" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="16"">
                        </div>
                    `);
                    statusPerseorangan = 'customer-lama/';
                    statusPerseorangan2 = 'pengkinian-data/';
                }
            });

            $(document).on('click', '.opsi2Perseorangan .card', function() {
                $('.modal-body .opsi2Perseorangan .card').removeClass('active2');
                $(this).addClass('active2');
                statusPerseorangan2 = $(this).text().trim() + '/';
                statusPerseorangan2 = statusPerseorangan2.replace(' ', '-').toLowerCase();
            });

            // Modal Badan Usaha
            $('.modal-body .opsi1BadanUsaha .card').on('click', function() {
                $('.modal-body .opsi2Perseorangan').children().remove();
                $('.identityPerseorangan').children().remove();
                $('.modal-body .opsi2BadanUsaha').children().remove();
                $('.identityBadanUsaha').children().remove();
                $('.modal-body .opsi1BadanUsaha .card').removeClass('active1');
                $(this).addClass('active1');

                if($(this).hasClass('cust_baru')) {
                    $('#npwp').attr('required', false);
                    $('#npwp').val(null);
                    $('.modal-body .opsi2BadanUsaha').children().remove().removeClass('pb-4');
                    $('.identityBadanUsaha').children().remove().removeClass('pb-4');
                    $('.modal-body .opsi2BadanUsaha').empty();
                    statusBadanUsaha = 'customer-baru/';
                    statusBadanUsaha2 = '';
                } else {
                    $('.modal-body .opsi2BadanUsaha').empty();
                    $('#npwp').attr('required', true);
                    $('.modal-body .opsi2BadanUsaha').append(`
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card active2 pengkininan_data d-flex align-items-center justify-content-center" style="cursor: pointer;">
                                <span><i class="fa-solid fa-rotate-left"></i> Pengkinian Data</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card cabang_baru d-flex align-items-center justify-content-center" style="cursor: pointer;">
                                <span><i class="fa-solid fa-building"></i> Cabang Baru</span>
                            </div>
                        </div>
                    `).addClass('pb-4');
                    $('.identityBadanUsaha').empty();
                    $('.identityBadanUsaha').append(`
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <label for="">Nomor NPWP <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Masukkan nomor NPWP" class="form-control" name="npwp" id="npwp" autocomplete="off" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="16"">
                        </div>
                    `);
                    statusBadanUsaha = 'customer-lama/';
                    statusBadanUsaha2 = 'pengkinian-data/';
                }
            });

            $(document).on('click', '.opsi2BadanUsaha .card', function() {
                $('.modal-body .opsi2BadanUsaha .card').removeClass('active2');
                $(this).addClass('active2');
                statusBadanUsaha2 = $(this).text().trim() + '/';
                statusBadanUsaha2 = statusBadanUsaha2.replace(' ', '-').toLowerCase();
            });

            // Next Perseorangan
            $(document).on('click', '#nextPerseorangan', function() {
                const nik = $('#nik').val();
                if(statusPerseorangan == 'customer-baru/') {
                    window.location.href = '/form-customer/scan-ktp/perseorangan/' + statusPerseorangan;
                } else {
                    if(nik == null || nik == '') {
                        Swal.fire({
                            title: 'Gagal!',
                            icon: 'warning',
                            text: 'Nomor NIK tidak boleh kosong'
                        });
                    } else {
                        $.ajax({
                            url: '/form-customer/perseorangan/' + statusPerseorangan + statusPerseorangan2 + nik + '/check',
                            type: 'GET',
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
                                Swal.close();
                                if(res.status == true) {
                                    if(res.dataa) {
                                        window.location.href = '/form-customer/scan-ktp/perseorangan/' + statusPerseorangan + statusPerseorangan2 + res.datID;
                                    } else {
                                        Swal.fire({
                                            title: 'Gagal!',
                                            text: res.error,
                                            icon: 'error'
                                        });    
                                    }
                                } else {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: res.error,
                                        icon: 'error'
                                    });
                                }
                            }
                        })
                    }
                }
            });

            // Next Badan Usaha
            $(document).on('click', '#nextBadanUsaha', function() {
                const npwp = $('#npwp').val();
                if(statusBadanUsaha == 'customer-baru/') {
                    window.location.href = '/form-customer/scan-npwp/badan-usaha/' + statusBadanUsaha;
                } else {
                    if(npwp == null || npwp == '') {
                        Swal.fire({
                            title: 'Gagal!',
                            icon: 'warning',
                            text: 'Nomor NPWP tidak boleh kosong'
                        });
                    } else {
                        $.ajax({
                            url: '/form-customer/badan-usaha/' + statusBadanUsaha + statusBadanUsaha2 + npwp + '/check',
                            type: 'GET',
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
                                Swal.close();
                                if(res.status == true) {
                                    if(res.dataa) {
                                        window.location.href = '/form-customer/scan-npwp/badan-usaha/' + statusBadanUsaha + statusBadanUsaha2 + res.datID;
                                    } else {
                                        Swal.fire({
                                            title: 'Gagal!',
                                            text: res.error,
                                            icon: 'error'
                                        });    
                                    }
                                } else {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: res.error,
                                        icon: 'error'
                                    });
                                }
                            }
                        })
                    }
                }
            });
        });
    </script>
@endsection
