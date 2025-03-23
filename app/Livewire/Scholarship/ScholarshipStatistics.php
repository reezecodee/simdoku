<?php

namespace App\Livewire\Scholarship;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Title;
use Livewire\Component;
use ZipArchive;

class ScholarshipStatistics extends Component
{
    #[Title('Statistik Beasiswa')]

    public $id;

    public function mount($id)
    {
        $this->id = $id;
        $this->generateChart('asal_sekolah', 'school');
        $this->generateChart('kelas', 'class');
        $this->generateChart('jurusan', 'major');
        $this->generateChart('rangking', 'rangking');
        $this->generateChart('besaran_beasiswa', 'scholarship_amount', 'beasiswa');
        $this->generateChart('status_loa', 'status_loa');
        $this->generateChart('status_sk_rektor', 'status_sk_rektor');
        $this->generateChart('status_pembayaran', 'payment_status');
        $this->generateChart('tgl_ajuan', 'submission', 'date');
    }

    public function generateChart($columnName, $filename, $type = null)
    {
        require_once(public_path('jpgraph/src/jpgraph.php'));
        require_once(public_path('jpgraph/src/jpgraph_pie.php'));

        $items = DB::table('students')
            ->select($columnName, DB::raw('COUNT(*) as jumlah'))
            ->where('beasiswa_id', $this->id)
            ->groupBy($columnName)
            ->get();

        $data = [];
        $labels = [];

        if ($type === null) {
            foreach ($items as $item) {
                $data[] = $item->jumlah;
                $labels[] = $item->{$columnName} . " (" . $item->jumlah . ")";
            }
        }

        if ($type === 'beasiswa') {
            foreach ($items as $item) {
                $percentage = (float) $item->{$columnName} * 100;
                $scholarship = number_format($percentage) . ' percent';
                $data[] = (int) $item->jumlah;
                $labels[] = $scholarship . " (" . (int) $item->jumlah . ")";
            }
        }

        if ($type === 'date') {
            foreach ($items as $item) {
                $date = Carbon::parse($item->$columnName)->format('Y/m/d');
                $data[] = $item->jumlah;
                $labels[] = $date . " (" . $item->jumlah . ")";
            }
        }

        $graph = new \PieGraph(500, 400);
        $graph->SetShadow();

        $title = ucwords(str_replace('_', ' ', $columnName));
        $graph->title->Set("Statistik Berdasarkan {$title}");
        $graph->title->SetFont(FF_FONT2, FS_BOLD);

        $p1 = new \PiePlot($data);
        $p1->SetLegends($labels);
        $p1->SetCenter(0.5, 0.5);
        $graph->Add($p1);

        $chartPath = public_path("charts/{$filename}_pie_chart.png");
        $graph->Stroke($chartPath);
    }

    public function downloadAll()
    {
        $zipFile = storage_path('app/charts.zip'); 
        $chartsPath = public_path('charts'); 

        if (!file_exists($chartsPath)) {
            return back()->with('failed', 'Folder charts tidak ditemukan.');
        }

        $zip = new ZipArchive;

        if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $files = glob($chartsPath . '/*'); 

            foreach ($files as $file) {
                if (is_file($file)) {
                    $zip->addFile($file, basename($file)); 
                }
            }

            $zip->close();

            return response()->download($zipFile)->deleteFileAfterSend(true);
        }

        return back()->with('failed', 'Gagal membuat ZIP.');
    }

    public function render()
    {
        return view('livewire.scholarship.scholarship-statistics');
    }
}
