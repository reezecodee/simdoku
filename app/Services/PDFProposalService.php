<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;

class PDFProposalService{

    public static function print($proposal, $date, $planSchedules, $committees, $budgets)
    {
        $imageBase64 = generateBase64($proposal->signature->tanda_tangan);
        $title = " " . $proposal->judul ?? "Tak Berjudul";

        $pdf = Pdf::loadView('pdf.proposal', [
            'proposal' => $proposal,
            'date' => $date,
            'imgbase64' => $imageBase64,
            'planSchedules' => $planSchedules,
            'committees' => $committees,
            'budgets' => $budgets
        ]);

        return response()->streamDownload(
            function () use ($pdf) {
                echo $pdf->output();
            },
            "Dokumen Proposal:{$title}.pdf"
        );
    }
}