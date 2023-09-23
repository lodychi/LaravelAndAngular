<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\JWTAuth;

class ManagerAuthServices extends Controller
{
    public function login($data)
    {
        $email = $data['email'];
        $password = $data['password'];
        $credentials = ["email" => $email, "password" => $password];
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function register($data)
    {
        $email = $data['email'];
        $name = $data['name'];
        $password = Hash::make($data['password']);
        
        $user = new User();
        $user->name     = $name;
        $user->email    = $email;
        $user->password = $password;
        
        if ($user->save()) {
            return $this->reponseSuccess("Register success", $user);
        } 
        return $this->reponseError("Register fail", null);
    }

    public function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
        ]);
    }
}
