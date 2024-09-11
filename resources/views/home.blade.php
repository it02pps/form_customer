@extends('layouts.app')

@section('title')
<title>List Data Customer</title>
@endsection

@section('css')
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
                    <table id="datatable" class="table table-bordered table-responsive table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Perusahaan</th>
                                <th>Alamat Lengkap</th>
                                <th>Nomor handphone</th>
                                <th>Kota / Kabupaten</th>
                                <th>Kecamatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $loop_data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $loop_data->nama_perusahaan }}</td>
                                    <td>{{ $loop_data->alamat_lengkap }}</td>
                                    <td>{{ $loop_data->nomor_handphone }}</td>
                                    <td>{{ $loop_data->kota_kabupaten }}</td>
                                    <td>{{ $loop_data->kecamatan }}</td>
                                    <td>
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
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();

            $(document).on('click', '#detail', function() {
                let url = $(this).data('url');
                window.location.href = url;
            })
        });
    </script>
@endsection