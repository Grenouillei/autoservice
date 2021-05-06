<?php

namespace App\Services;

use App\Interfaces\UpdaterInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserService implements UpdaterInterface
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
    public function update($req){
        $user = User::find(Auth::user()->id);
        $user->name = $req->name;
        $user->save();
    }
}
