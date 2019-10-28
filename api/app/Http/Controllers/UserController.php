<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }
    public function show($id)
    {
        return User::findOrFail($id);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => [
                'required', 
                'string',
                function ($atribute, $value, $fail){
                    $value = trim($value);
                    if(substr_count($value, ' ') == 0){
                        return $fail("O nome do usuário precisa ser completo");
                    }
                }
            ],
            'email'    => 'required|string|email|unique:users',
            'cpf' => 'required|string|cpf',
            'password' => 'required|string',
        ]);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->cpf = $request->cpf;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            'message' => 'Usuário Alterado com Sucesso!'], 201);
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'message' => 'Usuário Apagado com Sucesso!'], 201);
    }

    
}
