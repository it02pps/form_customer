<?php

namespace App\Services;

use App\Models\DataIdentitas;
use App\Models\IdentitasPerusahaan;

Class UploadApi {
    public static function getUploadedFile() {
        return DataIdentitas::select('foto')->toArray();
    }
}