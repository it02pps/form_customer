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

    .card.active {
        border: 2px solid #0063ee;
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
        <div class="container-fluid">
            <div class="content-menu">
                <div class="content-header">
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
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 badan_usaha" onclick="badan_usaha('badan_usaha')">
                            <img src="<?php echo e(asset('../../../images/enterprise 1.svg')); ?>" alt="Logo">
                            <p style="font-weight: 700;">Badan Usaha</p>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 perseorangan" data-bs-toggle="modal" data-bs-target="#modalMenu">
                            <img src="<?php echo e(asset('../../../images/Single Entity 1.svg')); ?>" alt="Logo">
                            <p style="font-weight: 700;">Perseorangan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="modalMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Menu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row gap-0 pb-4">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="card active cust_baru">
                                <span><i class="fa-solid fa-person-circle-plus"></i> Customer Baru</span>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="card">
                                <span><i class="fa-solid fa-rotate-left"></i> Customer Lama</span>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="card">
                                <span><i class="fa-solid fa-building"></i> Usaha Baru</span>
                            </div>
                        </div>
                    </div>

                    <div class="row gap-0">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <label for="">NIK <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Masukkan NIK" class="form-control" name="nik" id="nik" autocomplete="off" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="16" onkeyup="checkNIK()" readonly>
                            <span class="nik_check_message"></span>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <label for="">Nama Identitas <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Masukkan Nama Identitas" class="form-control" autocomplete="off" name="nama_identitas" id="nama_identitas" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="next">Selanjutnya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        function checkNIK() {
            const nik = document.getElementById('nik').value;

            fetch("/check-nik", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                body: JSON.stringify({ nik: nik })
            })
            .then(response => response.json())
            .then(res => {
                let message1 = document.getElementsByClassName('nik_check_message')[0];
                if(res.status == true) {
                    message1.innerHTML = '*NIK ditemukan';
                    message1.style.color = 'green';
                } else {
                    message1.innerHTML = '*NIK tidak ditemukan';
                    message1.style.color = 'red';
                }
            });
        }

        function badan_usaha(value) {
            window.location.href = '/form-customer/'+value;
        }

        $(document).ready(function() {
            $('.modal-body .card').on('click', function() {
                $('.modal-body .card').removeClass('active');
                $(this).addClass('active');

                if($(this).hasClass('cust_baru')) {
                    $('#nik').attr('required', false).prop('readonly', true);
                    $('#nama_identitas').attr('required', false).prop('readonly', true);
                    $('#nik').val(null);
                    $('#nama_identitas').val(null);
                    $('.nik_check_message').html('');
                } else {
                    $('#nik').attr('required', true).prop('readonly', false);
                    $('#nama_identitas').attr('required', true).prop('readonly', false);
                }
            });

            $(document).on('click', '#next', function() {
                const nik = $('#nik').val();
                const menu = 'perseorangan';
                const encoded = btoa(nik);

                window.location.href = '/form-customer/' + menu + '/' + encoded;
            })
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\form_customer\resources\views/customer/fix_menu.blade.php ENDPATH**/ ?>