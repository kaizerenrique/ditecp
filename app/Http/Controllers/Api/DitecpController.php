<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kaizerenrique\Consultabcv\Consultabcv;
use Kaizerenrique\Cedulavenezuela\ConsultaCedula;

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

    /** 
    * Esta función realiza una consulta a la Pagina del CNE
    * @param string   $nac 	Valores permitidos [V|E]
    * @param string   $ci 	Número de Cédula de Identidad
    *
    * @return Retorna un array.
    */
    
    public function consultarCedulaCne(Request $request)
    {
        $request->validate([
            'nac' => 'required|string',
            'ci' => 'required|numeric',
        ]);

        $nac = $request->nac;
        $ci = $request->ci;

        $conCedulaCne = new ConsultaCedula();
        $info = $conCedulaCne->consultar($nac, $ci);

        return response()->json([
            "status" => 200,
            "info" => $info
        ]);
    }
}
