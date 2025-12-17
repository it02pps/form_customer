<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

Class pdfGeneratorServices
{
    public function generate($data, ?string $signaturePath): string
    {
        $view = $data->bentuk_usaha === 'perseorangan'
            ? 'pdf.perseorangan_pdf'
            : 'pdf.badan_usaha_pdf';
            
        $pdf = Pdf::loadView($view, [
            'data' => $data,
            'signatureImage' => $signaturePath
        ]);

        $name = uniqid() . '-' . Str::slug($data->nama_perusahaan, '-') . '.pdf';
        $path = public_path("temp_files/$name");

        file_put_contents($path, $pdf->output());

        return $path;
    }
}