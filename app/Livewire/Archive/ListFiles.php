<?php

namespace App\Livewire\Archive;

use App\Models\Archive;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Component;

class ListFiles extends Component
{
    #[Title('Arsip Dokumen')]

    public $search = '';

    public function deleteFileZip($id)
    {
        $archive = Archive::findOrFail($id);

        if ($archive->file_zip && Storage::disk('public')->exists($archive->file_zip)) {
            Storage::disk('public')->delete($archive->file_zip);
        }

        $archive->delete();
    }

    public function updateNamaZip($id, $field, $value)
    {
        $archive = Archive::findOrFail($id);

        if ($archive) {
            $archive->$field = $value;
            $kebabCase = strtolower(preg_replace('/\s+/', '-', $value));
            $newName = 'archives/'.$kebabCase.'.zip';

            if ($archive->file_zip && Storage::disk('public')->exists($archive->file_zip)) {
                rename('storage/'.$archive->file_zip, 'storage/'.$newName);
            }

            $archive->file_zip = $newName;

            $archive->save();
        }
    }

    public function render()
    {
        $archives = Archive::when($this->search, function($query) {
            return $query->where('nama_zip', 'like', '%' . $this->search . '%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(6);
        $total = Archive::count();

        return view('livewire.archive.list-files', compact('archives', 'total'));
    }
}
