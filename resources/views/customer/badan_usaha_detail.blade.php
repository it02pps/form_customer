@extends('layouts.app')

@section('title')
<title>Detail Form Customer | PT Papasari</title>
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
        /* position: relative;
        left: 138px; */
        display: flex;
        justify-content: end;
        margin-left: auto;
        margin-right: auto;
        border-radius: 8px;
        width: 60%;
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

    label:not(.label_modal) {
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
                    <h4 class="mb-4">IDENTITAS PERUSAHAAN</h4>
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
                                    <label for="">Nomor Handphone Contact Person</label>
                                    <p>{{ $perusahaan['nomor_handphone'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Tahun Berdiri</label>
                                    <p>{{ $perusahaan['tahun_berdiri'] ? \Carbon\Carbon::parse($perusahaan['tahun_berdiri'])->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') : '-' }}</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Lama Usaha (Tahun)</label>
                                    <p>{{ $perusahaan['lama_usaha'] ? $perusahaan['lama_usaha'] . ' tahun' : '-' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Bidang Usaha</label>
                                    <p>{{ str_replace('_', ' ', strtoupper($perusahaan['bidang_usaha'])) }}</p>
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
                                            @if(str_contains($perusahaan['foto_ktp'], '.pdf'))
                                            <div id="preview_ktp" style="cursor: pointer;" onclick="preview_pdf('{{ asset('uploads/identitas_perusahaan/'.$perusahaan['foto_ktp']) }}')">
                                                <img src="{{ asset('images/pdf.png') }}" style="width: 20% !important; height: auto;">
                                                <span>Click to preview</span>
                                            </div>
                                            @else
                                                <img id="preview_foto_ktp" src="{{ asset('uploads/identitas_perusahaan/'.$perusahaan['foto_ktp']) }}" data-action="zoom">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 npwp-section">
                                <div class="form-group mb-4">
                                    <label for="">Jenis Badan Usaha</label>
                                    <p>{{ strtoupper($perusahaan['badan_usaha']) }}</p>
                                </div>
                            </div>
                            <div class="npwp-section">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="">Nomor NPWP</label>
                                            <p>{{ $perusahaan['nomor_npwp'] }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group mb-4">
                                            <label for="">Nama NPWP</label>
                                            <p>{{ $perusahaan['nama_npwp'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group mb-4">
                                            <label for="">Alamat NPWP</label>
                                            <p>{{ $perusahaan['alamat_npwp'] }}</p>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="">Email Khusus Untuk Faktur Pajak</label>
                                            <p>{{ $perusahaan['email_khusus_faktur_pajak'] }}</p>
                                        </div>
        
                                        <div class="form-group mb-3">
                                            <label for="">Status Pengusaha Kena Pajak (PKP)</label>
                                            <p>{{ str_replace("_", " ", strtoupper($perusahaan['status_pkp'])) }}</p>
                                        </div>
        
                                        <div class="form-group mb-4 @if($perusahaan['status_pkp'] !=  'pkp') d-none @endif" id="sppkp-section">
                                            <label for="">Foto SPPKP</label>
        
                                            <div id="preview_sppkp">
                                                @if(str_contains($perusahaan['sppkp'], '.pdf'))
                                                    <div id="preview_ktp" style="cursor: pointer;" onclick="preview_pdf('{{ asset('uploads/identitas_perusahaan/'.$perusahaan['sppkp']) }}')">
                                                        <img src="{{ asset('images/pdf.png') }}" style="width: 20% !important; height: auto;">
                                                        <span>Click to preview</span>
                                                    </div>
                                                @else
                                                    <img id="preview_foto_sppkp" src="{{ asset('uploads/identitas_perusahaan/'.$perusahaan['sppkp']) }}" data-action="zoom">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group mb-4">
                                            <label for="">Kota sesuai NPWP</label>
                                            <p>{{ $perusahaan['kota_npwp'] }}</p>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Foto NPWP</label>
                                        </div>
        
                                        <div id="preview_npwp" class="@if($perusahaan['identitas'] != 'npwp') d-none @endif">
                                            @if(str_contains($perusahaan['foto_npwp'], '.pdf'))
                                                <div id="preview_ktp" style="cursor: pointer;" onclick="preview_pdf('{{ asset('uploads/identitas_perusahaan/'.$perusahaan['foto_npwp']) }}')">
                                                    <img src="{{ asset('images/pdf.png') }}" style="width: 20% !important; height: auto;">
                                                    <span>Click to preview</span>
                                                </div>
                                            @else
                                                <img id="preview_foto_npwp" src="{{ asset('uploads/identitas_perusahaan/'.$perusahaan['foto_npwp']) }}" data-action="zoom">
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
                    <h4 class="mb-4">INFORMASI BANK</h4>
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
                                    <label for="">Nama Bank</label>
                                    <p>{{ $perusahaan['informasi_bank']['nama_bank'] }}</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Pemilik Rekening</label>
                                    @if(!$perusahaan['informasi_bank']['rekening_lain'])
                                        <p>{{ str_replace("_", " ", ucwords($perusahaan['informasi_bank']['status'])) }}</p>
                                    @else
                                        <p>{{ str_replace('_', ' ', ucwords($perusahaan['informasi_bank']['rekening_lain'])) }}</p>
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
                                    <p>{{ $perusahaan['data_identitas'] ? ($perusahaan['data_identitas']['nama'] ? $perusahaan['data_identitas']['nama'] : '-') : '-' }}</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Jabatan</label>
                                    <p>{{ $perusahaan['data_identitas'] ? ($perusahaan['data_identitas']['jabatan'] ? $perusahaan['data_identitas']['jabatan'] : '-') : '-' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-2">
                                    <label for="">Identitas Penanggung Jawab</label>
                                    <p>{{ $perusahaan['data_identitas'] ? ($perusahaan['data_identitas']['identitas'] ? strtoupper($perusahaan['data_identitas']['identitas']) : '-') : '-' }}</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-2" id="penanggung_ktp">
                                    <label for="">Foto KTP</label>
    
                                    @if($perusahaan['data_identitas'])
                                        @if($perusahaan['data_identitas']['foto'])
                                            <div id="preview_ktp_penanggung" class="@if($perusahaan['data_identitas']) @if($perusahaan['data_identitas']['identitas'] != 'ktp') d-none @endif @endif">
                                                @if(str_contains($perusahaan['data_identitas']['foto'], '.pdf'))
                                                    <div id="preview_ktp" style="cursor: pointer;" onclick="preview_pdf('{{ asset('uploads/penanggung_jawab/'.$perusahaan['data_identitas']['foto']) }}')">
                                                        <img src="{{ asset('images/pdf.png') }}" style="width: 20% !important; height: auto;">
                                                        <span>Click to preview</span>
                                                    </div>
                                                @else
                                                    <img id="preview_foto_ktp_penanggung" src="{{ asset('uploads/penanggung_jawab/'.$perusahaan['data_identitas']['foto']) }}" data-action="zoom">
                                                @endif
                                            </div>
                                        @else
                                            <p>-</p>
                                        @endif
                                    @else
                                        <p>-</p>
                                    @endif
                                </div>
    
                                <div class="form-group @if($perusahaan['data_identitas']) @if($perusahaan['data_identitas']['identitas'] != 'npwp') d-none @endif @else d-none @endif" id="penanggung_npwp">
                                    <label for="">Foto NPWP</label>
    
                                    @if($perusahaan['data_identitas'])
                                        <div id="preview_npwp_penanggung" class="d-none">
                                            @if(str_contains($perusahaan['data_identitas']['foto'], '.pdf'))
                                                <div id="preview_ktp" style="cursor: pointer;" onclick="preview_pdf('{{ asset('uploads/penanggung_jawab/'.$perusahaan['data_identitas']['foto']) }}')">
                                                    <img src="{{ asset('images/pdf.png') }}" style="width: 20% !important; height: auto;" alt="PDF">
                                                    <span>Click to preview</span>
                                                </div>
                                            @else
                                                <img id="preview_foto_npwp_penanggung" src="{{ asset('uploads/penanggung_jawab/'.$perusahaan['data_identitas']['foto']) }}" data-action="zoom">
                                            @endif
                                        </div>
                                    @else
                                        <p>-</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-footer mt-2">
                <button type="button" class="btn btn-outline-primary waves-effect waves-light rounded btn-md" id="update_customer" data-url="{{ $url }}" title="Edit Data Customer">Edit Data Customer</button>
                &nbsp;
                <a type="button" href="{{ route('form_customer.pdf', ['menu' => str_replace('_', '-', $perusahaan['bentuk_usaha']), 'id' => $enkripsi]) }}" target="_blank" class="btn btn-dark waves-effect waves-light rounded btn-md" id="pdf" data-id="{{ $enkripsi }}" title="Download PDF">Download PDF</a>
                &nbsp;
                <button type="button" class="btn btn-primary waves-effect waves-light rounded btn-md" id="upload_file" data-id="{{ $enkripsi }}" data-usaha="{{ str_replace('_', '-', $perusahaan['bentuk_usaha']) }}" title="Upload file">Upload File</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Upload --}}
<div class="modal fade" id="modalUpload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload PDF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_upload">
                    @csrf
                    <input type="hidden" name="encrypt" id="encrypt">
                    <div class="form-group">
                        <label for="" class="label_modal">Upload File <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" accept=".pdf" id="upload" name="upload" required>
                        <span class="text-danger">*Upload file PDF</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect waves-light rounded btn-md" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light rounded btn-md">Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        function preview_pdf(that) {
            window.open(that,'_blank');
        }

        $(document).ready(function() {
            $(document).on('click', '#update_customer', function() {
                let url = $(this).data('url');
                window.location.href = url;
            });

            $(document).on('click', '#upload_file', function() {
                $('#modalUpload').modal('show');
                $('#form_upload').find('#encrypt').val($(this).data('id'));
            });

            $(document).on('submit', '#form_upload', function(e) {
                e.preventDefault();
                let usaha = $('#upload_file').data('usaha');
                Swal.fire({
                    icon: 'question',
                    title: "Apakah anda sudah yakin data yang diisikan?",
                    showCancelButton: true,
                    confirmButtonText: "Konfirmasi",
                    denyButtonText: `Batal`
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = '{{ route('form_customer.confirmation', ':menu') }}';
                        url = url.replace(':menu', usaha);
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: new FormData(this),
                            cache: false,
                            contentType: false,
                            processData: false,
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
