

<?php $__env->startSection('title'); ?>
    <title>Perseorangan | PT. PAPASARI</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>
    .container {
        padding: 64px 0;
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

    .content-body .section1, .section2, .section3 {
        display: flex;
        flex-wrap: wrap;
        row-gap: 16px;
    }

    #ktp-section, #npwp-section {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
    }

    /* input::placeholder {
        color: #FF0000;   
    } */

    #preview_ktp, #preview_npwp, #preview_sppkp, #preview_penanggung {
        border: 1px solid #D2D0D8;
        border-radius: 5px;
        height: 271px;
        width: 592px;
    }

    #preview_ktp img, #preview_npwp img, #preview_sppkp img, #preview_penanggung img {
        width: 590px;
        height: 269px;
        border-radius: 7px;
    }

    .section1 {
        padding: 0 0 16px 0;
    }
    
    .section2, .section3 {
        padding: 16px 0 0 0;
    }

    .footer {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        gap: 16px;
        width: 100%;
    }

    .btnSubmit {
        padding: 0 24px;
        height: 48px;
        border-radius: 8px;
        background-color: #0063ee;
        border: none;
        color: #fff;
    }

    .btnKembali {
        padding: 0 24px;
        height: 48px;
        border-radius: 8px;
        background-color: #E7E6EB;
        border: none;
        color: #000;
    }

    #select {
        position: relative;
    }

    #select .caret {
        position: absolute;
        top: 50px;
        right: 23px;
    }

    .profile {
        cursor: pointer;
    }

    #preview_penanggung .zoom-img-wrap .zoom-img, #preview_ktp .zoom-img-wrap .zoom-img, #preview_npwp .zoom-img-wrap .zoom-img, #preview_sppkp .zoom-img-wrap .zoom-img {
        width: 100%;
        height: 100%;
        transition: 1s;
    }

    #signature {
        width: 100%;
        height: 271px;
        border: 1px solid #1C4A9C;
        border-radius: 7px;
    }

    #signature canvas {
        height: 268px !important;
        border-radius: 7px;
    }

    label {
        font-weight: 500;
    }

    .form-group input {
        width: 592px;
        padding: 16px;
    }

    .form-group select {
        width: 592px;
        padding: 16px;
    }

    .form-group textarea {
        width: 592px;
        padding: 16px;
    }

    @media screen and (max-width: 475px) {
        .container {
            padding: 0;
        }
        
        .container-fluid {
            background-color: #fff;
            border-radius: 16px;
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

        .form-group select {
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

        .footer {
            display: flex;
            justify-content: center;
        }

        #signature {
            width: 100%;
            height: 180px;
            border: 1px solid #1C4A9C;
            border-radius: 7px;
        }

        #signature canvas {
            border-radius: 7px;
            height: 177px !important;
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
                    <div class="profile" onclick="login()">
                        <img src="<?php echo e(asset('../../../images/Profile.svg')); ?>" alt="Profile">
                    </div>
                </div>
                <div class="title">
                    <h1>Formulir Data Customer</h1>
                    <h5>Silahkan isi data terkini anda, kemudian tanda tangan.</h5>
                </div>
                <form id="formCustomer" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="update_id" id="update_id" value="<?php echo e($enkripsi); ?>">
                    <input type="hidden" name="bentuk_usaha" id="bentuk_usaha" value="perseorangan">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <label for="" class="mb-2">Jenis Customer <span class="text-danger">*</span></label>
                            <br>
                            <input type="radio" name="jenis_cust" id="cust_lama" value="lama" checked>
                            <label for="">Customer Lama</label>
                            <br>
                            <input type="radio" name="jenis_cust" id="cust_baru" value="baru">
                            <label for="">Customer Baru</label>
                        </div>
                    </div>
                    <hr>
                    <div class="content-body">
                        <div class="section1">
                            <h1>Identitas Perseorangan</h1>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Usaha <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" placeholder="Masukkan nama usaha" autocomplete="off" required value="<?php echo e($data ? $data['nama_perusahaan'] : ''); ?>">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Group Usaha <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_group_perusahaan" id="nama_group_perusahaan" class="form-control" placeholder="Masukkan nama group usaha" autocomplete="off" required value="<?php echo e($data ? $data['nama_group_perusahaan'] : ''); ?>">
                                        <span class="text-danger" style="color: #FF0000;">*Jika tidak ada maka diisi dengan nama usaha</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Alamat usaha <span class="text-danger">*</span></label>
                                        <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" rows="6" placeholder="Masukkan alamat lengkap usaha" autocomplete="off" required><?php echo e($data ? $data['alamat_lengkap'] : ''); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="group-column">
                                        <div class="form-group">
                                            <label for="">Kota/Kabupaten <span class="text-danger">*</span></label>
                                            <input type="text" name="kota_kabupaten" id="kota_kabupaten" class="form-control" placeholder="Masukkan Kota/Kabupaten" autocomplete="off" required value="<?php echo e($data ? $data['kota_kabupaten'] : ''); ?>">
                                        </div>
                
                                        <div class="form-group">
                                            <label for="">Alamat Email usaha</label>
                                            <input type="text" name="alamat_email_perusahaan" id="alamat_email_perusahaan" class="form-control" autocomplete="off" placeholder="Masukkan alamat email usaha" value="<?php echo e($data ? $data['alamat_email'] : ''); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nomor Handphone Contact Person <span class="text-danger">*</span></label>
                                        <input type="text" name="no_hp" id="no_hp" class="form-control" autocomplete="off" placeholder="Contoh: 012345678910" required value="<?php echo e($data ? $data['nomor_handphone'] : ''); ?>">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Tahun Berdiri</label>
                                        <input type="date" name="tahun_berdiri" id="tahun_berdiri" autocomplete="off" class="form-control" value="<?php echo e($data ? $data['tahun_berdiri'] : ''); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Lama Usaha (Tahun)</label>
                                        <input type="text" name="lama_usaha" id="lama_usaha" class="form-control" autocomplete="off" readonly value="<?php echo e($data ? $data['lama_usaha'] : ''); ?>">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group" id="select">
                                        <label for="">Bidang Usaha <span class="text-danger">*</span></label>
                                        <select name="bidang_usaha" id="bidang_usaha" class="form-control" required>
                                            <option value="">Pilih Bidang Usaha</option>
                                            <?php $__currentLoopData = $bidang_usaha; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loop_bidang_usaha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($loop_bidang_usaha); ?>"><?php echo e(strtoupper(str_replace('_', ' ', $loop_bidang_usaha))); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <div class="bidang_lain d-none">
                                            <input type="text" class="form-control" name="bidang_usaha_lain" id="bidang_usaha_lain" placeholder="Masukkan bidang usaha lain" autocomplete="off" value="<?php echo e($data ? $data['bidang_usaha_lain'] : ''); ?>">
                                        </div>
                                        <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group" id="select">
                                        <label for="">Status Kepemilkan Tempat Usaha <span class="text-danger">*</span></label>
                                        <select name="status_kepemilikan" id="status_kepemilikan" class="form-control" required>
                                            <option value="">Pilih Status Kepemilikan</option>
                                            <option value="milik_sendiri">Milik Sendiri</option>
                                            <option value="sewa">Sewa</option>
                                            <option value="group">Group</option>
                                        </select>
                                        <div class="group d-none">
                                            <input type="text" class="form-control" name="nama_group" id="nama_group" placeholder="Masukkan nama group" autocomplete="off" value="<?php echo e($data ? $data['nama_group'] : ''); ?>">
                                        </div>
                                        <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group" id="select">
                                        <label for="">Identitas Perseorangan <span class="text-danger">*</span></label>
                                        <select name="identitas_perusahaan" id="identitas_perusahaan" class="form-control" required>
                                            <option value="ktp">KTP</option>
                                            <option value="npwp">NPWP</option>
                                        </select>
                                        <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="ktp-section">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="">NIK <span class="text-danger">*</span></label>
                                            <input type="text" id="nomor_ktp" name="nomor_ktp" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="16" placeholder="Masukkan NIK" autocomplete="off" class="form-control" value="<?php echo e($data ? $data['nomor_ktp'] : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="">Nama Lengkap Sesuai Identitas <span class="text-danger">*</span></label>
                                            <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" autocomplete="off" class="form-control" value="<?php echo e($data ? $data['nama_lengkap'] : ''); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="group-column">
                                    <div class="form-group">
                                        <label for="">Foto KTP <span class="text-danger">*</span></label>
                                        <input type="file" name="foto_ktp" id="foto_ktp" class="form-control" onchange="previewFileKtp(this);" accept=".jpg, .png, .pdf, .jpeg">
                                    </div>
            
                                    <div class="form-group" id="preview_ktp">
                                        <img id="preview_foto_ktp" src="<?php echo e($data ? asset('../../../uploads/identitas_perusahaan/' . $data['foto_ktp']) : ''); ?>" alt="Preview" data-action="zoom">
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div id="npwp-section" class="d-none">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="">Nama NPWP <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_npwp" id="nama_npwp" class="form-control" autocomplete="off" placeholder="Masukkan Nama NPWP" value="<?php echo e($data ? $data['nama_npwp'] : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="">Nomor NPWP <span class="text-danger">*</span></label>
                                            <input type="text" name="nomor_npwp" id="nomor_npwp" class="form-control" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="16" autocomplete="off" placeholder="Masukkan Nomor NPWP" value="<?php echo e($data ? $data['nomor_npwp'] : ''); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="group-column">
                                            <div class="form-group">
                                                <label for="">NITKU untuk penerbitan Faktur Pajak (22 digit) <span class="text-danger">*</span></label>
                                                <input type="text" name="nitku" id="nitku" class="form-control" autocomplete="off" placeholder="Masukkan NITKU untuk penerbitan Faktur Pajak" required value="<?php echo e($data ? $data['nitku'] : ''); ?>">
                                            </div>
    
                                            <div class="form-group">
                                                <label for="">Kota Sesuai NPWP <span class="text-danger">*</span></label>
                                                <input type="text" name="kota_npwp" id="kota_npwp" class="form-control" autocomplete="off" placeholder="Masukkan kota sesuai NPWP" value="<?php echo e($data ? $data['kota_npwp'] : ''); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="">Alamat NPWP <span class="text-danger">*</span></label>
                                            <textarea name="alamat_npwp" id="alamat_npwp" cols="70" rows="6" autocomplete="off" class="form-control" placeholder="Masukkan alamat sesuai NPWP"><?php echo e($data ? $data['alamat_npwp'] : ''); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="group-column">
                                            <div class="form-group">
                                                <label for="">Email Khusus Untuk Faktur Pajak <span class="text-danger">*</span></label>
                                                <input type="email" name="email_faktur" id="email_faktur" class="form-control" autocomplete="off" placeholder="Contoh: faktur@gmail.com" value="<?php echo e($data ? $data['email_khusus_faktur_pajak'] : ''); ?>">
                                            </div>
    
                                            <div class="form-group" id="select">
                                                <label for="">Status Pengusaha Kena Pajak (PKP) <span class="text-danger">*</span></label>
                                                <select name="status_pkp" id="status_pkp" class="form-control">
                                                    <option value="non_pkp">Non PKP</option>
                                                    <option value="pkp">PKP</option>
                                                </select>
                                                <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                            </div>
            
                                            <div class="pkp d-none">
                                                <div class="form-group">
                                                    <input type="file" name="sppkp" id="sppkp" class="form-control" onchange="previewFileSppkp(this);" accept=".jpg, .png, .pdf, .jpeg">
                                                </div>
                    
                                                <div id="preview_sppkp" class="form-group">
                                                    <img id="preview_foto_sppkp" src="<?php echo e($data ? asset('../../../uploads/identitas_perusahaan/' . $data['sppkp']) : ''); ?>" alt="Preview" data-action="zoom">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="">Foto NPWP <span class="text-danger">*</span></label>
                                            <input type="file" name="foto_npwp" id="foto_npwp" class="form-control" onchange="previewFileNpwp(this);" accept=".jpg, .png, .pdf, .jpeg">
                                        </div>
                
                                        <div class="form-group" id="preview_npwp">
                                            <img id="preview_foto_npwp" src="<?php echo e($data ? asset('../../../uploads/identitas_perusahaan/' . $data['foto_npwp']) : ''); ?>" alt="Preview" data-action="zoom">
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
                                        <label for="">Nomor Rekening <span class="text-danger">*</span></label>
                                        <input type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="15" placeholder="Masukkan nomor rekening" required value="<?php echo e($data ? $data['informasi_bank']['nomor_rekening'] : ''); ?>">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Rekening <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" autocomplete="off" placeholder="Masukkan nama rekening" required value="<?php echo e($data ? $data['informasi_bank']['nama_rekening'] : ''); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Bank <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_bank" id="nama_bank" class="form-control" autocomplete="off" placeholder="Masukkan nama bank" required value="<?php echo e($data ? $data['informasi_bank']['nama_bank'] : ''); ?>">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="group-column">
                                        <div class="form-group" id="select">
                                            <label for="">Pemilik Rekening <span class="text-danger">*</span></label>
                                            <select name="status_rekening" id="status_rekening" class="form-control" required>
                                                <option value="">Pilih Pemilik Rekening</option>
                                                <option value="rekening_usaha">Rekening usaha</option>
                                                <option value="lainnya">Lainnya</option>
                                            </select>
                                            <div class="rekening_lain d-none">
                                                <input type="text" class="form-control" name="rekening_lain" id="rekening_lain" placeholder="Masukkan pemilik rekening lain" autocomplete="off" value="<?php echo e($data ? $data['informasi_bank']['rekening_lain'] : ''); ?>">
                                            </div>
                                            <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
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
                                        <label for="">Nama Penanggung Jawab <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_penanggung_jawab" id="nama_penanggung_jawab" autocomplete="off" class="form-control" placeholder="Masukkan nama penanggung jawab" required value="<?php echo e($data ? $data['data_identitas']['nama'] : ''); ?>">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Jabatan <span class="text-danger">*</span></label>
                                        <input type="text" name="jabatan" id="jabatan" class="form-control" autocomplete="off" placeholder="Masukkan jabatan" required value="<?php echo e($data ? $data['data_identitas']['jabatan'] : ''); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group" id="select">
                                        <label for="">Identitas Penanggung Jawab <span class="text-danger">*</span></label>
                                        <select name="identitas_penanggung_jawab" id="identitas_penanggung_jawab" autocomplete="off" class="form-control" required>
                                            <option value="ktp">KTP</option>
                                            <option value="npwp">NPWP</option>
                                        </select>
                                        <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nomor Handphone <span class="text-danger">*</span></label>
                                        <input type="text" name="nomor_hp_penanggung_jawab" id="nomor_hp_penanggung_jawab" autocomplete="off" class="form-control" required placeholder="Contoh: 012345678910" value="<?php echo e($data ? $data['data_identitas']['no_hp'] : ''); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Foto Identitas <span class="text-danger">*</span></label>
                                        <input type="file" name="foto_penanggung" id="foto_penanggung" class="form-control" onchange="previewFilePenanggung(this);" accept=".jpg, .png, .pdf, .jpeg">
                                    </div>
        
                                    <div id="preview_penanggung" class="form-group">
                                        <img id="preview_foto_penanggung" src="<?php echo e($data ? asset('../../../uploads/penanggung_jawab/' . $data['data_identitas']['foto']) : ''); ?>" alt="Preview" data-action="zoom">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    
                                    <div class="form-group mt-2" id="ttd_credit">
                                        <label for="">Tanda Tangan <span class="text-danger">*</span></label>
                                        <div id="signature"></div>
                                        <input type="button" id="clear_signature" class="btn btn-outline-primary mt-2" value="Bersihkan">
                                        
                                        <input type="hidden" name="hasil_ttd" id="hasil_ttd" value="">
                                        
                                        
        
                                        <img src="" id="sign_prev" style="display: none;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <div class="button1">
                            <button type="button" class="btnKembali">Kembali</button>
                        </div>
                        <div class="button2">
                            <button type="submit" class="btnSubmit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        // START: Preview foto
        function previewFileKtp(input) {
            var file = $("#foto_ktp").prop('files');
            if(file){
                let ext = file[0].type.split('/')[1];
                var reader = new FileReader();
                $("#preview_ktp").removeClass('d-none');
                if(ext == 'pdf') {
                    $('#preview_foto_ktp').find('img').remove();
                    reader.onload = function() {
                        let filename = reader.result.split(',')[1];
                        $('#preview_ktp').html('<iframe src="'+reader.result+'" style="width: 100%; height: 271px;" target="_blank">'+file[0].name+'</iframe>');
                    }
                } else {
                    $("#preview_ktp").css('height', '271px');
                    $('#preview_ktp').html('<img id="preview_foto_ktp" src="" alt="Preview" data-action="zoom">');
                    reader.onload = function() {
                        $("#preview_foto_ktp").attr("src", reader.result);
                    }
                }
                reader.readAsDataURL(file[0]);
            }
        }

        function previewFileNpwp(input) {
            var file = $("#foto_npwp").prop('files');
            if(file){
                let ext = file[0].type.split('/')[1];
                var reader = new FileReader();
                $("#preview_npwp").removeClass('d-none');
                if(ext == 'pdf') {
                    $('#preview_foto_npwp').find('img').remove();
                    reader.onload = function() {
                        let filename = reader.result.split(',')[1];
                        $('#preview_npwp').html('<iframe src="'+reader.result+'" style="width: 100%; height: 271px;" target="_blank">'+file[0].name+'</iframe>');
                    }
                } else {
                    $("#preview_npwp").css('height', '271px');
                    $('#preview_npwp').html('<img id="preview_foto_npwp" src="" alt="Preview" data-action="zoom">');
                    reader.onload = function() {
                        $("#preview_foto_npwp").attr("src", reader.result);
                    }
                }
                reader.readAsDataURL(file[0]);
            }
        }

        function previewFileSppkp(input) {
            var file = $("#sppkp").prop('files');
            if(file){
                let ext = file[0].type.split('/')[1];
                var reader = new FileReader();
                $("#preview_sppkp").removeClass('d-none');
                if(ext == 'pdf') {
                    $('#preview_foto_sppkp').find('img').remove();
                    reader.onload = function() {
                        let filename = reader.result.split(',')[1];
                        $('#preview_sppkp').html('<iframe src="'+reader.result+'" style="width: 100%; height: 271px;" target="_blank">'+file[0].name+'</iframe>');
                    }
                } else {
                    $("#preview_sppkp").css('height', '271px');
                    $('#preview_sppkp').html('<img id="preview_foto_sppkp" src="" alt="Preview" data-action="zoom">');
                    reader.onload = function() {
                        $("#preview_foto_sppkp").attr("src", reader.result);
                    }
                }
                reader.readAsDataURL(file[0]);
            }
        }

        function previewFilePenanggung(input) {
            var file = $("#foto_penanggung").prop('files');
            if(file){
                let ext = file[0].type.split('/')[1];
                var reader = new FileReader();
                $("#preview_penanggung").removeClass('d-none');
                if(ext == 'pdf') {
                    $('#preview_penanggung').find('img').remove();
                    reader.onload = function() {
                        let filename = reader.result.split(',')[1];
                        $('#preview_foto_penanggung').html('<iframe src="'+reader.result+'" style="width: 100%; height: 271px;" target="_blank">'+file[0].name+'</iframe>');
                    }
                } else {
                    $("#preview_penanggung").css('height', '271px');
                    $('#preview_penanggung').html('<img id="preview_foto_penanggung" src="" alt="Preview" data-action="zoom">');
                    reader.onload = function() {
                        $("#preview_foto_penanggung").attr("src", reader.result);
                    }
                }
                reader.readAsDataURL(file[0]);
            }
        }
        // END: Preview foto

        // START: Auto format NPWP
        // const npwp = document.getElementById('nomor_npwp');
        // npwp.oninput = (e) => {
        //     e.target.value = autoFormatNPWP(e.target.value);
        // }
        // function autoFormatNPWP(NPWPString) {
        //     try {
        //         var cleaned = ("" + NPWPString).replace(/\D/g, "");
        //         var match = cleaned.match(/(\d{0,2})?(\d{0,3})?(\d{0,3})?(\d{0,1})?(\d{0,3})?(\d{0,3})$/);
        //         return [      
        //                 match[1], 
        //                 match[2] ? ".": "",
        //                 match[2], 
        //                 match[3] ? ".": "",
        //                 match[3],
        //                 match[4] ? ".": "",
        //                 match[4],
        //                 match[5] ? "-": "",
        //                 match[5],
        //                 match[6] ? ".": "",
        //                 match[6]].join("")
                
        //     } catch(err) {
        //         return "";
        //     }
        // }
        // END: Auto format NPWP

        // START: Direct login page
        function login() {
            window.location.href = '/login';
        }
        // END: Direct login page

        $(document).ready(function() {
            // START: Signature
            var $sigDiv = $('#signature').jSignature({'undoButton': true});

            $('#clear_signature').on('click', function() {
                $sigDiv.jSignature('reset');
            });
            // END: Signature

            // START: Tombol Kembali
            $('.btnKembali').on('click', function() {
                window.location.href = '/form-customer';
            });
            // END: Tombol Kembali

            // START: Change input properties
            $('#bidang_usaha').on('change', function() {
                if($(this).val() == 'lainnya') {
                    $('.bidang_lain').removeClass('d-none').prop('required', true);
                    $('.bidang_lain').find('input').prop('required', true);
                } else {
                    $('.bidang_lain').addClass('d-none').prop('required', false);
                    $('.bidang_lain').find('input').val('').prop('required', false);
                }
            });

            $('#status_kepemilikan').on('change', function() {
                if($(this).val() == 'group') {
                    $('.group').removeClass('d-none').prop('required', true);
                    $('.group').find('input').prop('required', true);
                } else {
                    $('.group').addClass('d-none').prop('required', false);
                    $('.group').find('input').val('').prop('required', false);
                }
            });

            $('#status_pkp').on('change', function() {
                if($(this).val() == 'pkp') {
                    $('.pkp').removeClass('d-none').prop('required', true);
                    $('.pkp').find('input').prop('required', true);
                } else {
                    $('.pkp').addClass('d-none').prop('required', false);
                    $('.pkp').find('input').val('').prop('required', false);
                }
            });

            $('#status_rekening').on('change', function() {
                if($(this).val() == 'lainnya') {
                    $('.rekening_lain').removeClass('d-none').prop('required', true);
                    $('.rekening_lain').find('input').prop('required', true);
                } else {
                    $('.rekening_lain').addClass('d-none').prop('required', false);
                    $('.rekening_lain').find('input').val('').prop('required', false);
                }
            });

            $('#identitas_perusahaan').on('change', function() {
                if($(this).val() == 'ktp') {
                    $('#ktp-section').removeClass('d-none');
                    $('#npwp-section').addClass('d-none');

                    $('#nik').prop('required', true);
                    $('#nama_lengkap').prop('required', true);

                    $('#nama_npwp').val('').prop('required', false);
                    $('#nomor_npwp').val('').prop('required', false);
                    $('#kota_npwp').val('').prop('required', false);
                    $('#alamat_npwp').val('').prop('required', false);
                    $('#email_faktur').val('').prop('required', false);
                    $('#status_pkp').val('').prop('required', false);
                } else {
                    $('#ktp-section').addClass('d-none');
                    $('#npwp-section').removeClass('d-none');

                    $('#nik').val('').prop('required', false);
                    $('#nama_lengkap').val('').prop('required', false);

                    $('#nama_npwp').prop('required', true);
                    $('#nomor_npwp').prop('required', true);
                    $('#kota_npwp').prop('required', true);
                    $('#alamat_npwp').prop('required', true);
                    $('#email_faktur').prop('required', true);
                    $('#status_pkp').prop('required', true);
                }
            });
            // END: Change input properties

            // START: Submit Form Customer
            $(document).on('submit', '#formCustomer', function(e) {
                e.preventDefault();
                var data = $sigDiv.jSignature('getData', 'base30');
                $('#hasil_ttd').val(data[1]);
                const badan_usaha = $('#bentuk_usaha').val();
                $.ajax({
                    url: '/form-customer/'+badan_usaha+'/store',
                    type: 'POST',
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: () => {
                        Swal.fire({
                            title: 'Loading...',
                            text: 'Harap Menunggu',
                            icon: 'info',
                            allowOutsideClick: false,
                            showConfirmButton: false
                        });
                    },
                    success: res => {
                        if(res.status == true) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: 'Data berhasil ditambahkan!',
                                icon: 'success'
                            });
                            $('#formCustomer')[0].reset();
                            window.location.href = res.link_test;
                        } else {
                            Swal.fire({
                                title: 'Gagal',
                                text: res.error,
                                icon: 'error'
                            });
                        }
                    }
                })
            });
            // END: Submit Form Customer

            // START: Get data untuk select
            var enkripsi = $('#update_id').val();
            let url = '<?php echo e(route('form_customer.select', ':id')); ?>';
            url = url.replace(':id', enkripsi);
            $.ajax({
                url: url,
                type: 'GET',
                success: res => {
                    if(res.status == true) {
                        $('#status_kepemilikan').val(res.data.status_kepemilikan).change();
                        $('#badan_usaha').val(res.data.badan_usaha).change();
                        $('#bidang_usaha').val(res.data.bidang_usaha).change();
                        $('#identitas_perusahaan').val(res.data.identitas).change();
                        $('#status_pkp').val(res.data.status_pkp).change();
                        $('#status_rekening').val(res.data.informasi_bank.status).change();
                        if(res.data.data_identitas) {
                            $('#identitas_penanggung_jawab').val(res.data.data_identitas.identitas).change();
                        }
                        if(res.data.status_cust == 'lama') {
                            $('#cust_lama').prop('checked', true);
                        } else {
                            $('#cust_baru').prop('checked', true);
                        }
                        $('#status_cabang').val(res.data.status_cabang).change();
                    } else {
                        $('#status_kepemilikan').val('').change();
                        $('#badan_usaha').val('').change();
                        $('#bidang_usaha').val('').change();
                        $('#identitas_perusahaan').val('ktp').change();
                        $('#status_pkp').val('non_pkp').change();
                        $('#status_rekening').val('').change();
                        $('#identitas_penanggung_jawab').val('').change();
                        $('#cust_lama').prop('checked', true);
                        $('#status_cabang').val('').change();
                    }
                }
            });
            // END: Get data untuk select
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Other\laragon\www\FormCustomer\resources\views/customer/fix_perseorangan.blade.php ENDPATH**/ ?>