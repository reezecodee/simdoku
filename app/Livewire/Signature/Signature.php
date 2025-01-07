<?php

namespace App\Livewire\Signature;

use Livewire\Attributes\Title;
use Livewire\Component;

class Signature extends Component
{
    #[Title('Tanda Tangan')]
    
    public function render()
    {
        return view('livewire.signature.signature');
    }
}
