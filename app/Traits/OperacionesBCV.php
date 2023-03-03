<?php
namespace App\Traits;

use Kaizerenrique\Consultabcv\Consultabcv;
use App\Models\Valorbcv;
use App\Traits\EnvioMensajes;

trait OperacionesBCV {

    use EnvioMensajes;

    public function consultarelvalordelusd()
    {
        $usdconsulta = new Consultabcv();
        $usd = $usdconsulta->valorbcv();

        if ($usd == false) {
            $text = 'error de consulta de USD';
            $mensaje = $this->telegramMensajeGrupo($text); 
            return false;
        } else {
            $valor = $this->valordelusd();

            if ($usd == $valor) {  
                return true;
            } else {
                $moneda = Valorbcv:: create([
                    'moneda' => 'USD',
                    'valor' => $usd,
                ]);   
                $text = 'USD: '.$usd;
                $mensaje = $this->telegramMensajeGrupo($text);              
            }
            return true;            
            
        }
    }

    public function valordelusd()
    {
        $valormoneda = Valorbcv::orderBy('created_at', 'desc')->first();
        
        $valor = round($valormoneda['valor'] , 3);
        return $valor;
    }

}