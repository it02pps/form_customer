<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?php echo e(asset('images/Vertical PNG 977 x 1188 px.png')); ?>">

    <title>PDF | PT Papasari</title>

    <style>
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
            margin-top: 30px;
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
                    <p class="label">Nama Perusahaan</p>
                    <p><?php echo e($data['nama_perusahaan']); ?></p>

                    <p class="label">Alamat Lengkap</p>
                    <p><?php echo e($data['alamat_lengkap']); ?></p>

                    <p class="label">Alamat Email Koresponden</p>
                    <p><?php echo e($data['alamat_email']); ?></p>

                    <p class="label">Tahun Berdiri</p>
                    <p><?php echo e($data['tahun_berdiri'] ? ($data['tahun_berdiri'] ? \Carbon\Carbon::parse($data['tahun_berdiri'])->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') : '-') : '-'); ?></p>

                    <p class="label">Bidang Usaha</p>
                    <p><?php echo e(strtoupper(str_replace('_', ' ', $data['bidang_usaha']))); ?></p>

                    <p class="label">Identitas Pemilik Usaha</p>
                    <p><?php echo e(strtoupper($data['identitas'])); ?></p>
                    
                    <p class="label">Jenis Badan Usaha</p>
                    <p><?php echo e(strtoupper($data['badan_usaha'])); ?></p>

                    <p class="label">Nama NPWP</p>
                    <p><?php echo e($data['nama_npwp']); ?></p>

                    <p class="label">Email Khusus Untuk Faktur Pajak</p>
                    <p><?php echo e($data['email_khusus_faktur_pajak']); ?></p>

                    <p class="label">Kota Sesuai NPWP</p>
                    <p><?php echo e($data['kota_npwp']); ?></p>

                    <p class="label">Status Pengusaha Kena Pajak (PKP)</p>
                    <p><?php echo e(str_replace("_", " ", strtoupper($data['status_pkp']))); ?></p>

                    <?php if($data['status_pkp'] == 'pkp'): ?>
                        <p class="label">Foto SPPKP</p>
                        <img id="preview_foto_sppkp" src="uploads/identitas_perusahaan/<?php echo e($data['sppkp']); ?>" alt="Preview" width="60%" style="margin-top: 5px; aspect-ratio: 16 / 9">
                    <?php endif; ?>
                </div>
                <div class="column">
                    <p class="label">Nama Group Perusahaan</p>
                    <p><?php echo e($data['nama_group_perusahaan']); ?></p>

                    <p class="label">Kota / Kabupaten</p>
                    <p><?php echo e($data['kota_kabupaten']); ?></p>

                    <p class="label">Kecamatan</p>
                    <p><?php echo e($data['kecamatan']); ?></p>

                    <p class="label">Lama Usaha (Tahun)</p>
                    <p><?php echo e($data['lama_usaha'] ? $data['lama_usaha'].' tahun' : '-'); ?></p>
                    
                    <p class="label">Nomor Handphone Contact Person</p>
                    <p><?php echo e($data['nomor_handphone']); ?></p>

                    <p class="label">Status Kepemilikan Tempat Usaha</p>
                    <p><?php echo e(str_replace("_", ' ', ucwords($data['status_kepemilikan']))); ?></p>

                    <p class="label">Nomor NPWP</p>
                    <p><?php echo e($data['nomor_npwp']); ?></p>

                    <p class="label">Alamat NPWP</p>
                    <p><?php echo e($data['alamat_npwp']); ?></p>

                    <p class="label">Foto NPWP</p>
                    <img src="uploads/identitas_perusahaan/<?php echo e($data['foto_npwp']); ?>" alt="Preview" width="60%" style="margin-top: 5px; aspect-ratio: 16 / 9">
                </div>
            </div>

            <hr>

            <h3>INFORMASI BANK</h3>
            <div class="row" style="margin-bottom: 20px;">
                <div class="column">
                    <p class="label">Nomor Rekening</p>
                    <p><?php echo e($data['informasi_bank']['nomor_rekening']); ?></p>

                    <p class="label">Nama Bank</p>
                    <p><?php echo e($data['informasi_bank']['nama_bank']); ?></p>
                </div>
                <div class="column">
                    <p class="label">Nama Rekening</p>
                    <p><?php echo e($data['informasi_bank']['nama_rekening']); ?></p>

                    <p class="label">Pemilik Rekening</p>
                    <p><?php echo e($data['informasi_bank']['rekening_lain'] ? str_replace('_', ' ', ucwords($data['informasi_bank']['rekening_lain'])) : str_replace("_", " ", ucwords($data['informasi_bank']['status']))); ?></p>
                </div>
            </div>

            <hr>
            
            
            <h3>DATA IDENTITAS PENANGGUNG JAWAB</h3>
            <div class="row">
                <div class="column">
                    <p class="label">Nama Penanggung Jawab</p>
                    <p><?php echo e($data['data_identitas'] ? ($data['data_identitas']['nama'] ? $data['data_identitas']['nama'] : '-') : '-'); ?></p>

                    <p class="label">Identitas Penanggung Jawab</p>
                    <p><?php echo e($data['data_identitas'] ? ($data['data_identitas']['identitas'] ? strtoupper($data['data_identitas']['identitas']) : '-') : '-'); ?></p>
                </div>
                <div class="column">
                    <p class="label">Jabatan</p>
                    <p><?php echo e($data['data_identitas'] ? ($data['data_identitas']['jabatan'] ? $data['data_identitas']['jabatan'] : '-') : '-'); ?></p>

                    <?php if($data['data_identitas']): ?>
                        <?php if($data['data_identitas']['identitas'] == 'ktp'): ?>
                            <p class="label">Foto KTP</p>
                        <?php else: ?>
                            <p class="label">Foto NPWP</p>
                        <?php endif; ?>

                        <?php if($data['data_identitas']['foto'] != null): ?>
                            <img src="uploads/penanggung_jawab/<?php echo e($data['data_identitas']['foto']); ?>" alt="" width="60%" style="margin-top: 5px; aspect-ratio: 16 / 9">
                        <?php else: ?>
                            <p>-</p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="label">Foto</p>
                        <p>-</p>
                    <?php endif; ?>

                    
                    
                    <div class="content-ttd">
                        <p>Penanggung Jawab</p>
                        <br><br><br><br>
                        <p>______________________</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH D:\WEB APP\Form_Customer\form_customer\resources\views/pdf/badan_usaha_pdf.blade.php ENDPATH**/ ?>