<?php

namespace App\Http\Livewire\Administracion;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class Perfiles extends Component
{
    use WithPagination;  
    
    public function mount($id)
    {
        $this->usuario = User::find($id);
    }

    public $buscar;

    protected $queryString = [
        'buscar' => ['except' => '']
    ];
    
    public function render()
    {
        $usuario = $this->usuario;

        //ultimos tokens usados
        $tokenslis = $usuario->tokens()->orderBy('last_used_at', 'desc')->paginate(6);

        // obtener la lista de tokens de un usuario y ordenar por tiempo de actualizacion
        $tokens = $usuario->tokens()->where('name', 'like', '%'.$this->buscar . '%')->orderBy('last_used_at', 'desc')->paginate(5);
        
        return view('livewire.administracion.perfiles',[
            'usuario' => $usuario,
            'tokenslis' => $tokenslis,
            'tokens' => $tokens,
        ]);
    }

    //Actualizar tabla para corregir falla de busqueda
    public function updatingBuscar()
    {
        $this->resetPage();
    }
}
