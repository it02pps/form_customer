<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?php echo e(asset('images/Vertical PNG 977 x 1188 px.png')); ?>">

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
            margin-top: 30px;
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
                    <p class="label">Jenis Customer</p>
                    <?php if($data['status_cust'] == 'lama'): ?>
                        <p>Customer Lama</p>
                    <?php else: ?>
                        <p>Customer Baru</p>
                    <?php endif; ?>

                    <p class="label">Nama Group Perusahaan</p>
                    <p><?php echo e($data['nama_group_perusahaan']); ?></p>

                    <p class="label">Alamat Lengkap Perusahaan</p>
                    <p><?php echo e($data['alamat_lengkap']); ?></p>

                    <p class="label">Tahun Berdiri</p>
                    <p><?php echo e($data['tahun_berdiri'] ? ($data['tahun_berdiri'] ? \Carbon\Carbon::parse($data['tahun_berdiri'])->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') : '-') : '-'); ?></p>

                    <p class="label">Alamat Email Perusahaan</p>
                    <p><?php echo e($data['alamat_email'] ? $data['alamat_email'] : '-'); ?></p>

                    <p class="label">Bidang Usaha</p>
                    <?php if($data['bidang_usaha'] == 'lainnya'): ?>
                        <p><?php echo e(ucfirst($data['bidang_usaha_lain'])); ?></p>
                    <?php else: ?>
                        <p><?php echo e(strtoupper(str_replace('_', ' ', $data['bidang_usaha']))); ?></p>
                    <?php endif; ?>

                    <?php if($data['identitas'] == 'ktp'): ?>
                        <p class="label">Foto KTP</p>
                        <p>Lampiran KTP</p>
                    <?php else: ?>
                        <p class="label">Nomor NPWP</p>
                        <p><?php echo e($data['nomor_npwp']); ?></p>

                        <p class="label">NITKU untuk penerbitan Faktur Pajak</p>
                        <p><?php echo e($data['nitku'] ? $data['nitku'] : '-'); ?></p>
    
                        <p class="label">Alamat NPWP</p>
                        <p><?php echo e($data['alamat_npwp']); ?></p>
                        
                        <p class="label">Email Khusus Untuk Faktur Pajak</p>
                        <p><?php echo e($data['email_khusus_faktur_pajak']); ?></p>
                    <?php endif; ?>
                </div>
                <div class="column">
                    <p class="label">Nama Perusahaan</p>
                    <p><?php echo e($data['nama_perusahaan']); ?></p>

                    <p class="label">Nomor Handphone Contact Person</p>
                    <p><?php echo e($data['nomor_handphone']); ?></p>

                    <p class="label">Kota / Kabupaten</p>
                    <p><?php echo e($data['kota_kabupaten']); ?></p>
                    
                    <p class="label">Lama Usaha (Tahun)</p>
                    <p><?php echo e($data['lama_usaha'] ? $data['lama_usaha'].' tahun' : '-'); ?></p>

                    <p class="label">Status Kepemilikan Tempat Usaha</p>
                    <?php if($data['status_kepemilikan'] == 'group'): ?>
                        <p><?php echo e(ucfirst($data['nama_group'])); ?></p>
                    <?php else: ?>
                        <p><?php echo e(str_replace("_", ' ', ucfirst($data['status_kepemilikan']))); ?></p>
                    <?php endif; ?>

                    <?php if($data['identitas'] == 'ktp'): ?>
                        <p class="label">Nomor KTP</p>
                        <p><?php echo e($data['nomor_ktp']); ?></p>

                        <p class="label">Nama Lengkap Sesuai Identitas</p>
                        <p><?php echo e($data['nama_lengkap']); ?></p>
                    <?php else: ?>
                        <p class="label">Nama NPWP</p>
                        <p><?php echo e($data['nama_npwp']); ?></p>

                        <p class="label">Foto NPWP</p>
                        <?php if(!$data['foto_npwp']): ?>
                            <p>-</p>
                        <?php else: ?>
                            <p>Lampiran NPWP</p>
                        <?php endif; ?>

                        <p class="label">Kota Sesuai NPWP</p>
                        <p><?php echo e($data['kota_npwp']); ?></p>

                        <p class="label">Status Pengusaha Kena Pajak (PKP)</p>
                        <p><?php echo e(str_replace("_", " ", strtoupper($data['status_pkp']))); ?></p>

                        <?php if($data['status_pkp'] == 'pkp'): ?>
                            <p class="label">Foto SPPKP</p>
                            <?php if(!$data['sppkp']): ?>
                                <p>-</p>
                            <?php else: ?>
                                <p>Lampiran SPPKP</p>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <?php if($data['cabang']): ?>
                <hr>
                <h3>Cabang</h3>
                <div class="row" style="margin-bottom: 20px;">
                    <?php $__empty_1 = true; $__currentLoopData = $data['cabang']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="column">
                            <p class="label">NITKU</p>
                            <p><?php echo e($value['nitku'] ? $value['nitku'] : '-'); ?></p>

                            <p class="label">Nama Cabang</p>
                            <p><?php echo e($value['nama'] ? $value['nama'] : '-'); ?></p>
                        </div>
                        <div class="column">
                            <p class="label">Alamat NITKU</p>
                            <p><?php echo e($value['alamat'] ? $value['alamat'] : '-'); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
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
                    <?php endif; ?>
                </div>
            <?php endif; ?>

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

                        <?php if($data['data_identitas']['foto']): ?>
                            <p>Lampiran Penanggung Jawab</p>
                        <?php else: ?>
                            <p>-</p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="label">Foto</p>
                        <p>-</p>
                    <?php endif; ?>

                    
                    <div class="content-ttd">
                        <p>Penanggung Jawab</p>
                        
                        <img src="uploads/ttd/<?php echo e($data['data_identitas']['ttd']); ?>" alt="" style="width: 70%;">
                        <p>______________________</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html><?php /**PATH D:\laragon\www\form_customer\resources\views/pdf/perseorangan_pdf.blade.php ENDPATH**/ ?>