<?php

namespace App\Services\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\EditorInterface;
use App\Models\UserPremium;
use App\Models\UserComment;
use App\Models\Order;
use App\Models\User;
use App\Models\Cart;

class AdminUserService implements EditorInterface
{
    /**
     * create new user
     * @param $req
     */
    public function create($req){
        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();
    }

    /**
     * remove user and everything related with
     * @param $req
     * @throws \Exception
     */
    public function delete($req){
        $user = User::find($req->id);
        $carts = Cart::all();
        $orders = Order::all();
        $comments = UserComment::all();
        foreach ($carts as $item) {
            if ($item->user_id==$user->id)
                $item->delete();
        }
        foreach ($comments as $item) {
            if ($item->id_user==$user->id)
                $item->delete();
        }
        foreach ($orders as $item) {
            if ($item->id_user==$user->id)
                $item->delete();
        }
        $user_premium = UserPremium::find($req->id);
        try {
            if ($user_premium->id==$user->id)
                $user_premium->delete();
        }catch (ErrorException $errorException){}
        $user->delete();
    }

    /**
     * set/remove admin for users
     * @param $request
     */
    public function setUserAdmin($request){
        $id = $request->id;
        $all_users = User::all();
        if($id!=null){
            $arr_id = explode(',',$id);
            foreach ($all_users as $user){
                if($user->id!=1&&$user->id!=Auth::user()->id){
                    if(in_array($user->id, $arr_id)){
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

}
