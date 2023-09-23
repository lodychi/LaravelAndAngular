<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use App\Models\Chat;

class ManagerChatServices extends Controller
{
    public function create($data)
    {   
        return Chat::create($data);
    }
    
}
