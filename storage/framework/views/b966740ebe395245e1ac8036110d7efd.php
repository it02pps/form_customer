<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo e(asset('images/Vertical PNG 977 x 1188 px.png')); ?>">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <?php echo $__env->yieldContent('title'); ?>

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    
    <link rel="stylesheet" href="<?php echo e(asset('css/zoom.css')); ?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        #loginBtn {
            background-color: #1C4A9C;
            width: 8vw;
            text-align: center;
            color: #fff;
            border-radius: 7px;
            border: 1px solid #1C4A9C;
        }

        #logoutBtn {
            background-color: #dc3545;
            width: 8vw;
            text-align: center;
            color: #fff;
            border-radius: 7px;
            border: 1px solid #dc3545;
        }

        #profilBtn {
            background-color: #1C4A9C;
            width: 8vw;
            text-align: center;
            color: #fff;
            border-radius: 7px;
            border: 1px solid #1C4A9C;
        }

        .labelProfil {
            font-weight: normal;
            text-decoration: none;
        }
    </style>

    <?php echo $__env->yieldContent('css'); ?>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="<?php echo e(url('https://papasari.com')); ?>">
                    <img src="<?php echo e(asset('images/PNG 4125 x 913.png')); ?>" width="180" height="40">
                    
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <?php if(auth()->guard()->guest()): ?>
                            
                                <li class="nav-item">
                                    <a id="loginBtn" class="nav-link" href="<?php echo e(route('login.index')); ?>"><?php echo e(__('Login')); ?></a>
                                </li>
                            
                        <?php else: ?>
                            <li>
                                <a type="button" id="profilBtn" class="nav-link" title="Edit Profil">Profil</a>
                            </li>
                            &nbsp;&nbsp;
                            <li>
                                <a id="logoutBtn" class="dropdown-item nav-link" title="Logout" href="<?php echo e(route('logout')); ?>"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    <?php echo e(__('Logout')); ?>

                                </a>
    
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </li>

                            
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

<?php if(Auth::check()): ?>
<!-- Modal -->
<div class="modal fade" id="modalProfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateProfil" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php
                        $profil = App\Models\User::where('id', Auth::user()->id)->first();
                    ?>
                    <div class="form-group">
                        <input type="radio" name="jenis" value="identitas" checked>
                        <label for="" class="labelProfil">Update Identitas</label>
                        <br>
                        <input type="radio" name="jenis" value="password">
                        <label for="" class="labelProfil">Update Password</label>
                    </div>
                    <input type="hidden" name="id" id="id" value="<?php echo e(Crypt::encryptString($profil->id)); ?>">
                    <div class="section_identitas">
                        <div class="form-group mt-2">
                            <label for="" class="labelProfil">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama" value="<?php echo e($profil->name); ?>" required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="" class="labelProfil">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" value="<?php echo e($profil->username); ?>" required>
                        </div>
                    </div>
                    <div class="section_password d-none">
                        <div class="form-group mt-2">
                            <label for="" class="labelProfil">Password Lama <span class="text-danger">*</span></label>
                            <input type="password" name="password_lama" id="password_lama" placeholder="Masukkan password lama" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="" class="labelProfil">Password Baru <span class="text-danger">*</span></label>
                            <input type="password" name="password_baru" id="password_baru" placeholder="Masukkan password baru" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="" class="labelProfil">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                            <input type="password" name="password_baru_confirmation" id="konfirmasi_password" placeholder="Konfirmasi password" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect waves-light rounded btn-md" title="Batal" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light rounded btn-md" title="Simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

</body>
</html>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo e(asset('js/jSignature.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/modernizr.js')); ?>"></script>
<script src="<?php echo e(asset('js/zoom.js')); ?>"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<?php echo $__env->yieldContent('script'); ?>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.section_password').addClass('d-none');
        $('input[name="jenis"]').on('change', function(e) {
            if(e.target.value == 'identitas') {
                $('.section_identitas').removeClass('d-none');
                $('.section_password').addClass('d-none');
                $('.section_identitas input').prop('required', true);
                $('.section_password input').prop('required', false);
            } else {
                $('.section_identitas').addClass('d-none');
                $('.section_password').removeClass('d-none');
                $('.section_identitas input').prop('required', false);
                $('.section_password input').prop('required', true);
            }
        });

        $('#profilBtn').on('click', function() {
            $('#modalProfil').modal('show');
        });

        $(document).on('submit', '#updateProfil', function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo e(route('home.update_profil')); ?>',
                type: 'POST',
                data: new FormData(this),
                cache: false,
                processData: false,
                contentType: false,
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
                    if(res.status == true) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: res.pesan,
                            icon: 'success'
                        });
                        $('#modalProfil').modal('hide');
                        $('#updateProfil')[0].reset();
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: res.error,
                            icon: 'error'
                        });
                    }
                }
            });
        });
    });
</script>
<?php /**PATH C:\Other\laragon\www\FormCustomer\resources\views/layouts/app.blade.php ENDPATH**/ ?>