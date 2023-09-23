<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\ManagerAuthServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManagerAuthApi extends Controller
{
    protected $auths;

    public function __construct(ManagerAuthServices $auths)
    {
       $this->auths = $auths;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        return $this->auths->login($request);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        return $this->auths->register($request);
    }
}
