<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;

class PDFLetterService
{
    public static function print($today, $letter, $executionStaffs, $staffs, $executionVolunteers, $volunteers)
    {
        $imageBase64 = self::generateBase64($letter->signature->tanda_tangan);

        $pdf = Pdf::loadView('pdf.surat-tugas', [
            'letter' => $letter,
            'today' => $today,
            'imgbase64' => $imageBase64,
            'executionStaffs' => $executionStaffs,
            'staffs' => $staffs,
            'executionVolunteers' => $executionVolunteers,
            'volunteers' => $volunteers,
        ]);

        return response()->streamDownload(
            function () use ($pdf) {
                echo $pdf->output();
            },
            'laporan.pdf'
        );
    }

    private static function generateBase64($path)
    {
        $storagePath = storage_path('app/public/' . $path);
        $imageData = base64_encode(file_get_contents($storagePath));
        $result = 'data:image/' . pathinfo($storagePath, PATHINFO_EXTENSION) . ';base64,' . $imageData;

        return $result;
    }
}
