<?php

namespace App\Livewire\Scholarship;

use App\Exports\StudentsExport;
use App\Models\Scholarship;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ModifyScholarship extends Component
{
    #[Title('Buat Penerima Beasiswa')]

    public $id;
    public $scholarship, $nama, $periode, $tahun;

    public function mount($id)
    {
        $this->id = $id;

        $this->scholarship = Scholarship::findOrFail($id);

        $this->nama = $this->scholarship->nama;
        $this->periode = $this->scholarship->periode;
        $this->tahun = $this->scholarship->tahun;
    }

    public function updated($property)
    {
        $this->scholarship->update([
            $property => $this->$property
        ]);
    }

    private function generateChart($columnName, $filename, $type = null)
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

    public function checkStatistics()
    {
        try {
            $this->generateChart('asal_sekolah', 'school');
            $this->generateChart('kelas', 'class');
            $this->generateChart('jurusan', 'major');
            $this->generateChart('rangking', 'rangking');
            $this->generateChart('besaran_beasiswa', 'scholarship_amount', 'beasiswa');
            $this->generateChart('status_loa', 'status_loa');
            $this->generateChart('status_sk_rektor', 'status_sk_rektor');
            $this->generateChart('status_pembayaran', 'payment_status');
            $this->generateChart('tgl_ajuan', 'submission', 'date');

            return redirect()->to(route('scholarship.statistic', $this->id));
        } catch (\Throwable $e) {
            session()->flash('failed', 'Sebelum melihat statistik harap pastikan Anda sudah mengisi data terlebih dahulu.');
            return redirect()->to(route('scholarship.modify', $this->id));
        }
    }

    public function downloadExcel()
    {
        $title = $this->nama ?? 'Beasiswa Tak Berjudul';
        return Excel::download(new StudentsExport($this->id), "{$title}.xlsx");
    }

    public function render()
    {
        return view('livewire.scholarship.modify-scholarship');
    }
}
