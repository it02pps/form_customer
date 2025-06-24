<?php $__env->startSection('title'); ?>
<title>Login | PT. Papasari</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>
    body {
        overflow: hidden;
    }

    .container {
        height: 100vh;
    }

    .container .header img {
        max-width: 40px;
    }

    .header h6 {
        font-weight: 400;
    }

    .header i {
        color: #C4C4C4;
        cursor: pointer;
    }

    .login-page {
        width: 100%;
        max-width: 55%;
    }

    .form-group {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group input {
        width: auto;
        padding: 16px;
    }

    .content-body {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .content-footer {
        display: flex;
        flex-direction: column;
        gap: 8px;
        align-items: flex-end;
        padding-top: 16px;
    }

    .content-footer button {
        width: 100%;
        background-color: #0063EE;
        color: #fff;
        border: none;
        padding: 16px 0 16px 0;
        border-radius: 5px;
    }

     @media (min-width: 576px) and (max-width: 991.98px) {
        body {
            overflow-y: auto;
            overflow-x: hidden !important;
        }

        .container {
            padding: 0 !important;
        }

        .login-page {
            width: 100%;
            min-width: 100%;
        }

        .form-group {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group input {
            width: auto;
            padding: 16px;
        }

        .content-body {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .content-footer {
            display: flex;
            flex-direction: column;
            gap: 8px;
            align-items: flex-end;
            padding-top: 16px;
        }

        .content-footer button {
            width: 100%;
            background-color: #0063EE;
            color: #fff;
            border: none;
            padding: 16px 0 16px 0;
            border-radius: 5px;
        }
    }

    @media (max-width: 575.98px) {
        body {
            overflow-y: auto;
            overflow-x: hidden !important;
            background-image: none;
        }

        .login-page {
            width: 100%;
            min-width: 380px;
            box-shadow: none !important;
        }

        .form-group {
            width: 100%;
            min-width: 300px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group input {
            width: auto;
            padding: 16px;
        }

        .content-body {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .content-footer {
            display: flex;
            flex-direction: column;
            gap: 8px;
            align-items: flex-end;
            padding-top: 16px;
        }

        .content-footer button {
            width: 100%;
            min-width: 200px;
            background-color: #0063EE;
            color: #fff;
            border: none;
            padding: 16px 0 16px 0;
            border-radius: 5px;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container d-flex justify-content-center align-items-center">
    <div class="login-page p-5 bg-white rounded-4 shadow text-center">
        <div class="d-grid gap-4">
            <div class="header row">
                <div class="col-lg-2 col-sm-2 text-start d-flex align-items-center">
                    <i class="fa-solid fa-arrow-left icon" onclick="kembali()"></i>
                </div>
                <div class="col-lg-10 col-sm-10">
                    <div class="title text-start">
                        <h2>Selamat Datang <img src="<?php echo e(asset('../../../images/hai.png')); ?>"></h2>
                        <h6 style="font-weight: 400;">Silahkan masukkan identitas anda.</h6>
                    </div>
                </div>
            </div>
            <div class="content">
                <form method="POST" action="<?php echo e(route('form_customer.login.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="content-body text-start">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username" required autocomplete="off" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="********" required autocomplete="off">
                        </div>
                    </div>
                    <div class="content-footer">
                        <button type="submit">Masuk</button>
                        <a href="" onclick="lupa_password()" class="text-decoration-none" style="color: #021526;">Lupa Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    function kembali() {
        window.location.href = '/form-customer';
    }
    
    function lupa_password() {
        window.location.href = '/lupa_password';
    }
    
    $(document).ready(function() {

    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\form_customer\resources\views/auth/loginfix.blade.php ENDPATH**/ ?>