<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $fillable = [
        'token_id',
        'operacion'
    ];

    public function registros()
    {
        return $this->hasMany(Registro::class);
    }
}
