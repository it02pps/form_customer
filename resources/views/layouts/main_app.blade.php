<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('../../../images/Vertical PNG 977 x 1188 px.png') }}">
    @yield('title')

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Fonts --}}
    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- Zoom --}}
    <link rel="stylesheet" href="{{ asset('../../../css/zoom.css') }}">
    {{-- Datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.min.css">
    {{-- Font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
            color: #021526;
        }
        
        body {
            background-image: linear-gradient(315deg, #E1F5FE, #CEF0FF);
        }

        main {
            /* display: flex;
            align-items: center; */
            width: 100vw;
            height: 100vh;
        }

        p {
            font-size: 23px;
        }
    
        h1 {
            font-size: 55px;
            font-weight: 700;
        }

        h2 {
            font-size: 44px;
        }

        h3 {
            font-size: 35px;
        }

        h4 {
            font-size: 28px;
        }

        h5 {
            font-size: 23px;
            font-weight: 400;
        }

        h6 {
            font-size: 18px;
        }

        @media screen and (max-width: 475px) {
            main {
                width: 100vw;
                height: 100vh;
            }

            p {
                font-size: 18px;
            }
        
            h1 {
                font-size: 36px;
                font-weight: 700;
            }

            h2 {
                font-size: 28px;
            }

            h3 {
                font-size: 23px;
            }

            h4 {
                font-size: 18px;
            }

            h5 {
                font-size: 16px;
                font-weight: 400;
            }

            h6 {
                font-size: 12px;
            }
        }
    </style>

    @yield('css')
</head>
<body>
    <div id="app">
        <main class="main">
            @yield('content')
        </main>
    </div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('../../../js/jSignature.min.js') }}"></script>
<script src="{{ asset('../../../js/modernizr.js') }}"></script>
<script src="{{ asset('../../../js/zoom.js') }}"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>

@yield('js')