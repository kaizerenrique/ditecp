<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kaizerenrique\Consultabcv\Consultabcv;

class DitecpController extends Controller
{    
    /**
    * consultarValorUsd.
    *
    * Esta funcion permite optener el valor del USD publicado por
    * el Banco Central de Venezuela
    *
    * @return array que contiene el status y el valor del usd
    */

    public function consultarValorUsd()
    {
        $usdconsulta = new Consultabcv();
        $usd = $usdconsulta->valorbcv();

        if ($usd == false) {
            return response()->json([
                "status" => 404,
                "usd" => "No encontrado"
            ]); 
        } else {
            return response()->json([
                "status" => 200,
                "usd" => $usd
            ]);            
        }
    }
}
