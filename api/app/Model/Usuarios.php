<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'COD_USUARIO';
    protected $fillable = ['COD_USUARIO','CPF','DES_NOME','CELULAR','EMAIL',
                           'created_at','updated_at'];
}
