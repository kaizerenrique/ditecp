<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cne extends Model
{
    use HasFactory;

    protected $fillable = [
        'inscrito',
        'cvestado',
        'cvmunicipio',
        'cvparroquia',
        'centro',
        'direccion'
    ];
}
