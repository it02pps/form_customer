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

    #hapusCustomer {
        width: 100px;
        height: 35px;
        border-radius: 8px;
        background-color: #e30606;
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

    .logoutBtn  {
        filter: brightness(1.5) contrast(0.9);
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
        width: 100%;
    }

    #search input {
        padding-left: 40px;
        height: 50px;
    }

    .modal-content {
        padding: 16px;
    }

    .forgot_password {
        display: flex;
        justify-content: end;
    }

    .searchCustomerNameIcon, .searchBillToAddressIcon, .searchSalesPersonIcon {
        position: absolute;
        top: 37px;
        left: 30px;
        opacity: 0.5;
    }

    @media (max-width: 575.98px) {
        .container {
            padding: 0;
        }
        
        .container-fluid {
            background-color: #fff;
            border-radius: 0;
            box-shadow: none;
        }

        .content {
            width: 100%;
            padding: 32px 16px;
        }

        .header .logo img {
            height: 72px;
            padding-bottom: 32px;
        }

        .profile {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        .header .profile img {
            height: 64px;
            padding-bottom: 32px;
        }

        #datatable_wrapper .table-footer div {
            justify-content: center !important;
        }

        .table-responsive {
            overflow-x: auto !important;
        }

        table thead tr th:nth-child(8), table tbody tr th:nth-child(8) {
            width: 800px !important;
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
                        <img id="logoutBtn" src="{{ asset('../../../images/Log Out.png') }}" title="Logout" alt="Logout" class="logoutBtn">
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
                    <div id="search" class="row">
                        <h5 class="mb-0">Filter</h5>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 position-relative">
                            <label for="">Customer Name</label>
                            <input type="text" name="searchCustomerName" id="searchCustomerName" class="form-control" placeholder="Search Customer Name" autocomplete="off">
                            <span class="searchCustomerNameIcon"><i class="fa-solid fa-search"></i></span>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 position-relative">
                            <label for="">Bill to Address</label>
                            <input type="text" name="searchBillToAddress" id="searchBillToAddress" class="form-control" placeholder="Search Bill To Address" autocomplete="off">
                            <span class="searchBillToAddressIcon"><i class="fa-solid fa-search"></i></span>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 position-relative">
                            <label for="">Sales Person</label>
                            <input type="text" name="searchSalesPerson" id="searchSalesPerson" class="form-control" placeholder="Search Sales Person" autocomplete="off">
                            <span class="searchSalesPersonIcon"><i class="fa-solid fa-search"></i></span>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                            <label for="">Upload Status</label>
                            <select name="filter_status" id="filter_status" class="form-control" style="height: 50px;">
                                <option value="">Filter By Status</option>
                                <option value="0">Belum Upload</option>
                                <option value="1">Sudah Upload</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive" style="width: 100%;">
                        <div class="mt-3">
                            <span class="text-danger">*Note: U = Badan Usaha | O = Perseorangan | CK = CheckList</span>
                            <table id="datatable" class="table" style="border: 1px solid #cfcfd1; min-width: 100%;">
                                <thead style="background-color: #E7E6EB;">
                                    <tr>
                                        <th style="min-width: 50px; font-size: 12px;">CK</th>
                                        <th style="min-width: 80px; font-size: 12px;">No</th>
                                        <th style="min-width: 140px; font-size: 12px;">Bussiness Entity</th>
                                        <th style="min-width: 200px; font-size: 12px;" class="text-center align-middle">Customer Name</th>
                                        <th style="min-width: 200px; font-size: 12px;" class="text-center align-middle">Bill to Name</th>
                                        <th style="min-width: 250px; font-size: 12px;" class="text-center align-middle">Bill to Address</th>
                                        <th style="min-width: 180px; font-size: 12px;" class="text-center align-middle">Sales Person</th>
                                        <th style="min-width: 50px; font-size: 12px;">Upload Status</th>
                                        <th style="min-width: 350px; font-size: 12px;">Update</th>
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
                autoWidth: false,
                ajax: '{{ route('home.datatable') }}',
                columns: [
                    { data: 'checklist', name: 'checklist' },
                    { data: 'kode_customer', name: 'kode_customer' },
                    { data: 'bentuk_usaha', name: 'bentuk_usaha' },
                    { data: 'nama_perusahaan', name: 'nama_perusahaan' },
                    { data: 'bill_to_name', name: 'bill_to_name' },
                    { data: 'bill_to_address', name: 'bill_to_address'},
                    { data: 'sales', name: 'nama_sales' },
                    { data: 'status', name: 'status_upload' },
                    { data: 'aksi', name: 'aksi', searchable: false, orderable: false },
                ],
                columnDefs: [
                    {
                        targets: '_all',
                        createdCell: function(td) {
                            $(td).css('font-size', '12px');
                        }
                    },
                    {
                        targets: [0, 1, 2, 6, 7, 8],
                        className: 'text-center align-middle',
                    },
                    {
                        targets: [2, 3, 4, 5],
                        createdCell: function(td) {
                            $(td).css('text-align', 'left');
                        }
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
            $('#searchCustomerName').on('keyup', function() {
                table.column(3).search(this.value).draw();
            });

            $('#searchBillToAddress').on('keyup', function() {
                table.column(5).search(this.value).draw();
            });

            $('#searchSalesPerson').on('keyup', function() {
                table.column(6).search(this.value).draw();
            });

            $('#filter_status').on('change', function() {
                table.column(7).search(this.value).draw();
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

            // Start: Button delete
            $(document).on('click', '#hapusCustomer', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: "Yakin?",
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#0063ee",
                    cancelButtonColor: "#e30606",
                    confirmButtonText: "Hapus",
                    cancelButtonText: `Batal`
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route("home.delete") }}',
                            type: 'GET',
                            data: {
                                id: id
                            },
                            beforeSend: () => {
                                Swal.fire({
                                    title: 'Loading...',
                                    text: 'Harap Menunggu',
                                    icon: 'info',
                                    allowOutsideClick: false,
                                    showConfirmButton: false,
                                });
                            },
                            success: res => {
                                if(res.status == true) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: res.pesan,
                                        icon: 'success'
                                    });
                                    table.ajax.reload();
                                } else {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: res.error,
                                        icon: 'error'
                                    });
                                }
                            }
                        })
                    }
                });
            });
            // END: Button delete

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