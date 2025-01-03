@extends('layouts.app')

@section('title')
<title>Detail Data Customer | PT Papasari</title>
@endsection

@section('css')
<style>
    body {
        overflow-x: hidden;
    }

    .content-body {
        border: 2px solid #1C4A9C;
        border-radius: 8px;
        width: 60%;
        height: auto;
        padding: 15px 20px;
        margin-left: auto;
        margin-right: auto;
    }

    .content-footer {
        display: flex;
        justify-content: right;
        border-radius: 8px;
        width: 62%;
    }

    .section1 h4, .section2 h4, .section3 h4 {
        text-align: center;
    }

    hr {
        border-top: 2px solid #1C4A9C;
        opacity: 1;
    }

    #signature {
        width: 100%;
        height: 200px;
        border: 1px solid #1C4A9C;
        border-radius: 7px;
    }

    #signature canvas {
        height: 198px !important;
        border-radius: 7px;
    }

    #preview_ktp img, #preview_npwp img, #preview_sppkp img, #preview_penanggung img {
        width: 100%;
        height: 180px;
        object-fit: fill;
        border-radius: 7px;
    }

    label {
        font-weight: bold;
        text-decoration: underline;
    }

    @media only screen and (max-width: 500px) {
        .content-header h2 {
            font-size: 22px;
        }

        .content-body {
            border: 2px solid #1C4A9C !important;
            border-radius: 8px;
            width: 90%;
            height: auto;
            padding: 15px 20px;
            margin-left: auto;
            margin-right: auto;
        }

        .content-footer {
            display: flex;
            justify-content: right;
            border-radius: 8px;
            width: 62%;
        }

        .section1-body .row .col-xl-6:nth-of-type(1) {
            margin-bottom: 12px;
        }

        .section2-body .row .col-xl-6:nth-of-type(1) {
            margin-bottom: 12px;
        }

        .section3-body .row .col-xl-6:nth-of-type(1) {
            margin-bottom: 12px;
        }

        #signature {
            width: 100%;
            height: 200px;
            border: 1px solid #1C4A9C;
            border-radius: 7px;
        }

        #signature canvas {
            border-radius: 7px;
            height: 198px !important;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="content-header text-center mb-4">
            <h2>DETAIL DATA CUSTOMER</h2>
        </div>
        <div class="content-body">
            <div class="section1 mb-4">
                <h4 class="mb-4">IDENTITAS PERUSAHAAN</h4>
                <div class="section1-body">
                    <div class="row mb-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Perusahaan</label>
                                <p>{{ $data['nama_perusahaan'] }}</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Group Perusahaan</label>
                                <p>{{ $data['nama_group_perusahaan'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Alamat Lengkap</label>
                                <p>{{ $data['alamat_lengkap'] }}</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group mb-2">
                                <label for="">Kota / Kabupaten</label>
                                <p>{{ $data['kota_kabupaten'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Alamat Email Perusahaan</label>
                                <p>{{ $data['alamat_email'] }}</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nomor Handphone Contact Person</label>
                                <p>{{ $data['nomor_handphone'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Tahun Berdiri</label>
                                <p>{{ $data['tahun_berdiri'] ? \Carbon\Carbon::parse($data['tahun_berdiri'])->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') : '-' }}</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Lama Usaha (Tahun)</label>
                                <p>{{ $data['lama_usaha'] ? $data['lama_usaha'] . ' tahun' : '-' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Bidang Usaha</label>
                                @if($data['bidang_usaha'] == 'lainnya')
                                    <p>{{ ucfirst($data['bidang_usaha_lain']) }}</p>
                                @else
                                    <p>{{ str_replace('_', ' ', ucfirst($data['bidang_usaha'])) }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <label for="">Status Kepemilikan Tempat Usaha</label>
                            @if($data['status_kepemilikan'] == 'group')
                                <p>{{ ucfirst($data['nama_group']) }}</p>
                            @else
                                <p>{{ str_replace("_", ' ', ucfirst($data['status_kepemilikan'])) }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group mb-2">
                            <label for="">Identitas Pemilik Perusahaan</label>
                            <p>{{ strtoupper($data['identitas']) }}</p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 npwp-section">
                        <div class="form-group mb-4">
                            <label for="">Jenis Badan Usaha</label>
                            <p>{{ strtoupper($data['badan_usaha']) }}</p>
                        </div>
                    </div>
                    <div class="npwp-section">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nomor NPWP</label>
                                    <p>{{ $data['nomor_npwp'] }}</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-4">
                                    <label for="">Nama NPWP</label>
                                    <p>{{ $data['nama_npwp'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-4">
                                    <label for="">Alamat NPWP</label>
                                    <p>{{ $data['alamat_npwp'] }}</p>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="">Email Khusus Untuk Faktur Pajak</label>
                                    <p>{{ $data['email_khusus_faktur_pajak'] }}</p>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="">Status Pengusaha Kena Pajak (PKP)</label>
                                    <p>{{ str_replace("_", " ", strtoupper($data['status_pkp'])) }}</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-4">
                                    <label for="">Kota sesuai NPWP</label>
                                    <p>{{ $data['kota_npwp'] }}</p>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="">Foto NPWP</label>
                                    
                                    <div id="preview_npwp" class="@if($data['identitas'] != 'npwp') d-none @endif">
                                        <img src="{{ asset('../../../uploads/identitas_perusahaan/' . $data['foto_npwp']) }}" alt="Foto NPWP" data-action="zoom">
                                        {{-- @if(str_contains($data['foto_npwp'], '.pdf')) --}}
                                        {{-- <div id="preview_ktp" style="cursor: pointer;" onclick="preview_pdf('{{ asset('uploads/identitas_perusahaan/'.$data['foto_npwp']) }}')">
                                            <img src="{{ asset('images/pdf.png') }}" style="width: 20% !important; height: auto;">
                                            <span>Click to preview</span>
                                        </div> --}}
                                        {{-- @else
                                        <img id="preview_foto_npwp" src="{{ route('showimage.view', ['category' => 'NPWP', 'filename' => $data['foto_npwp']]) }}" data-action="zoom">
                                        @endif --}}
                                    </div>
                                </div>

                                <div class="form-group  @if($data['status_pkp'] !=  'pkp') d-none @endif" id="sppkp-section">
                                    <label for="">Foto SPPKP</label>

                                    <div id="preview_sppkp">
                                        <img src="{{ asset('../../../uploads/identitas_perusahaan/' . $data['sppkp']) }}" alt="SPPKP" data-action="zoom">
                                        {{-- @if(str_contains($data['sppkp'], '.pdf')) --}}
                                            {{-- <div id="preview_ktp" style="cursor: pointer;" onclick="preview_pdf('{{ asset('uploads/identitas_perusahaan/'.$data['sppkp']) }}')">
                                                <img src="{{ asset('images/pdf.png') }}" style="width: 20% !important; height: auto;">
                                                <span>Click to preview</span>
                                            </div> --}}
                                        {{-- @else
                                            <img id="preview_foto_sppkp" src="{{ route('showimage.view', ['category' => 'SPPKP', 'filename' => $data['sppkp']]) }}" data-action="zoom">
                                        @endif --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="section2 mt-4 mb-4">
                <h4 class="mb-4">INFORMASI BANK</h4>
                <div class="section2-body">
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nomor Rekening</label>
                                <p>{{ $data['informasi_bank']['nomor_rekening'] }}</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Rekening</label>
                                <p>{{ $data['informasi_bank']['nama_rekening'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Bank</label>
                                <p>{{ $data['informasi_bank']['nama_bank'] }}</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Pemilik Rekening</label>
                                @if(!$data['informasi_bank']['rekening_lain'])
                                    <p>{{ str_replace("_", " ", ucwords($data['informasi_bank']['status'])) }}</p>
                                @else
                                    <p>{{ str_replace('_', ' ', ucwords($data['informasi_bank']['rekening_lain'])) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="section3 mt-4">
                <h4 class="mb-4">DATA IDENTITAS PENANGGUNG JAWAB</h4>
                <div class="section3-body">
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Penanggung Jawab</label>
                                <p>{{ $data['data_identitas'] ? ($data['data_identitas']['nama'] ? $data['data_identitas']['nama'] : '-') : '-' }}</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Jabatan</label>
                                <p>{{ $data['data_identitas'] ? ($data['data_identitas']['jabatan'] ? $data['data_identitas']['jabatan'] : '-') : '-' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group mb-2">
                                <label for="">Identitas Penanggung Jawab</label>
                                <p>{{ $data['data_identitas'] ? ($data['data_identitas']['identitas'] ? strtoupper($data['data_identitas']['identitas']) : '-') : '-' }}</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group mb-2">
                                <label for="">Foto</label>
                                <div id="preview_penanggung">
                                    <img src="{{ asset('../../../uploads/penanggung_jawab/' . $data['data_identitas']['foto']) }}" alt="Foto" data-action="zoom">
                                    {{-- @if(str_contains($data['data_identitas']['foto'], '.pdf')) --}}
                                        {{-- <div id="preview_ktp" style="cursor: pointer;" onclick="preview_pdf('{{ asset('uploads/penanggung_jawab/'.$data['data_identitas']['foto']) }}')">
                                            <img src="{{ asset('images/pdf.png') }}" style="width: 20% !important; height: auto;">
                                            <span>Click to preview</span>
                                        </div> --}}
                                    {{-- @else
                                        <img id="preview_foto_ktp_penanggung" src="{{ route('showimage.view', 
                                        ['category' => 'KTP_responsible', 'filename' => $data['data_identitas']['foto']])  }}" data-action="zoom">
                                    @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-footer mt-2">
            <button type="button" class="btn btn-danger btn-md waves-effect waves-light rounded" onclick="back()">Back</button>
            &nbsp;
            <a type="button" href="{{ route('form_customer.pdf', ['menu' => str_replace('_', '-', $data['bentuk_usaha']), 'id' => $enkripsi]) }}" target="_blank" class="btn btn-dark waves-effect waves-light rounded btn-md" id="pdf" data-id="{{ $enkripsi }}" title="Download PDF">Download PDF</a>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        function preview_pdf(that) {
            window.open(that,'_blank');
        }

        function back() {
            window.location.href = '/internal/panel';
        }
    </script>
@endsection