<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'email',
        'sexo'
    ];
}
