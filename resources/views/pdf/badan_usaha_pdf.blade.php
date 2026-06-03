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

        p {
            font-size: 14px;
        }

        #logo img {
            width: 30%;
        }

        .container {
            margin-top: 20px;
        }

        #header {
            line-height: 0px;
        }
        
        .dotted-line {
            border: none;
            border-top: 1px dotted #000;
            height: 1px;
        }

        #bodyTable {
            width: 100%;
            border-collapse: collapse;
        }

        #bodyTable tr td {
            padding: 3px 0;
            vertical-align: top;
            font-size: 14px;
        }

        #bodyTable tr td:nth-child(1) {
            width: 30%;
        }

        #bodyTable tr td:nth-child(2) {
            width: 3%;
        }
    </style>
</head>
<body>
    <div id="logo">
        <img src="{{ public_path('images/PNG 4125 x 913.png') }}">
    </div>

    <div class="container">
        <div id="header">
            <h2>FORMULIR DATA CUSTOMER</h2>
            <p>Dibuat pada : {{ \Carbon\Carbon::now()->locale('id')->settings(['formatFunction' => 'translatedFormat'])->isoFormat('D MMMM YYYY') }}</p>
        </div>
        <hr class="dotted-line">
        <div id="body">
            <div class="subBody">
                <h2 style="margin-bottom: 10px; margin-top: 0;">IDENTITAS PERUSAHAAN</h2>
                <table id="bodyTable">
                    <tr>
                        <td>Nama Perusahaan</td>
                        <td>:</td>
                        <td>{{ $data['nama_perusahaan'] }}</td>
                    </tr>
                    <tr>
                        <td>Alamat Lengkap Perusahaan</td>
                        <td>:</td>
                        <td>{{ $data['alamat_lengkap'] }}</td>
                    </tr>
                    <tr>
                        <td>Nama Group Perusahaan</td>
                        <td>:</td>
                        <td>{{ $data['nama_group_perusahaan'] }}</td>
                    </tr>
                    <tr>
                        <td>Alamat Group Perusahaan</td>
                        <td>:</td>
                        <td>{{ $data['alamat_group_lengkap'] }}</td>
                    </tr>
                    <tr>
                        <td>Kota / Kabupaten</td>
                        <td>:</td>
                        <td>{{ $data['kota_kabupaten'] }}</td>
                    </tr>
                    <tr>
                        <td>Tahun Berdiri</td>
                        <td>:</td>
                        <td>{{ strtoupper(\Carbon\Carbon::parse($data['tahun_berdiri'])->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d F Y')) ?: '-' }}</td>
                    </tr>
                    <tr>
                        <td>Lama Usaha</td>
                        <td>:</td>
                        <td>{{ $data['lama_usaha'] ? $data['lama_usaha'] . ' tahun' : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Bidang Usaha</td>
                        <td>:</td>
                        <td>{{ ucfirst($data['bidang_usaha_lain']) ?: strtoupper(str_replace('_', ' ', $data['bidang_usaha'])) }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Badan Usaha</td>
                        <td>:</td>
                        <td>{{ strtoupper($data['badan_usaha']) }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Telepon</td>
                        <td>:</td>
                        <td>{{ $data['nomor_handphone'] }}</td>
                    </tr>
                    <tr>
                        <td>Alamat Email</td>
                        <td>:</td>
                        <td>{{ $data['alamat_email'] ?: '-' }}</td>
                    </tr>
                    <tr>
                        <td>Bidang Usaha</td>
                        <td>:</td>
                        <td>{{ $data['bidang_usaha'] === 'lainnya' ? ucfirst($data['bidang_usaha_lain']) : strtoupper(str_replace('_', ' ', $data['bidang_usaha'])) }}</td>
                    </tr>
                    <tr>
                        <td>Kepemilikan Tempat Usaha</td>
                        <td>:</td>
                        <td>{{ $data['status_kepemilikan'] === 'group' ? strtoupper($data['nama_group']) : str_replace("_", ' ', strtoupper($data['status_kepemilikan'])) }}</td>
                    </tr>
                </table>
            </div>
            <div class="subBody">
                <h2 style="margin-bottom: 10px;">IDENTITAS PEMILIK USAHA</h2>
                <table id="bodyTable">
                    <tr>
                        <td>Nomor NPWP</td>
                        <td>:</td>
                        <td>{{ $data['nomor_npwp'] }}</td>
                    </tr>
                    <tr>
                        <td>Nama NPWP</td>
                        <td>:</td>
                        <td>{{ $data['nama_npwp'] }}</td>
                    </tr>
                    <tr>
                        <td>Alamat NPWP</td>
                        <td>:</td>
                        <td>{{ $data['alamat_npwp'] }}</td>
                    </tr>
                    <tr>
                        <td>Kota Sesuai NPWP</td>
                        <td>:</td>
                        <td>{{ $data['kota_npwp'] }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Aktif Untuk Faktur Pajak</td>
                        <td>:</td>
                        <td>{{ $data['nomor_whatsapp'] ?: '-' }}</td>
                    </tr>
                    <tr>
                        <td>Email Untuk Faktur Pajak</td>
                        <td>:</td>
                        <td>{{ $data['email_khusus_faktur_pajak'] ?: '-' }}</td>
                    </tr>
                </table>
            </div>
            <div class="subBody">
                <h2 style="margin-bottom: 10px;">INFORMASI BANK</h2>
                <table id="bodyTable">
                    <tr>
                        <td>Nomor Rekening</td>
                        <td>:</td>
                        <td>{{ $data['informasi_bank']['nomor_rekening'] }}</td>
                    </tr>
                    <tr>
                        <td>Nama Rekening</td>
                        <td>:</td>
                        <td>{{ $data['informasi_bank']['nama_rekening'] }}</td>
                    </tr>
                    <tr>
                        <td>Nama Bank</td>
                        <td>:</td>
                        <td>{{ $data['informasi_bank']['nama_bank'] }}</td>
                    </tr>
                    <tr>
                        <td>Pemilik Rekening</td>
                        <td>:</td>
                        <td>{{ str_replace('_', ' ', strtoupper($data['informasi_bank']['rekening_lain'])) ?: str_replace("_", " ", strtoupper($data['informasi_bank']['status'])) }}</td>
                    </tr>
                    <tr>
                        <td>Nama Finance</td>
                        <td>:</td>
                        <td>{{ $data['data_finance']['nama'] }}</td>
                    </tr>
                    <tr>
                        <td>No Hp Finance</td>
                        <td>:</td>
                        <td>{{ $data['data_finance']['no_hp'] }}</td>
                    </tr>
                    <tr>
                        <td>Email Finance</td>
                        <td>:</td>
                        <td>{{ $data['data_finance']['email'] }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>