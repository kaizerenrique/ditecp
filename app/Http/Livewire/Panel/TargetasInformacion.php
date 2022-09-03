<?php

namespace App\Http\Livewire\Panel;

use Livewire\Component;
use Kaizerenrique\Consultabcv\Consultabcv;

class TargetasInformacion extends Component
{
    protected $listeners = ['eliminarToken'];    
    public function eliminarToken(){

    }

    public function render()
    {
        //consultar Valor BCV
        $usdconsulta = new Consultabcv();
        $usd = $usdconsulta->valorbcv();

        if ($usd == false) {            
            $usd = "Error de conexión.";            
        } else {
            $usd = $usd;       
        }

        //consultar numero de tokens registrados
        $tokensNumero = auth()->user()->tokens()->count();

        //total tokens disponibles
        $tokensTotales = auth()->user()->parametro->limite;

        //total tokens restantes 
        $tokensRestantes = $tokensTotales - $tokensNumero;

        //ultimos tokens usados
        $tokenslis = auth()->user()->tokens()->orderBy('last_used_at', 'desc')->paginate(3);

        $tokenslis2 = auth()->user()->tokens()->orderBy('last_used_at', 'asc')->paginate(3);

        return view('livewire.panel.targetas-informacion',[
            'usd' => $usd,
            'tokensNumero' => $tokensNumero,
            'tokensTotales' => $tokensTotales,
            'tokensRestantes' => $tokensRestantes,
            'tokenslis' => $tokenslis,
            'tokenslis2' => $tokenslis2,            
        ]);
    }
}
