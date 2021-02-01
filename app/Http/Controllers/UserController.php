<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection|User[]
     */
    public function index()
    {
        $users = User::all();

        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return User
     */
    public function store(Request $request)
    {

        $user = new User();

        $user->email = $request->email;
        $user->name = $request->name;
        $user->cpf = $request->cpf;
        $user->password = Hash::make($request->password);

        $user->save();

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
        }
        catch (Throwable $e) {
            return response()->json(['error' => 'Usuário não encontrado', 'e' => $e->getMessage()]);
        }

        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {

        // validar nome completo
        // validar se o email ja existe
        // validar se o email é valido
        // validar se o cpf existe
        // validar se o cpf é valido

        $user = User::find($id);

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            $user->delete();
        }
        catch (Throwable $e) {
            return response()->json(['error' => 'Usuário não encontrado', 'e' => $e->getMessage()]);
        }

        return $user;
    }
}
