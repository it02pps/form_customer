@extends('layouts.app')

@section('title')
<title>Detail Form Customer</title>
@endsection

@section('css')
<style>
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">FORMULIR DATA CUSTOMER PT PAPASARI</h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <h3 class="text-center">Informasi Perusahaan</h3>
                            <table width="100%" style="border-collapse: separate; border-spacing: 10px;">
                                <tr>
                                    <th width="40%">Nama</th>
                                    <td width="5%">:</td>
                                    <td width="55%">
                                        {{ $perusahaan['nama_perusahaan'] }}
                                        {{-- <input type="text" class="form-control" value="{{ $perusahaan['nama_perusahaan'] }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nama Group Perusahaan</th>
                                    <td>:</td>
                                    <td>
                                        {{ $perusahaan['nama_group_perusahaan'] }}
                                        {{-- <input type="text" class="form-control" value="{{ $perusahaan['nama_group_perusahaan'] }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th valign="top">Alamat Lengkap</th>
                                    <td valign="top">:</td>
                                    <td>
                                        {{ $perusahaan['alamat_lengkap'] }}
                                        {{-- <textarea cols="30" rows="3" class="form-control" readonly>{{ $perusahaan['alamat_lengkap'] }}</textarea> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Bidang Usaha</th>
                                    <td>:</td>
                                    <td>
                                        {{ $perusahaan['bidang_usaha'] }}
                                        {{-- <input type="text" class="form-control" value="{{ $perusahaan['bidang_usaha'] }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tahun Berdiri</th>
                                    <td>:</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($perusahaan['tahun_berdiri'])->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') }}
                                        {{-- <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($perusahaan['tahun_berdiri'])->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Lama Usaha (Tahun)</th>
                                    <td>:</td>
                                    <td>
                                        {{ $perusahaan['lama_usaha'] }} tahun
                                        {{-- <input type="text" class="form-control" value="{{ $perusahaan['lama_usaha'] }} tahun" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nomor Handphone</th>
                                    <td>:</td>
                                    <td>
                                        {{ $perusahaan['nomor_handphone'] }}
                                        {{-- <input type="text" class="form-control" value="{{ $perusahaan['nomor_handphone'] }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>:</td>
                                    <td>
                                        {{ $perusahaan['alamat_email'] }}
                                        {{-- <input type="text" class="form-control" value="{{ $perusahaan['alamat_email'] }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status Kepemilikan</th>
                                    <td>:</td>
                                    <td>
                                        {{ \Str::replace('_', ' ', ucwords($perusahaan['status_kepemilikan'])) }}
                                        {{-- <input type="text" class="form-control" value="{{ \Str::replace('_', ' ', ucwords($perusahaan['status_kepemilikan'])) }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Identitas</th>
                                    <td>:</td>
                                    <td>
                                        {{ strtoupper($perusahaan['identitas']) }}
                                        {{-- <input type="text" class="form-control" value="{{ strtoupper($perusahaan['identitas']) }}" readonly> --}}
                                    </td>
                                </tr>
                                @if($perusahaan['identitas'] == 'ktp')
                                    <tr>
                                        <th>Nama KTP</th>
                                        <td>:</td>
                                        <td>
                                            {{ $perusahaan['nama_lengkap'] }}
                                            {{-- <input type="text" class="form-control" value="{{ $perusahaan['nama_lengkap'] }}" readonly> --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nomor KTP</th>
                                        <td>:</td>
                                        <td>
                                            {{ $perusahaan['nomor_ktp'] }}
                                            {{-- <input type="text" class="form-control" value="{{ $perusahaan['nomor_ktp'] }}" readonly> --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th valign="top">Foto KTP</th>
                                        <td valign="top">:</td>
                                        <td>
                                            <div style="width: 60%; height: auto; aspect-ratio: 16 / 9;">
                                                <img style="width: 100%; height: 100%; object-fit: cover;" src="/uploads/identitas_perusahaan/{{ $perusahaan['foto_ktp'] }}" alt="Foto KTP" class="rounded" data-action="zoom">
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <th>Nomor NPWP</th>
                                        <td>:</td>
                                        <td>
                                            {{ $perusahaan['nomor_npwp'] }}
                                            {{-- <input type="text" class="form-control" value="{{ $perusahaan['nomor_npwp'] }}" readonly> --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nama NPWP</th>
                                        <td>:</td>
                                        <td>
                                            {{ $perusahaan['nama_npwp'] }}
                                            {{-- <input type="text" class="form-control" value="{{ $perusahaan['nama_npwp'] }}" readonly> --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Badan Usaha</th>
                                        <td>:</td>
                                        <td>
                                            {{ strtoupper($perusahaan['badan_usaha']) }}
                                            {{-- <input type="text" class="form-control" value="{{ strtoupper($perusahaan['badan_usaha']) }}" readonly> --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th valign="top">Foto NPWP</th>
                                        <td valign="top">:</td>
                                        <td>
                                            <div style="width: 60%; height: auto; aspect-ratio: 16 / 9;">
                                                <img style="width: 100%; height: 100%; object-fit: cover;" src="/uploads/identitas_perusahaan/{{ $perusahaan['foto_npwp'] }}" alt="Foto NPWP" class="rounded" data-action="zoom">
                                            </div>
                                        </td>
                                    </tr>
                                    @if($perusahaan['status_pkp'] == 'pkp')
                                        <tr>
                                            <th>Foto SPPKP</th>
                                            <td>:</td>
                                            <td>
                                                <div style="width: 60%; height: auto; aspect-ratio: 16 / 9;">
                                                    <img style="width: 100%; height: 100%; object-fit: cover;" src="/uploads/identitas_perusahaan/{{ $perusahaan['sppkp'] }}" alt="Foto SPPKP" class="rounded" data-action="zoom">
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                                <tr>
                                    <th>Nomor Rekening</th>
                                    <td>:</td>
                                    <td>
                                        {{ $perusahaan['informasi_bank']['nomor_rekening'] }}
                                        {{-- <input type="text" class="form-control" value="{{ $perusahaan['informasi_bank']['nomor_rekening'] }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nama Rekening</th>
                                    <td>:</td>
                                    <td>
                                        {{ $perusahaan['informasi_bank']['nama_rekening'] }}
                                        {{-- <input type="text" class="form-control" value="{{ $perusahaan['informasi_bank']['nama_rekening'] }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status Rekening</th>
                                    <td>:</td>
                                    <td>
                                        {{ \Str::replace('_', ' ', ucwords($perusahaan['informasi_bank']['status'])) }}
                                        {{-- <input type="text" class="form-control" value="{{ \Str::replace('_', ' ', ucwords($perusahaan['informasi_bank']['status'])) }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nama Bank</th>
                                    <td>:</td>
                                    <td>
                                        {{ $perusahaan['informasi_bank']['nama_bank'] }}
                                        {{-- <input type="text" class="form-control" value="{{ $perusahaan['informasi_bank']['nama_bank'] }}" readonly> --}}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <h3 class="text-center">Data Identitas</h3>
                            <table width="100%" style="border-collapse: separate; border-spacing: 10px;">
                                <tr>
                                    <th width="37%">Nama Penanggung Jawab</th>
                                    <td width="5%">:</td>
                                    <td width="48%">
                                        {{ $perusahaan['data_identitas']['nama'] }}
                                        {{-- <input type="text" class="form-control" value="{{ $perusahaan['data_identitas']['nama'] }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jabatan</th>
                                    <td>:</td>
                                    <td>
                                        {{ $perusahaan['data_identitas']['jabatan'] }}
                                        {{-- <input type="text" class="form-control" value="{{ $perusahaan['data_identitas']['jabatan'] }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Identitas</th>
                                    <td>:</td>
                                    <td>
                                        {{ strtoupper($perusahaan['data_identitas']['identitas']) }}
                                        {{-- <input type="text" class="form-control" value="{{ strtoupper($perusahaan['data_identitas']['identitas']) }}" readonly> --}}
                                    </td>
                                </tr>
                                @if($perusahaan['identitas'] == 'ktp')
                                    <tr>
                                        <th valign="top">Foto KTP</th>
                                        <td valign="top">:</td>
                                        <td>
                                            <div style="width: 60%; height: auto; aspect-ratio: 16 / 9;">
                                                <img style="width: 100%; height: 100%; object-fit: cover;" src="/uploads/penanggung_jawab/{{ $perusahaan['data_identitas']['foto'] }}" alt="Foto KTP" class="rounded" data-action="zoom">
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <th valign="top">Foto NPWP</th>
                                        <td valign="top">:</td>
                                        <td>
                                            <div style="width: 60%; height: auto; aspect-ratio: 16 / 9;">
                                                <img style="width: 100%; height: 100%; object-fit: cover;" src="/uploads/penanggung_jawab/{{ $perusahaan['data_identitas']['foto'] }}" alt="Foto NPWP" class="rounded" data-action="zoom">
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th valign="top">Tanda Tangan</th>
                                    <td valign="top">:</td>
                                    <td>
                                        <img src="data:{{ $perusahaan['data_identitas']['ttd'] }}" alt="" style="width: 50%;" data-action="zoom">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-footer float-end mt-2">
                <button type="button" class="btn btn-outline-primary waves-effect waves-light rounded btn-md" id="update_customer" data-url="{{ $url }}" title="Edit Data Customer">Edit Data Customer</button>
                <a type="button" href="{{ route('form_customer.pdf', ['id' => $enkripsi]) }}" target="_blank" class="btn btn-outline-primary waves-effect waves-light rounded btn-md" id="pdf" data-id="{{ $enkripsi }}" title="Download PDF">Download PDF</a>
                <button type="button" class="btn btn-primary waves-effect waves-light rounded btn-md" id="konfirmasi" data-id="{{ $enkripsi }}" title="Upload Data Customer">Upload Data Customer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#update_customer', function() {
                let url = $(this).data('url');
                window.location.href = url;
            });

            $(document).on('click', '#konfirmasi', function() {
                let id = $(this).data('id');
                Swal.fire({
                    icon: 'question',
                    title: "Apakah anda sudah yakin data yang diisikan?",
                    showCancelButton: true,
                    confirmButtonText: "Konfirmasi",
                    denyButtonText: `Batal`
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('form_customer.confirmation') }}',
                            type: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": id
                            },
                            success: res => {
                                if(res.status == true) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: 'Data Customer Berhasil Diupload!',
                                        icon: 'success',
                                    });
                                    window.location.href = 'https://papasari.com';
                                } else {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: 'Terjadi Kesalahan!',
                                        icon: 'error'
                                    });
                                }
                            }
                        })
                    }
                });
            });
        });
    </script>
@endsection
