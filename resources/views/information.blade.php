@extends('layouts.app')

@section('title')
<title>Detail Form Customer | PT Papasari</title>
@endsection

@section('css')
<style>
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
        position: relative;
        left: 138px;
        border-radius: 8px;
        width: 100%;
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
            border-radius: 8px;
            width: 10%;
            display: flex;
            justify-content: center;
            margin-left: auto;
            margin-right: auto;
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
            <h2>FORMULIR DATA CUSTOMER PT PAPASARI</h2>
        </div>
    
        <form id="form_customer" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="update_id" id="update_id" value="{{ $enkripsi }}">
            <div class="content-body">
                <div class="section1 mb-4">
                    <h4>IDENTITAS PERUSAHAAN</h4>
                    <div class="section1-body">
                        <div class="row mb-2">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Perusahaan</label>
                                    <p>{{ $perusahaan['nama_perusahaan'] }}</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Group Perusahaan</label>
                                    <p>{{ $perusahaan['nama_group_perusahaan'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Alamat Lengkap</label>
                                    <p>{{ $perusahaan['alamat_lengkap'] }}</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-2">
                                    <label for="">Kota / Kabupaten</label>
                                    <p>{{ $perusahaan['kota_kabupaten'] }}</p>
                                </div>
                                <div class="form-gorup">
                                    <label for="">Kecamatan</label>
                                    <p>{{ $perusahaan['kecamatan'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Alamat Email Tempat Usaha</label>
                                    <p>{{ $perusahaan['alamat_email'] }}</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nomor Handphone</label>
                                    <p>{{ $perusahaan['nomor_handphone'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Tahun Berdiri</label>
                                    <p>{{ \Carbon\Carbon::parse($perusahaan['tahun_berdiri'])->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') }}</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Lama Usaha (Tahun)</label>
                                    <p>{{ $perusahaan['lama_usaha'] }} tahun</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Bidang Usaha</label>
                                    <p>{{ $perusahaan['bidang_usaha'] }}</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <label for="">Status Kepemilikan Tempat Usaha</label>
                                <p>{{ str_replace("_", ' ', ucwords($perusahaan['status_kepemilikan'])) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group mb-2">
                                <label for="">Identitas Pemilik Perusahaan</label>
                                <p>{{ strtoupper($perusahaan['identitas']) }}</p>
                            </div>
                        </div>
                        
                        @if($perusahaan['identitas'] == 'ktp')
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ktp-section">
                                <div class="form-group mb-2">
                                    <label for="">Nama Lengkap</label>
                                    <p>{{ $perusahaan['nama_lengkap'] }}</p>
                                </div>
                            </div>
                            <div class="ktp-section">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <label for="">Nomor KTP</label>
                                        <p>{{ $perusahaan['nomor_ktp'] }}</p>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <label for="">Foto KTP</label>
        
                                        <div id="preview_ktp" class="@if($perusahaan['identitas'] != 'ktp') d-none @endif">
                                            <img id="preview_foto_ktp" src="{{ asset('uploads/identitas_perusahaan/'.$perusahaan['foto_ktp']) }}" alt="Preview" data-action="zoom">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 npwp-section">
                                <div class="form-group mb-3">
                                    <label for="">Badan Usaha</label>
                                    <p>{{ strtoupper($perusahaan['badan_usaha']) }}</p>
                                </div>
                            </div>
                            <div class="npwp-section">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group mb-3">
                                            <label for="">Nomor NPWP</label>
                                            <p>{{ $perusahaan['nomor_npwp'] }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group mb-3">
                                            <label for="">Nama NPWP</label>
                                            <p>{{ $perusahaan['nama_npwp'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group mb-3">
                                            <label for="">Alamat NPWP <span class="text-danger">*</span></label>
                                            <p>{{ $perusahaan['alamat_npwp'] }}</p>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="">Email Khusus Untuk Faktur Pajak</label>
                                            <p>{{ $perusahaan['email_khusus_faktur_pajak'] }}</p>
                                        </div>
        
                                        <div class="form-group mb-3">
                                            <label for="">Status Pengusaha Kena Pajak (PKP)</label>
                                            <p>{{ str_replace("_", " ", strtoupper($perusahaan['status_pkp'])) }}</p>
                                        </div>
        
                                        <div class="form-group mb-3 @if($perusahaan['status_pkp'] !=  'pkp') d-none @endif" id="sppkp-section">
                                            <label for="">Foto SPPKP</label>
        
                                            <div id="preview_sppkp">
                                                <img id="preview_foto_sppkp" src="{{ asset('uploads/identitas_perusahaan/'.$perusahaan['sppkp']) }}" alt="Preview" data-action="zoom">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="">Foto NPWP</label>
                                        </div>
        
                                        <div id="preview_npwp" class="@if($perusahaan['identitas'] != 'npwp') d-none @endif">
                                            <img id="preview_foto_npwp" src="{{ asset('uploads/identitas_perusahaan/'.$perusahaan['foto_npwp']) }}" alt="Preview" data-action="zoom">
                                        </div>

                                        <div class="form-group mt-3">
                                            <label for="">Kota sesuai NPWP <span class="text-danger">*</span></label>
                                            <p>{{ $perusahaan['kota_npwp'] }}</p>
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
                                    <p>{{ $perusahaan['informasi_bank']['nomor_rekening'] }}</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Rekening</label>
                                    <p>{{ $perusahaan['informasi_bank']['nama_rekening'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Status Rekening</label>
                                    <p>{{ str_replace("_", " ", ucwords($perusahaan['informasi_bank']['status'])) }}</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Bank</label>
                                    <p>{{ $perusahaan['informasi_bank']['nama_bank'] }}</p>
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
                                    <p>{{ $perusahaan['data_identitas']['nama'] }}</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Jabatan</label>
                                    <p>{{ $perusahaan['data_identitas']['jabatan'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-2">
                                    <label for="">Identitas Penanggung Jawab</label>
                                    <p>{{ strtoupper($perusahaan['data_identitas']['identitas']) }}</p>
                                </div>
    
                                <div class="form-group mb-2" id="penanggung_ktp">
                                    <label for="">Foto KTP</label>
    
                                    <div id="preview_ktp_penanggung" class="@if($perusahaan['data_identitas']['identitas'] != 'ktp') d-none @endif">
                                        <img id="preview_foto_ktp_penanggung" src="{{ asset('uploads/penanggung_jawab/'.$perusahaan['data_identitas']['foto']) }}" alt="Preview" data-action="zoom">
                                    </div>
                                </div>
    
                                <div class="form-group @if($perusahaan['data_identitas']['identitas'] != 'npwp') d-none @endif" id="penanggung_npwp">
                                    <label for="">Foto NPWP</label>
    
                                    <div id="preview_npwp_penanggung" class="d-none">
                                        <img id="preview_foto_npwp_penanggung" src="{{ asset('uploads/penanggung_jawab/'.$perusahaan['data_identitas']['foto']) }}" alt="Preview" data-action="zoom">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                {{-- Signature --}}
                                <div class="">
                                    <label for="">Tanda Tangan</label>
                                    <div id="signature">
                                        <img src="data:{{ $perusahaan['data_identitas']['ttd'] }}" alt="" style="width: 100%;" data-action="zoom">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-footer d-flex justify-content-center mt-2">
                <button type="button" class="btn btn-outline-primary waves-effect waves-light rounded btn-md" id="update_customer" data-url="{{ $url }}" title="Edit Data Customer">Edit Data Customer</button>
                &nbsp;
                <a type="button" href="{{ route('form_customer.pdf', ['id' => $enkripsi]) }}" target="_blank" class="btn btn-outline-primary waves-effect waves-light rounded btn-md" id="pdf" data-id="{{ $enkripsi }}" title="Download PDF">Download PDF</a>
                &nbsp;
                <button type="button" class="btn btn-primary waves-effect waves-light rounded btn-md" id="konfirmasi" data-id="{{ $enkripsi }}" title="Upload Data Customer">Upload Data Customer</button>
            </div>
        </form>
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
