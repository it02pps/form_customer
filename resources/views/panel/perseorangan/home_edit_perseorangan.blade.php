@extends('layouts.main_app')

@section('title')
    <title>Perseorangan | PT. PAPASARI</title>
@endsection

@section('css')
@endsection

@section('content')
    @php
        // FOTO KTP
        $fotoKTP = $data['foto_ktp'] ?? null;
        $urlKTP = url('/form-customer/getFiles/FileIDCompanyOrPersonal/' . $fotoKTP);
        $extKTP = File::extension($fotoKTP);

        // FOTO PENANGGUNG
        $fotoPenanggung = $data['data_identitas']['foto'] ?? null;
        $urlPenanggung = url('/form-customer/getFiles/FileIDPersonCharge/' . $fotoPenanggung);
        $extPenanggung = File::extension($fotoPenanggung);
    @endphp

    <div class="px-4 py-3 px-md-5">
        <div class="header d-flex justify-content-between align-items-center">
            <div class="logo">
                <img src="{{ asset('images/PNG 4125 x 913.png') }}" class="img-fluid" alt="Logo">
            </div>
            <div class="d-flex gap-3 justify-content-end w-100">
                <img id="logoutBtn" src="{{ asset('images/Log Out.png') }}" class="img-fluid" style="width: 40px; cursor: pointer;" title="Logout" alt="Logout">
                <form id="logout-form" action="{{ route('form_customer.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
        <div class="d-flex flex-column gap-2">
            <h1 class="text-center text-md-start m-0 p-0">Formulir Data Customer</h1>
            <h5 class="text-center text-md-start p-0">Silahkan isi data terkini anda, kemudian tanda tangan.</h5>
        </div>
        <form id="formCustomer" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="update_id" id="update_id" value="{{ $enkripsi }}">
            <input type="hidden" name="bentuk_usaha" id="bentuk_usaha" value="perseorangan">
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-group p-0 position-relative" id="select">
                        <label for="">Sales</label>
                        <select name="sales" id="sales" autocomplete="off" class="form-control">
                            <option value="">-</option>
                            @foreach ($sales as $loop_sales)
                                <option value="{{ $loop_sales->nama_sales }}">{{ $loop_sales->nama_sales }}</option>
                            @endforeach
                        </select>
                        <span class="caret position-absolute top-50" style="right: 15px;"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                    </div>
                </div>
            </div>
            <hr>
            <div class="py-2">
                <h1 class="text-center text-md-start">Identitas Perseorangan</h1>
                <div class="d-flex flex-column gap-3">
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Group Usaha <span class="text-danger">*</span></label>
                                <input type="text" name="nama_group_perusahaan" id="nama_group_perusahaan" class="form-control" placeholder="Masukkan nama group usaha" autocomplete="off" required value="{{ $data['nama_group_perusahaan'] ?: '' }}">
                                <span class="text-danger" style="color: #FF0000;">*Jika tidak ada maka diisi dengan nama usaha</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Alamat Email Usaha</label>
                                <input type="text" name="alamat_email_perusahaan" id="alamat_email_perusahaan" class="form-control" autocomplete="off" placeholder="Masukkan alamat email usaha" value="{{ $data['alamat_email'] ?: '' }}">
                            </div>   
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Alamat Group Usaha <span class="text-danger">*</span></label>
                                <textarea name="alamat_group_lengkap" id="alamat_group_lengkap" class="form-control" rows="6" placeholder="Masukkan alamat group usaha" autocomplete="off" required>{{ $data['alamat_group_lengkap'] ?: '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Kota/Kabupaten <span class="text-danger">*</span></label>
                                <input type="text" name="kota_kabupaten" id="kota_kabupaten" class="form-control" placeholder="Masukkan Kota/Kabupaten" autocomplete="off" required value="{{ $data['kota_kabupaten'] ?: '' }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nomor Handphone Contact Person <span class="text-danger">*</span></label>
                                <input type="text" name="no_hp" id="no_hp" class="form-control" autocomplete="off" placeholder="Contoh: 012345678910" required value="{{ $data['nomor_handphone'] ?: '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Tahun Berdiri</label>
                                <input type="date" name="tahun_berdiri" id="tahun_berdiri" autocomplete="off" class="form-control" value="{{ $data['tahun_berdiri'] ?: '' }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Lama Usaha (Tahun)</label>
                                <input type="text" name="lama_usaha" id="lama_usaha" class="form-control" autocomplete="off" readonly value="{{ $data['lama_usaha'] ?: '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group" id="select">
                                <label for="">Bidang Usaha <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <select name="bidang_usaha" id="bidang_usaha" class="form-control" required>
                                        <option value="">Pilih Bidang Usaha</option>
                                        @foreach ($bidang_usaha as $loop_bidang_usaha)
                                            <option value="{{ $loop_bidang_usaha }}">{{ strtoupper(str_replace('_', ' ', $loop_bidang_usaha)) }}</option>
                                        @endforeach
                                    </select>
                                    <div class="bidang_lain d-none">
                                        <input type="text" class="form-control" name="bidang_usaha_lain" id="bidang_usaha_lain" placeholder="Masukkan bidang usaha lain" autocomplete="off" value="{{ $data['bidang_usaha_lain'] ?: '' }}">
                                    </div>
                                    <span class="caret position-absolute" style="right: 15px; top: 14px;"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group" id="select">
                                <label for="">Status Kepemilkan Tempat Usaha <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <select name="status_kepemilikan" id="status_kepemilikan" class="form-control" required>
                                        <option value="">Pilih Status Kepemilikan</option>
                                        <option value="milik_sendiri">Milik Sendiri</option>
                                        <option value="sewa">Sewa</option>
                                        <option value="group">Group</option>
                                    </select>
                                    <div class="group d-none">
                                        <input type="text" class="form-control" name="nama_group" id="nama_group" placeholder="Masukkan nama group" autocomplete="off" value="{{ $data['nama_group'] ?: '' }}">
                                    </div>
                                    <span class="caret position-absolute" style="right: 15px; top: 14px;"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">NIK <span class="text-danger">*</span></label>
                                <input type="text" id="nomor_ktp" name="nomor_ktp" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="16" placeholder="Masukkan NIK" autocomplete="off" class="form-control" value="{{ $data['nomor_ktp'] ? $data['nomor_ktp'] : $data['nomor_npwp'] }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Lengkap Sesuai Identitas <span class="text-danger">*</span></label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" autocomplete="off" class="form-control" value="{{ $data['nama_lengkap'] ?: '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Alamat Lengkap Sesuai Identitas <span class="text-danger">*</span></label>
                                <textarea name="alamat_ktp" id="alamat_ktp" class="form-control" rows="6" placeholder="Masukkan alamat lengkap KTP" autocomplete="off" required>{{ $data['alamat_ktp'] ?: '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Foto KTP / NPWP <span class="text-danger">*</span></label>
                                <input type="file" name="foto_ktp" id="foto_ktp" class="form-control" onchange="previewFileKtp(this);" accept=".jpg, .png, .pdf, .jpeg">
                            </div>
                            @if($fotoKTP)
                                <div class="form-group {{ $extKTP === 'pdf' ? 'd-flex justify-content-center align-items-center py-2 px-3 m-0' : 'p-0' }}" id="preview_ktp" style="height: {{ $extKTP === 'pdf' ? 'auto' : '271px' }};">
                                    @if($extKTP === 'pdf')
                                        <p style="font-size: 18px;">Preview file KTP</p>
                                        <a href="{{ $urlKTP}}" target="_blank" id="previewPDF">Preview PDF</a>
                                    @else
                                        <img id="preview_foto_ktp" src="{{ $urlKTP }}" alt="Belum ada file" data-action="zoom">
                                    @endif
                                </div>
                            @else
                                <div class="form-group" id="preview_ktp">
                                    <p class="text-center">Belum ada file</p>
                                </div>
                            @endif
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="branch-section p-0">
                                <span class="text-danger">*Jika terdapat cabang, silahkan tekan tombol disamping. Apabila tidak ada, dapat diabaikan</span>
                                <button type="button" class="btnCabang btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalCabang">Tambah Cabang</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <h1 class="text-center text-md-start">Informasi Bank</h1>
                <div class="d-flex flex-column gap-3">
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nomor Rekening <span class="text-danger">*</span></label>
                                <input type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="15" placeholder="Masukkan nomor rekening" required value="{{ $data ? $data['informasi_bank'] ? $data['informasi_bank']['nomor_rekening'] : '' : '' }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Rekening <span class="text-danger">*</span></label>
                                <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" autocomplete="off" placeholder="Masukkan nama rekening" required value="{{ $data ? $data['informasi_bank'] ? $data['informasi_bank']['nama_rekening'] : '' : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Bank <span class="text-danger">*</span></label>
                                <input type="text" name="nama_bank" id="nama_bank" class="form-control" autocomplete="off" placeholder="Masukkan nama bank" required value="{{ $data ? $data['informasi_bank'] ? $data['informasi_bank']['nama_bank'] : '' : '' }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group" id="select">
                                <label for="">Pemilik Rekening <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <select name="status_rekening" id="status_rekening" class="form-control" required>
                                        <option value="">Pilih Pemilik Rekening</option>
                                        <option value="rekening_usaha">Rekening usaha</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                    <div class="rekening_lain d-none">
                                        <input type="text" class="form-control" name="rekening_lain" id="rekening_lain" placeholder="Masukkan pemilik rekening lain" autocomplete="off" value="{{ $data ? $data['informasi_bank'] ? $data['informasi_bank']['rekening_lain'] : '' : '' }}">
                                    </div>
                                    <span class="caret position-absolute" style="right: 15px; top: 14px;"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Finance <span class="text-danger">*</span></label>
                                <input type="text" name="nama_finance" id="nama_finance" placeholder="Masukkan nama finance" autocomplete="off" class="form-control" value="{{ $data ? $data['data_finance'] ? $data['data_finance']['nama'] : '' : '' }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">No HP Finance <span class="text-danger">*</span></label>
                                <input type="text" name="no_hp_finance" id="no_hp_finance" oninput="this.value = this.value.replace(/[^0-9+]/g, '')" placeholder="Masukkan No HP finance" autocomplete="off" maxlength="20" class="form-control" value="{{ $data ? $data['data_finance'] ? $data['data_finance']['no_hp'] : '' : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Email Finance <span class="text-danger">*</span></label>
                        <input type="text" name="email_finance" id="email_finance" placeholder="Masukkan email finance" autocomplete="off" class="form-control" value="{{ $data ? $data['data_finance'] ? $data['data_finance']['email'] : '' : '' }}">
                    </div>
                </div>
                <hr>
                <h1 class="text-center text-md-start">Data Identitas Penanggung Jawab</h1>
                <div class="d-flex flex-column gap-3">
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nama Penanggung Jawab <span class="text-danger">*</span></label>
                                <input type="text" name="nama_penanggung_jawab" id="nama_penanggung_jawab" autocomplete="off" class="form-control" placeholder="Masukkan nama penanggung jawab" required value="{{ $data['data_identitas']['nama'] ?: '' }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Jabatan <span class="text-danger">*</span></label>
                                <input type="text" name="jabatan" id="jabatan" class="form-control" autocomplete="off" placeholder="Masukkan jabatan" required value="{{ $data['data_identitas']['jabatan'] ?: '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group position-relative" id="select">
                                <label for="">Identitas Penanggung Jawab <span class="text-danger">*</span></label>
                                <select name="identitas_penanggung_jawab" id="identitas_penanggung_jawab" autocomplete="off" class="form-control" required>
                                    <option value="ktp">KTP</option>
                                    <option value="npwp">NPWP</option>
                                </select>
                                <span class="caret position-absolute top-50" style="right: 15px;"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Nomor Handphone <span class="text-danger">*</span></label>
                                <input type="text" name="nomor_hp_penanggung_jawab" id="nomor_hp_penanggung_jawab" autocomplete="off" class="form-control" required placeholder="Contoh: 012345678910" value="{{ $data['data_identitas']['no_hp'] ?: '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Foto Identitas (KTP / NPWP) <span class="text-danger">*</span></label>
                                <input type="file" name="foto_penanggung" id="foto_penanggung" class="form-control" onchange="previewFilePenanggung(this);" accept=".jpg, .png, .pdf, .jpeg">
                            </div>
                            @if($fotoPenanggung)
                                <div class="form-group {{ $extPenanggung === 'pdf' ? 'd-flex justify-content-between align-items-center py-2 px-3 m-0' : 'p-0' }}" id="preview_penanggung" style="height: {{ $extPenanggung === 'pdf' ? 'auto' : '271px' }};">
                                    @if($extPenanggung === 'pdf')
                                        <p style="font-size: 18px">Preview file identitas</p>
                                        <a href="{{ $urlPenanggung }}" target="_blank" id="previewPDF">Preview PDF</a>
                                    @else
                                        <img id="preview_foto_penanggung" src="{{ $urlPenanggung }}" alt="Belum ada file" data-action="zoom">
                                    @endif
                                </div>
                            @else
                                <div class="form-group" id="preview_penanggung">
                                    <p class="text-center">Belum ada file</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <h1 class="text-center text-md-start">Tipe Customer</h1>
                <div class="d-flex flex-column gap-3">
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group position-relative" id="select">
                                <label for="">Jenis Transaksi</label>
                                <select name="jenis_transaksi" id="jenis_transaksi" class="form-control" required>
                                    <option value="cash">Cash</option>
                                    <option value="credit">Credit</option>
                                </select>
                                <span class="caret position-absolute top-50" style="right: 15px;"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group position-relative" id="select">
                                <label for="">Tipe Harga</label>
                                <select name="tipe_harga" id="tipe_harga" class="form-control" required>
                                    <option value="end_user">End User</option>
                                    <option value="retail">Retail</option>
                                </select>
                                <span class="caret position-absolute top-50" style="right: 15px;"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group position-relative" id="select">
                                <label for="">Kategori Customer</label>
                                <select name="kategori_customer" id="kategori_customer" class="form-control">
                                    <option value="">Pilih kategori customer</option>
                                    @foreach($bidang_usaha as $loop_bidang_usaha)
                                        <option value="{{ $loop_bidang_usaha }}">{{ str_replace('_', ' ', strtoupper($loop_bidang_usaha)) }}</option>
                                    @endforeach
                                </select>
                                <span class="caret position-absolute top-50" style="right: 15px;"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Plafond</label>
                                <input type="text" name="plafond" id="plafond" oninput="this.value = this.value.replace(/[^0-9+]/g, '')" class="form-control" placeholder="Masukkan plafond" autocomplete="off" value="{{ $data['tipe_customer'] ? $data['tipe_customer']['plafond'] : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Term of Payment</label>
                                <input type="text" name="payment_term" id="payment_term" class="form-control" placeholder="Masukkan term of payment" autocomplete="off" value="{{ $data['tipe_customer'] ? $data['tipe_customer']['payment_term'] : '' }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group position-relative" id="select">
                                <label for="">Channel Distributor</label>
                                <select name="channel_distributor" id="channel_distributor" class="form-control">
                                    <option value="">Pilih channel distributor</option>
                                    <option value="allptk">Semua Jalur Pontianak</option>
                                    <option value="alljkt">Semua Jalur Jakarta</option>
                                </select>
                                <span class="caret position-absolute top-50" style="right: 15px;"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group position-relative" id="select">
                                <label for="">Keterangan</label>
                                <select name="keterangan" id="keterangan" class="form-control" required>
                                    <option value="New Customer">New Customer</option>
                                    <option value="New Bill To">New Bill To</option>
                                    <option value="Update Data">Update Data</option>
                                </select>
                                <span class="caret position-absolute top-50" style="right: 15px;"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Customer Code</label>
                                <input type="text" name="kode_customer" id="kode_customer" class="form-control" placeholder="Masukkan kode customer" autocomplete="off" value="{{ $data['tipe_customer'] ? $data['tipe_customer']['kode_customer'] : '-' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group position-relative" id="select">
                                <label for="">Apakah Terbaca Sebagai NPWP?</label>
                                <select name="npwp_perseorangan" id="npwp_perseorangan" class="form-control">
                                    <option value="">Pilih status</option>
                                    <option value="0">Tidak</option>
                                    <option value="1">Iya</option>
                                </select>
                                <span class="caret position-absolute top-50" style="right: 15px;"><i class="fa-solid fa-caret-down text-secondary"></i></span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">New Bill To Code</label>
                                <input type="text" name="new_bill_to_code" id="new_bill_to_code" class="form-control" placeholder="Masukkan new bill to code" autocomplete="off" value="{{ $data['tipe_customer'] ? $data['tipe_customer']['new_bill_to_code'] : '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column-reverse flex-md-row gap-2 justify-content-md-end w-100 mt-4" id="footer">
                <button type="button" class="btnKembali btn btn-outline-danger" title="Kembali">Kembali</button>
                <button type="submit" class="btnSubmit btn btn-primary" title="Submit">Submit</button>
            </div>

            {{-- START: Branch modal --}}
            <div class="modal fade" id="modalCabang" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cabang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="w-100 text-end">
                                <button type="button" id="addRow" class="btn btn-primary" title="Tambah Cabang"><i class="fa-solid fa-plus text-light"></i></button>
                            </div>
                            <div class="dynamic-row">
                                @if($data)
                                    @if(count($data['cabang']) > 0)
                                        @foreach($data['cabang'] as $key => $value)
                                            <hr class="line-{{ $key + 1 }}">
                                            <div class="w-100">
                                                <div class="d-flex flex-column gap-3">
                                                    <div class="row g-3 counter-{{ $key + 1 }} numDiv">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                            <div class="form-group-modal">
                                                                <label for="">Nomor NITKU (22 digit) <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="nitku_cabang[]" id="nitku_cabang" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="22" autocomplete="off" placeholder="Masukkan nomor NITKU" value="{{ $value['nitku'] }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                            <div class="form-group-modal">
                                                                <label for="">Nama Cabang <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="nama_cabang[]" id="nama_cabang" autocomplete="off" placeholder="Masukkan nama cabang" value="{{ $value['nama'] }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <div class="form-group-modal">
                                                                <label for="">Alamat NITKU <span class="text-danger">*</span></label>
                                                                <textarea name="alamat_nitku[]" id="alamat_nitku" cols="30" rows="5" class="form-control" autocomplete="off" placeholder="Masukkan alamat NITKU">{{ $value['alamat'] }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4">
                                                        <button type="button" id="delRow" class="delRow btn btn-danger" title="Hapus" data-id="{{ $key + 1 }}"><i class="fa-solid fa-minus text-light"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <hr class="line-1">
                                        <div class="w-100">
                                            <div class="flex flex-column gap-3">
                                                <div class="row g-3 counter-1 numDiv">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                        <div class="form-group-modal">
                                                            <label for="">Nomor NITKU (22 digit) <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="nitku_cabang[]" id="nitku_cabang" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="22" autocomplete="off" placeholder="Masukkan nomor NITKU">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                        <div class="form-group-modal">
                                                            <label for="">Nama Cabang <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="nama_cabang[]" id="nama_cabang" autocomplete="off" placeholder="Masukkan nama cabang">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <div class="form-group-modal">
                                                            <label for="">Alamat NITKU <span class="text-danger">*</span></label>
                                                            <textarea name="alamat_nitku[]" id="alamat_nitku" cols="30" rows="5" class="form-control" autocomplete="off" placeholder="Masukkan alamat NITKU"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <button type="button" id="delRow" class="delRow btn btn-outline-danger" title="Hapus" data-id="1"><i class="fa-solid fa-minus text-light"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <hr class="line-1">
                                    <div class="w-100">
                                        <div class="flex flex-column gap-3">
                                            <div class="row g-3 counter-1 numDiv">
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="form-group-modal">
                                                        <label for="">Nomor NITKU (22 digit) <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="nitku_cabang[]" id="nitku_cabang" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="22" autocomplete="off" placeholder="Masukkan nomor NITKU">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="form-group-modal">
                                                        <label for="">Nama Cabang <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="nama_cabang[]" id="nama_cabang" autocomplete="off" placeholder="Masukkan nama cabang">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <div class="form-group-modal">
                                                        <label for="">Alamat NITKU <span class="text-danger">*</span></label>
                                                        <textarea name="alamat_nitku[]" id="alamat_nitku" cols="30" rows="5" class="form-control" autocomplete="off" placeholder="Masukkan alamat NITKU"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <button type="button" id="delRow" class="delRow btn btn-danger" title="Hapus" data-id="1"><i class="fa-solid fa-minus text-light"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- END: Branch Modal --}}
        </form>
    </div>
@endsection

@section('js')
    <script>
        // START: Logout submit
        document.getElementById('logoutBtn').addEventListener('click', logout);
        function logout() {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        }
        // END: Logout submit

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
                        $('#preview_ktp').html('File PDF telah ditambahkan!').css({
                            'height': '50px',
                            'padding': '16px',
                            'font-weight': 'bold'
                        });
                    }
                } else {
                    $("#preview_ktp").css('height', 'auto');
                    $('#preview_ktp').html('<img id="preview_foto_ktp" src="" alt="Preview" data-action="zoom">');
                    reader.onload = function() {
                        $("#preview_foto_ktp").attr("src", reader.result);
                    }
                }
                reader.readAsDataURL(file[0]);
            } else {
                $('#preview_ktp').html('<p class="text-center">Belum ada file</p>');
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
                        $('#preview_foto_penanggung').html('File PDF telah ditambahkan!').css({
                            'height': '50px',
                            'padding': '16px',
                            'font-weight': 'bold'
                        });
                    }
                } else {
                    $("#preview_penanggung").css('height', 'auto');
                    $('#preview_penanggung').html('<img id="preview_foto_penanggung" src="" alt="Preview" data-action="zoom">');
                    reader.onload = function() {
                        $("#preview_foto_penanggung").attr("src", reader.result);
                    }
                }
                reader.readAsDataURL(file[0]);
            } else {
                $('#preview_penanggung').html('<p class="text-center">Belum ada file</p>');
            }
        }
        // END: Preview foto

        // START: Format rupiah
        var rupiah = document.getElementById('plafond');
        rupiah.addEventListener('keyup', function(e)
        {
            rupiah.value = formatRupiah(this.value, 'Rp ');
        });
        
        /* Fungsi */
        function formatRupiah(angka, prefix)
        {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split    = number_string.split(','),
                sisa     = split[0].length % 3,
                rupiah     = split[0].substr(0, sisa),
                ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
                
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
        }
        // END: Format rupiah

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

        $(document).ready(function() {
            // START: Tombol Kembali
            $('.btnKembali').on('click', function() {
                window.location.href = '{{ route("home") }}';
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

            $('#keterangan').on('change', function() {
                if($(this).val() == 'New Customer') {
                    $('#kode_customer').prop('required', false).prop('readonly', true);
                    $('#kode_customer').val('');
                } else {
                    $('#kode_customer').prop('required', true).prop('readonly', false);
                }
            });
            // END: Change input properties

            // START: Submit Form Customer
            $(document).on('submit', '#formCustomer', function(e) {
                e.preventDefault();
                const badan_usaha = $('#bentuk_usaha').val();
                $.ajax({
                    url: '{{ route("home.edit_store") }}',
                    type: 'POST',
                    timout: 8000,
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
                            window.location.href = res.link;
                        } else {
                            Swal.fire({
                                title: 'Gagal',
                                html: res.error,
                                icon: 'error'
                            });
                        }
                    },
                    error: function(textStatus) {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Terjadi kesalahan. Silahkan dicoba lagi',
                            icon: 'error'
                        });
                    }
                })
            });
            // END: Submit Form Customer

            // START: Get data untuk select
            $.ajax({
                url: '{{ route("home.select", ":id") }}'.replace(':id', $("#update_id").val()),
                type: 'GET',
                success: res => {
                    if(res.status == true) {
                        if(res.data.tipe_customer) {
                            $('#jenis_transaksi').val(res.data.tipe_customer.jenis_transaksi).change();
                            $('#tipe_harga').val(res.data.tipe_customer.tipe_harga).change();
                            $('#kategori_customer').val(res.data.tipe_customer.kategori_customer).change();
                            $('#channel_distributor').val(res.data.tipe_customer.channel_distributor).change();
                            $('#keterangan').val(res.data.tipe_customer.keterangan).change();
                        }
                        
                        $('#jenis_cust').val(res.data.status_cust).change();
                        $('#status_cabang').val(res.data.status_cabang).change();
                        $('#bidang_usaha').val(res.data.bidang_usaha).change();
                        $('#status_kepemilikan').val(res.data.status_kepemilikan).change();
                        $('#sales').val(res.data.nama_sales).change();
                        $('#status_pkp').val(res.data.status_pkp).change();
                        $('#status_rekening').val(res.data.informasi_bank.status).change();
                        $('#identitas_penanggung_jawab').val(res.data.data_identitas.identitas).change();
                        $('#npwp_perseorangan').val(res.data.npwp_perseorangan).change();

                        let upperIdentitas = res.data.identitas.toUpperCase();
                        $('#identitas_perusahaan').val(upperIdentitas).change();
                    } else {
                        $('#jenis_cust').val('').change();
                        $('#bidang_usaha').val('').change();
                        $('#status_kepemilikan').val('').change();
                        $('#identitas_perusahaan').val('').change();
                        $('#status_pkp').val('').change();
                        $('#status_rekening').val('').change();
                        $('#identitas_penanggung_jawab').val('').change();
                        $('input[name="jenis_transaksi"]').val('cash').prop('checked', true);
                        $('input[name="tipe_harga"]').val('end_user').prop('checked', true);
                        $('#kategori_customer').val('').change();
                        $('#channel_distributor').val('').change();
                        $('#keterangan').val('').change();
                        $('#status_cabang').val('0').change();
                        $('#sales').val('').change();
                    }
                }
            });
            // END: Get data untuk select

            // START: Dynamic row
            let counter = 1;
            $('#addRow').on('click', function() {
                counter++;
                $('#counter').val(counter);
                $('.dynamic-row').append(`
                    <hr class="line-${counter}">
                    <div class="w-100">
                        <div class="d-flex flex-column gap-3">
                            <div class="row g-3 counter-${counter} numDiv">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group-modal">
                                        <label for="">Nomor NITKU (22 digit)</label>
                                        <input type="text" class="form-control" name="nitku_cabang[]" id="nitku_cabang" placeholder="Masukkan nomor NITKU" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="22">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group-modal">
                                        <label for="">Nama Cabang</label>
                                        <input type="text" class="form-control" name="nama_cabang[]" id="nama_cabang" placeholder="Masukkan nama cabang" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-group-modal">
                                        <label for="">Alamat NITKU</label>
                                        <textarea name="alamat_nitku[]" id="alamat_nitku" cols="30" rows="5" class="form-control" placeholder="Masukkan alamat NITKU" autocomplete="off"></textarea>
                                    </div>
                                </div>    
                            </div>
                            <div class="mt-4">
                                <button type="button" id="delRow" class="btn btn-danger" title="Hapus" data-id="${counter}"><i class="fa-solid fa-minus text-light"></i></button>
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

            // START: AUTO CAPITAL TEXT
            $(document).on('keyup', '#nama_perusahaan, #nama_group_perusahaan, #alamat_lengkap, #alamat_group_lengkap, #bidang_usaha_lain, #nama_group, #nama_lengkap, #alamat_ktp, #nama_rekening, #nama_bank, #rekening_lain, #nama_penanggung_jawab, #jabatan, #kota_kabupaten, #nama_cabang, #alamat_nitku, #payment_term', function() {
                $(this).val($(this).val().toUpperCase());
            });
            // END: AUTO CAPITAL TEXT
        });
    </script>
@endsection
