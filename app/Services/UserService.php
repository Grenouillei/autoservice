<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserService
{
    /**
     * get all users
     * @return mixed
    */
    public function getAllUsers(){
        return User::all();
    }

    /**
     * change user name
     * @param $req
     */
    public function updateUser($req){
        $user = User::find(Auth::user()->id);
        $user->name = $req->name;
        $user->save();
    }
}
