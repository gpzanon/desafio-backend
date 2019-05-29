<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use DB;
use Session;
use Route;
use Validator;
use App\Model\Usuarios;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('usuario.form-usuario');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function criar(Request $request)
    {        
        $input  = $request->all();

        $rules    = [
            'DES_NOME'   => 'required',
        ];

        $nomes    = [
            'DES_NOME'   => 'Campo Nome',

        ];

        $messages = [];

        $validator = Validator::make($input, $rules, $messages);
        $validator->setAttributeNames($nomes);

        if ($validator->fails())
        {
            Session::flash('error', true);
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        try {
            

            $user = new Usuarios();
            $result = (object) $user->Salvar($input);                        

            if ($result->status == 400)            
                Session::flash('success', true);

            if ($result->status == 500)            
                Session::flash('error', true);
            return redirect()->back();
        }catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', true);
            return redirect()->back()->withErrors([$e->getMessage()])->withInput();
           
        }

        return redirect()->back();
    }

    public function getCliente(Request $request)
    {
        
        
        $query = trim($request->get('searchText'));
        $user = Usuarios::getList();
        return view('usuario.list-usuario')->with([
            'usuario'    => $user,
            'searchText' => $query,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =  Usuarios::getAtualiza($id);
        return view('usuario.edit-usuario')->with([
            'usuario'    => $user,
        ]);
            
            
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $input = $request->all();
        
        $rules    = [
            'DES_NOME'   => 'required',
        ];

        $nomes    = [
            'DES_NOME'   => 'Campo Nome',

        ];

        $messages = [];

        $validator = Validator::make($input, $rules, $messages);
        $validator->setAttributeNames($nomes);

        if ($validator->fails())
        {
            Session::flash('error', true);
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {            
            $user = new Usuarios();
            $result = (object) $user->setEdita($input);                        

            if ($result->status == 400)            
                Session::flash('success', true);

            if ($result->status == 500)            
                Session::flash('error', true);

        }catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', true);
            return redirect()->back()->withErrors([$e->getMessage()])->withInput();
        }
        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        //$user = Usuario::deleta($id);
        try {
            $user = new Usuarios();
            $result = (object) $user->excluir($id);

            if ($result->status == 400)            
                Session::flash('success', true);

            if ($result->status == 500)            
                Session::flash('error', true);

            Session::flash('success', true);
            return redirect()->back();
        }catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', true);
            return redirect()->back()->withErrors([$e->getMessage()])->withInput();
        }
        
        return redirect()->back();
    }
}
