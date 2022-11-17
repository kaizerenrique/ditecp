<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infoservicios extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'servicio_id',
        'date'
    ];
}
