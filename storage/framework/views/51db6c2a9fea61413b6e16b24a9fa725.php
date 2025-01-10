

<?php $__env->startSection('title'); ?>
    <title>Menu | PT. PAPASARI</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>
    .container {
        background-color: #fff;
        width: 100%;
        height: 100%;
        border-radius: 16px;
        box-shadow: 2px 2px 20px rgba(0, 0, 0, 0.25);
    }

    .content-menu {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: auto;
        height: 100%;
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

    .content-body {
        display: flex;
        flex-direction: row;
        justify-content: center;
        flex-wrap: wrap;
        width: auto;
        text-align: center;
        gap: 64px;
    }

    .content-body .badan_usaha, .perseorangan {
        border: 1px solid #D2D0D8;
        border-radius: 8px;
        padding: 32px 64px;
    }

    .content-body div img {
        width: 152px;
        height: 152px;
        padding-bottom: 16px;
    }

    p {
        margin: 0;
    }

    .title {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .badan_usaha, .perseorangan {
        cursor: pointer;
    }

    .title p {
        max-width: 75%;
    }

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="content-menu">
            <div class="content-header">
                <div class="logo">
                    <img src="<?php echo e(asset('../../../images/PNG 4125 x 913.png')); ?>" alt="Logo">
                </div>
                <div class="title">
                    <h1>Pilih Menu</h1>
                    <p>Silahkan pilih menu dibawah ini untuk mengisi data customer. Bentuk usaha customer:</p>
                </div>
            </div>
            <div class="content-body">
                <div class="badan_usaha">
                    <img src="<?php echo e(asset('../../../images/enterprise 1.svg')); ?>" alt="Logo">
                    <p style="font-weight: 700;">Badan Usaha</p>
                </div>
                <div class="perseorangan">
                    <img src="<?php echo e(asset('../../../images/Single Entity 1.svg')); ?>" alt="Logo">
                    <p style="font-weight: 700;">Perseorangan</p>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function() {
            $('.badan_usaha').on('click', function() {
                window.location.href = '/fix-form-customer/badan-usaha';
            });

            // $('.perseorangan').on('click', function() {
            //     window.location.href = '';
            // });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Other\laragon\www\FormCustomer\resources\views/customer/fix_menu_duplicate.blade.php ENDPATH**/ ?>