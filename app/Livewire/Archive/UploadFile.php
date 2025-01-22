<?php

namespace App\Livewire\Archive;

use App\Models\Archive;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use ZipArchive;

class UploadFile extends Component
{
    use WithFileUploads;

    #[Title('Upload Files')]

    public $files = [];

    #[Validate]
    public $nama_zip;
    #[Validate]
    public $new_files;

    protected function rules()
    {
        return [
            'new_files.*' => 'required|file',
            'nama_zip' => 'required|max:255|unique:archives,nama_zip'
        ];
    }

    protected function messages()
    {
        return [
            'new_files.*.required' => 'Harap upload file setidaknya satu.',
            'new_files.*.file' => 'File yang di unggah tidak valid.',
            'nama_zip.required' => 'Harap isi nama ZIP.',
            'nama_zip.max' => 'Maksimal nama ZIP adalah 255 karakter.',
            'nama_zip.unique' => 'Nama ZIP sudah digunakan.'
        ];
    }

    public function updatedNewFiles($newFiles)
    {
        if (is_array($newFiles)) {
            $this->files = array_merge($this->files, $newFiles);
        }

        $this->reset('new_files');
    }

    public function removeFile($index)
    {
        unset($this->files[$index]);
        $this->files = array_values($this->files); 
    }

    public function submit()
    {
        $data = $this->validate();
        $kebabCase = strtolower(preg_replace('/\s+/', '-', $data['nama_zip']));
        $data['file_zip'] = $this->generateZIPFile($this->files, $kebabCase);

        Archive::create($data);

        session()->flash('success', 'Berhasil menambahkan arsip baru.');
        return redirect()->to(route('archive.index'));
    }

    private function generateZIPFile($files, $zipName)
    {
        $zipFileName = "{$zipName}.zip";
        $zipFilePath = Storage::disk('public')->path('archives/' . $zipFileName);

        if (!Storage::disk('public')->exists('archives')) {
            Storage::disk('public')->makeDirectory('archives');
        }

        $uniqueTempDir = 'temp/' . uniqid(); 
        Storage::disk('public')->makeDirectory($uniqueTempDir);

        $zip = new ZipArchive;

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            foreach ($files as $file) {
                $filePath = $file->store($uniqueTempDir, 'public'); 
                $absoluteFilePath = Storage::disk('public')->path($filePath); 

                if (File::exists($absoluteFilePath)) {
                    $zip->addFile($absoluteFilePath, $file->getClientOriginalName());
                } else {
                    return back()->withErrors('Gagal memproses permintaan. Silakan coba lagi nanti.');
                }
            }

            try {
                $zip->close();

                Storage::disk('public')->deleteDirectory($uniqueTempDir);
            } catch (\Exception $e) {
                return back()->withErrors('Gagal memproses permintaan. Silakan coba lagi nanti.');
            }

            return 'archives/'.$zipFileName;
        } else {
            return back()->withErrors('Gagal memproses permintaan. Silakan coba lagi nanti.');
        }
    }

    public function render()
    {
        return view('livewire.archive.upload-file');
    }
}
