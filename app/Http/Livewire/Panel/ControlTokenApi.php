<?php

namespace App\Http\Livewire\Panel;

use Livewire\Component;
use Livewire\WithPagination;

class ControlTokenApi extends Component
{
    use WithPagination;

    //variables
    public $agregarToken = false;
    public $mostrarTokenApi = false;
    public $name;

    public function render()
    {
        // obtener la lista de tokens de un usuario y ordenar por tiempo de actualizacion
        $tokens = auth()->user()->tokens()->orderBy('last_used_at', 'desc')->paginate(5);
        
        return view('livewire.panel.control-token-api',[
            'tokens' => $tokens,
        ]);
    }

    //Actualizar tabla para corregir falla de busqueda
    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function eliminarToken($id)
    {       
        $tokenId = $id;
        auth()->user()->tokens()->where('id', $tokenId )->delete();

        //actualiza la tarjeta de informacion 
        $this->emitTo('panel.targetas-informacion', 'eliminarToken');
        
    }

    //registrar nuevo token

    protected $rules = [
        'name' => 'required|min:6',
    ];

    public function tokenAdd()
    {
        $this->reset(['name']);
        $this->agregarToken = true;
    }

    public function generarToken()
    {
        $this->validate();
        
        $nombre = $this->name;
        $tokenNuevo = auth()->user()->createToken($nombre, ["read","create","update","delete"])->plainTextToken;
        
        $this->agregarToken = false;
        //actualiza la tarjeta de informacion 
        $this->emitTo('panel.targetas-informacion', 'eliminarToken');
        $this->token = $tokenNuevo;
        $this->mostrarTokenApi = true;
        
    }

}
