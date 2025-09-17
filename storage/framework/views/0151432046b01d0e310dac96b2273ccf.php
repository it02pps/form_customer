<?php $__env->startSection('title'); ?>
    <title>Badan Usaha | PT. PAPASARI</title>
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

    #preview_npwp, #preview_sppkp, #preview_penanggung {
        border: 1px solid #D2D0D8;
        border-radius: 5px;
        height: 271px;
        width: 100%;
    }

    #preview_npwp img, #preview_sppkp img, #preview_penanggung img {
        width: 100%;
        height: 269px;
        border-radius: 7px;
    }

    .section1, .section2, .section4 {
        padding: 0 0 16px 0;
    }
    
    .section2, .section3, {
        padding: 16px 0;
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

    .btnCabang {
        padding: 0 5px;
        width: 180px;
        height: 48px;
        border-radius: 8px;
        background-color: #0063ee;
        border: none;
        color: #fff;
    }

    #addRow {
        padding: 0 24px;
        height: 48px;
        border-radius: 8px;
        background-color: #0063ee;
        border: none;
    }

    #delRow {
        padding: 0 24px;
        height: 48px;
        border-radius: 8px;
        background-color: #FF0000;
        border: none;
    }

    #select {
        position: relative;
    }

    #select .caret {
        position: absolute;
        top: 50px;
        right: 24px;
    }

    .profile {
        cursor: pointer;
    }

    #preview_penanggung .zoom-img-wrap .zoom-img, #preview_ktp .zoom-img-wrap .zoom-img, #preview_npwp .zoom-img-wrap .zoom-img, #preview_sppkp .zoom-img-wrap .zoom-img {
        width: 100%;
        height: 100%;
        transition: 1s;
    }

    label {
        font-weight: 500;
    }

    .form-group {
        width: 100%;
    }

    .form-group input {
        padding: 16px;
    }

    .form-group select {
        padding: 16px;
    }

    .form-group textarea {
        padding: 16px;
        height: 164px;
    }

    .row {
        width: 100vw;
    }

    .row div .group-column .form-group:last-child {
        padding-top: 16px;
        padding-left: 0;
    }

    .row div .group-column .form-group:first-child {
        padding: 0;
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

    .branch-section {
        display: flex;
        justify-content: space-between;
        padding: 0;
    }

    #previewPDF {
        padding: 8px 16px;
        border-radius: 8px;
        background-color: #424242;
        border: none;
        color: #fff;
        text-decoration: none;
    }


    @media screen and (max-width: 475px) {
        .container {
            padding: 0;
            overflow-x: hidden;
        }
        
        .container-fluid {
            background-color: #fff;
            border-radius: 0;
            box-shadow: 2px 2px 20px rgba(0, 0, 0, 0.25);
        }

        .content {
            width: 100%;
            padding: 32px 16px;
        }

        .content-body {
            width: 100%;
        }

        .header .logo img {
            height: 72px;
            padding-bottom: 32px;
        }

        .header .profile img {
            height: 64px;
            padding-bottom: 32px;
        }

        .form-group {
            /* padding: 0 16px; */
            width: auto;
        }

        .form-group input {
            /* padding: 16px; */
            width: 100%;
        }

        .form-group select {
            padding: 16px;
        }

        .form-group textarea {
            height: 165px;
        }

        .section1, .section2, .section3, .section4 {
            padding: 0 16px;
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

        #preview_npwp, #preview_sppkp, #preview_penanggung {
            border: 1px solid #D2D0D8;
            border-radius: 5px;
            height: 205px;
            width: 100%;
            margin: 0;
        }

        #preview_ktp img, #preview_npwp img, #preview_sppkp img, #preview_penanggung img {
            width: 100%;
            height: 200px;
            border-radius: 7px;
        }

        .branch-section {
            display: flex;
            justify-content: center;
            padding: 0;
        }

        .additional-label{
            padding-top: 16px;
        }

        h1 {
            padding-bottom: 8px;
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
                    <div class="alert alert-primary fade show" role="alert">
                        Mohon untuk mengisi data dengan lengkap dan sebenar-benarnya sesuai dengan dokumen identitas resmi yang digunakan.
                        Data yang Anda berikan akan digunakan untuk keperluan verifikasi dan kelancaran proses transaksi.
                        Segala bentuk ketidaksesuaian atau ketidakakuratan data menjadi tanggung jawab pihak yang mengisi.
                        PT PAPASARI berkomitmen untuk menjaga kerahasiaan dan keamanan seluruh data pribadi pelanggan sesuai dengan ketentuan yang berlaku.
                    </div>
                </div>
                <form id="formCustomer" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="update_id" id="update_id" value="<?php echo e($enkripsi); ?>">
                    <input type="hidden" name="opsi" id="opsi" value="data_baru">
                    <input type="hidden" name="bentuk_usaha" id="bentuk_usaha" value="badan_usaha">
                    <div class="section4">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                <div class="form-group p-0" id="select">
                                    <label for="">Sales</label>
                                    <select name="sales" id="sales" autocomplete="off" class="form-control">
                                        <option value="">-</option>
                                        <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loop_sales): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($loop_sales->nama_sales); ?>"><?php echo e($loop_sales->nama_sales); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="content-body">
                        <h1>Identitas Perusahaan</h1>
                        <div class="section1">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Perusahaan <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" placeholder="Masukkan nama perusahaan" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Group Perusahaan <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_group_perusahaan" id="nama_group_perusahaan" class="form-control" placeholder="Masukkan nama group perusahaan" autocomplete="off" required>
                                        <span class="text-danger" style="color: #FF0000;">*Jika tidak ada maka diisi dengan nama perusahaan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Alamat Perusahaan <span class="text-danger">*</span></label>
                                        <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" rows="6" placeholder="Masukkan alamat lengkap perusahaan" autocomplete="off" required></textarea>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Alamat Group Perusahaan <span class="text-danger">*</span></label>
                                        <textarea name="alamat_group_lengkap" id="alamat_group_lengkap" class="form-control" rows="6" placeholder="Masukkan alamat group perusahaan" autocomplete="off" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Kota/Kabupaten <span class="text-danger">*</span></label>
                                        <input type="text" name="kota_kabupaten" id="kota_kabupaten" class="form-control" placeholder="Masukkan Kota/Kabupaten" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group pb-0">
                                        <label for="" class="additional-label">Alamat Email Perusahaan</label>
                                        <input type="text" name="alamat_email_perusahaan" id="alamat_email_perusahaan" class="form-control" autocomplete="off" placeholder="Contoh: perusahaan@gmail.com">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nomor Handphone Contact Person <span class="text-danger">*</span></label>
                                        <input type="text" name="no_hp" id="no_hp" oninput="this.value = this.value.replace(/[^0-9+]/g, '')" maxlength="14" class="form-control" autocomplete="off" placeholder="Contoh: 012345678910" required>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Tahun Berdiri</label>
                                        <input type="date" name="tahun_berdiri" id="tahun_berdiri" autocomplete="off" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Lama Usaha (Tahun)</label>
                                        <input type="text" name="lama_usaha" id="lama_usaha" class="form-control" autocomplete="off" readonly>
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
                                            <input type="text" class="form-control" name="bidang_usaha_lain" id="bidang_usaha_lain" placeholder="Masukkan bidang usaha lain" autocomplete="off">
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
                                            <input type="text" class="form-control" name="nama_group" id="nama_group" placeholder="Masukkan nama group" autocomplete="off">
                                        </div>
                                        <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group" id="select">
                                        <label for="">Jenis Badan Usaha <span class="text-danger">*</span></label>
                                        <select name="badan_usaha" id="badan_usaha" class="form-control" required>
                                            <option value="">Pilih Jenis Usaha</option>
                                            <option value="pt">PT</option>
                                            <option value="cv">CV</option>
                                            <option value="pd">PD</option>
                                            <option value="pribadi">PRIBADI</option>
                                            <option value="yayasan">YAYASAN</option>
                                            <option value="lainnya">LAINNYA</option>
                                        </select>
                                        <div class="badan_usaha_lain d-none">
                                            <input type="text" class="form-control" name="badan_usaha_lain" id="badan_usaha_lain" placeholder="Masukkan badan usaha lain" autocomplete="off">
                                        </div>
                                        <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama NPWP <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_npwp" id="nama_npwp" class="form-control" autocomplete="off" placeholder="Masukkan Nama NPWP" required>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nomor NPWP (16 digit) <span class="text-danger">*</span></label>
                                        <input type="text" name="nomor_npwp" id="nomor_npwp" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="16" class="form-control" autocomplete="off" placeholder="Masukkan Nomor NPWP" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="group-column">
                                        <div class="form-group">
                                            <label for="">Alamat NPWP <span class="text-danger">*</span></label>
                                            <textarea name="alamat_npwp" id="alamat_npwp" cols="70" rows="6" autocomplete="off" class="form-control" required placeholder="Masukkan Alamat NPWP"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="group-column">
                                        <div class="form-group">
                                            <label for="">Kota Sesuai NPWP <span class="text-danger">*</span></label>
                                            <input type="text" name="kota_npwp" id="kota_npwp" class="form-control" autocomplete="off" placeholder="Masukkan kota sesuai NPWP" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="additional-label">Email Khusus Untuk Faktur Pajak <span class="text-danger">*</span></label>
                                            <input type="email" name="email_faktur" id="email_faktur" class="form-control" autocomplete="off" placeholder="Contoh: faktur@gmail.com" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="group-column">
                                        <div class="form-group">
                                            <label for="">Nomor Aktif Untuk Faktur Pajak</label>
                                            <input type="text" name="no_wa" id="no_wa" oninput="this.value = this.value.replace(/[^0-9+-]/g, '')" maxlength="14" class="form-control" autocomplete="off" placeholder="Contoh: 012345678910">
                                        </div>

                                        <div class="form-group mt-4 pb-0" id="select">
                                            <label for="">Status Pengusaha Kena Pajak (PKP) <span class="text-danger">*</span></label>
                                            <select name="status_pkp" id="status_pkp" class="form-control" required>
                                                <option value="non_pkp">Non PKP</option>
                                                <option value="pkp">PKP</option>
                                            </select>
                                            <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                        </div>
                                        <div class="pkp d-none p-0">
                                            <div class="form-group">
                                                <input type="file" name="foto_sppkp" id="foto_sppkp" onchange="previewFileSppkp(this);" accept=".jpg, .png, .pdf, .jpeg" class="form-control">
                                            </div>
                
                                            <?php if($data): ?>
                                                <?php if($data['sppkp']): ?>
                                                    <?php if(File::extension($data['sppkp']) == 'pdf'): ?>
                                                        <div id="preview_sppkp" class="form-group d-flex justify-content-between align-items-center py-2 px-3 m-0" style="height: auto;">
                                                            <p style="font-size: 18px;">Preview file SPPKP</p>
                                                            <a href="" target="_blank" id="previewPDF">Preview PDF</a>
                                                        </div>
                                                    <?php elseif(File::extension($data['sppkp']) != 'pdf'): ?>
                                                        <div id="preview_sppkp" class="form-group">
                                                            <img id="preview_foto_sppkp" src="" alt="Belum ada file" data-action="zoom">
                                                        </div>
                                                    <?php else: ?>
                                                        <div id="preview_sppkp" class="form-group">
                                                            <p class="text-center">Belum ada file</p>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <div id="preview_sppkp" class="form-group">
                                                        <p class="text-center">Belum ada file</p>
                                                    </div>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <div id="preview_sppkp" class="form-group">
                                                    <p class="text-center">Belum ada file</p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="group-column">
                                        <div class="form-group">
                                            <label for="">Foto NPWP <span class="text-danger">*</span></label>
                                            <input type="file" name="foto_npwp" id="foto_npwp" onchange="previewFileNpwp(this);" accept=".jpg, .png, .pdf, .jpeg" class="form-control">
                                        </div>
                
                                        <?php if($data): ?>
                                            <?php if($data['foto_npwp']): ?>
                                                <?php if(File::extension($data['foto_npwp']) == 'pdf'): ?>
                                                    <div id="preview_npwp" class="form-group d-flex justify-content-between align-items-center py-2 px-3 m-0" style="height: auto;">
                                                        <p style="font-size: 18px;">Preview file NPWP</p>
                                                        <a href="" target="_blank" id="previewPDF">Preview PDF</a>
                                                    </div>
                                                <?php elseif(File::extension($data['foto_npwp']) != 'pdf'): ?>
                                                    <div id="preview_npwp" class="form-group">
                                                        <img id="preview_foto_npwp" src="" alt="Belum ada file" data-action="zoom">
                                                    </div>
                                                <?php else: ?>
                                                    <div id="preview_npwp" class="form-group">
                                                        <p class="text-center">Belum ada file</p>
                                                    </div>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <div id="preview_npwp" class="form-group">
                                                    <p class="text-center">Belum ada file</p>
                                                </div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <div id="preview_npwp" class="form-group">
                                                <p class="text-center">Belum ada file</p>
                                            </div>
                                        <?php endif; ?>

                                        <div class="branch-section mt-4 p-0">
                                            <div >
                                                <span class="text-danger">*Jika terdapat cabang, silahkan tekan tombol disamping. Apabila tidak ada, dapat diabaikan</span>
                                            </div>
                                            <div>
                                                <button type="button" class="btnCabang" data-bs-toggle="modal" data-bs-target="#modalCabang">Tambah Cabang</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h1>Informasi Bank</h1>
                        <div class="section2">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nomor Rekening <span class="text-danger">*</span></label>
                                        <input type="text" name="nomor_rekening" id="nomor_rekening" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="15" class="form-control" autocomplete="off" placeholder="Masukkan nomor rekening" required>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Rekening <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" autocomplete="off" placeholder="Masukkan nama rekening" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Bank <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_bank" id="nama_bank" class="form-control" autocomplete="off" placeholder="Masukkan nama bank" required>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="group-column">
                                        <div class="form-group" id="select">
                                            <label for="">Pemilik Rekening <span class="text-danger">*</span></label>
                                            <select name="status_rekening" id="status_rekening" class="form-control" required>
                                                <option value="">Pilih Pemilik Rekening</option>
                                                <option value="rekening_perusahaan">Rekening Perusahaan</option>
                                                <option value="lainnya">Lainnya</option>
                                            </select>
                                            <div class="rekening_lain d-none">
                                                <input type="text" class="form-control" name="rekening_lain" id="rekening_lain" placeholder="Masukkan pemilik rekening lain" autocomplete="off">
                                            </div>
                                            <span class="caret"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h1>Data Identitas Penanggung Jawab</h1>
                        <div class="section3">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Nama Penanggung Jawab <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_penanggung_jawab" id="nama_penanggung_jawab" autocomplete="off" class="form-control" placeholder="Masukkan nama penanggung jawab" required>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Jabatan <span class="text-danger">*</span></label>
                                        <input type="text" name="jabatan" id="jabatan" class="form-control" autocomplete="off" placeholder="Masukkan jabatan" required>
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
                                        <input type="text" name="nomor_hp_penanggung_jawab" id="nomor_hp_penanggung_jawab" oninput="this.value = this.value.replace(/[^0-9+]/g, '')" maxlength="14" autocomplete="off" class="form-control" required placeholder="Contoh: 012345678910">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="group-column">
                                        <div class="form-group">
                                            <label for="">Foto Identitas (KTP / NPWP) <span class="text-danger">*</span></label>
                                            <input type="file" name="foto_penanggung" id="foto_penanggung" class="form-control" onchange="previewFilePenanggung(this);" accept=".jpg, .png, .pdf, .jpeg">
                                        </div>
            
                                        <?php if($data): ?>
                                            <?php if($data['data_identitas']['foto']): ?>
                                                <?php if(File::extension($data['data_identitas']['foto']) == 'pdf'): ?>
                                                    <div id="preview_penanggung" class="form-group d-flex justify-content-between align-items-center py-2 px-3 m-0" style="height: auto;">
                                                        <p style="font-size: 18px;">Preview file identitas</p>
                                                        <a href="" target="_blank" id="previewPDF">Preview PDF</a>
                                                    </div>
                                                <?php elseif(File::extension($data['data_identitas']['foto']) != 'pdf'): ?>
                                                    <div id="preview_penanggung" class="form-group">
                                                        <img id="preview_foto_penanggung" src="" alt="Belum ada file" data-action="zoom">
                                                    </div>
                                                <?php else: ?>
                                                    <div id="preview_penanggung" class="form-group">
                                                        <p class="text-center">Belum ada file</p>
                                                    </div>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <div id="preview_penanggung" class="form-group">
                                                    <p class="text-center">Belum ada file</p>
                                                </div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <div id="preview_penanggung" class="form-group">
                                                <p class="text-center">Belum ada file</p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <div class="button1">
                            <?php if($enkripsi): ?>
                                <button type="button" class="btnKembali" id="btnKembaliDetail" title="Kembali" data-url="<?php echo e($url); ?>">Kembali</button>
                            <?php else: ?>
                                <button type="button" class="btnKembali" title="Kembali">Kembali</button>
                            <?php endif; ?>
                        </div>
                        <div class="button2">
                            <button type="submit" class="btnSubmit" title="Submit">Submit</button>
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
                                    <div class="delRow-section">
                                        <button type="button" id="addRow"><i class="fa-solid fa-plus text-light"></i></button>
                                    </div>
                                    <div class="dynamic-row">
                                        <hr class="line-1">
                                        <div class="row align-items-center counter-1 numDiv">
                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-12 d-flex justify-content-center">
                                                <button type="button" id="delRow" class="delRow" data-id="1"><i class="fa-solid fa-minus text-light"></i></button>
                                            </div>
                                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                                                <div class="group-column-modal">
                                                    <div class="form-group-modal">
                                                        <label for="">Nomor NITKU (22 digit) <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="nitku_cabang[]" id="nitku_cabang" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="22" autocomplete="off" placeholder="Masukkan nomor NITKU">
                                                    </div>
                                                    <div class="form-group-modal">
                                                        <label for="">Nama Cabang <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="nama_cabang[]" id="nama_cabang" autocomplete="off" placeholder="Masukkan nama cabang">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                <div class="form-group-modal">
                                                    <label for="">Alamat NITKU <span class="text-danger">*</span></label>
                                                    <textarea name="alamat_nitku[]" id="alamat_nitku" cols="30" rows="5" class="form-control" autocomplete="off" placeholder="Masukkan alamat NITKU"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
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
                        $('#preview_npwp').html('File PDF telah ditambahkan!').css({
                            'height': '50px',
                            'padding': '16px',
                            'font-weight': 'bold'
                        });
                    }
                } else {
                    $("#preview_npwp").css({
                        'height': '271px',
                        'padding-top': '0'
                    });
                    $('#preview_npwp').html('<img id="preview_foto_npwp" src="" alt="Preview" data-action="zoom">');
                    reader.onload = function() {
                        $("#preview_foto_npwp").attr("src", reader.result);
                    }
                }
                reader.readAsDataURL(file[0]);
            } else {
                $("#preview_npwp").html('<p class="text-center">Belum ada file</p>');
            }
        }

        function previewFileSppkp(input) {
            var file = $("#foto_sppkp").prop('files');
            if(file){
                let ext = file[0].type.split('/')[1];
                var reader = new FileReader();
                $("#preview_sppkp").removeClass('d-none');
                if(ext == 'pdf') {
                    $('#preview_foto_sppkp').find('img').remove();
                    reader.onload = function() {
                        let filename = reader.result.split(',')[1];
                        $('#preview_sppkp').html('File PDF telah ditambahkan!').css({
                            'height': '50px',
                            'padding': '16px',
                            'font-weight': 'bold'
                        });
                    }
                } else {
                    $("#preview_sppkp").css({
                        'height': '271px',
                        'padding-top': '0'
                    });
                    $('#preview_sppkp').html('<img id="preview_foto_sppkp" src="" alt="Preview" data-action="zoom">');
                    reader.onload = function() {
                        $("#preview_foto_sppkp").attr("src", reader.result);
                    }
                }
                reader.readAsDataURL(file[0]);
            } else {
                $("#preview_sppkp").html('<p class="text-center">Belum ada file</p>');
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
                        $('#preview_penanggung').html('File PDF telah ditambahkan!').css({
                            'height': '50px',
                            'padding': '16px',
                            'font-weight': 'bold'
                        });
                    }
                } else {
                    $("#preview_penanggung").css({
                        'height': '271px',
                        'padding-top': '0'
                    });
                    $('#preview_penanggung').html('<img id="preview_foto_penanggung" src="" alt="Preview" data-action="zoom">');
                    reader.onload = function() {
                        $("#preview_foto_penanggung").attr("src", reader.result);
                    }
                }
                reader.readAsDataURL(file[0]);
            } else {
                $("#preview_penanggung").html('<p class="text-center">Belum ada file</p>');
            }
        }
        // END: Preview foto

        // START: Sembunyikan tombol remove
        function updateDeleteButtonVisibility() {
            if ($('.numDiv').length <= 1) {
                $('#delRow').hide();
            } else {
                $('#delRow').show();
            }
        }
        updateDeleteButtonVisibility();
        // END: Sembunyikan tombol remove

        // START: Direct login page
        function login() {
            window.location.href = '/form-customer/panel/login';
        }
        // END: Direct login page

        $(document).ready(function() {
            // START: Tombol Kembali
            $('.btnKembali').on('click', function() {
                window.location.href = '/form-customer';
            });

            $('#btnKembaliDetail').on('click', function() {
                let url = $(this).data('url');
                window.location.href = url;
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

            $('#badan_usaha').on('change', function() {
                if($(this).val() == 'lainnya') {
                    $('.badan_usaha_lain').removeClass('d-none').prop('required', true);
                    $('.badan_usaha_lain').find('input').prop('required', true);
                } else {
                    $('.badan_usaha_lain').addClass('d-none').prop('required', false);
                    $('.badan_usaha_lain').find('input').val('').prop('required', false);
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
                    $('.pkp').find('input').prop('required', false);
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
            // END: Change input properties

            // START: Submit Form Customer
            $(document).on('submit', '#formCustomer', function(e) {
                e.preventDefault();
                const badan_usaha = $('#bentuk_usaha').val();
                $.ajax({
                    url: '/form-customer/'+badan_usaha+'/store',
                    timeout: 120000,
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
                                title: 'Sedang diproses...',
                                text: 'Mohon tunggu sebentar',
                                ico: 'info',
                                allowOutsideClick: false,
                                allowEscapeClick: false,
                                showConfirmButton: false,
                                timer: 60000,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            }).then((result) => {
                                if(result.dismiss === Swal.DismissReason.timer) {
                                    Swal.fire({
                                        title: 'Berhasil',
                                        text: 'Data berhasil ditambahkan!',
                                        icon: 'success'
                                    });
                                    $('#formCustomer')[0].reset();
                                    // console.log(res.link);
                                    window.location.href = res.link;
                                }
                            })
                        } else {
                            Swal.fire({
                                title: 'Gagal',
                                text: res.error,
                                icon: 'error'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        if(error === 'timeout') {
                            Swal.fire({
                                title: 'Gagal',
                                text: 'Permintaan terlalu lama (Lebih dari 2 menit). Silahkan coba lagi.',
                                icon: 'error'
                            });
                        } else {
                            Swal.fire({
                                title: 'Gagal',
                                text: 'Terjadi kesalahan ' + error,
                                icon: 'error'
                            });
                        }
                    }
                })
            });
            // END: Submit Form Customer
            
            // START: Tahun berdiri
            $(document).on('change', '#tahun_berdiri', function(e) {
                if(e.target.value != '') {
                    let tgl = new Date();
                    let tgl_berdiri = new Date($(this).val());
    
                    let thn_berdiri = tgl_berdiri.getFullYear();
                    let thn_sekarang = tgl.getFullYear();
                    let result = thn_sekarang - thn_berdiri;
                    
                    $('#lama_usaha').val(result + ' tahun');
                    $('#lama_usaha_hide').val(result);
                } else {
                    $('#lama_usaha').val('');
                    $('#lama_usaha_hide').val('');
                }
            });
            // END: Tahun berdiri

            // START: Dynamic row
            let counter = 1;
            $('#addRow').on('click', function() {
                counter++;
                $('#counter').val(counter);
                $('.dynamic-row').append(`
                    <hr class="line-`+counter+`">
                    <div class="row align-items-center counter-`+counter+` numDiv">
                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-12 d-flex justify-content-center">
                            <button type="button" id="delRow" data-id="`+counter+`"><i class="fa-solid fa-minus text-light"></i></button>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                            <div class="group-column-modal">
                                <div class="form-group-modal">
                                    <label for="">Nomor NITKU (22 digit) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nitku_cabang[]" id="nitku_cabang" placeholder="Masukkan nomor NITKU" required autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="22">
                                </div>
                                <div class="form-group-modal">
                                    <label for="">Nama Cabang <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama_cabang[]" id="nama_cabang" placeholder="Masukkan nama cabang" required autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group-modal">
                                <label for="">Alamat NITKU <span class="text-danger">*</span></label>
                                <textarea name="alamat_nitku[]" id="alamat_nitku" cols="30" rows="5" class="form-control" placeholder="Masukkan alamat NITKU" required autocomplete="off"></textarea>
                            </div>
                        </div>
                    </div>
                `);
                updateDeleteButtonVisibility();
            });

            $(document).on('click', '#delRow', function() {
                let id = $(this).data('id');

                $('.dynamic-row').find('.line-'+id).remove();
                $('.dynamic-row').find('.counter-'+id).remove();
                counter--;
                $('#counter').val(counter);
                updateDeleteButtonVisibility();
            });
            // END: Dynamic row

            // START: AUTO CAPITAL TEXT
            $(document).on('keyup', '#nama_perusahaan, #nama_group_perusahaan, #alamat_lengkap, #alamat_group_lengkap, #bidang_usaha_lain, #nama_group, #nama_npwp, #badan_usaha_lain, #alamat_npwp, #kota_npwp, #nama_rekening, #nama_bank, #rekening_lain, #nama_penanggung_jawab, #jabatan, #kota_kabupaten, #nama_cabang, #alamat_nitku', function() {
                $(this).val($(this).val().toUpperCase());
            });
            // END: AUTO CAPITAL TEXT
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\form_customer\resources\views/customer/badan_usaha/cust_baru.blade.php ENDPATH**/ ?>