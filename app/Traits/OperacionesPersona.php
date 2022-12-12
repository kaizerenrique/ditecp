<?php
namespace App\Traits;

use App\Models\Persona;
use Kaizerenrique\Cedulavenezuela\ConsultaCedula;

trait OperacionesPersona {

    public function consultarpersona($nac, $ci)
    {
        if (Persona::where('cedula', $ci)->exists()) {
            $info = Persona::where('cedula', $ci)->get();
        } else {
            $conCedulaCne = new ConsultaCedula();
            $info = $conCedulaCne->consultar($nac, $ci);

            if ($info['error'] == 0 ) {
                Persona::create([
                    'nacionalidad' => $info['nacionalidad'],
                    'cedula' => $info['cedula'],
                    'nombres' => $info['nombres'],
                    'apellidos' => $info['apellidos'],
                ]);
            } else {
                return $info;
            }
            
        }

        return $info;
    }

}