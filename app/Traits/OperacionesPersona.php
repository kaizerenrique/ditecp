<?php
namespace App\Traits;

use App\Models\Persona;
use Kaizerenrique\Cedulavenezuela\ConsultaCedula;

trait OperacionesPersona {

    public function consultarpersona($nac, $ci)
    {
        if (Persona::where('cedula', $ci)->exists()) {
            $personas = Persona::where('cedula', $ci)->get();
            
            foreach ($personas as $persona) {
                $info = [
                    'error' => '0',
                    'nacionalidad' => $persona->nacionalidad,
                    'cedula' => $persona->cedula,
                    'nombres' => $persona->nombres,
                    'apellidos' => $persona->apellidos,
                    'inscrito' => $persona->cne->inscrito,
                    'cvestado' => $persona->cne->cvestado,
                    'cvmunicipio' => $persona->cne->cvmunicipio,
                    'cvparroquia' => $persona->cne->cvparroquia,
                    'centro' => $persona->cne->centro,
                    'direccion' => $persona->cne->direccion,
                ];
            }

        } else {
            $conCedulaCne = new ConsultaCedula();
            $info = $conCedulaCne->consultar($nac, $ci);

            if ($info['error'] == 0 ) {
                Persona::create([
                    'nacionalidad' => $info['nacionalidad'],
                    'cedula' => $info['cedula'],
                    'nombres' => $info['nombres'],
                    'apellidos' => $info['apellidos'],
                ])->cne()->create([
                    'inscrito' => $info['inscrito'],
                    'cvestado' => $info['cvestado'],
                    'cvmunicipio' => $info['cvmunicipio'],
                    'cvparroquia' => $info['cvparroquia'],
                    'centro' => $info['centro'],
                    'direccion' => $info['direccion']
                ]);
            } else {
                return $info;
            }
            
        }

        return $info;
    }

    public function fecha_naciminto($nac, $ci, $d1, $m1, $y1)
    {
        $personas = Persona::where('cedula', $ci)->get();
        foreach ($personas as $persona) {
            $id = $persona->id;                
        }        
        $fecha = Persona::find($id);
        $fecha->fecha_nacimiento = $y1.'-'.$m1.'-'.$d1;
        $fecha->save();          

        return $personas;
    }

}