<?php

namespace App\Http\Livewire\Administracion;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Usuarios extends Component
{
    use WithPagination;

    public $buscar;
    public $usuario;
    public $name;
    public $email;
    public $rol;
    public $token;

    public $modalAgregarUsuario = false;

    protected $queryString = [
        'buscar' => ['except' => '']
    ];

    public function render()
    {
        //listar los usuarios y consultar por nombre y correo
        $usuarios = User::where('name', 'like', '%'.$this->buscar . '%')  //buscar por nombre de usuario
                      ->orWhere('email', 'like', '%'.$this->buscar . '%') //buscar por correo de usuario
                      ->orderBy('id','desc') //ordenar de forma decendente
                      ->paginate(8); //paginacion
        
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

    public function usuarioAdd()
    {
        $this->reset(['name']);
        $this->reset(['email']);
        $this->modalAgregarUsuario = true;
    }

    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email|unique:users',
        'rol' => 'required',
        'token' => 'required|numeric|integer',
    ];

    public function guardarUsuario()
    {
        $this->validate();

        //genera una contraseña de 8 caracteres de forma randon
        //$password = Str::random(8);
        $password = '12345678';
        $limite = $this->token;

        $usuario = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($password),
        ])->assignRole($this->rol)->parametro()->create([
            'limite' => $limite
        ]);
        
        $this->modalAgregarUsuario = false;               
    }
}
