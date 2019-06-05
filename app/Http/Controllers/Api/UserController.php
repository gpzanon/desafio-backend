<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends BaseController
{
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
	        $success['name'] =  $user->name;


	        return $this->sendResponse($success, 'Usuário registrado com sucesso');
    	}
    	else{
    		return response()->json(['error'=> $notAuthorized], 401); 
    	}
    }

    public function edit(Request $request)
    {
    	$user = Auth::user(); 
    	//checa se o usuário é admin
    	if($user->isAdmin)
    	{

	        $validator = Validator::make($request->all(), [
	            'name' => 'required|string|max:255',
	            'email' => 'required|email|max:255|string'
	        ]);

	        if($validator->fails()){
	            return $this->sendError('Erro de validação.', $validator->errors());       
	        }

	        $input = $request->all();
	        $user = User::where('email', $input['email'])->first();
	        $user->name = $input['name'];
	        $user->save();
	        $success['name'] =  $user->name;

	        return $this->sendResponse($success, 'Usuário editado com sucesso');
    	}
    	else{
    		return response()->json(['error'=> $notAuthorized], 401); 
    	}
    }

    public function remove(Request $request)
    {
    	$user = Auth::user(); 
    	//checa se o usuário é admin
    	if($user->isAdmin)
    	{
	        $validator = Validator::make($request->all(), [
	            'email' => 'required|email|max:255|string',
	        ]);

	        if($validator->fails()){
	            return $this->sendError('Erro de validação.', $validator->errors());       
	        }

	        $input = $request->all();
	        $user = User::where('email', $input['email'])->first();
	        if($user->isAdmin)
	        {
		        $success['user'] =  $user->email;
	        	return $this->sendResponse($success, 'Usuário é admin e não pode ser removido');
	        }
	        else
	        {
		        $user->delete();
		        $success['user'] =  $user->email;

		        return $this->sendResponse($success, 'Usuário removido com sucesso');	        	
	        }
    	}
    	else{
    		return response()->json(['error'=> $notAuthorized], 401); 
    	}
    }

}
