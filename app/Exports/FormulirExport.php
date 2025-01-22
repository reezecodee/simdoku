<?php

namespace App\Exports;

use App\Models\BudgetSubmission;
use App\Models\Formulir;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class FormulirExport implements FromCollection, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public $id;
    public $formulir;
    public $budgets;

    public function __construct($id)
    {
        $this->id = $id;
        $this->formulir = Formulir::findOrFail($id);
        $this->budgets = BudgetSubmission::where('formulir_id', $id)->get();
    }

    public function collection()
    {
        return collect([]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->setShowGridlines(false);
                $event->sheet->getColumnDimension('A')->setWidth(25);
                $event->sheet->getColumnDimension('B')->setWidth(100);
                $event->sheet->getColumnDimension('C')->setWidth(35);

                $event->sheet->getStyle('A1:C50')->getFont()->setName('Arial');
                $event->sheet->getStyle('B1')->getFont()->setSize(11);
                $event->sheet->getStyle('A2:C50')->getFont()->setSize(8);

                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $drawing->setName('Logo');
                $drawing->setDescription('Logo');
                $drawing->setPath(public_path('images/logo/logo-bsi.png'));
                $drawing->setHeight(70);
                $drawing->setCoordinates('A1');
                $drawing->setOffsetX(5);
                $drawing->setOffsetY(5);
                $drawing->setWorksheet($event->sheet->getDelegate());

                $signature = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $signature->setName('TTD');
                $signature->setDescription('TTD');
                $signature->setPath(public_path('/ttd.png'));
                $signature->setHeight(70);
                $signature->setCoordinates('C18');
                $signature->setOffsetX(75);
                $signature->setOffsetY(-20);
                $signature->setWorksheet($event->sheet->getDelegate());

                $event->sheet->getRowDimension('1')->setRowHeight(70);
                $event->sheet->mergeCells('A1:C1');
                $event->sheet->setCellValue('A1', "FORMULIR PERMOHONAN PENGAJUAN DANA\nUNIVERSITAS BINA SARANA INFORMATIKA");
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('A1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('A1')->getFont()->setBold(true);
                $event->sheet->getStyle('A1')->getAlignment()->setWrapText(true);

                $event->sheet->setCellValue('A2', 'Diminta oleh');
                $event->sheet->setCellValue('B2', ':');

                $event->sheet->setCellValue('A3', 'Kampus');
                $event->sheet->setCellValue('B3', 'UBSI Kampus Tasikmalaya');
                $event->sheet->setCellValue('C3', 'Hari/Tgl. Pengajuan');

                $event->sheet->setCellValue('A4', 'Pemohon');
                $event->sheet->setCellValue('B4', $this->formulir->pemohon);
                $event->sheet->setCellValue('C4',  $this->formulir->tgl_pengajuan);

                $event->sheet->setCellValue('A5', 'Unit Kerja');
                $event->sheet->setCellValue('B5',  $this->formulir->unit_kerja);

                $event->sheet->setCellValue('A6', 'No. Rekening Bank dan');
                $event->sheet->setCellValue('B6', $this->formulir->no_rekening);
                $event->sheet->setCellValue('C6', 'Hari/Tgl. Diperlukan');
                $event->sheet->getStyle('B6')->getAlignment()->setVertical(Alignment::HORIZONTAL_LEFT);

                $event->sheet->setCellValue('A7', 'Nama');
                $event->sheet->setCellValue('B7', $this->formulir->atas_nama);
                $event->sheet->setCellValue('C7', $this->formulir->tgl_diperlukan);

                $event->sheet->mergeCells('A8:B8');
                $event->sheet->setCellValue('A8', 'Keterangan Pengajuan Dana');
                $event->sheet->getStyle('A8:B8')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $event->sheet->setCellValue('C8', 'Jumlah');
                $event->sheet->getStyle('A8:C8')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('A8:C8')->getFont()->setBold(true);

                $i = 9;
                foreach ($this->budgets as $item) {
                    $event->sheet->mergeCells("A{$i}:B{$i}");
                    $event->sheet->setCellValue("A{$i}", $item->keterangan);
                    $event->sheet->setCellValue("C{$i}", "Rp. " . $item->jumlah);
                    $i++;
                }

                $totalRow = $i + 1;
                $signaturesStartRow = $i + 4;

                $event->sheet->mergeCells("A". $totalRow .":B". $totalRow);
                $event->sheet->mergeCells("A". $totalRow + 1 .":C". $totalRow + 1);
                $event->sheet->setCellValue("A{$totalRow}", 'Total Dana Dibutuhkan');
                $event->sheet->setCellValue("A".($totalRow + 1), "Terbilang # Enam Ratus Dua Puluh Lima Rupiah");
                $event->sheet->setCellValue("C{$totalRow}", "Rp. 0");

                $event->sheet->getStyle("A8:C8")->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['rgb' => 'CCCCCC']
                    ],
                    'font' => [
                        'bold' => true
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN
                        ]
                    ]
                ]);
                $event->sheet->getStyle("A{$totalRow}:C" . ($totalRow + 1))->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['rgb' => 'CCCCCC']
                    ],
                    'font' => [
                        'bold' => true
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN
                        ]
                    ]
                ]);

                $event->sheet->getStyle('A1:C' . ($signaturesStartRow + 6))->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);

                $event->sheet->setCellValue("A{$signaturesStartRow}", 'Menyetujui,');
                $event->sheet->setCellValue("B{$signaturesStartRow}", 'Mengetahui');
                $event->sheet->setCellValue("C{$signaturesStartRow}", 'Pemohon,');

                $event->sheet->setCellValue("A" . ($signaturesStartRow + 1), 'Ka. Divisi MER');
                $event->sheet->setCellValue("B" . ($signaturesStartRow + 1), 'Ka. BAKU');
                $event->sheet->setCellValue("C" . ($signaturesStartRow + 1), 'Kepala Kampus UBSI Kampus Tasikmalaya');

                $event->sheet->setCellValue("A" . ($signaturesStartRow + 5), '(Ir. Naba Aji Noto Seputro, M.Kom)');
                $event->sheet->setCellValue("B" . ($signaturesStartRow + 5), '(Dwi Astuti Ratriningsih, M.Kom)');
                $event->sheet->setCellValue("C" . ($signaturesStartRow + 5), '(Agung Baitul Hikmah,S.Kom, M.Kom)');

                $event->sheet->setCellValue("A" . ($signaturesStartRow + 6), 'Tanggal :');

                $event->sheet->getStyle('A' . ($signaturesStartRow) . ':C' . ($signaturesStartRow + 5))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);



                $borders = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ];
                $leftBorder = [
                    'borders' => [
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN, 
                        ],
                    ],
                ];

                $event->sheet->getStyle('A2:C7')->applyFromArray($borders);
                $event->sheet->getStyle('C9:C' . $totalRow + 1)->applyFromArray($leftBorder);
                $event->sheet->getStyle('C4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('C7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $signature = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $signature->setName('TTD');
                $signature->setDescription('TTD');
                $signature->setPath(public_path('/ttd.png'));
                $signature->setHeight(70);
                $signature->setCoordinates('C'.$totalRow + 6);
                $signature->setOffsetX(75);
                $signature->setOffsetY(-20);
                $signature->setWorksheet($event->sheet->getDelegate());
            },
        ];
    }
}
