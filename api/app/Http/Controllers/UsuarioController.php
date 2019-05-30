<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use DB;
use Session;
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

        $pessoa = Usuarios::get();
        return json_encode($pessoa);

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
    public function store(Request $request)
    {
        try {                    
            $pessoa = new Usuarios();            
            $pessoa->fill($request->all())->save();
            $pessoa->save();            

            return ['status'=>400,'id'=>$pessoa->COD_USUARIO,'msg'=>'Usuário cadastrado com sucesso...'];
        }catch (\Exception $e) {
            DB::rollBack();
            return ['status'=>500,'msg'=>'Erro ao cadastrado cadastro, mensagem:' . $e];
        }                
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
        $pessoa = Usuarios::where('COD_USUARIO',$id)->first();
        return  json_encode($pessoa);
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
        
        try {                    
            $pessoa = Usuarios::find($request['COD_USUARIO']);
            if ($pessoa)
            {
                $pessoa->fill($request->all())->save();               
                $pessoa->save();
            }else{
                return ['status'=>500,'msg'=>'Usuário não encontrado'];    
            }                       
            return ['status'=>400,'msg'=>'Usuário atualizado com sucesso...'];
        }catch (\Exception $e) {
            DB::rollBack();
            return ['status'=>500,'msg'=>'Erro ao atualizar cadastro, mensagem:' . $e];
        }                        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $pessoa = Usuarios::where('COD_USUARIO',$id)->first();
            if ($pessoa){
                $pessoa->delete();
                return array('status'=>400,'msg'=>'Usuário excluido com sucesso');
            } else
                throw new \Exception('Usuário não encontrado');

        }catch (\Exception $e){
            return array('status'=>500,'msg'=>'Erro: ' . $e->getMessage());
        }
    }
}
