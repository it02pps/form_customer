<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Form Customer</title>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        {{-- Bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        {{-- Select2 --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        {{-- Sweetalert2 --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <style>
            body {
                padding: 30px 0;
            }

            table {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0 10px;
            }

            table tr input, table tr textarea {
                border-radius: 5px;
                width: 100%;
                border: 1px solid #1C4A9C;
                padding: 0 10px;
            }

            .content-body {
                border: 2px solid #1C4A9C;
                border-radius: 8px;
                width: 80%;
                height: auto;
                padding: 25px 35px;
                margin-left: auto;
                margin-right: auto;
            }

            .content-footer {
                
            }

            hr {
                border-top: 2px solid #1C4A9C;
                opacity: 1;
            }

            @media screen only and (max-width: 384px) {
                .content-body {
                    /* border: 2px solid #1C4A9C; */
                    border-radius: 8px;
                    width: 1000px;
                    height: auto;
                    padding: 25px 35px;
                    margin-left: auto;
                    margin-right: auto;
                }
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="content-header text-center mb-4">
            <h2>FORMULIR DATA CUSTOMER PT PAPASARI</h2>
        </div>

        <div class="content-body">
            <table>
                <tr>
                    <th width="20%">Nama</th>
                    <td width="5%">:</td>
                    <td width="75%">
                        <input type="text" value="{{ $perusahaan['nama_perusahaan'] }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>Nama Group Perusahaan</th>
                    <td>:</td>
                    <td>
                        <input type="text" value="{{ $perusahaan['nama_group_perusahaan'] }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th valign="top">Alamat Lengkap</th>
                    <td valign="top">:</td>
                    <td>
                        <textarea cols="30" rows="3" readonly>{{ $perusahaan['alamat_lengkap'] }}</textarea>
                    </td>
                </tr>
                <tr>
                    <th>Bidang Usaha</th>
                    <td>:</td>
                    <td>
                        <input type="text" value="{{ $perusahaan['bidang_usaha'] }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>Tahun Berdiri</th>
                    <td>:</td>
                    <td>
                        <input type="text" value="{{ \Carbon\Carbon::parse($perusahaan['tahun_berdiri'])->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>Lama Usaha (Tahun)</th>
                    <td>:</td>
                    <td>
                        <input type="text" value="{{ $perusahaan['lama_usaha'] }} tahun" readonly>
                    </td>
                </tr>
                <tr>
                    <th>Nomor Handphone</th>
                    <td>:</td>
                    <td>
                        <input type="text" value="{{ $perusahaan['nomor_handphone'] }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>:</td>
                    <td>
                        <input type="text" value="{{ $perusahaan['alamat_email'] }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>Status Kepemilikan</th>
                    <td>:</td>
                    <td>
                        <input type="text" value="{{ \Str::replace('_', ' ', ucwords($perusahaan['status_kepemilikan'])) }}" readonly>
                    </td>
                </tr>
            </table>
            <hr>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <table>
                        <tr>
                            <th width="20%">Nama Penanggung Jawab</th>
                            <td width="5%">:</td>
                            <td width="75%">
                                <input type="text" value="{{ $penanggung_jawab['nama'] }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td>:</td>
                            <td>
                                <input type="text" value="{{ $penanggung_jawab['jabatan'] }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>Identitas</th>
                            <td>:</td>
                            <td>
                                <input type="text" value="{{ strtoupper($perusahaan['identitas']) }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th valign="top">Foto Identitas</th>
                            <td valign="top">:</td>
                            <td>
                                <img src="/uploads/penanggung_jawab/{{ $penanggung_jawab['foto'] }}" alt="Foto KTP" width="30%" class="rounded">
                            </td>
                        </tr>
                        <tr>
                            <th>Nomor Rekening</th>
                            <td>:</td>
                            <td>
                                <input type="text" value="{{ $bank['nomor_rekening'] }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>Nama Rekening</th>
                            <td>:</td>
                            <td>
                                <input type="text" value="{{ $bank['nama_rekening'] }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>Status Rekening</th>
                            <td>:</td>
                            <td>
                                <input type="text" value="{{ \Str::replace('_', ' ', ucwords($bank['status'])) }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>Nama Bank</th>
                            <td>:</td>
                            <td>
                                <input type="text" value="{{ $bank['nama_bank'] }}" readonly>
                            </td>
                        </tr>
                        @if($perusahaan['identitas'] == 'npwp')
                            <tr>
                                <th>Tanda Tangan</th>
                                <td>:</td>
                                <td>
                                    <input type="text" value="foto">
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <table>
                        @if($perusahaan['identitas'] == 'ktp')
                            <tr>
                                <th width="20%">Nama KTP</th>
                                <td width="5%">:</td>
                                <td width="75%">
                                    <input type="text" value="{{ $perusahaan['nama_lengkap'] }}" readonly>
                                </td>
                            </tr>
                            <tr>
                                <th>Nomor KTP</th>
                                <td>:</td>
                                <td>
                                    <input type="text" value="{{ $perusahaan['nomor_ktp'] }}" readonly>
                                </td>
                            </tr>
                            <tr>
                                <th valign="top">Foto KTP</th>
                                <td valign="top">:</td>
                                <td>
                                    <img src="/uploads/identitas_perusahaan/{{ $perusahaan['foto_ktp'] }}" alt="Foto KTP" width="30%" class="rounded">
                                </td>
                            </tr>
                            <tr>
                                <th valign="top">Tanda Tangan</th>
                                <td valign="top">:</td>
                                <td>
                                    <textarea name="" id="" cols="30" rows="4"></textarea>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <th>Nomor NPWP</th>
                                <td>:</td>
                                <td>
                                    <input type="text" value="{{ $perusahaan['nomor_npwp'] }}" readonly>
                                </td>
                            </tr>
                            <tr>
                                <th>Nama NPWP</th>
                                <td>:</td>
                                <td>
                                    <input type="text" value="{{ $perusahaan['nama_npwp'] }}" readonly>
                                </td>
                            </tr>
                            <tr>
                                <th>Badan Usaha</th>
                                <td>:</td>
                                <td>
                                    <input type="text" value="{{ $perusahaan['badan_usaha'] }}" readonly>
                                </td>
                            </tr>
                            <tr>
                                <th>Foto NPWP</th>
                                <td>:</td>
                                <td>
                                    <input type="text" value="foto" readonly>
                                </td>
                            </tr>
                            @if($perusahaan['status_pkp'] == 'pkp')
                                <tr>
                                    <th>Foto SPPKP</th>
                                    <td>:</td>
                                    <td>
                                        <img src="/uploads/identitas_perusahaan/{{ $perusahaan['sppkp'] }}" alt="Foto KTP" width="30%" class="rounded">
                                    </td>
                                </tr>
                            @endif
                        @endif
                    </table>
                </div>
            </div>
        </div>

        <div class="content-footer mt-2">
            <button type="button" class="btn btn-primary waves-effect waves-light rounded btn-md" id="update_customer" title="Edit Data Customer">Edit Data Customer</button>
        </div>

        <script>
            $(document).ready(function() {

            });
        </script>
    </body>
</html>