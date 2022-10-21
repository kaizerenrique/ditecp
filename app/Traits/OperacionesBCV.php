<?php
namespace App\Traits;

use Kaizerenrique\Consultabcv\Consultabcv;
use App\Models\Valorbcv;

trait OperacionesBCV {

    public function consultarelvalordelusd()
    {
        $usdconsulta = new Consultabcv();
        $usd = $usdconsulta->valorbcv();

        if ($usd == false) {
            return false;
        } else {
            $moneda = Valorbcv:: create([
                'moneda' => 'USD',
                'valor' => $usd,
            ]);
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