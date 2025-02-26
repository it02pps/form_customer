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

    .btnSimpan {
        padding: 8px 80px;
        border-radius: 5px;
        background-color: #0063ee;
        border: none;
        color: #fff;
    }

    .btnBatal {
        padding: 8px 80px;
        border-radius: 5px;
        background-color: #fff;
        border: 1px solid #0063ee;
        color: #0063ee;
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

    #search {
        position: relative;
    }

    #search input {
        padding-left: 50px;
        height: 50px;
    }

    #search::before {
        content: '';
        position: absolute;
        left: 30px;
        top: 33%;
        pointer-events: none;
        background-image: url('../../../images/search.png');
        background-size: contain;
        background-repeat: no-repeat;
        width: 16px;
        height: 16px;
    }

    .modal-content {
        padding: 16px;
    }

    .forgot_password {
        display: flex;
        justify-content: end;
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
                        <img id="Edit Profile" data-bs-toggle="modal" data-bs-target="#modalEditProfil" src="{{ asset('../../../images/Profile.svg') }}" title="Edit Profile" alt="Profile">
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
                        <div id="search" class="row">
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                <input type="text" name="searchInput" id="searchInput" class="form-control" placeholder="Search" autocomplete="off">
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                <select name="filter_status" id="filter_status" class="form-control" style="height: 50px;">
                                    <option value="">Cari Status</option>
                                    <option value="Belum Upload">Belum Upload</option>
                                    <option value="Sudah Upload">Sudah Upload</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-3">
                            <table id="datatable" class="table" style="border: 1px solid #cfcfd1;">
                                <thead style="background-color: #E7E6EB;">
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th>Kode Customer</th>
                                        <th>Bentuk Usaha</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Alamat Lengkap</th>
                                        <th>Nomor HP</th>
                                        <th>Sales</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
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

    {{-- START: Modal edit profile & ubah password --}}
    <div class="modal fade" id="modalEditProfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formProfil">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" value="{{ Auth::user()->username }}">
                        </div>
                        <div class="forgot_password">
                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalUbahPassword" style="text-decoration: none; color: #021526;">Lupa Password?</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btnBatal" data-bs-dismiss="modal" title="Batal">Batal</button>
                        <button type="submit" class="btnSimpan" title="Simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUbahPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formUbahPassword">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" id="username_pass" class="form-control" placeholder="Masukkan username">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Password Baru <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password baru">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" id="konfirmasi_password" class="form-control" placeholder="Konfirmasi password baru">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btnBatal" data-bs-dismiss="modal" title="Batal">Batal</button>
                        <button type="submit" class="btnSimpan" title="Simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- END: Modal edit profile & ubah password --}}
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
                ajax: '{{ route('home.datatable') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false },
                    { data: 'kode_customer', name: 'kode_customer' },
                    { data: 'bentuk_usaha', name: 'bentuk_usaha' },
                    { data: 'nama_perusahaan', name: 'nama_perusahaan' },
                    { data: 'alamat_lengkap', name: 'alamat_lengkap' },
                    { data: 'nomor_handphone', name: 'nomor_handphone' },
                    { data: 'nama_sales', name: 'nama_sales' },
                    { data: 'status', name: 'status' },
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
                        'targets': 5,
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

            $('#filter_status').on('change', function() {
                table.search(this.value).draw();
            })
            // END: Search

            // START: Button detail
            $(document).on('click', '#detailCustomer', function() {
                let id = $(this).data('id');
                window.location.href = '/internal/panel/detail/' + id;
            });
            // END: Button detail

            // START: Button edit
            $(document).on('click', '#editCustomer', function() {
                let id = $(this).data('id');
                window.location.href = '/internal/panel/edit/' + id;
            });
            // END: Button edit

            // START: Form profil
            $(document).on('submit', '#formProfil', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route("home.update_profil") }}',
                    type: 'POST',
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: () => {
                        Swal.fire({
                            title: 'Loading...',
                            text: 'Harap Menunggu',
                            icon: 'info',
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                    },
                    success: res => {
                        if(res.status == true) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Profil berhasil diubah',
                                icon: 'success'
                            });
                            location.reload();
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: res.error,
                                icon: 'error'
                            });
                        }
                    }
                });
            })
            // END: Form profil

            // START: Form password
            $(document).on('submit', '#formUbahPassword', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route("home.forgot_password") }}',
                    type: 'POST',
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: () => {
                        Swal.fire({
                            title: 'Loading...',
                            text: 'Harap Menunggu',
                            icon: 'info',
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                    },
                    success: res => {
                        if(res.status == true) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Password berhasil diubah',
                                icon: 'success'
                            });
                            location.reload();
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: res.error,
                                icon: 'error'
                            });
                        }
                    }
                });
            })
            // END: Form password
        });
    </script>
@endsection