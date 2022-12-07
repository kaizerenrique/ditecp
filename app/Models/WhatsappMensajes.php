<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappMensajes extends Model
{
    use HasFactory;

    protected $fillable = [
        'token_id',
        'configwhatsapps_id',
        'user_id',
        'id_mensaje',
        'status',
        'linea_temporal',
        'recipient',
        'id_wha_buss',
        'id_tlf_buss',
        'display_phone_number',
    ];
}
