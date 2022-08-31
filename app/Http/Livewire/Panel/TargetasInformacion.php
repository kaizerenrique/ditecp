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

        //consultar numero de apis registrados
        $tokensNumero = auth()->user()->tokens()->count();

        //total tokens disponibles
        $tokensTotales = 120;

        //total tokens restantes 
        $tokensRestantes = $tokensTotales - $tokensNumero;

        return view('livewire.panel.targetas-informacion',[
            'usd' => $usd,
            'tokensNumero' => $tokensNumero,
            'tokensTotales' => $tokensTotales,
            'tokensRestantes' => $tokensRestantes,            
        ]);
    }
}
