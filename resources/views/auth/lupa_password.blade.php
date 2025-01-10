@extends('layouts.main_app')

@section('title')
<title>Lupa Password | PT. Papasari</title>
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
    flex-direction: row;
    gap: 16px;
    align-items: flex-end;
}

/* .content-footer button{
    width: 100%;
    background-color: #0063EE;
    color: #fff;
    border: none;
    padding: 16px 0 16px 0;
    border-radius: 5px;
} */

.content-footer .konfirmasi {
    width: 100%;
    background-color: #0063EE;
    color: #fff;
    border: none;
    padding: 16px 0 16px 0;
    border-radius: 5px;
}

.content-footer .batal {
    width: 100%;
    color: #0063EE;
    background-color: #fff;
    border: 1px solid #0063EE;
    padding: 16px 0 16px 0;
    border-radius: 5px;
}

.gambar {
    width: 50%;
}

.gambar img {
    height: 100%;
    object-fit: cover;
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="content">
        <div class="content-left">
            <i class="fa-solid fa-arrow-left icon"></i>
            <div class="content-body">
                <h4>Ganti Password</h4>
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="">Password Baru</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="********" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="">Konfirmasi Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="konfirmasi_password" placeholder="********" required autocomplete="off">
                </div>
            </div>
            <div class="content-footer">
                <button type="button" class="batal">Batal</button>
                <button type="submit" class="konfirmasi">Konfirmasi</button>
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