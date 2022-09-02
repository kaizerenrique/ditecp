<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Parametro extends Model
{
    use HasFactory;

    protected $fillable = [
        'limite'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
