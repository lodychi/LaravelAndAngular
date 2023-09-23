<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Namshi\JOSE\JWT;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $token;
    protected $auth;

    public function responseSuccess($message, $data)
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], 200);
    }

    public function responseError($message, $data)
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], 400);
    }
}
