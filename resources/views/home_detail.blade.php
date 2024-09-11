@extends('layouts.app')

@section('title')
<title>Detail Data Customer</title>
@endsection

@section('css')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Detail Data Customer</h2>
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
                                        {{ $data['nama_perusahaan'] }}
                                        {{-- <input type="text" class="form-control" value="{{ $data['nama_perusahaan'] }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nama Group Perusahaan</th>
                                    <td>:</td>
                                    <td>
                                        {{ $data['nama_group_perusahaan'] }}
                                        {{-- <input type="text" class="form-control" value="{{ $data['nama_group_perusahaan'] }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th valign="top">Alamat Lengkap</th>
                                    <td valign="top">:</td>
                                    <td>
                                        {{ $data['alamat_lengkap'] }}
                                        {{-- <textarea cols="30" rows="3" class="form-control" readonly>{{ $data['alamat_lengkap'] }}</textarea> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Bidang Usaha</th>
                                    <td>:</td>
                                    <td>
                                        {{ $data['bidang_usaha'] }}
                                        {{-- <input type="text" class="form-control" value="{{ $data['bidang_usaha'] }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tahun Berdiri</th>
                                    <td>:</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($data['tahun_berdiri'])->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') }}
                                        {{-- <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($data['tahun_berdiri'])->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Lama Usaha (Tahun)</th>
                                    <td>:</td>
                                    <td>
                                        {{ $data['lama_usaha'] }} tahun
                                        {{-- <input type="text" class="form-control" value="{{ $data['lama_usaha'] }} tahun" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nomor Handphone</th>
                                    <td>:</td>
                                    <td>
                                        {{ $data['nomor_handphone'] }}
                                        {{-- <input type="text" class="form-control" value="{{ $data['nomor_handphone'] }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>:</td>
                                    <td>
                                        {{ $data['alamat_email'] }}
                                        {{-- <input type="text" class="form-control" value="{{ $data['alamat_email'] }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status Kepemilikan</th>
                                    <td>:</td>
                                    <td>
                                        {{ \Str::replace('_', ' ', ucwords($data['status_kepemilikan'])) }}
                                        {{-- <input type="text" class="form-control" value="{{ \Str::replace('_', ' ', ucwords($data['status_kepemilikan'])) }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Identitas</th>
                                    <td>:</td>
                                    <td>
                                        {{ strtoupper($data['identitas']) }}
                                        {{-- <input type="text" class="form-control" value="{{ strtoupper($data['identitas']) }}" readonly> --}}
                                    </td>
                                </tr>
                                @if($data['identitas'] == 'ktp')
                                    <tr>
                                        <th>Nama KTP</th>
                                        <td>:</td>
                                        <td>
                                            {{ $data['nama_lengkap'] }}
                                            {{-- <input type="text" class="form-control" value="{{ $data['nama_lengkap'] }}" readonly> --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nomor KTP</th>
                                        <td>:</td>
                                        <td>
                                            {{ $data['nomor_ktp'] }}
                                            {{-- <input type="text" class="form-control" value="{{ $data['nomor_ktp'] }}" readonly> --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th valign="top">Foto KTP</th>
                                        <td valign="top">:</td>
                                        <td>
                                            <div style="width: 60%; height: auto; aspect-ratio: 16 / 9;">
                                                <img style="width: 100%; height: 100%; object-fit: cover;" src="/uploads/identitas_perusahaan/{{ $data['foto_ktp'] }}" alt="Foto KTP" class="rounded" data-action="zoom">
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <th>Nomor NPWP</th>
                                        <td>:</td>
                                        <td>
                                            {{ $data['nomor_npwp'] }}
                                            {{-- <input type="text" class="form-control" value="{{ $data['nomor_npwp'] }}" readonly> --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nama NPWP</th>
                                        <td>:</td>
                                        <td>
                                            {{ $data['nama_npwp'] }}
                                            {{-- <input type="text" class="form-control" value="{{ $data['nama_npwp'] }}" readonly> --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Badan Usaha</th>
                                        <td>:</td>
                                        <td>
                                            {{ strtoupper($data['badan_usaha']) }}
                                            {{-- <input type="text" class="form-control" value="{{ strtoupper($data['badan_usaha']) }}" readonly> --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th valign="top">Foto NPWP</th>
                                        <td valign="top">:</td>
                                        <td>
                                            <div style="width: 60%; height: auto; aspect-ratio: 16 / 9;">
                                                <img style="width: 100%; height: 100%; object-fit: cover;" src="/uploads/identitas_perusahaan/{{ $data['foto_npwp'] }}" alt="Foto NPWP" class="rounded" data-action="zoom">
                                            </div>
                                        </td>
                                    </tr>
                                    @if($data['status_pkp'] == 'pkp')
                                        <tr>
                                            <th>Foto SPPKP</th>
                                            <td>:</td>
                                            <td>
                                                <div style="width: 60%; height: auto; aspect-ratio: 16 / 9;">
                                                    <img style="width: 100%; height: 100%; object-fit: cover;" src="/uploads/identitas_perusahaan/{{ $data['sppkp'] }}" alt="Foto SPPKP" class="rounded" data-action="zoom">
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                                <tr>
                                    <th>Nomor Rekening</th>
                                    <td>:</td>
                                    <td>
                                        {{ $data['informasi_bank']['nomor_rekening'] }}
                                        {{-- <input type="text" class="form-control" value="{{ $data['informasi_bank']['nomor_rekening'] }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nama Rekening</th>
                                    <td>:</td>
                                    <td>
                                        {{ $data['informasi_bank']['nama_rekening'] }}
                                        {{-- <input type="text" class="form-control" value="{{ $data['informasi_bank']['nama_rekening'] }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status Rekening</th>
                                    <td>:</td>
                                    <td>
                                        {{ \Str::replace('_', ' ', ucwords($data['informasi_bank']['status'])) }}
                                        {{-- <input type="text" class="form-control" value="{{ \Str::replace('_', ' ', ucwords($data['informasi_bank']['status'])) }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nama Bank</th>
                                    <td>:</td>
                                    <td>
                                        {{ $data['informasi_bank']['nama_bank'] }}
                                        {{-- <input type="text" class="form-control" value="{{ $data['informasi_bank']['nama_bank'] }}" readonly> --}}
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
                                        {{ $data['data_identitas']['nama'] }}
                                        {{-- <input type="text" class="form-control" value="{{ $data['data_identitas']['nama'] }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jabatan</th>
                                    <td>:</td>
                                    <td>
                                        {{ $data['data_identitas']['jabatan'] }}
                                        {{-- <input type="text" class="form-control" value="{{ $data['data_identitas']['jabatan'] }}" readonly> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Identitas</th>
                                    <td>:</td>
                                    <td>
                                        {{ strtoupper($data['data_identitas']['identitas']) }}
                                        {{-- <input type="text" class="form-control" value="{{ strtoupper($data['data_identitas']['identitas']) }}" readonly> --}}
                                    </td>
                                </tr>
                                @if($data['identitas'] == 'ktp')
                                    <tr>
                                        <th valign="top">Foto KTP</th>
                                        <td valign="top">:</td>
                                        <td>
                                            <div style="width: 60%; height: auto; aspect-ratio: 16 / 9;">
                                                <img style="width: 100%; height: 100%; object-fit: cover;" src="/uploads/penanggung_jawab/{{ $data['data_identitas']['foto'] }}" alt="Foto KTP" class="rounded" data-action="zoom">
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <th valign="top">Foto NPWP</th>
                                        <td valign="top">:</td>
                                        <td>
                                            <div style="width: 60%; height: auto; aspect-ratio: 16 / 9;">
                                                <img style="width: 100%; height: 100%; object-fit: cover;" src="/uploads/penanggung_jawab/{{ $data['data_identitas']['foto'] }}" alt="Foto NPWP" class="rounded" data-action="zoom">
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th valign="top">Tanda Tangan</th>
                                    <td valign="top">:</td>
                                    <td>
                                        <img src="data:{{ $data['data_identitas']['ttd'] }}" alt="" style="width: 50%;" data-action="zoom">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-danger waves-effect waves-light rounded btn-md mt-2" onclick="back()">Back</button>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        function back() {
            window.location.href = '/panel';
        }
        $(document).ready(function() {

        });
    </script>
@endsection