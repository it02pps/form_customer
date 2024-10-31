<?php $__env->startSection('title'); ?>
<title>Detail Data Customer | PT Papasari</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">

        <div class="content-header text-center mb-4">
            <h2>DETAIL DATA CUSTOMER</h2>
        </div>
        <div class="content-body">
            <div class="section1 mb-4">
                <h4>IDENTITAS PERSEORANGAN</h4>
                <div class="section1-body">
                    <div class="row mb-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Merk Usaha</label>
                                <p><?php echo e($data['nama_perusahaan']); ?></p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Group Usaha</label>
                                <p><?php echo e($data['nama_group_perusahaan']); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Alamat Lengkap</label>
                                <p><?php echo e($data['alamat_lengkap']); ?></p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group mb-2">
                                <label for="">Kota / Kabupaten</label>
                                <p><?php echo e($data['kota_kabupaten']); ?></p>
                            </div>
                            <div class="form-gorup">
                                <label for="">Kecamatan</label>
                                <p><?php echo e($data['kecamatan']); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Alamat Email Tempat Usaha</label>
                                <p><?php echo e($data['alamat_email']); ?></p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nomor Handphone Contact Person</label>
                                <p><?php echo e($data['nomor_handphone']); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Tahun Berdiri</label>
                                <p><?php echo e($data['tahun_berdiri'] ? \Carbon\Carbon::parse($data['tahun_berdiri'])->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') : '-'); ?></p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Lama Usaha (Tahun)</label>
                                <p><?php echo e($data['lama_usaha'] ? $data['lama_usaha'] . ' tahun' : '-'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Bidang Usaha</label>
                                <p><?php echo e(str_replace('_', ' ', strtoupper($data['bidang_usaha']))); ?></p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <label for="">Status Kepemilikan Tempat Usaha</label>
                            <p><?php echo e(str_replace("_", ' ', ucwords($data['status_kepemilikan']))); ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group mb-2">
                            <label for="">Identitas Pemilik Perusahaan</label>
                            <p><?php echo e(strtoupper($data['identitas'])); ?></p>
                        </div>
                    </div>
                    
                    <?php if($data['identitas'] == 'ktp'): ?>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ktp-section">
                            <div class="form-group mb-2">
                                <label for="">Nama Lengkap</label>
                                <p><?php echo e($data['nama_lengkap']); ?></p>
                            </div>
                        </div>
                        <div class="ktp-section">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="">Nomor KTP</label>
                                    <p><?php echo e($data['nomor_ktp']); ?></p>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="">Foto KTP</label>
    
                                    <div id="preview_ktp" class="<?php if($data['identitas'] != 'ktp'): ?> d-none <?php endif; ?>">
                                        <?php if(str_contains($data['foto_ktp'], '.pdf')): ?>
                                        <div id="preview_ktp" style="cursor: pointer;" onclick="preview_pdf('<?php echo e(asset('uploads/identitas_perusahaan/'.$data['foto_ktp'])); ?>')">
                                            <img src="<?php echo e(asset('images/pdf.png')); ?>" style="width: 20% !important; height: auto;">
                                            <span>Click to preview</span>
                                        </div>
                                        <?php else: ?>
                                            <img id="preview_foto_ktp" src="<?php echo e(asset('uploads/identitas_perusahaan/'.$data['foto_ktp'])); ?>" data-action="zoom">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 npwp-section">
                            <div class="form-group mb-4">
                                <label for="">Jenis Badan Usaha</label>
                                <p><?php echo e(strtoupper($data['badan_usaha'])); ?></p>
                            </div>
                        </div>
                        <div class="npwp-section">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nomor NPWP</label>
                                        <p><?php echo e($data['nomor_npwp']); ?></p>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="">Nama NPWP</label>
                                        <p><?php echo e($data['nama_npwp']); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="">Alamat NPWP</label>
                                        <p><?php echo e($data['alamat_npwp']); ?></p>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="">Email Khusus Untuk Faktur Pajak</label>
                                        <p><?php echo e($data['email_khusus_faktur_pajak']); ?></p>
                                    </div>
    
                                    <div class="form-group mb-3">
                                        <label for="">Status Pengusaha Kena Pajak (PKP)</label>
                                        <p><?php echo e(str_replace("_", " ", strtoupper($data['status_pkp']))); ?></p>
                                    </div>
    
                                    <div class="form-group mb-4 <?php if($data['status_pkp'] !=  'pkp'): ?> d-none <?php endif; ?>" id="sppkp-section">
                                        <label for="">Foto SPPKP</label>
    
                                        <div id="preview_sppkp">
                                            <?php if(str_contains($data['sppkp'], '.pdf')): ?>
                                                <div id="preview_ktp" style="cursor: pointer;" onclick="preview_pdf('<?php echo e(asset('uploads/identitas_perusahaan/'.$data['sppkp'])); ?>')">
                                                    <img src="<?php echo e(asset('images/pdf.png')); ?>" style="width: 20% !important; height: auto;">
                                                    <span>Click to preview</span>
                                                </div>
                                            <?php else: ?>
                                                <img id="preview_foto_sppkp" src="<?php echo e(asset('uploads/identitas_perusahaan/'.$data['sppkp'])); ?>" data-action="zoom">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="">Kota sesuai NPWP</label>
                                        <p><?php echo e($data['kota_npwp']); ?></p>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Foto NPWP</label>
                                    </div>
    
                                    <div id="preview_npwp" class="<?php if($data['identitas'] != 'npwp'): ?> d-none <?php endif; ?>">
                                        <?php if(str_contains($data['foto_npwp'], '.pdf')): ?>
                                            <div id="preview_ktp" style="cursor: pointer;" onclick="preview_pdf('<?php echo e(asset('uploads/identitas_perusahaan/'.$data['foto_npwp'])); ?>')">
                                                <img src="<?php echo e(asset('images/pdf.png')); ?>" style="width: 20% !important; height: auto;">
                                                <span>Click to preview</span>
                                            </div>
                                        <?php else: ?>
                                            <img id="preview_foto_npwp" src="<?php echo e(asset('uploads/identitas_perusahaan/'.$data['foto_npwp'])); ?>" data-action="zoom">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

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
                                <p><?php echo e($data['informasi_bank']['nomor_rekening']); ?></p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Rekening</label>
                                <p><?php echo e($data['informasi_bank']['nama_rekening']); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Bank</label>
                                <p><?php echo e($data['informasi_bank']['nama_bank']); ?></p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Pemilik Rekening</label>
                                <?php if(!$data['informasi_bank']['rekening_lain']): ?>
                                    <p><?php echo e(str_replace("_", " ", ucwords($data['informasi_bank']['status']))); ?></p>
                                <?php else: ?>
                                    <p><?php echo e(str_replace('_', ' ', ucwords($data['informasi_bank']['rekening_lain']))); ?></p>
                                <?php endif; ?>
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
                                <p><?php echo e($data['data_identitas'] ? ($data['data_identitas']['nama'] ? $data['data_identitas']['nama'] : '-') : '-'); ?></p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Jabatan</label>
                                <p><?php echo e($data['data_identitas'] ? ($data['data_identitas']['jabatan'] ? $data['data_identitas']['jabatan'] : '-') : '-'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group mb-2">
                                <label for="">Identitas Penanggung Jawab</label>
                                <p><?php echo e($data['data_identitas'] ? ($data['data_identitas']['identitas'] ? strtoupper($data['data_identitas']['identitas']) : '-') : '-'); ?></p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group mb-2" id="penanggung_ktp">
                                <label for="">Foto KTP</label>

                                <?php if($data['data_identitas']): ?>
                                    <?php if($data['data_identitas']['foto']): ?>
                                        <div id="preview_ktp_penanggung" class="<?php if($data['data_identitas']): ?> <?php if($data['data_identitas']['identitas'] != 'ktp'): ?> d-none <?php endif; ?> <?php endif; ?>">
                                            <?php if(str_contains($data['data_identitas']['foto'], '.pdf')): ?>
                                                <div id="preview_ktp" style="cursor: pointer;" onclick="preview_pdf('<?php echo e(asset('uploads/penanggung_jawab/'.$data['data_identitas']['foto'])); ?>')">
                                                    <img src="<?php echo e(asset('images/pdf.png')); ?>" style="width: 20% !important; height: auto;">
                                                    <span>Click to preview</span>
                                                </div>
                                            <?php else: ?>
                                                <img id="preview_foto_ktp_penanggung" src="<?php echo e(asset('uploads/penanggung_jawab/'.$data['data_identitas']['foto'])); ?>" data-action="zoom">
                                            <?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <p>-</p>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <p>-</p>
                                <?php endif; ?>
                            </div>

                            <div class="form-group <?php if($data['data_identitas']): ?> <?php if($data['data_identitas']['identitas'] != 'npwp'): ?> d-none <?php endif; ?> <?php else: ?> d-none <?php endif; ?>" id="penanggung_npwp">
                                <label for="">Foto NPWP</label>

                                <?php if($data['data_identitas']): ?>
                                    <div id="preview_npwp_penanggung" class="d-none">
                                        <?php if(str_contains($data['data_identitas']['foto'], '.pdf')): ?>
                                            <div id="preview_ktp" style="cursor: pointer;" onclick="preview_pdf('<?php echo e(asset('uploads/penanggung_jawab/'.$data['data_identitas']['foto'])); ?>')">
                                                <img src="<?php echo e(asset('images/pdf.png')); ?>" style="width: 20% !important; height: auto;" alt="PDF">
                                                <span>Click to preview</span>
                                            </div>
                                        <?php else: ?>
                                            <img id="preview_foto_npwp_penanggung" src="<?php echo e(asset('uploads/penanggung_jawab/'.$data['data_identitas']['foto'])); ?>" data-action="zoom">
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <p>-</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($data['data_identitas']): ?>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        
                        <div class="">
                            <label for="">Tanda Tangan</label>
                            <?php if($data['data_identitas'] && $data['data_identitas']['ttd']): ?>
                                <div id="signature">
                                    <img src="<?php echo e(asset('uploads/ttd/'.$data['data_identitas']['ttd'])); ?>" style="width: 100%;" data-action="zoom">
                                </div>
                            <?php else: ?>
                                <p>-</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="content-footer mt-2">
            <button type="button" class="btn btn-danger btn-md waves-effect waves-light rounded" onclick="back()">Back</button>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        function preview_pdf(that) {
            window.open(that,'_blank');
        }

        function back() {
            window.location.href = '/internal/panel';
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Other\laragon\www\FormCustomer\resources\views/user/home_detail_perseorangan.blade.php ENDPATH**/ ?>