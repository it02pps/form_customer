<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFinance extends Model
{
    use HasFactory;
    protected $table = 'data_finance';
    protected $guarded = [];

    public function identitas_perusahaan()
    {
        return $this->belongsTo(IdentitasPerusahaan::class, 'identitas_perusahaan_id');
    }
}
