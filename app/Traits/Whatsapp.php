<?php
namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait Whatsapp {

    public function enviarmensajebasico($plantilla, $mensaje, $token, $uri, $telefono)
    {
        $body = array(
            'messaging_product' => "whatsapp",
            'to' => $telefono,
            'type' => "template",
            'template' => array(
                "name"=> $plantilla,
                'language'=> array(
                    "code"=>"es"
                ),
                'components'=> array(            
                    array(
                        "type" => "body",
                        "parameters" => array(
                            array(
                                "type"=> "text",
                                "text"=> $mensaje
                            )
                        )
                    )
                )
            )
        );
        
        $response = Http::withToken($token)->post($uri, $body);        
        return $response;
    }

    public function enviomensajepdf($plantilla, $mensaje, $token, $uri, $telefono, $documento, $nombre)
    {
        $body = array(
            'messaging_product' => "whatsapp",
            'to' => $telefono,
            'type' => "template",
            'template' => array(
                "name"=> $plantilla,
                'language'=> array(
                    "code"=>"es"
                ),
                'components'=> array(
                    array(
                        "type" => "header",
                        "parameters" => array(
                            array(
                                "type"=> "document",
                                "document" => array(
                                    "filename" => $nombre,
                        	        "link" => $documento
                                )                                
                            )
                        )
                    ),
                    array(
                        "type" => "body",
                        "parameters" => array(
                            array(
                                "type"=> "text",
                                "text"=> $mensaje
                            )
                        )
                    )
                )
            )
        );

        $response = Http::withToken($token)->post($uri, $body);

        return $response;
    }
}