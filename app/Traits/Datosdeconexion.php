<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait Datosdeconexion
{

    public function guardardatos($request, $operacion)
    {
        foreach ($request->user()->tokens()->get() as $tokenapli) {
            if (hash_equals($tokenapli->token, hash('sha256', $request->bearerToken()))) {
                $respuesta = [
                    'usuario' => $request->user()->id,
                    'id_token' => $tokenapli->id,
                    'operacion' => $operacion
                ];
            }
        }

        $request->user()->registros()->create([
            'token_id' => $respuesta['id_token'],
            'operacion' => $respuesta['operacion']
        ])->datosconexion()->create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('user-agent')
        ]);
    }
}
