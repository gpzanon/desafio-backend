<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;


class AuthController extends BaseController
{
    public function login(Request $request){ 
	if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
	   $user = Auth::user(); 
	   $success['token'] =  $user->createToken('Generas');
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
