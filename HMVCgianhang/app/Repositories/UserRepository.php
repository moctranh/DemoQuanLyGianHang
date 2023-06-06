<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Models\Decentralization;
class UserRepository
{
    public function checkPermission($permissions)
    {
        $user = Auth::user();
        $decentralization = Decentralization::where('user_id',$user->id)
        ->whereIn('permission_id', $permissions)
        ->get();
        if (sizeof($decentralization)>0)
            return true;
        return false;
    }

    public function getUserId()
    {
        return Auth::user()->id;
    }
}