<?php

namespace App\Http\Controllers;

use App\Rules\ChecaCpf;
use App\Rules\ChecaMascaraCpf;
use App\Rules\ChecaNomeCompleto;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserController extends Controller
{
    /**
     * Lista todos os usuário
     *
     * @return \Illuminate\Database\Eloquent\Collection|User[]
     */
    public function index()
    {
        $users = User::all();

        return $users;
    }

    /**
     * Insere novo usuário
     *
     * @param \Illuminate\Http\Request $request
     * @return User
     */
    public function store(Request $request)
    {

        $this->validaUsuario($request, true);

        $user = new User();

        $user->email    = $request->email;
        $user->name     = $request->name;
        $user->cpf      = $request->cpf;
        $user->password = Hash::make($request->password);

        $user->save();

        return $user;
    }

    /**
     * Busca usuário por id
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (Throwable $e) {
            return response()->json(['error' => 'Usuário não encontrado', 'e' => $e->getMessage()]);
        }

        return $user;
    }


    /**
     * Validação de nome completo, email e cpf, com regras custom
     * @param $request
     * @param $required
     * @param string $id
     */
    public function validaUsuario($request, $required, $id = "")
    {
        $req = $required ? "required" : "";

        $request->validate([
            'email' => "$req |email:rfc|unique:users,email,$id",
            'cpf' => "$req |unique:users,cpf,$id"
        ]);

        if (!empty($request->cpf)) {
            $request->validate(["cpf" => new ChecaCpf()]);
            $request->validate(["cpf" => new ChecaMascaraCpf()]);
        }

        if (!empty($request->name)) {
            $request->validate(["name" => new ChecaNomeCompleto()]);
        }
    }

    /**
     * Edição de usuário
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {

        $this->validaUsuario($request, false, $id);

        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        if (!empty($request->email))
            $user->email = $request->email;

        if (!empty($request->name))
            $user->name = $request->name;

        if (!empty($request->cpf))
            $user->cpf = $request->cpf;

        if (!empty($request->password))
            $user->password = Hash::make($request->password);

        $user->update();

        $result = $user->toArray();
        unset($result["password"]);

        return $user;
    }

    /**
     * Delete de usuário
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user_logado = auth()->user();

        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        if ($user_logado->id == $user->id) {
            return response()->json(['error' => 'Não é permitido deletar o usuário que está logado'], 200);
        }

        $user->delete();

        return $user;
    }
}
