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
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf'=> $request->cpf,
            'password' => bcrypt($request->password),
          ]);    
    }
    public function show($id)
    {
        return User::findOrFail($id);
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->cpf = $request->cpf;
        $user->password = bcrypt($request->password);
        $user->save();
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }



}
