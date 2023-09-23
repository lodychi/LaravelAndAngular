<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Services\ManagerGroupServices;

class ManagerGroupApi extends Controller
{
    protected $groups;

    public function __construct(ManagerGroupServices $groups)
    {
       $this->groups = $groups;
    }

    public function index()
    {
        if (auth('api')->id()) {
            $group = $this->groups->index(auth('api')->id());

            return $this->responseSuccess('Get success', $group);
        }
        return $this->responseError('Fail', null);
    }

    public function create(Request $request)
    {
        if (auth('api')->id()) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $request['user_id'] = auth('api')->id();
            $group = $this->groups->create($request->all());

            return $this->responseSuccess("Create success", $group);
        }
        return $this->responseError('Fail', null);
    }

    public function edit($id, Request $request)
    {
        if (auth('api')->id()) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $request['user_id'] = auth('api')->id();
            $group = $this->groups->update($id, $request->all());

            return $this->responseSuccess('Edit success', $group);
        }
        return $this->responseError('Fail', null);
    }

    public function getMemberByGroupId($id)
    {
        if (auth('api')->id()) {
            $group = $this->groups->getMemberByGroupId(auth('api')->id(), $id);

            if ($group) {
                return $this->responseSuccess('Get member success', $group);
            }
        }
        return $this->responseError('Fail', null);
    }
}
