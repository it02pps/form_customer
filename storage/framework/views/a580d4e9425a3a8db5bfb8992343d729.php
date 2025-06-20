<?php $__env->startSection('title'); ?>
    <title>Menu | PT. PAPASARI</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>
    body {
        overflow-x: hidden;
    }

    .container {
        padding: 64px 0;
    }
    
    .container-fluid {
        background-color: #fff;
        border-radius: 16px;
        box-shadow: 2px 2px 20px rgba(0, 0, 0, 0.25);
    }

    .content-menu {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 64px;
    }

    .content-menu .content-header .logo {
        padding-bottom: 2rem;
    }

    .content-menu .content-header .logo img {
        width: 347px;
        height: 76px;
    }

    .content-header {
        text-align: center;
        padding-bottom: 32px;
    }

    .row {
        gap: 64px;
        flex-wrap: nowrap;
    }

    .row .badan_usaha, .perseorangan {
        display: flex;
        align-items: center;
        flex-direction: column;
        border: 1px solid #D2D0D8;
        border-radius: 8px;
        padding: 32px 64px;
    }

    .row div img {
        width: 152px;
        height: 152px;
        padding-bottom: 16px;
    }

    p {
        margin: 0;
    }

    .badan_usaha, .perseorangan {
        cursor: pointer;
    }

    .card {
        padding: 16px;
        cursor: pointer;
    }

    .card i {
        padding-right: 6px;
    }

    .card span {
        text-align: center;
    }

    .row {
        display: flex;
    }

    .modal-body .opsi1Perseorangan .card.active1, .opsi1BadanUsaha .card.active1 {
        border: 2px solid #0063ee;
    }

    .modal-body .opsi2Perseorangan .card.active2, .opsi2BadanUsaha .card.active2 {
        border: 2px solid #0063ee;
    }

    .profile {
        cursor: pointer;
    }

    @media screen and (max-width: 475px) {
        body {
            overflow-x: hidden;
            background: #fff;
        }
        
        .container {
            padding: 0;
            height: 100vh;
        }

        .title h1 {
            font-size: 32px;
        }

        .title p {
            font-size: 16px;
        }
        
        .container-fluid {
            background-color: #fff;
            border-radius: 0;
            height: 100vh;
            box-shadow: none;

        }

        .content-menu {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 80px 64px 32px 64px;
        }

        .content-menu .content-header .logo {
            padding-bottom: 1.5rem;
        }

        .content-menu .content-header .logo img {
            width: 256px;
            height: 60px;
        }

        .content-header {
            text-align: center;
            padding-bottom: 16px;
        }

        .row {
            gap: 24px;
            flex-wrap: wrap;
        }

        .row .badan_usaha, .perseorangan {
            display: flex;
            align-items: center;
            flex-direction: column;
            border: 1px solid #D2D0D8;
            border-radius: 8px;
            padding: 24px 40px;
        }

        .row div img {
            height: 100px;
            padding-bottom: 4px;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="container-fluid position-relative">
            <div class="content-menu">
                <div class="content-header">
                    <div class="profile position-absolute top-0 end-0 p-5" onclick="login()">
                        <img src="<?php echo e(asset('../../../images/Profile.svg')); ?>" alt="Profile" width="40">
                    </div>
                    <div class="logo">
                        <img src="<?php echo e(asset('../../../images/PNG 4125 x 913.png')); ?>" alt="Logo">
                    </div>
                    <div class="title">
                        <h1>Pilih Menu</h1>
                        <p>Silahkan pilih menu dibawah ini untuk mengisi data customer.<br>Bentuk usaha customer:</p>
                    </div>
                </div>
                <div class="content-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 badan_usaha" data-bs-toggle="modal" data-bs-target="#modalMenuBadanUsaha">
                            <img src="<?php echo e(asset('../../../images/enterprise 1.svg')); ?>" alt="Logo">
                            <p style="font-weight: 700;">Badan Usaha</p>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 perseorangan" data-bs-toggle="modal" data-bs-target="#modalMenuPerseorangan">
                            <img src="<?php echo e(asset('../../../images/Single Entity 1.svg')); ?>" alt="Logo">
                            <p style="font-weight: 700;">Perseorangan</p>
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
                            <div class="card active1 cust_baru">
                                <span><i class="fa-solid fa-person-circle-plus"></i> Belum</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card cust_lama">
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
                            <div class="card active1 cust_baru">
                                <span><i class="fa-solid fa-person-circle-plus"></i> Belum</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card cust_lama">
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
                $('.modal-body .opsi1Perseorangan .card').removeClass('active1');
                $(this).addClass('active1');

                if($(this).hasClass('cust_baru')) {
                    $('#nik').attr('required', false);
                    $('#nik').val(null);
                    $('#nama_identitas').val(null);
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
                            <div class="card active2 pengkininan_data">
                                <span><i class="fa-solid fa-rotate-left"></i> Pengkinian Data</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card cabang_baru">
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
                $('.modal-body .opsi1BadanUsaha .card').removeClass('active1');
                $(this).addClass('active1');

                if($(this).hasClass('cust_baru')) {
                    $('#npwp').attr('required', false);
                    $('#npwp').val(null);
                    $('#nama_identitas').val(null);
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
                            <div class="card active2 pengkininan_data">
                                <span><i class="fa-solid fa-rotate-left"></i> Pengkinian Data</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card cabang_baru">
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
<?php echo $__env->make('layouts.main_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\form_customer\resources\views/customer/menu.blade.php ENDPATH**/ ?>