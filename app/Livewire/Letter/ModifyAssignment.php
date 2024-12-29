<?php

namespace App\Livewire\Letter;

use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Livewire\Attributes\Title;
use Livewire\Component;

class ModifyAssignment extends Component
{
    #[Title('Buat Surat Tugas')]
    
    public function downloadPDF()
    {
        $pdf = Pdf::loadView('pdf.surat-tugas');

        return response()->streamDownload(
            fn() => print($pdf->stream()), 'laporan.pdf'
        );
    }

    // public function pieChart()
    // {
    //     // Memuat JPGraph
    //     include(public_path('jpgraph/src/jpgraph.php'));
    //     include(public_path('jpgraph/src/jpgraph_pie.php'));

    //     // Data untuk Pie Chart
    //     $data = [10, 20, 30, 40];
    //     $labels = ['January', 'February', 'March', 'April'];

    //     // Membuat objek PieGraph
    //     $graph = new \PieGraph(400, 300);
    //     $graph->SetShadow();

    //     // Membuat objek pie chart
    //     $p1 = new \PiePlot($data);
    //     $p1->SetLegends($labels);

    //     // Menambahkan PieChart ke dalam graph
    //     $graph->Add($p1);

    //     // Menyimpan grafik ke dalam file sementara
    //     $graph->Stroke(public_path('charts/piechart.png'));

    //     // Menampilkan gambar dalam tampilan blade
    //     return view('pdf.surat-tugas', ['image' => url('charts/piechart.png')]);
    // }

    public function generatePdf()
    {
        include(public_path('jpgraph/src/jpgraph.php'));
        include(public_path('jpgraph/src/jpgraph_pie.php'));

        $data = [10, 20, 30, 40];
        $labels = ['January', 'February', 'March', 'April'];

        $graph = new \PieGraph(400, 300);
        $graph->SetShadow();

        $p1 = new \PiePlot($data);
        $p1->SetLegends($labels);

        $graph->Add($p1);
        $graph->Stroke(public_path('charts/piechart.png'));

        $imagePath = public_path('charts/piechart.png');
        $imageData = base64_encode(file_get_contents($imagePath));
        $image = '<img src="data:image/png;base64,' . $imageData . '" alt="Pie Chart">';

        $pdf = Pdf::loadView('pdf.surat-tugas', [
            'image' => $image
        ]);

        return response()->streamDownload(
            function () use ($pdf, $imagePath) {
                print($pdf->stream());
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            },
            'laporan.pdf'
        );    
    }


    public function render()
    {
        return view('livewire.letter.modify-assignment');
    }
}
