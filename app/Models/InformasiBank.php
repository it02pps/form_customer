<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiBank extends Model
{
    use HasFactory;
    protected $table = 'informasi_bank';
    protected $fillable = ['*'];
}
