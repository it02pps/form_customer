@extends('layouts.main_app')

@section('title')
    <title>Menu | PT. PAPASARI</title>
@endsection

@section('css')
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
@endsection

@section('content')
    <div class="container">
        <div class="container-fluid">
            <div class="content-menu">
                <div class="content-header">
                    <div class="logo">
                        <img src="{{ asset('../../../images/PNG 4125 x 913.png') }}" alt="Logo">
                    </div>
                    <div class="title">
                        <h1>Pilih Menu</h1>
                        <p>Silahkan pilih menu dibawah ini untuk mengisi data customer.<br>Bentuk usaha customer:</p>
                    </div>
                </div>
                <div class="content-body">
                    <div class="row"> 
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 badan_usaha" onclick="form_customer('badan-usaha')">
                            <img src="{{ asset('../../../images/enterprise 1.svg') }}" alt="Logo">
                            <p style="font-weight: 700;">Badan Usaha</p>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 perseorangan" onclick="form_customer('perseorangan')">
                            <img src="{{ asset('../../../images/Single Entity 1.svg') }}" alt="Logo">
                            <p style="font-weight: 700;">Perseorangan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function form_customer(value) {
            window.location.href = '/form-customer/'+value;
        }
    </script>
@endsection