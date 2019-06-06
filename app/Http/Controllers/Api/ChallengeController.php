<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Http\Requests\Validations;

class ChallengeController extends Controller
{
    protected $challenge;

    public function __construct(Challenge $challenge)
    {
        $this->challenge = $challenge;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $challenge = $this->challenge->find($id);

        return response()->json($challenge);
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


     

     //Criei um request para fazer a validação do email, a validação do cpf e nome completo fiz direto no controller apenas para fazer dessas duas formas possíveis
    public function store(Validations $request)
    {
        $dataForm = $request->all();
    
        // Faz a verificação se o nome é válido.
        if ($dataForm['nome']) {
            $name = $dataForm['nome'];

            if (preg_match("/^[A-ZÀ-Ÿ][A-zÀ-ÿ']+\s([A-zÀ-ÿ']\s?)*[A-ZÀ-Ÿ][A-zÀ-ÿ']+$/", $name)) {
            } else {
                return response()->json(['error' => 'Nome inválido'], 500);
            }
        }

        // Faz a verificação se o CPF é válido.
            // ->Assim que for executado o cadastro, será feita a verificação do CPF antes que os dados sejam inseridos no banco.
        if ($dataForm['cpf']) {

            $cpf = $dataForm['cpf'];
            // Extrai somente os números
            $cpf = preg_replace('/[^0-9]/is', '', $cpf);

            // Verifica se foi informado todos os digitos corretamente
            if (strlen($cpf) != 11) {

                return response()->json(['error' => 'CPF inválido'], 500);
            }
            // Verifica se foi informada uma sequência de digitos repetidos.
            if (preg_match('/(\d)\1{10}/', $cpf)) {
                return response()->json(['error' => 'CPF inválido'], 500);
            }
            // Faz o calculo para validar o CPF
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{
                        $c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{
                    $c} != $d) {
                    return response()->json(['error' => 'CPF inválido'], 500);
                }
            }
            $challenge = $this->challenge->create($dataForm);
            if (!$challenge)
                return response()->json(['error' => 'Não foi possível cadastrar o usuário'], 500);

            return response()->json($challenge, 201);
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
        $challenge = $this->challenge->find($id);
        if (!$challenge)
            return response()->json(['error' => 'Usuário não encontrado'], 404);

        return response()->json($challenge);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $challenge = $this->challenge->find($id);
        if (!$challenge)
            return response()->json(['error' => 'Usuário não encontrado'], 404);

        $update = $challenge->update($request->all());
        if (!$update)
            return response()->json(['error' => 'Não foi possível atualizar o usuário'], 500);

        return response()->json($challenge);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $challenge = $this->challenge->find($id);
        if (!$challenge)
            return response()->json(['error' => 'Usuário não encontrado'], 404);

        $delete = $challenge->delete();

        if (!$delete)
            return response()->json(['error' => 'Não foi possível deletar o usuário'], 500);

        return response()->json(['success' => 'Usuário deletado com sucesso'], 200);
    }
}
