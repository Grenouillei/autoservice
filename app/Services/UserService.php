<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Models\user;
use Illuminate\Http\Request;

class UserService
{
    public function Userupdate(Request $request){
        $user = User::find(1);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
    }
}
