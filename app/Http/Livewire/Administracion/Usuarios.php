<?php

namespace App\Http\Livewire\Administracion;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Registro;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\NotificacionMailable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\FuncCall;
use App\Models\Servicio;

class Usuarios extends Component
{
    use WithPagination;    

    public $buscar;
    public $usuario;
    public $name;
    public $email;
    public $rol;
    public $token;
    public $identificador;
    public $titulo;
    public $mensaje;
    public $servicio;
    public $fecha;

    public $modalAgregarUsuario = false;
    public $modalBorrarUsuario = false;
    public $modalMensaje = false;

    public $modalServicio = false;

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

        //cuenta el total de tokens generados
        $tokens = DB::table('personal_access_tokens')->count();

        $tokensinfo = DB::table('personal_access_tokens')->orderBy('last_used_at', 'desc')->paginate(5);

        $registros = Registro::latest()->take(5)->get();

        $servicios = Servicio::all();

        return view('livewire.administracion.usuarios',[
            'usuarios' => $usuarios,
            'roles' => $roles,
            'users_count' => $users_count,
            'tokens' => $tokens,
            'tokensinfo' => $tokensinfo,
            'registros' => $registros,
            'servicios' => $servicios
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
        $this->reset(['token']);
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
        $password = Str::random(8);
        //$password = '12345678';
        $limite = $this->token;

        $usuario = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($password),
        ])->assignRole($this->rol)->parametro()->create([
            'limite' => $limite
        ]);
        
        $this->modalAgregarUsuario = false;

        //funcion que envia el correo
        $subject = 'Nuevo Registro';
        $mensajeCorreo = 'Por medio de este correo le damos la bienvenid@, puedes ingresar usando las siguientes credenciales: ';
        $name = $this->name;
        $email = $this->email;
        $password = $password;

        try {
            $confirmacion = Mail::to($email)->send(new NotificacionMailable($subject, $mensajeCorreo, $name, $email, $password));

            $this->titulo = 'Notificación.';
            $this->mensaje = 'Usuario registrado correctamente y correo enviado.';
            $this->modalMensaje = true;
        } catch (\Throwable $th) {
            $confirmacion = false;

            $this->titulo = '¡ Alerta Error !';
            $this->mensaje = 'Usuario registrado correctamente pero correo no enviado, error en envió de correo. ';
            $this->modalMensaje = true;
        }        
    }

    public function consultarBorrarUsuario($id)
    {
        $usuarioId = $id;  
        $usuario = User::find($id); 

        $this->mensaje = 'Esta Seguro de querer Eliminar al Usuario: '. $usuario->name .' una vez eliminado no puede ser recuperado.';
        $this->identificador = $usuarioId;
        $this->modalBorrarUsuario = true;
    }

    public function borrarUsuario($id)
    {
        $this->modalBorrarUsuario = false;
        $resul = User::find($id);
        $resul->tokens()->delete();
        $resul->delete();
    }

    public function servicioadd($id)
    {
        $usuarioId = $id;
        $usuario = User::find($id); 

        $this->ide = $usuario->id;

        $this->modalServicio = true;
    }

    public function guardarservicio()
    {
        $resul = $this->validate([
            'ide' => 'required',
            'servicio' => 'required',
            'fecha' => 'date'
        ]);

        dd($resul);
    }
}
