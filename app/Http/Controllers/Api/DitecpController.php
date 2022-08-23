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

        if ($info == false) {
            return response()->json([
                "status" => 404,
                "info" => "No encontrado"
            ]);
        } else {
            return response()->json([
                "status" => 200,
                "info" => $info
            ]);
        }
        
    }

    /**
    * Esta función consulta si una persona es pensionada del IVSS.
    * @param string   $nac 	Valores permitidos [V|E]
	* @param string   $ci 	Número de Cédula de Identidad
	* @param string   $d1 	Dia de Nacimiento  	
	* @param string   $m1 	Mes de Nacimiento
	* @param string   $y1 	Año de Nacimiento 
    *
    * @return Retorna un array.
    */

    public function consultaIvssPensionado(Request $request)
    {
        $request->validate([
            'nac' => 'required|string',
            'ci' => 'required|numeric',
            'd1' => 'required|numeric',
            'm1' => 'required|numeric',
            'y1' => 'required|numeric',
        ]);

        $nac = $request->nac;
        $ci = $request->ci;
        $d1 = $request->d1;
        $m1 = $request->m1;
        $y1 = $request->y1;

        $conCedulaIvss = new ConsultaCedula();
        $info = $conCedulaIvss->ivssPension($nac, $ci, $d1, $m1, $y1);

        if ($info == false) {
            return response()->json([
                "status" => 404,
                "info" => "No encontrado"
            ]);
        } else {
            return response()->json([
                "status" => 200,
                "info" => $info
            ]);
        }
    }

    /**
    * Esta función consulta si una persona posee cuenta del IVSS.
    * @param string   $nac 	Valores permitidos [V|E]
	* @param string   $ci 	Número de Cédula de Identidad
	* @param string   $d 	Dia de Nacimiento  	
	* @param string   $m 	Mes de Nacimiento
	* @param string   $y 	Año de Nacimiento 
    *
    * @return Retorna un array.
    */

    public function consultarCuentaIndividualIvss(Request $request)
    {
        $request->validate([
            'nac' => 'required|string',
            'ci' => 'required|numeric',
            'd' => 'required|numeric',
            'm' => 'required|numeric',
            'y' => 'required|numeric',
        ]);

        $nac = $request->nac;
        $ci = $request->ci;
        $d = $request->d;
        $m = $request->m;
        $y = $request->y;
        
        $conCedulaIvss = new ConsultaCedula();
        $info = $conCedulaIvss->cuentaIndividual($nac, $ci, $d, $m, $y);

        if ($info == false) {
            return response()->json([
                "status" => 404,
                "info" => "No encontrado"
            ]);
        } else {
            return response()->json([
                "status" => 200,
                "info" => $info
            ]);
        }

    }
}
