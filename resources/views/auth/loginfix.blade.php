@extends('layouts.main_app')

@section('title')
<title>Login | PT. Papasari</title>
@endsection

@section('css')
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
@endsection

@section('content')
@if($errors->has('error'))
    <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>
        <div>
            {{ $errors->first('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
<div class="container d-flex justify-content-center align-items-center">
    <div class="login-page p-5 bg-white rounded-4 shadow text-center">
        <div class="d-grid gap-4">
            <div class="header row">
                <div class="col-lg-2 col-sm-2 text-start d-flex align-items-center">
                    <i class="fa-solid fa-arrow-left icon" onclick="kembali()"></i>
                </div>
                <div class="col-lg-10 col-sm-10">
                    <div class="title text-start">
                        <h2>Selamat Datang <img src="{{ asset('../../../images/hai.png') }}"></h2>
                        <h6 style="font-weight: 400;">Silahkan masukkan identitas anda.</h6>
                    </div>
                </div>
            </div>
            <div class="content">
                <form method="POST" action="{{ route('form_customer.login.store') }}">
                    @csrf
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
                        {{-- <a href="" onclick="lupa_password()" class="text-decoration-none" style="color: #021526;">Lupa Password?</a> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function kembali() {
        window.location.href = '/form-customer';
    }
    
    function lupa_password() {
        window.location.href = '/lupa_password';
    }
</script>
@endsection