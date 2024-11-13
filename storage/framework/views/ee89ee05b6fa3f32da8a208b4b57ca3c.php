

<?php $__env->startSection('title'); ?>
<title>Menu | PT Papasari</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>
    body {
        height: 100vh;
        overflow-y: hidden;
    }

    .content {
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    .card {
        width: 30%;
        cursor: pointer;
        transition: 0.5s;
        border: 1px solid #1C4A9C;
    }

    .card:hover {
        background-color: #1C4A9C;
        color: #fff;
        transition: 0.5s;
    }

    @media screen and (max-width: 769px) {
        .content {
            flex-direction: column;
            align-items: center;
        }

        .card {
            margin-top: 3vh;
            width: 80% !important;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container" style="height: 80vh;">
    <div class="head">
        <h3 class="text-center">Pilih Menu</h3>
        <p class="text-center">Silahkan pilih menu dibawah ini untuk pengisian data customer. Bentuk usaha customer:</p>
    </div>
    <div class="content">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center" onclick="form_customer('badan-usaha')">BADAN USAHA</h3>
                
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3 class="text-center" onclick="form_customer('perseorangan')">PERSEORANGAN</h3>
                
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    function form_customer(value) {
        window.location.href = '/'+value;
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WEB APP\Form_Customer\form_customer\resources\views/menu.blade.php ENDPATH**/ ?>