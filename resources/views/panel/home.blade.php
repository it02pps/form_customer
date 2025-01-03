@extends('layouts.app')

@section('title')
<title>List Data Customer | PT Papasari</title>
@endsection

@section('css')
<style>
    body {
        overflow-x: hidden;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">List Data Customer</h2>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" width="100%" class="table table-bordered table-striped nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Bentuk Usaha</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Alamat Lengkap</th>
                                    <th>Nomor handphone</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $loop_data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ str_replace('_', ' ', strtoupper($loop_data->bentuk_usaha)) }}</td>
                                        <td>{{ $loop_data->nama_perusahaan }}</td>
                                        <td>{{ $loop_data->alamat_lengkap . ', ' . $loop_data->kecamatan . ', ' . $loop_data->kota_kabupaten}}</td>
                                        <td>{{ $loop_data->nomor_handphone }}</td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-warning waves-effect waves-light rounded btn-md"
                                                title="Edit Data Customer"
                                                id="edit" disabled
                                                data-url="{{ route('home.edit', ['menu' => $loop_data->bentuk_usaha, 'id' => Crypt::encryptString($loop_data->id)]) }}">Edit</button>
                                            <button type="button"
                                                class="btn btn-primary waves-effect waves-light rounded btn-md"
                                                title="Detail Data Customer"
                                                id="detail"
                                                data-url="{{ route('home.detail', ['id' => Crypt::encryptString($loop_data->id)]) }}">Detail</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                responsive: true,
            });

            $(document).on('click', '#detail', function() {
                let url = $(this).data('url');
                window.location.href = url;
            });

            $(document).on('click', '#edit', function() {
                let url = $(this).data('url');
                window.location.href = url;
            });

            $(document).on('submit', '#form_customer', function(e) {
                e.preventDefault();
                var data = $sigDiv.jSignature('getData', 'base30');
                // Masukkan ke textarea
                $('#hasil_ttd').val(data[1]);
                const bentuk_usaha = $('#bentuk_usaha').val();
                $.ajax({
                    url: '/'+bentuk_usaha+'/store',
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: () => {
                        Swal.fire({
                            icon: 'info',
                            title: 'Loading...',
                            text: 'Harap Menunggu',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                        });
                    },
                    success: res => {
                        if(res.status == true) {
                            Swal.fire({
                                title: 'Berhasil!',
                                icon: 'success',
                                html: 'Berhasil!'
                            });
                            window.location.href = res.link;
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                icon: 'error',
                                html: res.error
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection