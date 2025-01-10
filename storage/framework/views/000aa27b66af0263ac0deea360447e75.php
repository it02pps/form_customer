

<?php $__env->startSection('title'); ?>
    <title>Badan Usaha | PT. PAPASARI</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>
    .container {
        background-color: #fff;
        width: 1504px;
        height: auto;
        border-radius: 16px;
        box-shadow: 2px 2px 20px rgba(0, 0, 0, 0.25);
        gap: 32px;
    }
    
    .content {
        padding: 64px;
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

    .form-input {
        display: flex;
        flex-direction: row;
        gap: 32px;
        padding: 8px 0;
    }

    .form-group label {
        padding-bottom: 8px;
    }

    .form-group input {
        width: 568px;
        padding: 16px;
    }

    .form-group select {
        width: 568px;
        padding: 16px;
    }

    .group-column .form-group {
        padding: 0 0 16px 0;
    }

    .form-input .form-group textarea {
        height: 165px;
    }

    /* input::placeholder {
        color: #FF0000;   
    } */

    .preview_file, .preview_file_sppkp, .preview_file_penanggung {
        border: 1px solid #D2D0D8;
        border-radius: 5px;
        height: 197px;
    }
    
    .section2, .section3 {
        padding: 16px 0 0 0;
    }

    .footer {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        gap: 16px;
    }

    .btnSubmit {
        width: 144px;
        height: 48px;
        border-radius: 8px;
        background-color: #0063ee;
        border: none;
        color: #fff;
    }

    .btnKembali {
        width: 144px;
        height: 48px;
        border-radius: 8px;
        background-color: #E7E6EB;
        border: none;
        color: #000;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="content">
            <div class="header d-flex justify-content-between align-items-center">
                <div class="logo">
                    <img src="<?php echo e(asset('../../../images/PNG 4125 x 913.png')); ?>" alt="Logo">
                </div>
                <div class="profile">
                    <img src="<?php echo e(asset('../../../images/Profile.svg')); ?>" alt="Profile">
                </div>
            </div>
            <div class="title">
                <h1>Formulir Data Customer</h1>
                <h5>Silahkan isi data terkini anda, kemudian tanda tangan.</h5>
            </div>
            <hr>
            <div class="content-body">
                <div class="section1">
                    <h1>Identitas Perusahaan</h1>

                    <div class="form-input">
                        <div class="form-group">
                            <label for="">Nama Perusahaan <span class="text-danger">*</span></label>
                            <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" placeholder="Masukkan nama perusahaan" required>
                        </div>

                        <div class="form-group">
                            <label for="">Nama Group Perusahaan <span class="text-danger">*</span></label>
                            <input type="text" name="nama_group_perusahaan" id="nama_group_perusahaan" class="form-control" placeholder="Masukkan nama group perusahaan" required>
                            <span class="text-danger" style="color: #FF0000;">*Jika tidak ada maka diisi dengan nama perusahaan</span>
                        </div>
                    </div>

                    <div class="form-input">
                        <div class="form-group">
                            <label for="">Alamat Perusahaan <span class="text-danger">*</span></label>
                            <textarea name="alamat_perusahaan" id="alamat_perusahaan" class="form-control" cols="70" placeholder="Masukkan alamat lengkap perusahaan" required></textarea>
                        </div>

                        <div class="group-column">
                            <div class="form-group">
                                <label for="">Kota/Kabupaten <span class="text-danger">*</span></label>
                                <input type="text" name="kota_kabupaten" id="kota_kabupaten" class="form-control" placeholder="Masukkan Kota/Kabupaten" required>
                            </div>
    
                            <div class="form-group">
                                <label for="">Alamat Email Perusahaan</label>
                                <input type="email" name="alamat_email_perusahaan" id="alamat_email_perusahaan" class="form-control" placeholder="Masukkan alamat email perusahaan">
                            </div>
                        </div>
                    </div>

                    <div class="form-input">
                        <div class="form-group">
                            <label for="">Nomor Handphone Contact Person <span class="text-danger">*</span></label>
                            <input type="text" name="nomor_hp" id="nomor_hp" class="form-control" placeholder="Contoh: 012345678910" required>
                        </div>

                        <div class="form-group">
                            <label for="">Tahun Berdiri <span class="text-danger">*</span></label>
                            <input type="date" name="tahun_berdiri" id="tahun_berdiri" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-input">
                        <div class="form-group">
                            <label for="">Lama Usaha (Tahun) <span class="text-danger">*</span></label>
                            <input type="text" name="lama_usaha" id="lama_usaha" class="form-control" required readonly>
                        </div>

                        <div class="form-group">
                            <label for="">Bidang Usaha <span class="text-danger">*</span></label>
                            <select name="bidang_usaha" id="bidang_usaha" class="form-control" required>
                                <option value="1">Opsi 1</option>
                                <option value="2">Opsi 2</option>
                                <option value="3">Opsi 3</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-input">
                        <div class="form-group">
                            <label for="">Status Kepemilkan Tempat Usaha <span class="text-danger">*</span></label>
                            <select name="status_kepemilikan" id="status_kepemilikan" class="form-control" required>
                                <option value="milik_sendiri">Milik Sendiri</option>
                                <option value="sewa">Sewa</option>
                                <option value="group">Group</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Jenis Badan Usaha <span class="text-danger">*</span></label>
                            <select name="jenis_badan_usaha" id="jenis_badan_usaha" class="form-control" required>
                                <option value="pt">PT</option>
                                <option value="cv">CV</option>
                                <option value="pd">PD</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-input">
                        <div class="form-group">
                            <label for="">Nama NPWP <span class="text-danger">*</span></label>
                            <input type="text" name="nama_npwp" id="nama_npwp" class="form-control" placeholder="Masukkan Nama NPWP" required>
                        </div>

                        <div class="form-group">
                            <label for="">Nomor NPWP <span class="text-danger">*</span></label>
                            <input type="text" name="nomor_npwp" id="nomor_npwp" class="form-control" placeholder="Masukkan Nomor NPWP" required>
                        </div>
                    </div>

                    <div class="form-input">
                        <div class="group-column">
                            <div class="form-group">
                                <label for="">Alamat NPWP <span class="text-danger">*</span></label>
                                <textarea name="alamat_npwp" id="alamat_npwp" cols="70" rows="10" class="form-control" required></textarea>
                            </div>
    
                            <div class="form-group">
                                <label for="">Kota Sesuai NPWP <span class="text-danger">*</span></label>
                                <input type="text" name="kota_npwp" id="kota_npwp" class="form-control" placeholder="Masukkan kota sesuai NPWP" required>
                            </div>
                        </div>

                        <div class="group-column">
                            <div class="form-group">
                                <label for="">Foto NPWP <span class="text-danger">*</span></label>
                                <input type="file" name="foto_npwp" id="foto_npwp" class="form-control" required>
                            </div>
    
                            <div class="form-group preview_file">
                                <img src="" alt="Preview">
                            </div>
                        </div>
                    </div>

                    <div class="form-input">
                        <div class="form-group">
                            <label for="">Email Khusus Untuk Faktur Pajak <span class="text-danger">*</span></label>
                            <input type="email" name="email_faktur" id="email_faktur" class="form-control" placeholder="Contoh: faktur@gmail.com" required>
                        </div>

                        <div class="group-column">
                            <div class="form-group">
                                <label for="">Status Pengusaha Kena Pajak (PKP) <span class="text-danger">*</span></label>
                                <select name="status_pkp" id="status_pkp" class="form-control" required>
                                    <option value="non_pkp">Non PKP</option>
                                    <option value="pkp">PKP</option>
                                </select>
                            </div>
    
                            <div class="form-group">
                                <input type="file" name="sppkp" id="sppkp" class="form-control">
                            </div>

                            <div class="form-group preview_file_sppkp">
                                <img src="" alt="Preview">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="section2">
                    <h1>Informasi Bank</h1>

                    <div class="form-input">
                        <div class="form-group">
                            <label for="">Nomor Rekening <span class="text-danger">*</span></label>
                            <input type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" placeholder="Masukkan nomor rekening" required>
                        </div>

                        <div class="form-group">
                            <label for="">Nama Rekening <span class="text-danger">*</span></label>
                            <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" placeholder="Masukkan nama rekening" required>
                        </div>
                    </div>

                    <div class="form-input">
                        <div class="form-group">
                            <label for="">Nama Bank<span class="text-danger">*</span></label>
                            <input type="text" name="nama_bank" id="nama_bank" class="form-control" placeholder="Masukkan nama bank" required>
                        </div>

                        <div class="group-column">
                            <div class="form-group">
                                <label for="">Pemilik Rekening <span class="text-danger">*</span></label>
                                <select name="pemilik_rekening" id="pemilik_rekening" class="form-control" required>
                                    <option value="rekening_perusahaan">Rekening Perusahaan</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="section3">
                    <h1>Data Identitas Penanggung Jawab</h1>

                    <div class="form-input">
                        <div class="form-group">
                            <label for="">Nama Penanggung Jawab <span class="text-danger">*</span></label>
                            <input type="text" name="nama_penanggung_jawab" id="nama_penanggung_jawab" class="form-control" placeholder="Masukkan nama penanggung jawab" required>
                        </div>

                        <div class="form-group">
                            <label for="">Jabatan <span class="text-danger">*</span></label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control" placeholder="Masukkan jabatan" required>
                        </div>
                    </div>

                    <div class="form-input">
                        <div class="form-group">
                            <label for="">Identitas Penanggung Jawab<span class="text-danger">*</span></label>
                            <select name="identitas_penanggung_jawab" id="identitas_penanggung_jawab" class="form-control" required>
                                <option value="ktp">KTP</option>
                                <option value="npwp">NPWP</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Nomor Handphone <span class="text-danger">*</span></label>
                            <input type="text" name="no_hp_penanggung_jawab" id="no_hp_penanggung_jawab" class="form-control" required placeholder="Contoh: 012345678910">
                        </div>
                    </div>

                    <div class="form-input">
                        <div class="group-column">
                            <div class="form-group">
                                <label for="">Foto NPWP <span class="text-danger">*</span></label>
                                <input type="file" name="foto_penanggung" id="foto_penanggung" class="form-control" required>
                            </div>

                            <div class="form-group preview_file_penanggung">
                                <img src="" alt="Preview">
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
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function() {

        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Other\laragon\www\FormCustomer\resources\views/customer/fix_badan_usaha.blade.php ENDPATH**/ ?>