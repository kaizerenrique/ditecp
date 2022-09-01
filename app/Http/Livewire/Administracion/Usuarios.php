<?php

namespace App\Http\Livewire\Administracion;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class Usuarios extends Component
{
    use WithPagination;

    public $buscar;
    public $usuario;
    public $name;
    public $email;

    protected $queryString = [
        'buscar' => ['except' => '']
    ];

    public function render()
    {
        //listar los usuarios y consultar por nombre y correo
        $usuarios = User::where('name', 'like', '%'.$this->buscar . '%')  //buscar por nombre de usuario
                      ->orWhere('email', 'like', '%'.$this->buscar . '%') //buscar por correo de usuario
                      ->orderBy('id','desc') //ordenar de forma decendente
                      ->paginate(10); //paginacion
        
        $roles = Role::all();
        //Numero de Usuarios Totales
        $users_count = User::count();

        return view('livewire.administracion.usuarios',[
            'usuarios' => $usuarios,
            'roles' => $roles,
            'users_count' => $users_count
        ]);
    }

    //Actualizar tabla para corregir falla de busqueda
    public function updatingBuscar()
    {
        $this->resetPage();
    }
}
