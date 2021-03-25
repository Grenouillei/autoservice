<?php

namespace App\Services;

use App\Http\Requests\Auth\UserRequest;
use App\Models\User;
use App\Models\UserPremium;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserService{

    public function getAllUsers(){
        return User::all();
    }

    public function Userupdate($req){
        $user = User::find(Auth::user()->id);
        $user->name = $req->name;
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
    public function setUserAdmin($request){
        $id = $request->id;
        if($id!=null){
            $arr_id = explode(',',$id);
                foreach ($arr_id as $dude) {
                    $user_id = User::find($dude);
                    if($user_id->id==$dude){
                        $user_id->admin = true;
                        $user_id->save();
                    }else{
                        $user_id->admin = false;
                        $user_id->save();
                    }
                }
        }else{
            $all_users = $this->getAllUsers();
            foreach ($all_users as $user) {
                if($user->id!=1){
                    $user->admin = false;
                    $user->save();
                }
            }
        }
    }
    public function setUserPremium(){
        $user_p = new UserPremium();
        $user_p->id = Auth::user()->id;
        $user_p->on_date = mktime(date('H'), date('i'), date('s'),
                                date("m")  , date("d"), date("Y"));
        $user_p->off_date = mktime(date('H'), date('i'), date('s')+60,
                            date("m"), date("d"), date("Y"));
        $t = strtotime('+1 day');
        $user_p->date = date('d.m.Y H:i:s',$t);
        $user_p->save();

        $user = User::find(Auth::user()->id);
        $user->PREMIUM = true;
        $user->save();
    }
    public function checkUserPremium(){
        $current_date = mktime(date('H'), date('i'), date('s'),
                            date("m")  , date("d"), date("Y"));
        $user_premium = UserPremium::all();
            foreach ($user_premium as $premium) {
               if($premium->id==Auth::user()->id){
                   if($current_date>=$premium->off_date){
                       $user = User::find(Auth::user()->id);
                       $user->PREMIUM = false;
                       $user->save();

                       $user_p = UserPremium::find(Auth::user()->id);
                       $user_p->delete();
                   }
               }
            }
    }
    public function getDateOfEndingPremium(){
        try{
            $user_p = UserPremium::find(Auth::user()->id);
            $today = $user_p->date;
            return $today;
        }catch (ErrorException $e)
        {
            return false;
        }
    }
}
