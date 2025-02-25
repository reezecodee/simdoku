<?php

namespace App\Livewire\Components;

use App\Models\Signature;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class UploadSignature extends Component
{
    use WithFileUploads;

    public $search;

    public $nama_pemilik;
    public $tanda_tangan;
    public $nip;
    public $status;

    protected function rules()
    {
        return [
            'nama_pemilik' => 'required|max:255',
            'nip' => 'nullable|max:255',
            'tanda_tangan' => 'required|file|mimes:jpg,png,jpeg',
            'status' => 'required'
        ];
    }

    public function submit()
    {
        $this->validate();

        $originalExtension = $this->tanda_tangan->getClientOriginalExtension();
        $uniqueFileName = uniqid() . '.' . $originalExtension;
        $filePath = $this->tanda_tangan->storeAs('tanda_tangan', $uniqueFileName, 'public');

        Signature::create([
            'nama_pemilik' => $this->nama_pemilik,
            'nip' => $this->nip,
            'tanda_tangan' => $filePath,
            'status' => $this->status
        ]);

        session()->flash('success', 'Berhasil mengupload tanda tangan baru.');
        return redirect()->to(route('signature.index'));
    }

    public function render()
    {
        return view('livewire.components.upload-signature');
    }
}
