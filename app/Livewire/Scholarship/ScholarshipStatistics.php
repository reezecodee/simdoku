<?php

namespace App\Livewire\Scholarship;

use App\Models\Scholarship;
use Livewire\Attributes\Title;
use Livewire\Component;
use ZipArchive;

class ScholarshipStatistics extends Component
{
    #[Title('Statistik Beasiswa')]

    public $id, $scholarship;

    public function mount($id)
    {
        $this->id = $id;
        $this->scholarship = Scholarship::findOrFail($id);
    }

    public function downloadAll()
    {
        $title = $this->scholarship->nama ?? 'Beasiswa Tak Berjudul';
        $zipFile = storage_path("app/{$title}.zip");
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
