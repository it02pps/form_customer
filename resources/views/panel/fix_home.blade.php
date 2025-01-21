@extends('layouts.main_app')

@section('title')
    <title>List Data Customer | PT. PAPASARI</title>
@endsection

@section('css')
<style>
    .container {
        padding: 64px 0;
    }
    
    .container-fluid {
        background-color: #fff;
        border-radius: 16px;
        box-shadow: 2px 2px 20px rgba(0, 0, 0, 0.25);
    }
    
    .content {
        width: 100%;
        padding: 64px 32px;
    }

    .content-body {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
    }

    .header .logo img {
        height: 96px;
        padding-bottom: 32px;
    }

    .header .profile img {
        height: 72px;
        padding-bottom: 32px;
    }

    .title {
        padding-bottom: 16px;
    }

    #detailCustomer {
        width: 100px;
        height: 35px;
        border-radius: 8px;
        background-color: #0063ee;
        border: none;
        color: #fff;
    }

    #editCustomer {
        width: 100px;
        height: 35px;
        border-radius: 8px;
        background-color: #FFC107;
        border: none;
        color: #000;
    }

    .profile {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        cursor: pointer;
    }

    table {
        border-collapse: collapse;
    }
    
    .table-responsive {
        width: 100%;
    }

    .table td {
        border-bottom: 1px solid #cfcfd1 !important;
    } 
    
    thead th {
        font-weight: 500;
        border: none;
        padding: 12px 8px !important;
        width: 50px;
    }

    tbody td {
        font-weight: 400;
        padding: 12px 8px !important;
        vertical-align: middle;
    }

    input {
        width: 250px;
        height: 50px;
        border-radius: 6px;
        border: 1px solid #E7E6EB;
        padding: 16px;
    }

    #search {
        position: relative;
    }

    #search input {
        padding-left: 50px;
    }

    #search::before {
        content: '';
        position: absolute;
        left: 20px;
        top: 33%;
        pointer-events: none;
        background-image: url('../../../images/search.png');
        background-size: contain;
        background-repeat: no-repeat;
        width: 16px;
        height: 16px;
    }

    @media screen and (max-width: 475px) {
        .container {
            padding: 0;
        }
        
        .container-fluid {
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 2px 2px 20px rgba(0, 0, 0, 0.25);
        }

        .content {
            width: 100%;
            padding: 32px 16px;
        }

        .header .logo img {
            height: 72px;
            padding-bottom: 32px;
        }

        .header .profile img {
            height: 64px;
            padding-bottom: 32px;
        }

        #datatable_wrapper .table-footer div {
            justify-content: center !important;
        }
    }
</style>
@endsection

@section('content')
    <div class="container">
        <div class="container-fluid">
            <div class="content">
                <div class="header d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <img src="{{ asset('../../../images/PNG 4125 x 913.png') }}" alt="Logo">
                    </div>
                    <div class="profile">
                        <img id="Edit Profile" src="{{ asset('../../../images/Profile.svg') }}" title="Edit Profile" alt="Profile">
                        <img id="logoutBtn" src="{{ asset('../../../images/Log Out.png') }}" title="Logout" alt="Logout">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
                <div class="title">
                    <h1>List Data Customer</h1>
                </div>
                <hr>
                <div class="content-body">
                    <div class="table-responsive">
                        <div id="search">
                            <input type="text" name="searchInput" id="searchInput" placeholder="Search" autocomplete="off">
                        </div>
                        <div class="table mt-3">
                            <table id="datatable" style="border: 1px solid #cfcfd1;">
                                <thead style="background-color: #E7E6EB;">
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th width="15%">Bentuk Usaha</th>
                                        <th width="15%">Nama Perusahaan</th>
                                        <th width="30%">Alamat Lengkap</th>
                                        <th width="10%">Nomor HP</th>
                                        <th width="18%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // START: Logout submit
        document.getElementById('logoutBtn').addEventListener('click', logout);
        function logout() {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        }
        // END: Logout submit

        $(document).ready(function() {
            // START: Datatable
            let table = $('#datatable').DataTable({
                serverSide: true,
                responsive: true,
                ordering: false,
                ajax: '{{ route('fixHome.datatable') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false },
                    { data: 'bentuk_usaha', name: 'bentuk_usaha' },
                    { data: 'nama_perusahaan', name: 'nama_perusahaan' },
                    { data: 'alamat_lengkap', name: 'alamat_lengkap' },
                    { data: 'nomor_handphone', name: 'nomor_handphone' },
                    { data: 'aksi', name: 'aksi', searchable: false, orderable: false },
                ],
                columnDefs: [
                    {
                        'targets': 0,
                        createdCell: function(td) {
                            $(td).css('text-align', 'center');
                        }
                    },
                    {
                        'targets': 4,
                        createdCell: function(td) {
                            $(td).css('text-align', 'left');
                        },
                        'className': 'dt-head-left'
                    },
                ],
                pagingType: 'simple_numbers',
                pageLength: 10,
                lengthMenu: [10, 20, 30],
                language: {
                    info: '_START_ page of _TOTAL_',
                    sLengthMenu: '_MENU_',
                    oPaginate: {
                        sNext: '>',
                        sPrevious: '<',
                    }
                },
                dom: 'rt<"row"<"col-sm-12 d-flex justify-content-center align-items-center mt-3 gap-3"ipl>>',
            });
            // END: Datatable

            // START: Search
            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });
            // END: Search

            // START: Button detail
            $(document).on('click', '#detailCustomer', function() {
                let id = $(this).data('id');
                window.location.href = '/internal/panel/fix/detail/' + id;
            });
            // END: Button detail

            // START: Button edit
            $(document).on('click', '#editCustomer', function() {
                let id = $(this).data('id');
                window.location.href = '/internal/panel/fix/edit/testing/' + id;
            });
            // END: Button edit
        });
    </script>
@endsection