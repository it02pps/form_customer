

<?php $__env->startSection('title'); ?>
    <title>Menu | PT. PAPASARI</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>
    body {
        overflow: hidden;
    }

    .container {
        display: flex;
        align-items: center;
        height: 100%;
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

    @media screen and (max-width: 475px) {
        body {
            overflow: hidden;
        }
        
        .container {
            padding: 0;
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
            width: 295px;
            height: 64px;
        }

        .content-header {
            text-align: center;
            padding-bottom: 32px;
        }

        .row {
            gap: 32px;
            flex-wrap: wrap;
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
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 badan_usaha" onclick="form_customer('badan-usaha')">
                            <img src="<?php echo e(asset('../../../images/enterprise 1.svg')); ?>" alt="Logo">
                            <p style="font-weight: 700;">Badan Usaha</p>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 perseorangan" onclick="form_customer('perseorangan')">
                            <img src="<?php echo e(asset('../../../images/Single Entity 1.svg')); ?>" alt="Logo">
                            <p style="font-weight: 700;">Perseorangan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        function form_customer(value) {
            window.location.href = '/form-customer/'+value;
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Other\laragon\www\FormCustomer\resources\views/customer/fix_menu.blade.php ENDPATH**/ ?>