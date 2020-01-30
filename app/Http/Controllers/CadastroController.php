<?php

namespace App\Http\Controllers;

use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use App\Cadastro;

class CadastroController extends Controller
{

    public function index()
    {
        return Cadastro::all();
    }

    public function store(Request $request)
    {
        if(substr_count($request->get("email"), '@') != 1)
        {
            abort(422, 'Email invalido!');
        }
        else
        {
            return Cadastro::create($request->all());
        }
    }

    public function show($id)
    {
        return Cadastro::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $cadastro = Cadastro::findOrFail($id);
        $cadastro->update($request->all());
    }

    public function destroy($id)
    {
        $cadastro = Cadastro::findOrFail($id);
        $cadastro->delete();
    }
}
