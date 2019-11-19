<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\PayloadFactory;
use Tymon\JWTAuth\JWTManager as JWT;

class UserController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->json()->all(), [
            'name'     => 'required|string|max:255',
            'cpf'      => 'required|string|max:14',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name'     => $request->json()->get('name'),
            'cpf'      => $request->json()->get('cpf'),
            'email'    => $request->json()->get('email'),
            'password' => Hash::make($request->json()->get('password'))
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);
    }

    public function update(Request $request) {
        try {
            if(!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch(Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch(Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch(Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        $create    = false;
        $validator = Validator::make($request->json()->all(), [
            'name'     => 'required|string|max:255',
            'cpf'      => 'required|string|max:14',
            'email'    => 'required|string|email|max:255',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        if($request->json()->get('id')) {
            $user = User::findOrFail($request->json()->get('id'));

            if($user) {
                $user->name  = $request->json()->get('name');
                $user->cpf   = $request->json()->get('cpf');
                $user->email = $request->json()->get('email');

                if($request->json()->get('password')) {
                    $user->password  = $request->json()->get('password');
                }

                $user->save();

                return response()->json(compact('user'), 201);
            } else {
                $create = true;
            }
        } else {
            $create = true;        
        }

        if($create) {
            $user = User::create([
                'name'     => $request->json()->get('name'),
                'cpf'      => $request->json()->get('cpf'),
                'email'    => $request->json()->get('email'),
                'password' => Hash::make($request->json()->get('password'))
            ]);
    
            $token = JWTAuth::fromUser($user);

            return response()->json(compact('user', 'token'), 201);              
        }
    }  

    public function getAuthenticatedUser() {
        try {
            if(!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch(Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch(Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch(Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }

    public function delete(Request $request) {
        try {
            if(!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch(Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch(Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch(Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        $user = User::findOrFail($request->json()->get('id'));
        if($user) {
            $user->delete();
            $msg = 'usuário foi apagado';

            return response()->json(compact('msg'), 201);
        }

    }    
}