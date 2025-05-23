<?php

namespace App\Livewire\Signature;

use App\Models\Signature as SG;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Component;

class Signature extends Component
{
    #[Title('Tanda Tangan')]

    public $search = '';

    public function deleteSignature($id)
    {
        $signature = SG::findOrFail($id);
        $relations = ['letter', 'proposal', 'report', 'report2', 'formulir', 'formulir2'];

        foreach ($relations as $relation) {
            if (
                method_exists($signature, $relation) &&
                $signature->$relation()->exists()
            ) {
                session()->flash('failed', 'Tanda tangan tidak bisa dihapus karena masih digunakan di data lain.');
                return redirect()->to(route('signature.index'));
            }
        }

        if ($signature->tanda_tangan && Storage::disk('public')->exists($signature->tanda_tangan)) {
            Storage::disk('public')->delete($signature->tanda_tangan);
        }

        $signature->delete();
    }

    public function updateDataPemilik($id, $field, $value)
    {
        $signature = SG::findOrFail($id);

        if ($signature) {
            $signature->$field = $value;
            $signature->save();
        }
    }

    public function render()
    {
        $signatures = SG::when($this->search, function ($query) {
            return $query->where('nama_pemilik', 'like', '%' . $this->search . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        $total = SG::count();

        return view('livewire.signature.signature', compact('signatures', 'total'));
    }
}
