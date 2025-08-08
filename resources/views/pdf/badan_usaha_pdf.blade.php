<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/Vertical PNG 977 x 1188 px.png') }}">

    <title>PDF | PT Papasari</title>

    <style>
        * {
            font-family: 'Poppins', sans-serif;
            color: #021526;
        }
        
        h2, h3 {
            text-align: center;
        }

        .content-body {
            border-radius: 8px;
            width: 90%;
            /* padding: 0 -100px; */
            margin-left: auto;
            margin-right: auto;
            /* height: 100vh; */
        }

        .content-body .row {
            page-break-inside: avoid;
        }

        .column {
            float: left;
            width: 50%;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        p {
            margin-bottom: 0;
            margin-top: 4px;
        }

        p.label {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 15px;
        }

        .break {
            page-break-after: always;
        }

        .content-ttd {
            margin-top: 6rem;
            text-align: center;
        }

        .lampiran .content-body {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content-header">
            <h2>FORMULIR DATA CUSTOMER</h2>
        </div>
        <div class="content-body">
            <h3>IDENTITAS PERUSAHAAN</h3>
            <div class="row" style="margin-bottom: 20px;">
                <div class="column">
                    <p class="label">Sales Person</p>
                    <p>{{ $data['nama_sales'] ? $data['nama_sales'] : '-' }}</p>

                    <p class="label">Nama Perusahaan</p>
                    <p>{{ $data['nama_group_perusahaan'] }}</p>

                    <p class="label">Alamat Lengkap Perusahaan</p>
                    <p>{{ $data['alamat_lengkap'] }}</p>

                    <p class="label">Tahun Berdiri</p>
                    <p>{{ $data['tahun_berdiri'] ? ($data['tahun_berdiri'] ? \Carbon\Carbon::parse($data['tahun_berdiri'])->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') : '-') : '-' }}</p>

                    <p class="label">Nomor Handphone Contact Person</p>
                    <p>{{ $data['nomor_handphone'] }}</p>

                    <p class="label">Alamat Email Perusahaan</p>
                    <p>{{ $data['alamat_email'] ? $data['alamat_email'] : '-' }}</p>

                    <p class="label">Bidang Usaha</p>
                    @if($data['bidang_usaha'] == 'lainnya')
                        <p>{{ ucfirst($data['bidang_usaha_lain']) }}</p>
                    @else
                        <p>{{ strtoupper(str_replace('_', ' ', $data['bidang_usaha'])) }}</p>
                    @endif

                    <p class="label">Nomor NPWP</p>
                    <p>{{ $data['nomor_npwp'] }}</p>

                    <p class="label">Alamat NPWP</p>
                    <p>{{ $data['alamat_npwp'] }}</p>
                    
                    <p class="label">Email Khusus Untuk Faktur Pajak</p>
                    <p>{{ $data['email_khusus_faktur_pajak'] ? $data['email_khusus_faktur_pajak'] : '-' }}</p>
                </div>
                <div class="column">
                    <p class="label">Nama Group Perusahaan</p>
                    <p>{{ $data['nama_perusahaan'] }}</p>

                    <p class="label">Alamat Group Perusahaan</p>
                    <p>{{ $data['alamat_group_lengkap'] }}</p>

                    <p class="label">Kota / Kabupaten</p>
                    <p>{{ $data['kota_kabupaten'] }}</p>
                    
                    <p class="label">Lama Usaha (Tahun)</p>
                    <p>{{ $data['lama_usaha'] ? $data['lama_usaha'].' tahun' : '-' }}</p>

                    <p class="label">Status Kepemilikan Tempat Usaha</p>
                    @if($data['status_kepemilikan'] == 'group')
                        <p>{{ ucfirst($data['nama_group']) }}</p>
                    @else
                        <p>{{ str_replace("_", ' ', ucfirst($data['status_kepemilikan'])) }}</p>
                    @endif

                    <p class="label">Jenis Badan Usaha</p>
                    <p>{{ strtoupper($data['badan_usaha']) }}</p>

                    <p class="label">Nama NPWP</p>
                    <p>{{ $data['nama_npwp'] }}</p>

                    <p class="label">Kota Sesuai NPWP</p>
                    <p>{{ $data['kota_npwp'] }}</p>

                    <p class="label">Status Pengusaha Kena Pajak (PKP)</p>
                    <p>{{ str_replace("_", " ", strtoupper($data['status_pkp'])) }}</p>

                    <p class="label">Nomor Aktif Untuk Faktur Pajak</p>
                    <p>{{ $data['nomor_whatsapp'] ? $data['nomor_whatsapp'] : '-' }}</p>
                </div>
            </div>

            @if($data['cabang'])
                <hr>
                <h3>Cabang</h3>
                <div class="row" style="margin-bottom: 20px;">
                    @forelse($data['cabang'] as $key => $value)
                        <div class="column">
                            <p class="label">NITKU</p>
                            <p>{{ $value['nitku'] ? $value['nitku'] : '-' }}</p>

                            <p class="label">Nama Cabang</p>
                            <p>{{ $value['nama'] ? $value['nama'] : '-' }}</p>
                        </div>
                        <div class="column">
                            <p class="label">Alamat NITKU</p>
                            <p>{{ $value['alamat'] ? $value['alamat'] : '-' }}</p>
                        </div>
                    @empty
                        <div class="column">
                            <p class="label">NITKU</p>
                            <p>-</p>

                            <p class="label">Nama Cabang</p>
                            <p>-</p>
                        </div>
                        <div class="column">
                            <p class="label">Alamat NITKU</p>
                            <p>-</p>
                        </div>
                    @endforelse
                </div>
            @endif

            <hr>

            <h3>INFORMASI BANK</h3>
            <div class="row" style="margin-bottom: 20px;">
                <div class="column">
                    <p class="label">Nomor Rekening</p>
                    <p>{{ $data['informasi_bank']['nomor_rekening'] }}</p>

                    <p class="label">Nama Bank</p>
                    <p>{{ $data['informasi_bank']['nama_bank'] }}</p>
                </div>
                <div class="column">
                    <p class="label">Nama Rekening</p>
                    <p>{{ $data['informasi_bank']['nama_rekening'] }}</p>

                    <p class="label">Pemilik Rekening</p>
                    <p>{{ $data['informasi_bank']['rekening_lain'] ? str_replace('_', ' ', ucwords($data['informasi_bank']['rekening_lain'])) : str_replace("_", " ", ucwords($data['informasi_bank']['status'])) }}</p>
                </div>
            </div>

            <hr>
            {{-- <div class="break"></div> --}}
            
            <h3>DATA IDENTITAS PENANGGUNG JAWAB</h3>
            <div class="row">
                <div class="column">
                    <p class="label">Nama Penanggung Jawab</p>
                    <p>{{ $data['data_identitas'] ? $data['data_identitas']['nama'] : '-' }}</p>

                    <p class="label">Identitas Penanggung Jawab</p>
                    <p>{{ $data['data_identitas'] ? strtoupper($data['data_identitas']['identitas']) : '-' }}</p>
                </div>
                <div class="column">
                    <p class="label">Jabatan</p>
                    <p>{{ $data['data_identitas'] ? $data['data_identitas']['jabatan'] : '-' }}</p>

                    <div class="content-ttd">
                        <p class="label">Penanggung Jawab</p>
                        <br><br><br><br>
                        <p>______________________</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="break"></div>
    <div class="lampiran container">
        <div class="content-header">
            <h2>Lampiran</h2>
        </div>
    </div>
</body>
</html>