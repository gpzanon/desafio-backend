<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    /**
     * Listagem de todos usuários do banco de dados
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
        if(count($usuarios) > 0){
            return $usuarios;
        } else {
            return "Nenhum usuário encontrado.";
        }
    }

    /**
     * Armazena um usuário enviado pelo request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $Nome = $request->Nome;
        $Cpf = $request->Cpf;
        $Email = $request->Email;

        // Valida o CPF
        if($this->validaCpf($Cpf)){
            // Verifica se todos os campos foram preenchidos.
            if($Nome == ""){
                return "Preencha o nome completo do usuário.";
            } else  if($Cpf == ""){
                return "Preencha o cpf do usuário.";
            } else  if($Email == ""){
                return "Preencha o e-mail do usuário.";
            }

            // Verifica se já não existe algum usuário com o e-mail informado.
            $usuario = Usuario::where('Email', $Email)->first();

            if($usuario["idUsuario"] > 0){
                return "Já existe um usuário cadastrado com o e-mail: " . $Email;
            } else {
                Usuario::create($request->all());
                return "O usuário foi cadastrado com sucesso.";

            }
        } else {
            return "O CPF informado é inválido, informe apenas números. O CPF deve conter 11 números.";
        }

       

    }

    /**
     * Exibe um usuário especifico de acordo com o id passado
     *
     * @param  int  $idUsuario
     * @return \Illuminate\Http\Response
     */
    public function show($idUsuario)
    {
        $usuario = Usuario::where('idUsuario', $idUsuario)->first();
        
        if($usuario["idUsuario"] > 0){
            return $usuario;
        } else {
            return "Nenhum usuário encontrado com o id " . $idUsuario . ".";
        }
    }

    /**
     * Atualiza um usuário especifico de acordo com o id passado
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idUsuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idUsuario)
    {
        $Email = $request->Email;
        $Cpf = $request->Cpf;

        if(isset($Email)){
            // Verifica se já não existe algum usuário com o e-mail informado.
            $usuario = Usuario::where('Email', $Email)->first();

            if($usuario["idUsuario"] > 0 && $usuario["idUsuario"] != $idUsuario)
                return "Já existe um usuário cadastrado com o e-mail: " . $Email;
        }

        // Verifica se existe cpf e se é válido
        if(isset($Cpf) && $this->validaCpf($Cpf) == false){
            return "O CPF informado é inválido, informe apenas números. O CPF deve conter 11 números.";
        }

        // Verifica se existe usuário com o id
        $usuario = Usuario::where('idUsuario', $idUsuario)->first();

        if($usuario["idUsuario"] > 0){
            Usuario::where('idUsuario', $idUsuario)->update($request->all());
            return "O usuário foi atualizado com sucesso.";
        } else {
            return "Nenhum usuário encontrado com o id " . $idUsuario . ".";
        }

       

    }

    /**
     * Exclui um usuário especifico de acordo com o id passado
     *
     * @param  int  $idUsuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($idUsuario)
    {

        $usuario = Usuario::where('idUsuario', $idUsuario)->first();

        if($usuario["idUsuario"] > 0){
            Usuario::where('idUsuario', $idUsuario)->delete();
            return "O usuário ". $idUsuario ." foi excluído com sucesso.";
        } else {
            return "Não foi encontrado nenhum usuário com o id: " . $idUsuario;
        }

    }

    /**
     * Valida o CPF
     *
     * @param  string  $cpf
     */
    function validaCpf($cpf) {
 
        if (!is_numeric($cpf)) {
            return false;
        }
        
        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
         
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
    
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

       
    
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    
    }
}
