<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserService{
    public function Userupdate(Request $request){
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        //$user->email = $request->email;
        //$user->password = $request->password;
        $user->save();
    }
    public function getPremium(){

    }
}
