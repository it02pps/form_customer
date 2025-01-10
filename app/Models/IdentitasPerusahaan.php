<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentitasPerusahaan extends Model
{
    use HasFactory;
    protected $table = 'identitas_perusahaan';
    protected $fillable = ['*'];

    public function data_identitas() {
        return $this->hasOne(DataIdentitas::class, 'identitas_perusahaan_id', 'id');
    }

    public function informasi_bank() {
        return $this->hasOne(InformasiBank::class, 'identitas_perusahaan_id', 'id');
    }

    public function tipe_customer() {
        return $this->hasOne(TipeCustomer::class, 'identitas_perusahaan_id', 'id');
    }
}
