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
        display: flex;
        justify-content: end;
        margin-left: auto;
        margin-right: auto;
        border-radius: 8px;
        width: 60%;
        padding: 0;
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

    #preview_ktp img, #preview_npwp img, #preview_sppkp img, #preview_penanggung img{
        width: 100%;
        height: 180px;
        object-fit: fill;
        border-radius: 7px;
    }

    label:not(.label_modal) {
        font-weight: bold;
        text-decoration: underline;
    }

    #preview_penanggung .zoom-img-wrap .zoom-img, #preview_ktp .zoom-img-wrap .zoom-img, #preview_npwp .zoom-img-wrap .zoom-img, #preview_sppkp .zoom-img-wrap .zoom-img {
        width: 100%;
        height: 100%;
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
            <h2>FORMULIR DATA CUSTOMER</h2>
        </div>
        <div class="content-body">
            <div class="section1 mb-4">
                <h4>IDENTITAS PERSEORANGAN</h4>
                <div class="section1-body">
                    <div class="row mb-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Jenis Customer</label>
                                <p>{{ ucfirst($perusahaan['status_cust']) }}</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Usaha</label>
                                <p>{{ $perusahaan['nama_perusahaan'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Group Usaha</label>
                                <p>{{ $perusahaan['nama_group_perusahaan'] }}</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Alamat Lengkap Usaha</label>
                                <p>{{ $perusahaan['alamat_lengkap'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group mb-2">
                                <label for="">Kota / Kabupaten</label>
                                <p>{{ $perusahaan['kota_kabupaten'] }}</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Alamat Email Usaha</label>
                                <p>{{ $perusahaan['alamat_email'] ? $perusahaan['alamat_email'] : '' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nomor Handphone Contact Person</label>
                                <p>{{ $perusahaan['nomor_handphone'] }}</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Tahun Berdiri</label>
                                <p>{{ $perusahaan['tahun_berdiri'] ? \Carbon\Carbon::parse($perusahaan['tahun_berdiri'])->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') : '-' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Lama Usaha (Tahun)</label>
                                <p>{{ $perusahaan['lama_usaha'] ? $perusahaan['lama_usaha'] . ' tahun' : '-' }}</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Bidang Usaha</label>
                                @if($perusahaan['bidang_usaha'] == 'lainnya')
                                    <p>{{ ucfirst($perusahaan['bidang_usaha_lain']) }}</p>
                                @else
                                    <p>{{ str_replace('_', ' ', ucfirst($perusahaan['bidang_usaha'])) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Status Kepemilikan Tempat Usaha</label>
                            @if($perusahaan['status_kepemilikan'] == 'group')
                                <p>{{ ucfirst($perusahaan['nama_group']) }}</p>
                            @else
                                <p>{{ str_replace("_", ' ', ucfirst($perusahaan['status_kepemilikan'])) }}</p>
                            @endif
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
                                    <div class="form-group mt-3">
                                        <label for="">Nomor KTP</label>
                                        <p>{{ $perusahaan['nomor_ktp'] }}</p>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group mt-3">
                                        <label for="">Foto KTP</label>
        
                                        <div id="preview_ktp" class="@if($perusahaan['identitas'] != 'ktp') d-none @endif">
                                            {{-- @if(str_contains($perusahaan['foto_ktp'], '.pdf')) --}}
                                            {{-- <div id="preview_ktp" style="cursor: pointer;" onclick="preview_pdf('{{ asset('uploads/identitas_perusahaan/'.$perusahaan['foto_ktp']) }}')">
                                                <img src="{{ asset('images/pdf.png') }}" style="width: 20% !important; height: auto;">
                                                <span>Click to preview</span>
                                            </div> --}}
                                            {{-- @else --}}
                                            {{-- <img id="preview_foto_ktp" src="{{ route('showimage.view', ['category' => 'KTP', 'filename' => $perusahaan['foto_ktp']]) }}" data-action="zoom"> --}}
                                            {{-- @endif --}}
                                            <img src="{{ asset('uploads/identitas_perusahaan/'.$perusahaan['foto_ktp']) }}" alt="Foto KTP" data-action="zoom">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group mb-2">
                                <label for="">Identitas Pemilik Perusahaan</label>
                                <p>{{ strtoupper($perusahaan['identitas']) }}</p>
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
                                    <div class="form-group">
                                        <label for="">Cabang</label>
                                        @if($perusahaan['status_cabang'] == '0')
                                            <p>Tidak ada</p>
                                        @else
                                            <p>Ada</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">NITKU</label>
                                        <p>{{ $perusahaan['nitku'] ? $perusahaan['nitku'] : '-' }}</p>
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
                                            {{-- @if(str_contains($perusahaan['sppkp'], '.pdf'))
                                                <div id="preview_ktp" style="cursor: pointer;" onclick="preview_pdf('{{ asset('uploads/identitas_perusahaan/'.$perusahaan['sppkp']) }}')">
                                                    <img src="{{ asset('images/pdf.png') }}" style="width: 20% !important; height: auto;">
                                                    <span>Click to preview</span>
                                                </div>
                                            @else
                                                <img id="preview_foto_sppkp" src="{{ route('showimage.view', ['category' => 'SPPKP', 'filename' => $perusahaan['sppkp']]) }}" data-action="zoom">
                                            @endif --}}
                                            <img src="{{ asset('uploads/identitas_perusahaan/'.$perusahaan['sppkp']) }}" alt="SPPKP" data-action="zoom">
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
                                        {{-- @if(str_contains($perusahaan['foto_npwp'], '.pdf'))
                                            <div id="preview_ktp" style="cursor: pointer;" onclick="preview_pdf('{{ asset('uploads/identitas_perusahaan/'.$perusahaan['foto_npwp']) }}')">
                                                <img src="{{ asset('images/pdf.png') }}" style="width: 20% !important; height: auto;">
                                                <span>Click to preview</span>
                                            </div>
                                        @else
                                            <img id="preview_foto_npwp" src="{{ route('showimage.view', ['category' => 'NPWP', 'filename' => $perusahaan['foto_npwp']]) }}" data-action="zoom">
                                        @endif --}}
                                        <img src="{{ asset('uploads/identitas_perusahaan/'.$perusahaan['foto_npwp']) }}" alt="Foto NPWP" data-action="zoom">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="section2 mt-4 mb-4">
                <hr>
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
            <div class="section3 mt-4">
                <hr>
                <h4>DATA IDENTITAS PENANGGUNG JAWAB</h4>
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
                            <div class="form-group mb-2">
                                <label for="">Foto</label>
                                <div id="preview_penanggung">
                                    <img src="{{ asset('uploads/penanggung_jawab/' . $perusahaan['data_identitas']['foto']) }}" alt="Foto" data-action="zoom">
                                </div>
                            </div>

                            {{-- Signature --}}
                            <div class="">
                                <label for="">Tanda Tangan</label>
                                <div id="signature">
                                    <img src="{{ asset('uploads/ttd/'.$perusahaan['data_identitas']['ttd']) }}" style="width: 100%; height: 100%;" data-action="zoom">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-footer mt-2">
            <button type="button" class="btn btn-outline-primary waves-effect waves-light rounded btn-md" id="update_customer" data-url="{{ $url }}" title="Edit Data Customer">Edit Data Customer</button>
            &nbsp;
            @if($perusahaan['data_identitas'])
                <button type="button" class="btn btn-primary waves-effect waves-light rounded btn-md" id="konfirmasi_without_upload" data-id="{{ $enkripsi }}" data-usaha="{{ str_replace('_', '-', $perusahaan['bentuk_usaha']) }}" title="Konfirmasi penginputan data customer">Konfirmasi</button>
            @else
                <a type="button" href="{{ route('form_customer.pdf', ['menu' => str_replace('_', '-', $perusahaan['bentuk_usaha']), 'id' => $enkripsi]) }}" target="_blank" class="btn btn-dark waves-effect waves-light rounded btn-md" id="pdf" data-id="{{ $enkripsi }}" title="Download PDF">Download PDF</a>
                &nbsp;
                <button type="button" class="btn btn-primary waves-effect waves-light rounded btn-md" id="upload_file" data-id="{{ $enkripsi }}" data-usaha="{{ str_replace('_', '-', $perusahaan['bentuk_usaha']) }}" title="Upload file">Upload File</button>
            @endif
        </div>
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
                        <input type="file" class="form-control" accept=".pdf" id="upload" name="upload">
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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

            $(document).on('click', '#konfirmasi_without_upload', function() {
                let id = $(this).data('id');
                let usaha = $(this).data('usaha');
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
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'encrypt': id
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
