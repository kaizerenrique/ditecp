<?php

namespace App\Http\Livewire\Administracion;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Servicio;
use App\Models\Infoservicios;
use App\Models\Configwhatsapp;

class Perfiles extends Component
{
    use WithPagination;  
    
    public function mount($id)
    {
        $this->usuario = User::find($id);
    }

    public $buscar;
    public $eliminatoken = false;
    public $modalMensaje = false;
    public $identificador;
    public $titulo;
    public $mensaje;
    public $editarTokenModal = false;
    public $token_id, $name, $abilities;

    public $listadeatributos = array(
        '0' => ['id' => 1, 'atributo' => '["USD","CNE","IVSS"]'],
        '1' => ['id' => 2, 'atributo' => '["USD","CNE","IVSS","WhatsApp"]'],
        '3' => ['id' => 3, 'atributo' => '["Desactivado"]'],
    );

    public $agregarconfigWhatsAppModal = false;
    public $usuario_id, $servicios_id, $tokenapid, $token, $uri, $id_wha_buss, $id_tlf_buss, $telefono_comercial;

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

        $servicios = Servicio::all();
        
        return view('livewire.administracion.perfiles',[
            'usuario' => $usuario,
            'tokenslis' => $tokenslis,
            'tokens' => $tokens,
            'servicios' => $servicios
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
        $tokens = DB::table('personal_access_tokens')->where('id', $tokenId )->delete();

        $this->eliminatoken = false;
    }

    public function editarToken($id)
    {
        $token = DB::table('personal_access_tokens')->find($id);
        $this->token_id = $token->id;
        $this->name = $token->name; 

        if ($token->abilities == '["USD","CNE","IVSS"]') {
            $this->abilities = '1';
        } elseif($token->abilities == '["USD","CNE","IVSS","WhatsApp"]'){
            $this->abilities = '2';
        } elseif($token->abilities == '["Desactivado"]'){
            $this->abilities = '3';
        }
        $this->titulo = "Editar Token";
        $this->editarTokenModal = true;        
    }

    public function guardarcambiodetoken()
    {
        $resul = $this->validate([
            'token_id' => 'required',
            'name' => 'required',
            'abilities' => 'required',
        ]); 

        if ($resul['abilities'] == '1') {
            $abilities = '["USD","CNE","IVSS"]';
        } elseif ($resul['abilities'] == '2') {
            $abilities = '["USD","CNE","IVSS","WhatsApp"]';
        } elseif ($resul['abilities'] == '3') {
            $abilities = '["Desactivado"]';
        }

        $token = DB::table('personal_access_tokens')->where('id', $resul['token_id']);

        $token->update([
            "abilities" => $abilities
        ]);

        $this->editarTokenModal = false;        
    }

    public function agregarWhatsApp($id)
    {
        $token = DB::table('personal_access_tokens')->find($id);

        $this->usuario_id = $token->tokenable_id;//id del usuario propietario del token
        $this->tokenapid = $token->id;
        
        $this->reset(['token']);
        $this->reset(['uri']);
        $this->reset(['id_wha_buss']);
        $this->reset(['id_tlf_buss']);
        $this->reset(['telefono_comercial']);

        $this->agregarconfigWhatsAppModal = true;
    }

    public function guardarconfigWhatsApp()
    {
        $resul = $this->validate([
            'usuario_id' => 'required',
            'servicios_id' => 'required',
            'tokenapid' => 'required',            
            'token' => 'required',
            'uri' => 'required',
            'id_wha_buss' => 'required',
            'id_tlf_buss' => 'required',
            'telefono_comercial' => 'required',
        ]); 

        $nuevo = Configwhatsapp::create([
            'user_id' => $resul['usuario_id'],
            'servicio_id'  => $resul['servicios_id'],
            'token_id'  => $resul['tokenapid'],
            'token'  => $resul['token'],
            'uri'  => $resul['uri'],
            'id_wha_buss'  => $resul['id_wha_buss'],
            'id_tlf_buss'  => $resul['id_tlf_buss'],
            'telefono_comercial'  => $resul['telefono_comercial'],
        ]);

        $this->agregarconfigWhatsAppModal = false;
    }

    public function eliminarTokenWhatsApp($id)
    {
        //optener la configuracion del token
        $configuraciones = Configwhatsapp::where('token_id', $id)->get();

        foreach ($configuraciones as $configuracion)
        {
            $resultado = [
                'id' => $configuracion->id,
                'token_id' => $configuracion->token_id,
            ];            
        }

        if (!empty($resultado)) {           

            $token = DB::table('personal_access_tokens')->where('id', $resultado['token_id']);            
            $abili = '["USD","CNE","IVSS"]';
            $token->update([
                "abilities" => $abili
            ]);
            $eliminar = Configwhatsapp::where('id', $resultado['id'] )->delete();
        } else {
            $this->titulo = "Alerta !!";
            $this->mensaje = 'El token no esta configurado, aun no posee parámetros.';
            $this->modalMensaje = true;
        }
        
    }
}
