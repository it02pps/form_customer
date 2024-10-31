@extends('layouts.app')

@section('title')
<title>Menu | PT Papasari</title>
@endsection

@section('css')
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
</style>
@endsection

@section('content')
<div class="container" style="height: 80vh;">
    <div class="head">
        <h3 class="text-center">Pilih Menu</h3>
        <p class="text-center">Silahkan pilih menu dibawah ini untuk pengisian data customer. Bentuk usaha customer:</p>
    </div>
    <div class="content">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center" onclick="form_customer('badan-usaha')">BADAN USAHA</h3>
                {{-- <button type="button" class="btn btn-primary waves-effect waves-light rounded btn-md">Pilih</button> --}}
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3 class="text-center" onclick="form_customer('perseorangan')">PERSEORANGAN</h3>
                {{-- <button type="button" class="btn btn-primary waves-effect waves-light rounded btn-md">Pilih</button> --}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function form_customer(value) {
        window.location.href = '/'+value;
    }
</script>
@endsection