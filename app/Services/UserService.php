<?php

namespace App\Services;

use App\Models\Basket;
use App\Models\User;
use App\Models\UserComment;
use App\Models\UserPremium;
use ErrorException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService{

    public function getAllUsers(){
        return User::all();
    }
    public function getAllComments(){
        return UserComment::all();
    }
    public function UserUpdate($req){
        $user = User::find(Auth::user()->id);
        $user->name = $req->name;
        $user->save();
    }
    public function xzxzxz(){
        //$users = UserComment::find(1);
        //$comments = User::find(1)->comments;
        return false;
    }
    public function UserDelete($request){
        $user = User::find($request->id);
        $baskets = Basket::all();
        $comments = $this->getAllComments();
        foreach ($baskets as $item) {
                if ($item->user_id==$user->id){
                    $item->delete();
                }
            }
        foreach ($comments as $item) {
            if ($item->id_user==$user->id){
                $item->delete();
            }
        }
        $user_premium = UserPremium::find($request->id);
        try {
            if ($user_premium->id==$user->id)
                $user_premium->delete();
        }catch (ErrorException $errorException){}
        $user->delete();
    }
    public function UserAdd($request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
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
        if(Auth::user()->premium)
            $is_premium = true;
        else
            $is_premium = false;
        return $is_premium;
    }
    public function setUserAdmin($request){
        $id = $request->id;
        $all_users = $this->getAllUsers();
        if($id!=null){
            $arr_id = explode(',',$id);
            foreach ($all_users as $user){
                if($user->id!=1&&$user->id!=Auth::user()->id){
                    if (in_array($user->id, $arr_id)){
                        $user->admin = true;
                        $user->save();
                    }else{
                        $user->admin = false;
                        $user->save();
                    }
                }
            }
        }else{
            foreach ($all_users as $user) {
                if($user->id!=1&&$user->id!=Auth::user()->id){
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
        $user->premium = true;
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
                       $user->premium = false;
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
    public function setComment($reg){
        $comment = new UserComment();
        $comment->id_user = $reg->id_user;
        $comment->id_good = $reg->id_good;
        $comment->comment = $reg->comment;
        $comment->save();
    }
    public function deleteComment($reg){
        $comment = UserComment::find($reg->id);
        $comment->delete();
    }
}
