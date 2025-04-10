<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;

class PDFLetterService
{
    public static function print($today, $letter, $executionStaffs, $staffs, $executionVolunteers, $volunteers)
    {
        $imageBase64 = generateBase64($letter->signature->tanda_tangan);
        $title = " " . $letter->perihal ?? 'Tak Berperihal';

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
            "Surat Pengajuan{$title}.pdf"
        );
    }
}
