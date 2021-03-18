<?php

namespace App\Services;

use App\Http\Requests\Auth\UserRequest;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserService{

    public $tomorrow_date;
    public $current_date;

    public function getAllUsers(){
        return User::all();
    }
    public function Userupdate($req){
        $user = User::find(Auth::user()->id);
        $user->name = $req->name;
        //$user->email = $req->email;
        //$user->password = $req->password;
        $user->save();
    }
    public function isAdmin(){
        if(Auth::user()->admin)
            $is_admin = true;
        else
            $is_admin = false;
        return $is_admin;
    }
    public function isPremium(){
        if(Auth::user()->PREMIUM)
            $is_premium = true;
        else
            $is_premium = false;
        return $is_premium;
    }
    public function getPremium(){

        $current_date = mktime(date('H'), date('i'), date('s'),
            date("m")  , date("d"), date("Y"));
        $this->current_date = $current_date;

        $tomorrow_date = mktime(date('H'), date('i'), date('s')+30,
            date("m"), date("d")+1, date("Y"));
        $this->tomorrow_date = $tomorrow_date;

    }

}
