<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadImages extends Component
{
    use WithFileUploads;

    public $images = [];
    public $uploadedImages = []; // Menyimpan gambar yang sudah diunggah sebelumnya

    public function updatedImages()
    {
        foreach ($this->images as $image) {
            $this->validate([
                'images.*' => 'image|max:2048|mimes:jpg,png',
            ]);
        }

        // Menyimpan gambar baru tanpa menghapus yang lama
        $this->uploadedImages = array_merge($this->uploadedImages, $this->images);

        // Reset $images agar input file bisa digunakan kembali
        $this->images = [];
    }

    public function removeImage($index)
    {
        unset($this->uploadedImages[$index]);
        $this->uploadedImages = array_values($this->uploadedImages); // Reset indeks array
    }

    public function submit()
    {
        $savedImages = [];
        foreach ($this->uploadedImages as $image) {
            $savedImages[] = $image->store('images', 'public'); // Simpan ke storage
        }

        session()->flash('message', 'Upload berhasil!');
        $this->uploadedImages = []; // Reset setelah upload (opsional)
    }

    public function render()
    {
        return view('livewire.components.upload-images');
    }
}
