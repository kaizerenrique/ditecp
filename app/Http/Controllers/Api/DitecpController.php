<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kaizerenrique\Cedulavenezuela\ConsultaCedula;
use Illuminate\Support\Facades\Http;
use App\Models\Registro;
use App\Traits\OperacionesBCV;
use App\Traits\Whatsapp;
use App\Models\Configwhatsapp;

class DitecpController extends Controller
{    
    use OperacionesBCV;
    use Whatsapp;

    /**
    * consultarValorUsd.
    *
    * Esta funcion permite optener el valor del USD publicado por
    * el Banco Central de Venezuela
    *
    * @return array que contiene el status y el valor del usd
    */

    public function consultarValorUsd(Request $request)
    {
        $usd = $this->valordelusd();   

        if ($request->user()->tokenCan('USD')) {
            //almacena los datos del usuario y el token que realizan la consulta
            foreach ($request->user()->tokens()->get() as $tokenapli)
            {
                if (hash_equals($tokenapli->token, hash('sha256', $request->bearerToken()))) {
                    $respuesta = [
                        'usuario' => $request->user()->id,
                        'id_token' => $tokenapli->id,
                        'operacion' => 'consultar USD'
                    ];
                }
            }

            $request->user()->registros()->create([
                'token_id' => $respuesta['id_token'],
                'operacion' => $respuesta['operacion']
            ]);

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
        } else {
            return response()->json([
                "status" => 401,
                "info" => "Acción no Autorizada"
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
        if ($request->user()->tokenCan('CNE')) {
            $request->validate([
                'nac' => 'required|string',
                'ci' => 'required|numeric',
            ]);
    
            $nac = $request->nac;
            $ci = $request->ci;
    
            $conCedulaCne = new ConsultaCedula();
            $info = $conCedulaCne->consultar($nac, $ci);
    
            //almacena los datos del usuario y el token que realizan la consulta
            foreach ($request->user()->tokens()->get() as $tokenapli)
            {
                if (hash_equals($tokenapli->token, hash('sha256', $request->bearerToken()))) {
                    $respuesta = [
                        'usuario' => $request->user()->id,
                        'id_token' => $tokenapli->id,
                        'operacion' => 'consultar Cedula CNE'
                    ];
                }
            }
     
            $request->user()->registros()->create([
                'token_id' => $respuesta['id_token'],
                'operacion' => $respuesta['operacion']
            ]);
    
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

        } else {
            return response()->json([
                "status" => 401,
                "info" => "Acción no Autorizada"
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
        if ($request->user()->tokenCan('IVSS')) {
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
    
            //almacena los datos del usuario y el token que realizan la consulta
            foreach ($request->user()->tokens()->get() as $tokenapli)
            {
                if (hash_equals($tokenapli->token, hash('sha256', $request->bearerToken()))) {
                    $respuesta = [
                        'usuario' => $request->user()->id,
                        'id_token' => $tokenapli->id,
                        'operacion' => 'consultar Pensionado IVSS'
                    ];
                }
            }
     
            $request->user()->registros()->create([
                'token_id' => $respuesta['id_token'],
                'operacion' => $respuesta['operacion']
            ]);
    
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

        } else {
            return response()->json([
                "status" => 401,
                "info" => "Acción no Autorizada"
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
        if ($request->user()->tokenCan('IVSS')) {
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
    
            //almacena los datos del usuario y el token que realizan la consulta
            foreach ($request->user()->tokens()->get() as $tokenapli)
            {
                if (hash_equals($tokenapli->token, hash('sha256', $request->bearerToken()))) {
                    $respuesta = [
                        'usuario' => $request->user()->id,
                        'id_token' => $tokenapli->id,
                        'operacion' => 'consultar Cuenta Individual IVSS'
                    ];
                }
            }
     
            $request->user()->registros()->create([
                'token_id' => $respuesta['id_token'],
                'operacion' => $respuesta['operacion']
            ]);
    
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
        } else {
            return response()->json([
                "status" => 401,
                "info" => "Acción no Autorizada"
            ]);
        }
        
    }

    public function apiwha(Request $request)
    {
        if ($request->user()->tokenCan('WhatsApp')) {
            
            $request->validate([
                'mensaje' => 'required|string',
                'telefono' => 'required|numeric',
                'documento' => 'string|nullable',
                'nombre' => 'string|nullable',
            ]);

            foreach ($request->user()->tokens()->get() as $tokenapli)
            {
                if (hash_equals($tokenapli->token, hash('sha256', $request->bearerToken()))) {
                    $respuesta = [
                        'usuario' => $request->user()->id,
                        'id_token' => $tokenapli->id,
                        'operacion' => 'WhatsApp'
                    ];
                }
            }

            $request->user()->registros()->create([
                'token_id' => $respuesta['id_token'],
                'operacion' => $respuesta['operacion']
            ]);
            
            $configuraciones = Configwhatsapp::where('token_id', $tokenapli->id)->get();

            foreach ($configuraciones as $configuracion)
            {
                $resul = [
                    'tokenApi' => $configuracion->token,
                    'uriApi' => $configuracion->uri,
                ];
            }           

            $mensaje = $request->mensaje;
            $token = $resul['tokenApi'];
            $uri = $resul['uriApi'];
            $telefono = $request->telefono;
            $documento = $request->documento;
            $nombre = $request->nombre;

            if ($request->documento == null) {
                $text = "plantilla_base_04";
                $info = $this->enviarmensajebasico($text, $mensaje, $token, $uri, $telefono); 
            } else {
                $documen = "plantilla_base_03";
                $info = $this->enviomensajepdf($documen, $mensaje, $token, $uri, $telefono, $documento, $nombre); 
            } 
            return $info;
        } else {
            return response()->json([
                "status" => 401,
                "info" => "Acción no Autorizada"
            ]);
        }
        
    }
}
