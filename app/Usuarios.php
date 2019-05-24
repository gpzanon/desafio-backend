<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table = 'usuarios';

    protected $fillable = [
        'nome_completo', 'email', 'cpf',
    ];


    public function validaNome($dados)
    {
        $nome_completo = $dados['nome_completo'];
        if(preg_match('/\s/', $nome_completo)  ) $resp = true;
        else $resp = false;

        return $resp;
    }

    public function validaEmail($dados)
    {
        $email = $this->where('email', $dados['email'])->first();

        if(!$email) $resp = true;
        else $resp = false;

        return $resp;
    }

    public function buscarUsuario($dados)
    {
        $usuario = $this->where('id', $dados['id'])->first();
        return $usuario;

    }

}
