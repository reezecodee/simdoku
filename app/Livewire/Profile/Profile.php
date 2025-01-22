<?php

namespace App\Livewire\Profile;

use App\Models\Profile as ModelsProfile;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    #[Title('Profile Saya')]

    public $nama, $nip, $tanda_tangan;

    public function mount()
    {
        $profile = ModelsProfile::latest()->first();

        $this->nama = $profile->nama ?? 'Belum diatur';
        $this->nip = $profile->nip ?? 'Belum diatur';
    }

    protected function rules()
    {
        return [
            'nama' => 'nullable|max:255',
            'nip' => 'nullable|max:255',
            'tanda_tangan' => 'nullable|file|mimes:jpg,png'
        ];
    }

    protected function messages()
    {
        return [
            'nama.max' => 'Nama tidak boleh melebihi 255 karakter.',
            'nip.max' => 'NIP tidak boleh melebihi 255 karakter.',
            'tanda_tangan.file' => 'Tanda tangan tidak valid.',
            'tanda_tangan.mimes' => 'Tanda tangan harus berupa gambar dengan ekstensi JPG atau PNG.'
        ];
    }

    public function submit($id)
    {
        $data = $this->validate();
        $profile = ModelsProfile::find($id);

        if ($profile && $this->tanda_tangan && $profile->tanda_tangan && Storage::disk('public')->exists($profile->tanda_tangan)) {
            Storage::disk('public')->delete($profile->tanda_tangan);
        }

        if($this->tanda_tangan){
            $originalExtension = $this->tanda_tangan->getClientOriginalExtension();
            $uniqueFileName = uniqid() . '.' . $originalExtension;
            $filePath = $this->tanda_tangan->storeAs('my_signature', $uniqueFileName, 'public');
            $data['tanda_tangan'] = $filePath;
        }else{
            unset($data['tanda_tangan']);
        }

        if($profile){
            $profile->update($data);
        }else{
            ModelsProfile::create($data);
        }

        session()->flash('success', 'Berhasil memperbarui profile');
        return redirect()->to(route('profile.index'));
    }

    public function render()
    {
        return view('livewire.profile.profile');
    }
}
