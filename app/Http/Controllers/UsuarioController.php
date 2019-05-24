<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuarios;
use Response;

class UsuarioController extends Controller
{

    private $usuarios;

    public function __construct(Usuarios $usuarios){
        $this->usuarios = $usuarios;
    }

    public function show()
    {
        $usuarios = $this->usuarios->all();
        return response()->json(['data' => $usuarios]);
    }


    public function store(Request $request)
    {
        $usuarioData = $request->all();
        $usuarioDataValidaNome = $this->usuarios->validaNome($usuarioData);

        if($usuarioDataValidaNome){
            $usuarioDataValidaCpf = $request->cpf;

            if($usuarioDataValidaCpf){

                $usuarioDataValidaEmail = $this->usuarios->validaEmail($usuarioData);

                if($usuarioDataValidaEmail){
                    $this->usuarios->create($usuarioData);
                    return response()->json(['sucesso' => 'usuario salvo com sucesso']);

                }else return response()->json(['error' => 'Email ja existente']);

            } else return response()->json(['error' => 'Insira um cpf']);

        }else {
          return response()->json(['error' => 'Insira o nome completo']);
        }

    }

    public function editar(Request $request)
    {
        $usuarioData = $request->all();
        $editarUsuario = $this->usuarios->buscarUsuario($usuarioData);

        if($editarUsuario){
            $usuarioDataValidaNome = $this->usuarios->validaNome($usuarioData);

            if($usuarioDataValidaNome){
                $usuarioDataValidaCpf = $request->cpf;

                if($usuarioDataValidaCpf){

                    $usuarioDataValidaEmail = $this->usuarios->validaEmail($usuarioData);

                    if($usuarioDataValidaEmail){
                        $alterarUsuario = Usuarios::find($request->id);
                        $alterarUsuario->update($request->all());

                        return response()->json(['sucesso' => 'usuario editado com sucesso']);

                    }else return response()->json(['error' => 'Email ja existente']);

                } else return response()->json(['error' => 'Insira um cpf']);

            }else {
              return response()->json(['error' => 'Insira o nome completo']);
            }

        }
          return response()->json(['error' => $editarUsuario]);
    }

    public function delete($id)
    {
        $usuario = Usuarios::findOrFail($id);
        if($usuario){
           $usuario->delete();
            return response()->json(['sucesso' => 'Usuario deletado']);
        }
        else return response()->json(['error'=> 'falha ao encontrar usuario']);
    }
}
