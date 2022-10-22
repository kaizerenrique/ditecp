<?php
namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait Whatsapp {

    public function enviarmensajebasico($mensaje, $token, $uri, $telefono)
    {
        $body = array(
            'messaging_product' => "whatsapp",
            'to' => $telefono,
            'type' => "template",
            'template' => array(
                "name"=> "plantilla_base_04",
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

    public function enviomensajepdf($mensaje, $token, $uri, $telefono)
    {
        $body = array(
            'messaging_product' => "whatsapp",
            'to' => $telefono,
            'type' => "template",
            'template' => array(
                "name"=> "plantilla_base_03",
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
                                    "filename" => "moWzwHAGXH.pdf",
                        	        "link" => "https://docs.google.com/viewerng/viewer?url=http://qslabsys.com/storage/moWzwHAGXH.pdf"
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