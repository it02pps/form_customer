<?php $__env->startSection('title'); ?>
    <title>Detail Data Customer | PT. PAPASARI</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>
    .container {
        padding: 64px 32px;
        overflow-x: hidden;
    }
    
    .container-fluid {
        background-color: #fff;
        border-radius: 16px;
        box-shadow: 2px 2px 20px rgba(0, 0, 0, 0.25);
    }
    
    .content {
        width: 100%;
        padding: 64px 32px;
    }

    .header .logo img {
        height: 96px;
        padding-bottom: 32px;
    }

    .header .profile img {
        height: 72px;
        padding-bottom: 32px;
    }

    .title {
        padding-bottom: 16px;
    }

    .content-body {
        padding: 16px 0;
    }

    .form-group label {
        padding-bottom: 8px;
    }

    .group-column .form-group {
        padding: 0 0 16px 0;
    }

    .content-body .section1, .section2, .section3, .section4 {
        display: flex;
        flex-wrap: wrap;
        row-gap: 16px;
    }

    #ktp-section, #npwp-section {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        width: 100%;
    }

    #preview_ktp, #preview_npwp, #preview_sppkp, #preview_penanggung {
        border: 1px solid #D2D0D8;
        border-radius: 5px;
        height: 271px;
        width: 100%;
        padding: 0;
    }

    #preview_ktp img, #preview_npwp img, #preview_sppkp img, #preview_penanggung img {
        width: 100%;
        height: 269px;
        border-radius: 7px;
    }

    .section1 {
        padding: 0 0 16px 0;
    }
    
    .section2, .section3, .section4 {
        padding: 16px 0;
    }

    .footer {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        gap: 16px;
        width: 100%;
    }

    .btnEditData {
        width: 185px;
        height: 48px;
        border-radius: 8px;
        background-color: #0063ee;
        border: none;
        color: #fff;
    }

    #previewPDF {
        padding: 8px 16px;
        border-radius: 8px;
        background-color: #424242;
        border: none;
        color: #fff;
        text-decoration: none;
    }

    .btnKembali {
        width: 144px;
        height: 48px;
        border-radius: 8px;
        background-color: #E7E6EB;
        border: none;
        color: #000;
    }

    .profile {
        cursor: pointer;
    }

    #preview_penanggung .zoom-img-wrap .zoom-img, #preview_ktp .zoom-img-wrap .zoom-img, #preview_npwp .zoom-img-wrap .zoom-img, #preview_sppkp .zoom-img-wrap .zoom-img {
        width: 100%;
        height: 100%;
        transition: 1s;
    }

    input.form-control:read-only {
        background-color: #f3f3f3;
    }

    textarea.form-control:read-only {
        background-color: #f3f3f3;
    }

    label {
        font-weight: 500;
    }

    .form-group input {
        padding: 16px;
    }

    .form-group textarea {
        padding: 16px;
        height: 164px;
    }

    .btnUploadFile {
        padding: 0 24px;
        height: 48px;
        border-radius: 8px;
        background-color: #0063ee;
        border: none;
        color: #fff;
    }

    .row {
        width: 100vw;
    }

    .row div:first-child {
        padding: 0;
    }

    .row div:last-child {
        padding-left: 16px;
    }

    .row div .group-column .form-group:first-child {
        padding: 0;
    }

    .row div .group-column .form-group:last-child {
        padding-top: 16px;
        padding-left: 0;
    }

    .form-group-modal input {
        padding: 16px;
    }

    .form-group-modal textarea {
        padding: 16px;
    }

    .form-group-modal {
        padding: 0 !important;
    }

    .dynamic-row .row {
        width: 100% !important;
    }

    .group-column-modal {
        display: flex;
        flex-direction: column;
        padding: 0 !important;
        gap: 16px;
    }

    .modal-content {
        padding: 16px;
    }

    #cabang {
        position: relative;
    }

    #cabang button {
        position: absolute;
        right: 0;
        top: 37px;
    }

    .btnDetailCabang {
        padding: 8px 16px;
        border-radius: 8px;
        background-color: #424242;
        border: none;
        color: #fff;
    }

    #signature {
        height: 271px;
        width: 100%;
        border: 1px solid #cccccc;
        border-radius: 7px;
        padding: 0;
    }

    #signature img {
        height: 268px;
        width: 100%;
        border-radius: 7px;
    }

    @media screen and (max-width: 475px) {
        .container {
            padding: 0;
        }
        
        .container-fluid {
            background-color: #fff;
            box-shadow: 2px 2px 20px rgba(0, 0, 0, 0.25);
        }

        .content {
            width: 100%;
            padding: 32px 16px;
        }

        .header .logo img {
            height: 72px;
            padding-bottom: 32px;
        }

        .header .profile img {
            height: 64px;
            padding-bottom: 32px;
        }

        .form-group input {
            width: 100%;
            padding: 16px;
        }

        .form-group textarea {
            height: 165px;
            width: 100%;
        }

        .row {
            gap: 16px;
        }

        .row div {
            padding: 0 !important;
        }

        .footer {
            display: flex;
            justify-content: center;
        }

        #preview_ktp, #preview_npwp, #preview_sppkp, #preview_penanggung {
            border: 1px solid #D2D0D8;
            border-radius: 5px;
            height: 205px;
            width: 333px;
        }

        #preview_ktp img, #preview_npwp img, #preview_sppkp img, #preview_penanggung img {
            width: 330px;
            height: 200px;
            border-radius: 7px;
        }

        #ktp-section, #npwp-section {
            display: inline;
        }

        #signature {
            width: 100%;
            height: 180px;
            border: 1px solid #cccccc;
            border-radius: 7px;
        }

        #signature canvas {
            border-radius: 7px;
            height: 177px !important;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="container-fluid">
            <div class="content">
                <div class="header d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <img src="<?php echo e(asset('../../../images/PNG 4125 x 913.png')); ?>" alt="Logo">
                    </div>
                    <div class="profile">
                        <img id="Edit Profile" src="<?php echo e(asset('../../../images/Profile.svg')); ?>" title="Edit Profile" alt="Profile">
                        <img id="logoutBtn" src="<?php echo e(asset('../../../images/Log Out.png')); ?>" title="Logout" alt="Logout">
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </div>
                <div class="title">
                    <h1>Detail Data Customer</h1>
                </div>
                <hr>
                <div class="content-body">
                    <div class="section1">
                        <h1>Identitas Perseorangan</h1>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Jenis Customer</label>
                                    <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" autocomplete="off" readonly value="<?php echo e(strtoupper($data['status_cust'])); ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Sales</label>
                                    <input type="text" name="nama_sales" id="nama_sales" class="form-control" autocomplete="off" readonly value="<?php echo e($data['nama_sales']); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="group-column">
                                    <div class="form-group">
                                        <label for="">Nama Usaha</label>
                                        <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" autocomplete="off" readonly value="<?php echo e($data['nama_perusahaan']); ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Nama Group Usaha</label>
                                        <input type="text" name="nama_group_perusahaan" id="nama_group_perusahaan" class="form-control" autocomplete="off" readonly value="<?php echo e($data['nama_group_perusahaan']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Alamat usaha</label>
                                    <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" rows="6" autocomplete="off" readonly><?php echo e($data['alamat_lengkap']); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Alamat Email usaha</label>
                                    <input type="text" name="alamat_email_perusahaan" id="alamat_email_perusahaan" class="form-control" autocomplete="off" readonly value="<?php echo e($data['alamat_email'] ? $data['alamat_email'] : '-'); ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Kota/Kabupaten</label>
                                    <input type="text" name="kota_kabupaten" id="kota_kabupaten" class="form-control" autocomplete="off" readonly value="<?php echo e($data['kota_kabupaten']); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nomor Handphone Contact Person</label>
                                    <input type="text" name="no_hp" id="no_hp" class="form-control" autocomplete="off" readonly value="<?php echo e($data['nomor_handphone']); ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Tahun Berdiri</label>
                                    <input type="text" name="tahun_berdiri" id="tahun_berdiri" autocomplete="off" class="form-control" readonly value="<?php echo e($data['tahun_berdiri'] ? $data['tahun_berdiri'] : '-'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Lama Usaha (Tahun)</label>
                                    <input type="text" name="lama_usaha" id="lama_usaha" class="form-control" autocomplete="off" readonly value="<?php echo e($data['lama_usaha'] ? $data['lama_usaha'] : '-'); ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Bidang Usaha</label>
                                    <input type="text" name="bidang_usaha" id="bidang_usaha" autocomplete="off" class="form-control" readonly value="<?php echo e(strtoupper(str_replace('_', ' ', $data['bidang_usaha']))); ?>">
                                    <div class="bidang_lain p-0 <?php if($data['bidang_usaha'] != 'lainnya'): ?> d-none <?php endif; ?>">
                                        <input type="text" class="form-control" name="bidang_usaha_lain" id="bidang_usaha_lain" readonly autocomplete="off" value="<?php echo e($data['bidang_usaha_lain'] ? $data['bidang_usaha_lain'] : '-'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 p-0">
                                <div class="form-group">
                                    <label for="">Status Kepemilkan Tempat Usaha</label>
                                    <input type="text" name="status_kepemilikan" id="status_kepemilikan" autocomplete="off" class="form-control" readonly value="<?php echo e(ucwords(str_replace('_', ' ', $data['status_kepemilikan']))); ?>">
                                    <div class="group p-0 <?php if($data['status_kepemilikan'] != 'group'): ?> d-none <?php endif; ?>">
                                        <input type="text" class="form-control" name="nama_group" id="nama_group" autocomplete="off" readonly value="<?php echo e($data['nama_group'] ? $data['nama_group'] : '-'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">NIK</label>
                                    <input type="text" id="nomor_ktp" name="nomor_ktp" autocomplete="off" class="form-control" readonly value="<?php echo e($data['nomor_ktp'] ? $data['nomor_ktp'] : '-'); ?>">
                                </div>
                            </div>
                        </div>
                        <div id="ktp-section">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Foto KTP <span class="text-danger">*</span></label>
                                        <?php if(File::extension($data['foto_ktp']) == 'pdf'): ?>
                                            <div class="form-group d-flex justify-content-between align-items-center py-2 px-3 m-0" style="height: auto;" id="preview_ktp">
                                                <p style="font-size: 18px;">Preview file KTP</p>
                                                <a href="<?php echo e(asset('../../../uploads/identitas_perusahaan/' . $data['foto_ktp'])); ?>" target="_blank" id="previewPDF">Preview PDF</a>
                                            </div>
                                        <?php else: ?>
                                            <div class="form-group" id="preview_ktp">
                                                <img id="preview_foto_ktp" src="<?php echo e($data['foto_ktp'] ? asset('../../../uploads/identitas_perusahaan/' . $data['foto_ktp']) : '-'); ?>" alt="Belum ada file" data-action="zoom">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Lengkap Sesuai Identitas</label>
                                        <input type="text" id="nama_lengkap" name="nama_lengkap" autocomplete="off" class="form-control" readonly value="<?php echo e($data['nama_lengkap'] ? $data['nama_lengkap'] : '-'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="section2">
                        <h1>Informasi Bank</h1>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nomor Rekening</label>
                                    <input type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" autocomplete="off" readonly value="<?php echo e($data['informasi_bank']['nomor_rekening']); ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Rekening</label>
                                    <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" autocomplete="off" readonly value="<?php echo e($data['informasi_bank']['nama_rekening']); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Bank</label>
                                    <input type="text" name="nama_bank" id="nama_bank" class="form-control" autocomplete="off" readonly value="<?php echo e($data['informasi_bank']['nama_bank']); ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Pemilik Rekening</label>
                                    <input type="text" name="pemilik_rekening" id="pemilik_rekening" class="form-control" autocomplete="off" readonly value="<?php echo e(ucwords(str_replace('_', ' ', $data['informasi_bank']['status']))); ?>">
                                    <div class="rekening_lain <?php if($data['informasi_bank']['status'] != 'lainnya'): ?> d-none <?php endif; ?>">
                                        <input type="text" class="form-control" name="rekening_lain" id="rekening_lain" autocomplete="off" readonly value="<?php echo e($data['informasi_bank']['rekening_lain'] ? $data['informasi_bank']['rekening_lain'] : '-'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="section3">
                        <h1>Data Identitas Penanggung Jawab</h1>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Penanggung Jawab</label>
                                    <input type="text" name="nama_penanggung_jawab" id="nama_penanggung_jawab" autocomplete="off" class="form-control" readonly value="<?php echo e($data['data_identitas']['nama']); ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Jabatan</label>
                                    <input type="text" name="jabatan" id="jabatan" class="form-control" autocomplete="off" readonly value="<?php echo e($data['data_identitas']['jabatan']); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group" >
                                    <label for="">Identitas Penanggung Jawab</label>
                                    <input type="text" name="identitas_penanggung_jawab" id="identitas_penanggung_jawab" class="form-control" autocomplete="off" readonly value="<?php echo e(strtoupper($data['data_identitas']['identitas'])); ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nomor Handphone</label>
                                    <input type="text" name="nomor_hp_penanggung_jawab" id="nomor_hp_penanggung_jawab" autocomplete="off" class="form-control" readonly value="<?php echo e($data['data_identitas']['no_hp']); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Foto Identitas</label>
                                    <?php if(File::extension($data['data_identitas']['foto']) == 'pdf'): ?>
                                        <div id="preview_penanggung" class="form-group d-flex justify-content-between align-items-center py-2 px-3 m-0" style="height: auto;">
                                            <p style="font-size: 18px;">Preview file identitas</p>
                                            <a href="<?php echo e(asset('../../../uploads/penanggung_jawab/' . $data['data_identitas']['foto'])); ?>" target="_blank" id="previewPDF">Preview PDF</a>
                                        </div>
                                    <?php else: ?>
                                        <div id="preview_penanggung" class="form-group">
                                            <img id="preview_foto_penanggung" src="<?php echo e($data['data_identitas']['foto'] ? asset('../../../uploads/penanggung_jawab/' . $data['data_identitas']['foto']) : '-'); ?>" alt="Preview" data-action="zoom">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                
                                <div class="form-group" id="ttd_credit">
                                    <label for="">Tanda Tangan</label>
                                    <div id="signature">
                                        <img src="<?php echo e($data['data_identitas']['ttd'] ? asset('../../../uploads/ttd/' . $data['data_identitas']['ttd']) : '-'); ?>" alt="Preview" data-action="zoom">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="section4">
                        <h1>Tipe Customer</h1>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Jenis Transaksi</label>
                                    <input type="text" name="jenis_transaksi" id="jenis_transaksi" readonly autocomplete="off" class="form-control" value="<?php echo e($data['tipe_customer'] ? ucwords(str_replace('_', ' ', $data['tipe_customer']['jenis_transaksi'])) : '-'); ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Tipe Harga</label>
                                    <input type="text" name="tipe_harga" id="tipe_harga" class="form-control" autocomplete="off" readonly value="<?php echo e($data['tipe_customer'] ? ucwords(str_replace('_', ' ', $data['tipe_customer']['tipe_harga'])) : '-'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group" >
                                    <label for="">Kategori Customer</label>
                                    <input type="text" name="kategori_customer" id="kategori_customer" class="form-control" autocomplete="off" readonly value="<?php echo e($data['tipe_customer'] ? ucwords(str_replace('_', ' ', $data['tipe_customer']['kategori_customer'])) : '-'); ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Plafond</label>
                                    <input type="text" name="plafond" id="plafond" readonly autocomplete="off" class="form-control" value="<?php echo e($data['tipe_customer'] ? 'Rp ' . number_format($data['tipe_customer']['plafond'], 0, ',', '.') : '-'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Term of Payment</label>
                                    <input type="text" name="plafond" id="plafond" readonly autocomplete="off" class="form-control" value="<?php echo e($data['tipe_customer'] ? $data['tipe_customer']['payment_term'] : '-'); ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Channel Distributor</label>
                                    <?php if($data['tipe_customer']): ?>
                                        <?php if($data['tipe_customer']['channel_distributor'] == 'allptk'): ?>
                                            <input type="text" name="channel_distributor" id="channel_distributor" readonly autocomplete="off" class="form-control" value="Semua Jalur Pontianak">
                                        <?php else: ?>
                                            <input type="text" name="channel_distributor" id="channel_distributor" readonly autocomplete="off" class="form-control" value="Semua Jalur Jakarta">
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <input type="text" name="channel_distributor" id="channel_distributor" readonly autocomplete="off" class="form-control" value="-">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="width: 100%;">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="" class="mb-2">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" readonly autocomplete="off" class="form-control" value="<?php echo e($data['tipe_customer'] ? $data['tipe_customer']['keterangan'] : '-'); ?>" style="padding: 16px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <div class="button1">
                        <button type="button" class="btnKembali" title="Kembali">Kembali</button>
                    </div>
                    <div class="button2">
                        <button type="submit" class="btnEditData" title="Edit Data Customer" data-url="<?php echo e($url); ?>">Edit Data Customer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="modalCabang" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cabang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="dynamic-row">
                        <?php if($data['cabang']): ?>
                            <?php $__currentLoopData = $data['cabang']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row align-items-center">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="group-column-modal">
                                            <div class="form-group-modal">
                                                <label for="">Nomor NITKU (22 digit)</label>
                                                <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="22" autocomplete="off" readonly placeholder="Masukkan nomor NITKU" value="<?php echo e($value['nitku']); ?>">
                                            </div>
                                            <div class="form-group-modal">
                                                <label for="">Nama Cabang</label>
                                                <input type="text" class="form-control" autocomplete="off" readonly placeholder="Masukkan nama cabang" value="<?php echo e($value['nama']); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group-modal">
                                            <label for="">Alamat NITKU</label>
                                            <textarea cols="30" rows="5" class="form-control" autocomplete="off" placeholder="Masukkan alamat NITKU" readonly><?php echo e($value['alamat']); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        // START: Logout submit
        document.getElementById('logoutBtn').addEventListener('click', logout);
        function logout() {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        }
        // END: Logout submit

        $(document).ready(function() {
            // START: Footer button
            $(document).on('click', '.btnEditData', function() {
                let url = $(this).data('url');
                window.location.href = url;
            });

            $(document).on('click', '.btnKembali', function() {
                window.location.href = '/internal/panel';
            });
            // END: Footer button
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\form_customer\resources\views/panel/fix_home_detail_perseorangan.blade.php ENDPATH**/ ?>