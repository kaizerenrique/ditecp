<?php

namespace App\Http\Livewire\Panel;

use Livewire\Component;

class ControlTokenApi extends Component
{
    public function render()
    {
        // obtener la lista de tokens de un usuario
        $tokens = auth()->user()->tokens;
        
        return view('livewire.panel.control-token-api');
    }
}
