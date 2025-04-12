<?php

namespace App\Exports;

use App\Models\Student;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentsExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
{
    public $beasiswa_id;

    public function __construct($beasiswa_id)
    {
        $this->beasiswa_id = $beasiswa_id;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['name' => 'Arial', 'size' => 10],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '6A0DAD'],
                ]
            ],
            'A:L' => ['font' => ['name' => 'Arial', 'size' => 10]],
        ];
    }

    public function collection()
    {
        return Student::select(
            'created_at',
            'asal_sekolah',
            'nis',
            'nisn',
            'nama_peserta_didik',
            'kelas',
            'jurusan',
            'rangking',
            'besaran_beasiswa',
            'status_loa',
            'status_sk_rektor',
            'status_pembayaran',
            'tgl_ajuan'
        )->get()->map(function ($student) {
            return [
                'Timestamp' => Carbon::parse($student->created_at)->format('d/m/Y H:i:s'),
                'Nama Asal Sekolah' => $student->asal_sekolah,
                'Nomor Induk/NISN' => $student->nis . ' / ' . $student->nisn,
                'Nama Peserta Didik' => $student->nama_peserta_didik,
                'Kelas' => $student->kelas,
                'Jurusan' => $student->jurusan,
                'Rangking' => $student->rangking,
                'Besaran Beasiswa Diajukan' => ($student->besaran_beasiswa * 100) . '%',
                'Status LoA' => $student->status_loa,
                'Status SK Rektor' => $student->status_sk_rektor,
                'Status Pembayaran ' => $student->status_pembayaran,
                'Tgl Ajuan LoA' => Carbon::parse($student->tgl_ajuan)->format('Y/m/d'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Timestamp',
            'Nama Asal Sekolah',
            'Nomor Induk/NISN',
            'Nama Peserta Didik',
            'Kelas',
            'Jurusan',
            'Rangking',
            'Besaran Beasiswa Diajukan',
            'Status LoA',
            'Status SK Rektor',
            'Status Pembayaran ',
            'Tgl Ajuan LoA',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 25,
            'C' => 30,
            'D' => 25,
            'E' => 10,
            'F' => 20,
            'G' => 10,
            'H' => 30,
            'I' => 25,
            'J' => 25,
            'K' => 25,
            'L' => 20,
        ];
    }
}
