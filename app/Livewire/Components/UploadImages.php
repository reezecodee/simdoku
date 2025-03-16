<?php

namespace App\Livewire\Components;

use App\Models\ReportFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class UploadImages extends Component
{
    use WithFileUploads;

    public $images = [];
    public $documentation = [];
    public $attendance = [];
    public $receipt = [];
    public $uploadedImages = [
        'documentation' => [],
        'attendance' => [],
        'receipt' => [],
    ];
    public $type;
    public $id;

    public function mount($id, $type)
    {
        $this->id = $id;
        $this->type = $type;
        $this->loadUploadedImages();
    }

    public function updatedImages()
    {
        $this->validate([
            "images" => "array",
            "images.*" => "image|max:10240|mimes:jpg,png",
        ]);

        foreach ($this->images as $image) {
            $this->uploadedImages[$this->type][] = [
                "file" => $image,
                "url" => $image->temporaryUrl(),
            ];
        }

        $this->images = [];
    }

    public function removeImage($index)
    {
        if (isset($this->uploadedImages[$this->type][$index]['id'])) {
            $file = ReportFile::where('id', $this->uploadedImages[$this->type][$index]['id'])->first();
            if ($file) {
                Storage::disk('public')->delete($file->filename);
                $file->delete();
            }
        }
    
        unset($this->uploadedImages[$this->type][$index]);
        $this->uploadedImages[$this->type] = array_values($this->uploadedImages[$this->type]);
    }

    public function submit()
    {
        foreach ($this->uploadedImages[$this->type] as $imageData) {
            if (isset($imageData['file']) && $imageData['file'] instanceof TemporaryUploadedFile) {
                $path = $imageData['file']->store("images/{$this->type}", 'public');

                ReportFile::create([
                    'laporan_id' => $this->id,
                    'type' => $this->type,
                    'filename' => $path,
                ]);
            }
        }

        session()->flash('message', 'Upload berhasil!');
        $this->loadUploadedImages();
    }

    public function loadUploadedImages()
    {
        $this->uploadedImages[$this->type] = [];

        $savedFiles = ReportFile::where('laporan_id', $this->id)
            ->where('type', $this->type)
            ->get();

        foreach ($savedFiles as $file) {
            $this->uploadedImages[$this->type][] = [
                'id' => $file->id,
                'url' => asset('storage/' . $file->filename)
            ];
        }
    }

    public function render()
    {
        return view('livewire.components.upload-images');
    }
}
