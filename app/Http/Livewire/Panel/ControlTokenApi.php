<?php

namespace App\Http\Livewire\Panel;

use Livewire\Component;
use Livewire\WithPagination;
use Mail;
use App\Mail\NotificacionMailable;

class ControlTokenApi extends Component
{
    use WithPagination;

    //variables
    public $agregarToken = false;
    public $mostrarTokenApi = false;
    public $eliminatoken = false;
    public $modalMensaje = false;
    public $identificador;
    public $titulo;
    public $mensaje;
    public $name;
    public $buscar;
    
    protected $queryString = [
        'buscar' => ['except' => '']
    ];

    public function render()
    {
        // obtener la lista de tokens de un usuario y ordenar por tiempo de actualizacion
        $tokens = auth()->user()->tokens()->where('name', 'like', '%'.$this->buscar . '%')->orderBy('last_used_at', 'desc')->paginate(5);
        
        
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

        $this->mensaje = 'Esta Seguro de querer Eliminar el token, una vez eliminado no puede ser recuperado.';
        $this->identificador = $tokenId;
        $this->eliminatoken = true;

    }

    public function borrarToken($id)
    {        
        $tokenId = $id;        
        auth()->user()->tokens()->where('id', $tokenId )->delete();
        //actualiza la tarjeta de informacion 
        $this->emitTo('panel.targetas-informacion', 'eliminarToken');
        $this->eliminatoken = false;
    }

    //registrar nuevo token

    protected $rules = [
        'name' => 'required|min:6',
    ];

    public function tokenAdd()
    {
        //total tokens disponibles
        $tokensTotales = auth()->user()->parametro->limite;

        //consultar numero de tokens registrados
        $tokensNumero = auth()->user()->tokens()->count();

        if ($tokensTotales == $tokensNumero) {
            $this->titulo = 'Notificación.';
            $this->mensaje = 'A alcanzado el numero total de tokens disponibles para su cuenta.';
            $this->modalMensaje = true;
        } else {
            $this->reset(['name']);
            $this->agregarToken = true;
        }
    }

    public function generarToken()
    {
        $this->validate();
        
        $nombre = $this->name;
        $tokenNuevo = auth()->user()->createToken($nombre, ["USD","CNE","IVSS"])->plainTextToken;
        $tokenNuevo = explode('|', $tokenNuevo)[1];
        
        $this->agregarToken = false;
        //actualiza la tarjeta de informacion 
        $this->emitTo('panel.targetas-informacion', 'eliminarToken');
        //$this->token = $tokenNuevo;
        //$this->mostrarTokenApi = true;

        //funcion que envia el correo
        $subject = 'Nuevo Token Registrado';
        $mensajeCorreo = 'Se a generado un nuevo token con las siguientes características: ';
        $name = $this->name;
        $email = auth()->user()->email;
        $password = $tokenNuevo;

        try {
            $confirmacion = Mail::to($email)->send(new NotificacionMailable($subject, $mensajeCorreo, $name, $email, $password));            
            $this->mensaje = 'Token registrado correctamente y correo enviado.';
            $this->token = $tokenNuevo;
            $this->mostrarTokenApi = true;
        } catch (\Throwable $th) {
            $confirmacion = false;
            $this->mensaje = 'EL token se a generado correctamente, pero no se logro enviar por correo.';
            $this->token = $tokenNuevo;
            $this->mostrarTokenApi = true;
        }  
        
    }

}
