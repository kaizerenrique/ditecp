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
use App\Models\WhatsappMensajes;
use Exception;

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
                    'configwhatsapps_id' => $configuracion->id,
                    'user_id' => $configuracion->user_id,
                    'token_id'  => $configuracion->token_id,
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
                $text = "plantilla_base_01";
                $info = $this->enviarmensajebasico($text, $mensaje, $token, $uri, $telefono); 
            } else {
                $documen = "plantilla_base_02"; //multimedia documento pdf
                $info = $this->enviomensajepdf($documen, $mensaje, $token, $uri, $telefono, $documento, $nombre); 
            } 
            
            if ($info['messaging_product'] == 'whatsapp'){
                
                //configuracion de datos a guardar 
                WhatsappMensajes::create([
                    'token_id' => $resul['token_id'],
                    'configwhatsapps_id' => $resul['configwhatsapps_id'],
                    'user_id' => $resul['user_id'],
                    'id_mensaje' => $info['messages'][0]['id'],
                    'status' => null,
                    'linea_temporal' => null,
                    'recipient' => $telefono,
                    'id_wha_buss' => null,
                    'id_tlf_buss' => null,
                    'display_phone_number' => null,
                ]);

                return response()->json([
                    "status" => 200,
                    "info" => 'Envió exitoso'
                ]);
            } else {
                return response()->json([
                    "status" => 401,
                    "info" => "Error" 
                ]);
            }
            
        } else {
            return response()->json([
                "status" => 401,
                "info" => "Acción no Autorizada"
            ]);
        }
        
    }

    public function apiwhawebhooks(Request $request)
    {
        try {
            $verifyToken = 'd4y4n4'; //token para comprobacion de facebook
            $query = $request->query();

            $mode = $query['hub_mode'];
            $token = $query['hub_verify_token'];
            $challenge = $query['hub_challenge'];
            
            if ($mode && $token) {
                if ($mode === 'subscribe' && $token == $verifyToken) {
                    return response($challenge, 200)->header('Content-Type', 'text/plain');
                }
            } 

            throw new Exception('Invalid request');
        }
        catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);            
        }
    }

    public function apiprocesobhooks(Request $request)
    {
        try {
            $bodyContent = json_decode($request->getContent(), true); 
            $body = '';

            $value = $bodyContent['entry'][0]['changes'][0]['value'];

            if (!empty($value['messages'])) {
                if ($value['messages'][0]['type'] == 'text') {
                    $body = $value['messages'][0]['text']['body'];
                }
            } elseif (!empty($value['statuses'])) {
                //identificador de mensaje
                $configuraciones = WhatsappMensajes::where('id_mensaje', $value['statuses'][0]['id'])->first();                

                //configuracion de datos a guardar 
                WhatsappMensajes::create([
                    'token_id' => $configuraciones->token_id,
                    'configwhatsapps_id' => $configuraciones->configwhatsapps_id,
                    'user_id' => $configuraciones->user_id,
                    'id_mensaje' => $value['statuses'][0]['id'],
                    'status' => $value['statuses'][0]['status'],
                    'linea_temporal' => $value['statuses'][0]['timestamp'],
                    'recipient' => $value['statuses'][0]['recipient_id'],
                    'id_wha_buss' => $bodyContent['entry'][0]['id'],
                    'id_tlf_buss' => $value['metadata']['phone_number_id'],
                    'display_phone_number' => $value['metadata']['display_phone_number'],
                ]);

            }
            return response()->json([
                'success' => true,
                'data' => $body
            ], 200);
        }
        catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);            
        }
    }
}
