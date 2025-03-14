<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;

class PDFReportService
{
    public static function print()
    {
        // $imageBase64 = generateBase64($proposal->signature->tanda_tangan);

        $pdf = Pdf::loadView('pdf.laporan');

        return response()->streamDownload(
            function () use ($pdf) {
                echo $pdf->output();
            },
            'laporan.pdf'
        );
    }
}
