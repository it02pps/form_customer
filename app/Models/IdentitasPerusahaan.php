<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentitasPerusahaan extends Model
{
    use HasFactory;
    protected $table = 'identitas_perusahaan';
    protected $fillable = ['*'];
}