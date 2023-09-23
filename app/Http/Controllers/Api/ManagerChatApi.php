<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\ManagerChatServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManagerChatApi extends Controller
{
    protected $chats;

    public function __construct(ManagerChatServices $chats)
    {
       $this->chats = $chats;
    }

    public function create(Request $request)
    {
        if (auth('api')->id()) {
            $validator = Validator::make($request->all(), [
                'group_id' => 'required',
                'message' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $request['user_id'] = auth('api')->id();
            $chat = $this->chats->create($request->all());

            return $this->responseSuccess("Create success", $chat);
        }
        return $this->responseError('Fail', null);
    }
}
