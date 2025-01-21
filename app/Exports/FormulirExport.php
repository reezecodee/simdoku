<?php

namespace App\Exports;

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

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return collect([]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
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
                $signature->setCoordinates('C21');
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
                $event->sheet->setCellValue('B4', 'Agung Baitul Hikmah, S.Kom, M.Kom');
                $event->sheet->setCellValue('C4', 'Jumat, 25 Oktober 2024');
                
                $event->sheet->setCellValue('A5', 'Unit Kerja');
                $event->sheet->setCellValue('B5', 'Kepala Kampus');
                
                $event->sheet->setCellValue('A6', 'No. Rekening Bank dan');
                $event->sheet->setCellValue('B6', '0941318214(BCA)');
                $event->sheet->setCellValue('C6', 'Hari/Tgl. Diperlukan');
                
                $event->sheet->setCellValue('A7', 'Nama');
                $event->sheet->setCellValue('B7', 'Siti Fatimah');
                $event->sheet->setCellValue('C7', 'Senin, 28 Oktober 2024');

                $event->sheet->mergeCells('A8:B8');
                $event->sheet->setCellValue('A8', 'Keterangan Pengajuan Dana');
                $event->sheet->getStyle('A8:B8')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $event->sheet->setCellValue('C8', 'Jumlah');
                $event->sheet->getStyle('A8:C8')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('A8:C8')->getFont()->setBold(true);
                
                $event->sheet->mergeCells('A9:B9');
                $event->sheet->setCellValue('A9', 'Biaya Pendaftaran Edu Fair dan Job Fair SMAN 10 Tasikmalaya (29 Oktober 2024)');
                $event->sheet->setCellValue('C9', '500000');
                

                $event->sheet->mergeCells('A15:B15');
                $event->sheet->setCellValue('A15', 'Total Dana Dibutuhkan');
                $event->sheet->setCellValue('B15', 'Rp.');
                $event->sheet->setCellValue('C15', '=SUM(C11:C13)');
                
                $event->sheet->mergeCells('A16:C16');
                $event->sheet->setCellValue('A16', 'Terbilang : #Enam Ratus Dua Puluh Lima Rupiah#');
                $event->sheet->getStyle('A16:C16')->getFont()->setBold(true);

                $event->sheet->setCellValue('A18', 'Menyetujui,');
                $event->sheet->setCellValue('B18', 'Mengetahui');
                $event->sheet->setCellValue('C18', 'Pemohon,');
                
                $event->sheet->setCellValue('A19', 'Ka. Divisi MER');
                $event->sheet->setCellValue('B19', 'Ka. BAKU');
                $event->sheet->setCellValue('C19', 'Kepala Kampus UBSI Kampus Tasikmalaya');
                
                $event->sheet->setCellValue('A23', '(Ir. Naba Aji Noto Seputro, M.Kom)');
                $event->sheet->setCellValue('B23', '(Dwi Astuti Ratriningsih, M.Kom)');
                $event->sheet->setCellValue('C23', '(Agung Baitul Hikmah,S.Kom, M.Kom)');
                
                $event->sheet->setCellValue('A24', 'Tanggal :');
                
                $borders = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ];
                
                $event->sheet->getStyle('A2:C7')->applyFromArray($borders);
                
                $event->sheet->getStyle('C11:C13')->getNumberFormat()->setFormatCode('#,##0');
                $event->sheet->getStyle('C20')->getNumberFormat()->setFormatCode('#,##0');
                
                $event->sheet->getStyle('A18:C23')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('C4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('C7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $event->sheet->getStyle('A8:C8')->applyFromArray([
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
                $event->sheet->getStyle('A15:C16')->applyFromArray([
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

                $event->sheet->getStyle('A1:C24')->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);
            },
        ];
    }
}
