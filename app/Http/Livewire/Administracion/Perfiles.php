<?php

namespace App\Http\Livewire\Administracion;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

        
        //dd($token->abilities);
        //dd($this->listadeatributos);
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
}
