<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    protected $table = 'cabang';
    protected $guarded = [];

    public function identitas_perusahaan()
    {
        return $this->belongsTo(IdentitasPerusahaan::class, 'identitas_perusahaan_id');
    }
}
