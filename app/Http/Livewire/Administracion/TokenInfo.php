<?php

namespace App\Http\Livewire\Administracion;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Registro;
use Illuminate\Support\Facades\DB;

class TokenInfo extends Component
{
    use WithPagination;  
    
    public function mount($id)
    {
        $this->token = DB::table('personal_access_tokens')->where('id', $id)->get();
        $this->tokenID = $id;
    }

    public function render()
    {
        //informacion del token         
        $infotokens = $this->token;
        //listar usuarios
        $usuarios = User::all();

        //buscar registros del token
        $registros = Registro::where('token_id', $this->tokenID)->get();
        //filtrar los registros del token de forma detallada
        $registrostotales = $registros->count();
        $usd = $registros->where('operacion', 'consultar USD')->count();
        $cne = $registros->where('operacion', 'consultar Cedula CNE')->count();
        $pensionadoIVSS = $registros->where('operacion', 'consultar Pensionado IVSS')->count();
        $individualIVSS = $registros->where('operacion', 'consultar Cuenta Individual IVSS')->count();        
        $whatsapp = $registros->where('operacion', 'WhatsApp')->count();

        return view('livewire.administracion.token-info',[
            'infotokens' => $infotokens,
            'usuarios' => $usuarios,
            'registrostotales' => $registrostotales,
            'usd' => $usd,
            'cne' => $cne,
            'pensionadoIVSS' => $pensionadoIVSS,
            'individualIVSS' => $individualIVSS,
            'whatsapp' => $whatsapp
        ]);
    }
}
