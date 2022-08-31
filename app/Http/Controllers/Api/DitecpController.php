<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kaizerenrique\Consultabcv\Consultabcv;
use Kaizerenrique\Cedulavenezuela\ConsultaCedula;
use Illuminate\Support\Facades\Http;

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
                "usd" => "Error de conexión fuente no encontrada."
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
                "info" => "Error de conexión fuente no encontrada."
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
                "info" => "Error de conexión fuente no encontrada."
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
                "info" => "Error de conexión fuente no encontrada."
            ]);
        } else {
            return response()->json([
                "status" => 200,
                "info" => $info
            ]);
        }
    }

    public function apiwha()
    {
        $tokenApi = 'EAAIZBovnnWcQBAJqT07nT6y6VRY81mDQex6JtrCbrZAMBxIiw5XEfJoSCH9isag91qZBiqVAp0bpfch4TDTgtkUOQuDGPW25sRqT7PHIngK3tg4WWEzUJASmi1x5j9uLPJOo5ZBbqlXngn7m4N6uPxcP8KF6iaTq2lSbrs5SMiTAJRA3IvhD3Ao5vFhBW9fAcs8k0cCfLwZDZD';
        $response = Http::withToken($tokenApi)->accept('application/json')->post('https://graph.facebook.com/v13.0/102740705902434/messages',[
                'messaging_product' => 'whatsapp',
                'to' => '584129918810',
                'type' => 'template',
                'template' => [
                    'name' => 'plantilla_base_01',
                    'language' => [
                        'code' => 'es'
                    ]
                ]
        ]);

        return $response;
    }
}
