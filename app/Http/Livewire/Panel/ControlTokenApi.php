<?php

namespace App\Http\Livewire\Panel;

use Livewire\Component;
use Livewire\WithPagination;

class ControlTokenApi extends Component
{
    use WithPagination;

    public function render()
    {
        // obtener la lista de tokens de un usuario
        $tokens = auth()->user()->tokens()->paginate(5);
        
        return view('livewire.panel.control-token-api',[
            'tokens' => $tokens,
        ]);
    }
}
