<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configwhatsapp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'servicio_id',
        'token_id',
        'token',
        'uri',
        'id_wha_buss',
        'id_tlf_buss',
        'telefono_comercial',
    ];
}
