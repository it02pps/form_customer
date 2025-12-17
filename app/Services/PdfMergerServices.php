<?php

namespace App\Services;

use setasign\Fpdi\Fpdi;

Class PdfMergerServices
{
    public function merge(array $files,  string $companyName): string
    {
        require_once base_path('vendor/setasign/fpdf/fpdf.php');
        require_once base_path('vendor/setasign/fpdi/src/autoload.php');

        $pdf = new Fpdi();
        $pdf->SetAutoPageBreak(true, 20);

        foreach($files as $index => $file) {
            $path = is_array($file) ? $file['path'] : $file;
            if(!$path) continue;

            $tmpPath = $this->normalizeFile($path);

            if($index === 0 && str_ends_with($tmpPath, '.pdf')) {
                $pageCount = $pdf->setSourceFile($tmpPath);
                for($i = 1; $i <= $pageCount; $i++) {
                    $tpl = $pdf->importPage($i);
                    $size = $pdf->getTemplateSize($tpl);

                    $pdf->AddPage();
                    $pdf->useTemplate($tpl, 0, 0, $size['width']);
                }

                continue;
            }

            // Lampiran
            $pdf->AddPage();

            if(is_array($file) && isset($file['title'])) {
                $pdf->SetFont('Arial', 'B', 13);
                $pdf->Cell(0, 10, $file['title'], 0, 1, 'C');
                $pdf->ln(5);
            }

            if(str_ends_with($tmpPath, '.pdf')) {
                $pageCount = $pdf->setSourceFile($tmpPath);
                for($i = 0; $i <= $pageCount; $i++) {
                    if($i > 0) $pdf->AddPage();

                    $tpl = $pdf->importPage($i);
                    $size = $pdf->getTemplateSize($tpl);

                    $x = (210 - $size['width']) / 2;
                    $pdf->useTemplate($tpl, $x, 30);
                }
            } else {
                $pdf->Image($tmpPath, 20, 30, 170);
            }
        }

        $output = public_path('temp_files/' . uniqid() . '-FORMULIR-CUSTOMER.pdf');
        $pdf->output($output, 'F');

        return $output;
    }

    private function normalizeFile(string $file): string
    {
        if(str_starts_with($file, 'data:image')) {
            [$meta, $data] = explode(',', $file);
            $ext = str_contains($meta, 'png') ? 'png' : 'jpg';

            $path = storage_path('app/tmp_' . uniqid() . '.' . $ext);
            file_put_contents($path, base64_decode($data));
            return $path;
        }

        if(file_exists($file)) {
            return $file;
        }

        throw new \RuntimeException("File not found; {$file}");
    }
}