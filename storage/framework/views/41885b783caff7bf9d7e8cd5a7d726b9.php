<?php $__env->startSection('title'); ?>
    <title>Menu | PT. PAPASARI</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>
    body {
        overflow-y: hidden;
    }

    .container .header img {
        width: 35%;
    }

    .page-wrapper {
        max-height: auto;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .option-menu {
        width: 70%;
        gap: 12px;
    }

    .option-menu .badan_usaha, .option-menu .perseorangan {
        display: flex;
        align-items: center;
        flex-direction: column;
        border: 1px solid #D2D0D8;
        border-radius: 8px;
        padding: 32px 0;
        cursor: pointer;
    }

    .profile-icon {
        position: absolute;
        top: 20px;
        right: 20px;
        cursor: pointer;
    }

    .card {
        padding: 16px;
        cursor: pointer;
    }

    .modal-body .opsi1Perseorangan .card.active1,
    .modal-body .opsi1BadanUsaha .card.active1,
    .modal-body .opsi2Perseorangan .card.active2,
    .modal-body .opsi2BadanUsaha .card.active2 {
        border: 2px solid #0063ee;
    }

    .badan_usaha, .perseorangan {
        gap: 8px;
    }

    /* TABLET RESOLUTION */
    @media (min-width: 576px) and (max-width: 991.98px) {
        body {
            overflow-y: auto;
        }

        .container .header img {
            width: 80%;
        }

        .modal-body .opsi1Perseorangan,
        .modal-body .opsi1BadanUsaha,
        .modal-body .opsi2Perseorangan,
        .modal-body .opsi2BadanUsaha {
            gap: 8px !important;
        }
    }

    /* MOBILE RESOLUTION */
    @media (max-width: 575.98px) {
        body {
            overflow-y: auto;
            background-image: none;
        }

        .container-fill-mobile {
            height: 100vh;
            flex: 1;
            display: flex;
            /* flex-direction: column; */
            /* justify-content: space-between; */
            padding: 0 !important;
        }

        .container .header img {
            width: 80%;
        }

        .container > div {
            border-radius: 0 !important;
            box-shadow: none !important;
            padding-left: 2rem !important;
            padding-right: 2rem !important;
        }

        .option-menu {
            width: 100%;
        }

        .modal-body .opsi1Perseorangan,
        .modal-body .opsi1BadanUsaha,
        .modal-body .opsi2Perseorangan,
        .modal-body .opsi2BadanUsaha {
            gap: 8px !important;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-wrapper">
        <div class="container container-fill-mobile py-5">
            <div class="p-5 bg-white rounded-4 shadow text-center position-relative">
                <div class="d-grid gap-5">
                    <div class="header d-grid gap-3">
                        <img src="<?php echo e(asset('../../../images/Profile.svg')); ?>" style="width: 40px;" class="profile-icon" onclick="login()">
                        <img src="<?php echo e(asset('../../../images/PNG 4125 x 913.png')); ?>" class="mx-auto">
                        <div class="title text-center">
                            <h1 class="m-0">Pilih Menu</h1>
                            <p class="m-0">Silahkan pilih menu dibawah ini untuk mengisi data customer.<br> Bentuk Usaha Customer:</p>
                        </div>
                    </div>
                    <div class="content-menu d-flex justify-content-center">
                        <div class="row text-center option-menu justify-content-around">
                            <div class="col-lg-5 col-sm-12 badan_usaha" data-bs-toggle="modal" data-bs-target="#modalMenuBadanUsaha">
                                <img src="<?php echo e(asset('../../../images/enterprise 1.svg')); ?>" width="150">
                                <p style="font-weight: 700;">Badan Usaha</p>
                            </div>
                            <div class="col-lg-5 col-sm-12 perseorangan" data-bs-toggle="modal" data-bs-target="#modalMenuPerseorangan">
                                <img src="<?php echo e(asset('../../../images/Single Entity 1.svg')); ?>" width="135">
                                <p style="font-weight: 700;">Perseorangan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="modalMenuPerseorangan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Menu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Apakah sudah pernah bertransaksi di PT Papasari?</h6>
                    <div class="row gap-0 pb-4 opsi1Perseorangan">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card active1 cust_baru text-center">
                                <span><i class="fa-solid fa-person-circle-plus"></i> Belum</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card cust_lama text-center">
                                <span><i class="fa-solid fa-rotate-left"></i> Sudah</span>
                            </div>
                        </div>
                    </div>
                    <div class="row gap-0 pb-4 opsi2Perseorangan">
                        
                    </div>
                    <div class="row gap-0 identityPerseorangan">
                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="nextPerseorangan">Selanjutnya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    
    <div class="modal fade" id="modalMenuBadanUsaha" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Menu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Apakah sudah pernah bertransaksi di PT Papasari?</h6>
                    <div class="row gap-0 pb-4 opsi1BadanUsaha">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card active1 cust_baru text-center">
                                <span><i class="fa-solid fa-person-circle-plus"></i> Belum</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card cust_lama text-center">
                                <span><i class="fa-solid fa-rotate-left"></i> Sudah</span>
                            </div>
                        </div>
                    </div>
                    <div class="row gap-0 pb-4 opsi2BadanUsaha">
                        
                    </div>
                    <div class="row gap-0 identityBadanUsaha">
                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="nextBadanUsaha">Selanjutnya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        var status = 'customer-baru/';
        var status2 = '';

        // START: Direct login page
        function login() {
            window.location.href = '<?php echo e(route("form_customer.login")); ?>';
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

                if($(this).hasClass('cust_baru')) {
                    $('#nik').attr('required', false);
                    $('#nik').val(null);
                    $('.modal-body .opsi2Perseorangan').children().remove().removeClass('pb-4');
                    $('.identityPerseorangan').children().remove().removeClass('pb-4');
                    $('.modal-body .opsi2Perseorangan').empty();
                    status = 'customer-baru/';
                    status2 = '';
                } else {
                    $('.modal-body .opsi2Perseorangan').empty();
                    $('#nik').attr('required', true);
                    $('.modal-body .opsi2Perseorangan').append(`
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card active2 pengkininan_data text-center">
                                <span><i class="fa-solid fa-rotate-left"></i> Pengkinian Data</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card cabang_baru text-center">
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
                    status = 'customer-lama/';
                    status2 = 'pengkinian-data/';
                }
            });

            $(document).on('click', '.opsi2Perseorangan .card', function() {
                $('.modal-body .opsi2Perseorangan .card').removeClass('active2');
                $(this).addClass('active2');
                status2 = $(this).text().trim() + '/';
                status2 = status2.replace(' ', '-').toLowerCase();
            });

            // Modal Badan Usaha
            $('.modal-body .opsi1BadanUsaha .card').on('click', function() {
                $('.modal-body .opsi2Perseorangan').children().remove();
                $('.identityPerseorangan').children().remove();
                $('.modal-body .opsi2BadanUsaha').children().remove();
                $('.identityBadanUsaha').children().remove();
                $('.modal-body .opsi1BadanUsaha .card').removeClass('active1');

                if($(this).hasClass('cust_baru')) {
                    $('#npwp').attr('required', false);
                    $('#npwp').val(null);
                    $('.modal-body .opsi2BadanUsaha').children().remove().removeClass('pb-4');
                    $('.identityBadanUsaha').children().remove().removeClass('pb-4');
                    $('.modal-body .opsi2BadanUsaha').empty();
                    status = 'customer-baru/';
                    status2 = '';
                } else {
                    $('.modal-body .opsi2BadanUsaha').empty();
                    $('#npwp').attr('required', true);
                    $('.modal-body .opsi2BadanUsaha').append(`
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card active2 pengkininan_data text-center">
                                <span><i class="fa-solid fa-rotate-left"></i> Pengkinian Data</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card cabang_baru text-center">
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
                    status = 'customer-lama/';
                    status2 = 'pengkinian-data/';
                }
            });

            $(document).on('click', '.opsi2BadanUsaha .card', function() {
                $('.modal-body .opsi2BadanUsaha .card').removeClass('active2');
                $(this).addClass('active2');
                status2 = $(this).text().trim() + '/';
                status2 = status2.replace(' ', '-').toLowerCase();
            });

            // Next Perseorangan
            $(document).on('click', '#nextPerseorangan', function() {
                const nik = $('#nik').val();
                if(status == 'customer-baru/') {
                    window.location.href = '/form-customer/perseorangan/' + status;
                } else {
                    if(nik == null || nik == '') {
                        Swal.fire({
                            title: 'Gagal!',
                            icon: 'warning',
                            text: 'Nomor NIK tidak boleh kosong'
                        });
                    } else {
                        $.ajax({
                            url: '/form-customer/perseorangan/' + status + status2 + nik + '/check',
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
                                        window.location.href = '/form-customer/perseorangan/' + status + status2 + res.datID;
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
                if(status == 'customer-baru/') {
                    window.location.href = '/form-customer/badan-usaha/' + status;
                } else {
                    if(npwp == null || npwp == '') {
                        Swal.fire({
                            title: 'Gagal!',
                            icon: 'warning',
                            text: 'Nomor NPWP tidak boleh kosong'
                        });
                    } else {
                        $.ajax({
                            url: '/form-customer/badan-usaha/' + status + status2 + npwp + '/check',
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
                                        window.location.href = '/form-customer/badan-usaha/' + status + status2 + res.datID;
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

            // $(document).on('submit', '#formPerseorangan', function() {
            //     e.preventDefault();
            //     if(status == 'customer-baru/') {
            //         window.location.href = '/form-customer/perseorangan/' + status + status2 + encoded;
            //     } else {
            //         if(nik == null || nik == '') {
            //             Swal.fire({
            //                 title: 'Gagal!',
            //                 icon: 'warning',
            //                 text: 'Nomor NIK / NPWP tidak boleh kosong'
            //             });
            //         } else {
            //             $.ajax({
            //                 url: '/form-customer/perseorangan/' + status + status2,
            //                 type: 'POST',
            //                 data: new FormData(this),
            //                 beforeSend: () => {
            //                     Swal.fire({
            //                         title: 'Loading...',
            //                         text: 'Harap Menunggu',
            //                         icon: 'info',
            //                         showConfirmButton: false,
            //                         allowOutsideClick: false
            //                     });
            //                 },
            //                 success: res => {
            //                     console.log(res);
            //                 }
            //             })
            //         }
            //     }
            // })
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\form_customer\resources\views/customer/menu2.blade.php ENDPATH**/ ?>