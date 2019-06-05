<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;


class AuthController extends BaseController
{
	public $successStatus = 200;
    public function register(Request $request)
    {
    	$user = Auth::user(); 
    	//checa se o usuário é admin
    	if($user->isAdmin)
    	{
	        $validator = Validator::make($request->all(), [
	            'name' => 'required|string|max:255',
	            'email' => 'required|email|max:255|string|unique:users',
	            'password' => 'required|string|min:8',
	            'c_password' => 'required|same:password',
	            'cpf' => 'required|string|min:11|max:11'
	        ]);


	        if($validator->fails()){
	            return $this->sendError('Erro de validação.', $validator->errors());       
	        }


	        $input = $request->all();
	        $input['password'] = bcrypt($input['password']);
	        $user = User::create($input);
	        $success['token'] =  $user->createToken('Generas')->accessToken;
	        $success['name'] =  $user->name;


	        return $this->sendResponse($success, 'Usuário registrado com sucesso');
    	}
    	else{
    		return response()->json(['error'=>'Não autorizado (É necessário ser admin para usar essa função)'], 401); 
    	}
    }

    public function login(Request $request){ 
	if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
	   $user = Auth::user(); 
	   $success['token'] =  $user->createToken('Generas');
	   $token = $success['token']->token;
	   $token->save();
	    return response()->json(['success' => $success['token']->accessToken], $this-> successStatus); 
	  } else{ 
	   return response()->json(['error'=>'Não autorizado'], 401); 
	   } 
	}

	public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Logout efetuado com sucesso'
        ]);
    }

	public function getUser(Request $request) {
	 $user = Auth::user();
	 return response()->json(['success' => $user], $this->successStatus); 
	}

}
