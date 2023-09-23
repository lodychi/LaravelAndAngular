<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;

class ManagerGroupServices extends Controller
{
    public function index($id)
    {
        return Group::find($id);
    }

    public function create($data)
    {   
        return Group::create($data);
    }

    public function update($id, $data)
    {
        $members = $data['members'] ?? null;

        $group = Group::find($id);
        $group->name = $data['name'];
        $group->members = $members;
        $group->save();
        return $group;
    }

    public function getMemberByGroupId($user_id, $id)
    {
        $group = Group::where('id', $id)->where('user_id', $user_id)->first();
       
        if ($group && $group->members) {
            return User::whereIn('id', $group->members)->get();
        }
        return false;
    }
}
