<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeCustomer extends Model
{
    use HasFactory;
    protected $table = 'tipe_customer';
    protected $fillable = [''];

    public function identitas_perusahaan() {
        return $this->belongsTo(IdentitasPerusahaan::class, 'identitas_perusahaan_id');
    }
}
