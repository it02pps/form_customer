@extends('layouts.main_app')

@section('title')
<title>Login | PT. Papasari</title>
@endsection

@section('css')
<style>
.container {
    display: flex;
    background-color: #fff;
    width: auto;
    height: auto;
    border-radius: 16px;
    box-shadow: 2px 2px 20px rgba(0, 0, 0, 0.25);
    align-items: center;
    padding: 0;
}

.content {
    display: flex;
    flex-direction: row;
    justify-content: center;
    width: 50%;
    height: 100%;
    padding: 64px;
}

.content .content-left {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 32px;
}

.content .content-left img {
    height: 40px;
}

.content .content-left i {
    color: #C4C4C4;
}

.content .content-left .sub-title {
    display: flex;
    gap: 8px;
}

.content-body {
    display: flex;
    flex-direction: column;
    gap: 16px;
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

.content-footer {
    display: flex;
    flex-direction: column;
    gap: 8px;
    align-items: flex-end;
}

.content-footer button {
    width: 100%;
    background-color: #0063EE;
    color: #fff;
    border: none;
    padding: 16px 0 16px 0;
    border-radius: 5px;
}

.gambar {
    width: 50%;
}

.gambar img {
    height: 100%;
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="content">
        <div class="content-left">
            <i class="fa-solid fa-arrow-left icon"></i>
            <div class="title">
                <div class="sub-title">
                    <h2>Selamat Datang</h2>
                    <img src="{{ asset('../../../images/hai.png') }}" alt="Logo">
                </div>
                <h6 style="font-weight: 400;">Silahkan masukkan identitas anda.</h6>
            </div>
            <div class="content-body">
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="********" required autocomplete="off">
                </div>
            </div>
            <div class="content-footer">
                <button type="submit">Masuk</button>
                <a href="" class="text-decoration-none" style="color: #021526;">Lupa Password?</a>
            </div>
        </div>
    </div>

    <div class="gambar">
        <img class="img-fluid" src="{{ asset('../../../images/Input Frame.svg') }}" alt="">
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {

    });
</script>
@endsection