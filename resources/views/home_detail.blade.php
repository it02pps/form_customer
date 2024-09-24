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

    #preview_ktp img, #preview_npwp img, #preview_sppkp img, #preview_ktp_penanggung img,  #preview_npwp_penanggung img {
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
            <h2>Detail Data Customer</h2>
        </div>
    
        <div class="content-body">
            <div class="section1 mb-4">
                <h4>IDENTITAS PERUSAHAAN</h4>
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
                            <div class="form-gorup">
                                <label for="">Kecamatan</label>
                                <p>{{ $data['kecamatan'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Alamat Email Tempat Usaha</label>
                                <p>{{ $data['alamat_email'] }}</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nomor Handphone</label>
                                <p>{{ $data['nomor_handphone'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Tahun Berdiri</label>
                                <p>{{ \Carbon\Carbon::parse($data['tahun_berdiri'])->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Lama Usaha (Tahun)</label>
                                <p>{{ $data['lama_usaha'] }} tahun</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Bidang Usaha</label>
                                <p>{{ $data['bidang_usaha'] }}</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <label for="">Status Kepemilikan Tempat Usaha</label>
                            <p>{{ str_replace("_", ' ', ucwords($data['status_kepemilikan'])) }}</p>
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
                    
                    @if($data['identitas'] == 'ktp')
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ktp-section">
                            <div class="form-group mb-2">
                                <label for="">Nama Lengkap</label>
                                <p>{{ $data['nama_lengkap'] }}</p>
                            </div>
                        </div>
                        <div class="ktp-section">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="">Nomor KTP</label>
                                    <p>{{ $data['nomor_ktp'] }}</p>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="">Foto KTP</label>
    
                                    <div id="preview_ktp" class="@if($data['identitas'] != 'ktp') d-none @endif">
                                        @if(str_contains($data['foto_ktp'], '.pdf'))
                                            <div id="preview_ktp" style="cursor: pointer;" onclick="preview_pdf('{{ asset('uploads/identitas_perusahaan/'.$data['foto_ktp']) }}')">
                                                <img src="{{ asset('images/pdf.png') }}" style="width: 20% !important; height: auto;" alt="PDF">
                                                <span>Click to preview</span>
                                            </div>
                                        @else
                                            <img id="preview_foto_ktp" src="{{ asset('uploads/identitas_perusahaan/'.$data['foto_ktp']) }}" alt="Preview" data-action="zoom">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 npwp-section">
                            <div class="form-group mb-4">
                                <label for="">Badan Usaha</label>
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
    
                                    <div class="form-group mb-4 @if($data['status_pkp'] !=  'pkp') d-none @endif" id="sppkp-section">
                                        <label for="">Foto SPPKP</label>
    
                                        <div id="preview_sppkp">
                                            @if(str_contains($data['sppkp'], '.pdf'))
                                                <div id="preview_ktp" style="cursor: pointer;" onclick="preview_pdf('{{ asset('uploads/identitas_perusahaan/'.$data['sppkp']) }}')">
                                                    <img src="{{ asset('images/pdf.png') }}" style="width: 20% !important; height: auto;" alt="PDF">
                                                    <span>Click to preview</span>
                                                </div>
                                            @else
                                                <img id="preview_foto_sppkp" src="{{ asset('uploads/identitas_perusahaan/'.$data['sppkp']) }}" alt="Preview" data-action="zoom">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="">Kota sesuai NPWP</label>
                                        <p>{{ $data['kota_npwp'] }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Foto NPWP</label>
                                    </div>
    
                                    <div id="preview_npwp" class="@if($data['identitas'] != 'npwp') d-none @endif">
                                        @if(str_contains($data['foto_npwp'], '.pdf'))
                                            <div id="preview_ktp" style="cursor: pointer;" onclick="preview_pdf('{{ asset('uploads/identitas_perusahaan/'.$data['foto_npwp']) }}')">
                                                <img src="{{ asset('images/pdf.png') }}" style="width: 20% !important; height: auto;" alt="PDF">
                                                <span>Click to preview</span>
                                            </div>
                                        @else
                                            <img id="preview_foto_npwp" src="{{ asset('uploads/identitas_perusahaan/'.$data['foto_npwp']) }}" alt="Preview" data-action="zoom">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
            <hr>
            <div class="section2 mt-4 mb-4">
                <h4>INFORMASI BANK</h4>
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
                                <label for="">Status Rekening</label>
                                <p>{{ str_replace("_", " ", ucwords($data['informasi_bank']['status'])) }}</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Bank</label>
                                <p>{{ $data['informasi_bank']['nama_bank'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="section3 mt-4">
                <h4>DATA IDENTITAS PENANGGUNG JAWAB</h4>
                <div class="section3-body">
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Penanggung Jawab</label>
                                <p>{{ $data['data_identitas']['nama'] }}</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Jabatan</label>
                                <p>{{ $data['data_identitas']['jabatan'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group mb-2">
                                <label for="">Identitas Penanggung Jawab</label>
                                <p>{{ strtoupper($data['data_identitas']['identitas']) }}</p>
                            </div>

                            <div class="form-group mb-2" id="penanggung_ktp">
                                <label for="">Foto KTP</label>

                                <div id="preview_ktp_penanggung" class="@if($data['data_identitas']['identitas'] != 'ktp') d-none @endif">
                                    @if(str_contains($data['data_identitas']['foto'], '.pdf'))
                                        <div id="preview_ktp" style="cursor: pointer;" onclick="preview_pdf('{{ asset('uploads/penanggung_jawab/'.$data['data_identitas']['foto']) }}')">
                                            <img src="{{ asset('images/pdf.png') }}" style="width: 20% !important; height: auto;" alt="PDF">
                                            <span>Click to preview</span>
                                        </div>
                                    @else
                                        <img id="preview_foto_ktp_penanggung" src="{{ asset('uploads/penanggung_jawab/'.$data['data_identitas']['foto']) }}" alt="Preview" data-action="zoom">
                                    @endif
                                </div>
                            </div>

                            <div class="form-group @if($data['data_identitas']['identitas'] != 'npwp') d-none @endif" id="penanggung_npwp">
                                <label for="">Foto NPWP</label>

                                <div id="preview_npwp_penanggung" class="d-none">
                                    @if(str_contains($data['data_identitas']['foto'], '.pdf'))
                                        <div id="preview_ktp" style="cursor: pointer;" onclick="preview_pdf('{{ asset('uploads/penanggung_jawab/'.$data['data_identitas']['foto']) }}')">
                                            <img src="{{ asset('images/pdf.png') }}" style="width: 20% !important; height: auto;" alt="PDF">
                                            <span>Click to preview</span>
                                        </div>
                                    @else
                                        <img id="preview_foto_npwp_penanggung" src="{{ asset('uploads/penanggung_jawab/'.$data['data_identitas']['foto']) }}" alt="Preview" data-action="zoom">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            {{-- Signature --}}
                            <div class="">
                                <label for="">Tanda Tangan</label>
                                <div id="signature">
                                    <img src="data:{{ $data['data_identitas']['ttd'] }}" alt="" style="width: 100%;" data-action="zoom">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-footer mt-2">
            <button type="button" class="btn btn-danger btn-md waves-effect waves-light rounded" onclick="back()">Back</button>
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
            window.location.href = '/panel';
        }
    </script>
@endsection