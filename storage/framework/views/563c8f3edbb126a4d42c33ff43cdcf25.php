<?php $__env->startSection('title'); ?>
    <title>Form Customer | PT Papasari</title>
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
            /* position: relative; */
            display: flex;
            justify-content: space-between;
            border-radius: 8px;
            width: 60%;
            margin-left: auto;
            margin-right: auto;
        }

        .section1 h4, .section2 h4, .section3 h4 {
            text-align: center;
        }

        hr {
            border-top: 2px solid #1C4A9C;
            opacity: 1;
        }

        #preview_ktp, #preview_npwp, #preview_sppkp, #preview_penanggung {
            border: 1px solid #1C4A9C;
            border-radius: 7px;
            margin-top: 2px;
            height: 180px;
            display: flex;
            align-items: center;
        }

        #preview_ktp img, #preview_npwp img, #preview_sppkp img, #preview_penanggung img {
            width: 100%;
            height: 180px;
            object-fit: fill;
            border-radius: 7px;
        }

        .select2-selection__rendered {
            line-height: 31px !important;
        }

        .select2-container .select2-selection--single {
            height: 37px !important;
        }
        
        .select2-selection__arrow {
            height: 37px !important;
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
                /* position: relative; */
                display: flex;
                justify-content: right;
                border-radius: 8px;
                width: 95%;
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
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">

        <div class="content-header text-center mb-4">
            <h2>FORMULIR DATA CUSTOMER</h2>
        </div>
    
        
        <form id="form_customer" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="update_id" id="update_id" value="<?php echo e($enkripsi); ?>">
            <input type="hidden" name="bentuk_usaha" id="bentuk_usaha" value="badan_usaha">
            <div class="content-body">
                <div class="alert alert-danger" role="alert">
                    <p style="font-size: 18px; font-weight: bold;" class="text-center mb-0">Silahkan mengisi data terkini, kemudian ditanda tangan dan cap perusahaan</p>
                </div>
                <div class="section1 mb-4">
                    <h4>IDENTITAS PERUSAHAAN</h4>
                    <div class="section1-body">
                        <div class="form-group mb-3">
                            <label for="">Jenis Customer <span class="text-danger">*</span></label>
                            <br>
                            <input type="radio" name="jenis_cust" id="cust_lama" value="lama" checked> 
                            <label for="">Customer Lama</label>
                            <br>
                            <input type="radio" name="jenis_cust" id="cust_baru" value="baru"> 
                            <label for="">Customer Baru</label>
                        </div>
                        <div class="row mb-2">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Perusahaan <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" placeholder="Masukkan nama perusahaan" autocomplete="off" required value="<?php echo e($data_perusahaan ? $data_perusahaan['nama_perusahaan'] : ''); ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Group Perusahaan <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_group_perusahaan" id="nama_group_perusahaan" class="form-control" placeholder="Masukkan nama group perusahaan" autocomplete="off" required value="<?php echo e($data_perusahaan ? $data_perusahaan['nama_group_perusahaan'] : ''); ?>">
                                    <span class="text-danger">*Jika tidak ada, maka diisi dengan nama perusahaan</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Alamat Lengkap Perusahaan<span class="text-danger">*</span></label>
                                    <textarea name="alamat_lengkap" id="alamat_lengkap" cols="30" rows="5" class="form-control" required autocomplete="off" placeholder="Masukkan alamat lengkap perusahaan"><?php echo e($data_perusahaan ? $data_perusahaan['alamat_lengkap'] : ''); ?></textarea>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-2">
                                    <label for="">Kota / Kabupaten <span class="text-danger">*</span></label>
                                    <input type="text" name="kota_kabupaten" id="kota_kabupaten" class="form-control" placeholder="Masukkan kota / kabupaten" autocomplete="off" required value="<?php echo e($data_perusahaan ? $data_perusahaan['kota_kabupaten'] : ''); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat Email Perusahaan</label>
                                    <input type="email" name="email_perusahaan" id="email_perusahaan" class="form-control" autocomplete="off" placeholder="Contoh: perusahaan@gmail.com" value="<?php echo e($data_perusahaan ? $data_perusahaan['alamat_email'] : ''); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nomor Handphone Contact Person <span class="text-danger">*</span></label>
                                    
                                    <input type="text" name="no_hp" id="no_hp" oninput="this.value = this.value.replace(/[^0-9+]/g, '')" maxlength="14" class="form-control" placeholder="Masukkan nomor handphone" required autocomplete="off" value="<?php echo e($data_perusahaan ? $data_perusahaan['nomor_handphone'] : ''); ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Tahun Berdiri</label>
                                    <input type="date" name="tahun_berdiri" id="tahun_berdiri" class="form-control" value="<?php echo e($data_perusahaan ? $data_perusahaan['tahun_berdiri'] : ''); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Lama Usaha (Tahun)</label>
                                    <input type="text" name="lama_usaha" id="lama_usaha" class="form-control" autocomplete="off" readonly value="<?php echo e($data_perusahaan ? $data_perusahaan['lama_usaha'] : ''); ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Bidang Usaha <span class="text-danger">*</span></label>
                                    <select name="bidang_usaha" class="form-control" id="bidang_usaha" required>
                                        <?php $__currentLoopData = $bidang_usaha; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loop_bidang_usaha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($loop_bidang_usaha); ?>"><?php echo e(str_replace('_', ' ', strtoupper($loop_bidang_usaha))); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <input type="text" class="form-control" placeholder="Masukkan bidang usaha lain" id="bidang_usaha_lain" name="bidang_usaha_lain" autocomplete="off" value="<?php echo e($data_perusahaan ? $data_perusahaan['bidang_usaha'] ? $data_perusahaan['bidang_usaha_lain'] : '' : ''); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <label for="">Status Kepemilikan Tempat Usaha <span class="text-danger">*</span></label>
                                <select name="status_kepemilikan" id="status_kepemilikan" class="form-control" required>
                                    <option value="milik_sendiri">Milik Sendiri</option>
                                    <option value="sewa">Sewa</option>
                                    <option value="group">Group</option>
                                </select>
                                <input type="text" class="form-control" autocomplete="off" placeholder="Masukkan nama group" id="nama_group" name="nama_group" value="<?php echo e($data_perusahaan ? $data_perusahaan['status_kepemilikan'] ? $data_perusahaan['nama_group'] : '' : ''); ?>">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-3">
                                    <label for="">Jenis Badan Usaha <span class="text-danger">*</span></label>
                                    <select name="badan_usaha" id="badan_usaha" class="form-control" required>
                                        <option value="pt">PT</option>
                                        <option value="cv">CV</option>
                                        <option value="pd">PD</option>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-3">
                                    <label for="">Nama NPWP <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_npwp" id="nama_npwp" class="form-control" autocomplete="off" placeholder="Masukkan nama NPWP" value="<?php echo e($data_perusahaan ? ($data_perusahaan['identitas'] == 'npwp' ? $data_perusahaan['nama_npwp'] : '') : ''); ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-3">
                                    <label for="">Nomor NPWP <span class="text-danger">*</span></label>
                                    <input type="text" name="nomor_npwp" id="nomor_npwp" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="20" class="form-control" autocomplete="off" placeholder="Masukkan nomor NPWP" value="<?php echo e($data_perusahaan ? ($data_perusahaan['identitas'] == 'npwp' ? $data_perusahaan['nomor_npwp'] : '' ) : ''); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-3">
                                    <label for="">Apakah ada cabang? <span class="text-danger">*</span></label>
                                    <select name="status_cabang" id="status_cabang" class="form-control" required>
                                        <option value="0">Tidak</option>
                                        <option value="1">Ada</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Foto NPWP <span class="text-danger">*</span></label>
                                    <input type="file" name="foto_npwp" id="foto_npwp" class="form-control" onchange="previewFileNpwp(this);" accept=".jpg, .png, .pdf, .jpeg" autocomplete="off">
                                </div>

                                <div id="preview_npwp" class="<?php if($data_perusahaan): ?> <?php if($data_perusahaan['identitas'] != 'npwp'): ?> d-none <?php endif; ?> <?php else: ?> d-none <?php endif; ?>">
                                    <img id="preview_foto_npwp" src="<?php echo e($data_perusahaan ? asset('uploads/identitas_perusahaan/'.$data_perusahaan['foto_npwp']) : ''); ?>" alt="Preview" data-action="zoom">
                                </div>

                                
                                <div class="form-group mt-3">
                                    <label for="">Kota Sesuai NPWP <span class="text-danger">*</span></label>
                                    <input type="text" name="kota_npwp" id="kota_npwp" class="form-control" placeholder="Masukkan kota" autocomplete="off" value="<?php echo e($data_perusahaan ? $data_perusahaan['kota_npwp'] : ''); ?>">
                                </div>

                                
                                <div class="form-group">
                                    <div class="form-group mt-3">
                                        <label for="">Email Khusus Untuk Faktur Pajak <span class="text-danger">*</span></label>
                                        <input type="email" name="email_faktur" id="email_faktur" class="form-control" autocomplete="off" placeholder="Contoh: faktur@gmail.com" value="<?php echo e($data_perusahaan ? ($data_perusahaan['identitas'] == 'npwp' ? $data_perusahaan['email_khusus_faktur_pajak'] : '') : ''); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-3">
                                    <label for="">NITKU <span class="text-danger">*</span></label>
                                    <input type="text" name="nitku" id="nitku" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="22" class="form-control" placeholder="Masukkan NITKU" readonly autocomplete="off" value="<?php echo e($data_perusahaan ? $data_perusahaan['nitku'] : ''); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="">Alamat NPWP <span class="text-danger">*</span></label>
                                    <textarea name="alamat_npwp" id="alamat_npwp" cols="30" rows="5" class="form-control" autocomplete="off" placeholder="Masukkan alamat NPWP"><?php echo e($data_perusahaan ? $data_perusahaan['alamat_npwp'] : ''); ?></textarea>
                                </div>
    
                                <div class="form-group mt-3">
                                    <label for="">Status Pengusaha Kena Pajak (PKP) <span class="text-danger">*</span></label>
                                    <select name="status_pkp" id="status_pkp" class="form-control">
                                        <option value="non_pkp">Non PKP</option>
                                        <option value="pkp">PKP</option>
                                    </select>
                                </div>

                                <div class="form-group mt-3 <?php if($data_perusahaan): ?> <?php if($data_perusahaan['status_pkp'] !=  'pkp'): ?> d-none <?php endif; ?> <?php else: ?> d-none <?php endif; ?>" id="sppkp-section">
                                    <label for="">Foto SPPKP <span class="text-danger">*</span></label>
                                    <input type="file" name="foto_sppkp" id="foto_sppkp" onchange="previewFileSppkp(this);" accept=".jpg, .png, .pdf, .jpeg" class="form-control">

                                    <div id="preview_sppkp">
                                        <img id="preview_foto_sppkp" src="<?php echo e($data_perusahaan ? asset('uploads/identitas_perusahaan/'.$data_perusahaan['sppkp']) : ''); ?>" alt="Preview" data-action="zoom">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <hr>
                <div class="section2 mt-4 mb-4">
                    <h4>INFORMASI BANK</h4>
                    <div class="section2-body">
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nomor Rekening <span class="text-danger">*</span></label>
                                    <input type="text" name="nomor_rekening" oninput="this.value = this.value.replace(/\D+/g, '')" id="nomor_rekening" maxlength="15" class="form-control" autocomplete="off" required placeholder="Masukkan nomor rekening" value="<?php echo e($data_perusahaan ? $data_perusahaan['informasi_bank']['nomor_rekening'] : ''); ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Rekening <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" autocomplete="off" required placeholder="Masukkan nama rekening" value="<?php echo e($data_perusahaan ? $data_perusahaan['informasi_bank']['nama_rekening'] : ''); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nama Bank <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_bank" id="nama_bank" class="form-control" autocomplete="off" required placeholder="Masukkan nama bank" value="<?php echo e($data_perusahaan ? $data_perusahaan['informasi_bank']['nama_bank'] : ''); ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Pemilik Rekening <span class="text-danger">*</span></label>
                                    <select name="status_rekening" id="status_rekening" class="form-control" required>
                                        <option value="rekening_perusahaan">Rekening Perusahaan</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                    <input type="text" class="form-control" id="rekening_lain" name="rekening_lain" placeholder="Masukkan pemilik rekening" autocomplete="off" value="<?php echo e($data_perusahaan ? $data_perusahaan['informasi_bank'] ? $data_perusahaan['informasi_bank']['status'] == 'lainnya' ? $data_perusahaan['informasi_bank']['rekening_lain'] : '' : '' : ''); ?>">
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
                                    <label for="">Nama Penanggung Jawab <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_penanggung_jawab" id="nama_penanggung_jawab" class="form-control" autocomplete="off" placeholder="Masukkan nama penanggung jawab" value="<?php echo e($data_perusahaan ? $data_perusahaan['data_identitas'] ? $data_perusahaan['data_identitas']['nama'] : '' : ''); ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Jabatan <span class="text-danger">*</span></label>
                                    <input type="text" name="jabatan" id="jabatan" class="form-control" autocomplete="off" placeholder="Masukkan jabatan" value="<?php echo e($data_perusahaan ? $data_perusahaan['data_identitas'] ? $data_perusahaan['data_identitas']['jabatan'] : '' : ''); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group mb-3">
                                    <label for="">Identitas Penanggung Jawab <span class="text-danger">*</span></label>
                                    <select name="identitas_penanggung_jawab" id="identitas_penanggung_jawab" class="form-control">
                                        <option value=""></option>
                                        <option value="ktp">KTP</option>
                                        <option value="npwp">NPWP</option>
                                    </select>
                                </div>
    
                                <div class="form-group mb-2">
                                    <label for="">Foto <span class="text-danger">*</span></label>
                                    <input type="file" name="foto_penanggung" id="foto_penanggung" onchange="previewFilePenanggung(this);" accept=".jpg, .png, .pdf, .jpeg" class="form-control">
    
                                    <div id="preview_penanggung">
                                        <img id="preview_foto_penanggung" src="<?php echo e($data_perusahaan ? ($data_perusahaan['data_identitas'] ? asset('uploads/penanggung_jawab/'.$data_perusahaan['data_identitas']['foto']) : '') : ''); ?>" alt="Preview" data-action="zoom">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="">Nomor Handphone <span class="text-danger">*</span></label>
                                    
                                    <input type="text" name="nomor_hp_penanggung_jawab" id="nomor_hp_penanggung_jawab" oninput="this.value = this.value.replace(/[^0-9+]/g, '')" class="form-control" autocomplete="off" maxlength="14" placeholder="Masukkan no hp penanggung jawab" value="<?php echo e($data_perusahaan ? ($data_perusahaan['data_identitas'] ? $data_perusahaan['data_identitas']['no_hp'] : '') : ''); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-footer mt-2">
                <div>
                    <?php if(!$data_perusahaan): ?>
                        <button type="button" class="btn waves-effect btn-danger waves-light rounded btn-md rounded" id="back" onclick="kembali()">Back</button>
                    <?php endif; ?>
                </div>
                <div>
                    <?php if($data_perusahaan): ?>
                        <button type="button" class="btn waves-effect btn-outline-danger waves-light rounded btn-md rounded" id="cancel" data-url="<?php echo e($url); ?>">Cancel</button>
                    <?php endif; ?>
                    <button type="submit" class="btn waves-effect waves-light btn-primary rounded btn-md rounded submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        function kembali() {
            window.location.href = '/';
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
                        $('#preview_npwp').html('<iframe src="'+reader.result+'" style="width: 100%; height: 180px;" target="_blank">'+file[0].name+'</iframe>');
                    }
                } else {
                    $("#preview_npwp").css('height', '180px');
                    $('#preview_npwp').html('<img id="preview_foto_npwp" src="" alt="Preview" data-action="zoom">');
                    $('#preview_npwp').find('a').remove();
                    reader.onload = function() {
                        $("#preview_foto_npwp").attr("src", reader.result);
                    }
                }
                reader.readAsDataURL(file[0]);
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
                        $('#preview_sppkp').html('<iframe src="'+reader.result+'" style="width: 100%; height: 180px;" target="_blank">'+file[0].name+'</iframe>');
                    }
                } else {
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
                        $('#preview_foto_penanggung').html('<iframe src="'+reader.result+'" style="width: 100%; height: 180px;" target="_blank">'+file[0].name+'</iframe>');
                    }
                } else {
                    reader.onload = function() {
                        $("#preview_foto_penanggung").attr("src", reader.result);
                    }
                }
                reader.readAsDataURL(file[0]);
            }
        }

        // Auto format NPWP
        const npwp = document.getElementById('nomor_npwp');
        npwp.oninput = (e) => {
            e.target.value = autoFormatNPWP(e.target.value);
        }
        function autoFormatNPWP(NPWPString) {
            try {
                var cleaned = ("" + NPWPString).replace(/\D/g, "");
                var match = cleaned.match(/(\d{0,2})?(\d{0,3})?(\d{0,3})?(\d{0,1})?(\d{0,3})?(\d{0,3})$/);
                return [      
                        match[1], 
                        match[2] ? ".": "",
                        match[2], 
                        match[3] ? ".": "",
                        match[3],
                        match[4] ? ".": "",
                        match[4],
                        match[5] ? "-": "",
                        match[5],
                        match[6] ? ".": "",
                        match[6]].join("")
                
            } catch(err) {
                return "";
            }
        }
        
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#badan_usaha').select2({
                placeholder: 'Pilih badan usaha',
            });

            $('#status_cabang').select2({
                placeholder: 'Apakah ada cabang',
            });

            $('#status_pkp').select2({
                placeholder: 'Pilih status PKP'
            });

            $('#bidang_usaha').select2({
                placeholder: 'Pilih bidang usaha',
            });

            $('#status_kepemilikan').select2({
                placeholder: 'Pilih status kepemilikan',
            });

            // Bidang usaha
            $('#bidang_usaha').on('change', function() {
                let val = $(this).val();
                if(val == 'lainnya') {
                    $('#bidang_usaha_lain').removeClass('d-none').prop('required', true);
                } else {
                    $('#bidang_usaha_lain').addClass('d-none').prop('required', false);
                    $('#bidang_usaha_lain').val('');
                }
            });

            // Status kepemilikan
            $('#status_kepemilikan').on('change', function() {
                let val = $(this).val();
                if(val == 'group') {
                    $('#nama_group').removeClass('d-none').prop('required', true);
                } else {
                    $('#nama_group').addClass('d-none').prop('required', false);
                    $('#nama_group').val('');
                }
            });

            $('#identitas_penanggung_jawab').select2({
                placeholder: 'Pilih identitas penanggung jawab',
                allowClear: true
            });

            $('#status_rekening').select2({
                placeholder: 'Pilih status rekening',
            });

            $(document).on('change', '#status_rekening', function() {
                let value = $(this).val();
                if(value == 'lainnya') {
                    $('#rekening_lain').removeClass('d-none').prop('required', true);
                    // $('#rekening_lain').prop('required', true);
                    // $('#rekening_lain').select2({
                    //     placeholder: 'Pilih rekening lainnya'
                    // });
                } else {
                    $('#rekening_lain').addClass('d-none').prop('required', false);
                    $('#rekening_lain').val();
                    // $('#rekening_lain').prop('required', false);
                }
            });

            $(document).on('change', '#status_pkp', function() {
                let status = $(this).val();
                if(status == 'pkp') {
                    $('#sppkp-section').removeClass('d-none');
                    $('#preview_sppkp').removeClass('d-none');
                } else {
                    $('#sppkp-section').addClass('d-none');
                    $('#preview_sppkp').addClass('d-none');
                }
            });

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

            $(document).on('submit', '#form_customer', function(e) {
                e.preventDefault();
                const bentuk_usaha = $('#bentuk_usaha').val();
                $.ajax({
                    url: '/'+ bentuk_usaha +'/store',
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: () => {
                        Swal.fire({
                            icon: 'info',
                            title: 'Loading...',
                            text: 'Harap Menunggu',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                        });
                    },
                    success: res => {
                        if(res.status == true) {
                            Swal.fire({
                                title: 'Berhasil!',
                                icon: 'success',
                                html: 'Berhasil!'
                            });
                            window.location.href = res.link;
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                icon: 'error',
                                html: res.error
                            });
                        }
                    }
                });
            });

            $(document).on('click', '#cancel', function() {
                let url = $(this).data('url');
                window.location.href = url;
            });

            $(document).on('change', '#status_cabang', function() {
                let val = $(this).val();
                if(val == '0') {
                    $('#nitku').val('').prop('readonly', true).prop('required', false);
                } else {
                    $('#nitku').prop('readonly', false).prop('required', true);
                }
            });

            // Get data untuk select
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
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Other\laragon\www\FormCustomer\resources\views/customer/badan_usaha.blade.php ENDPATH**/ ?>