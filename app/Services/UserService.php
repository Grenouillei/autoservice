<?php

namespace App\Services;

use App\Models\Basket;
use App\Models\Currency;
use App\Models\Favorite;
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
    public function getAllFavorites(){
        return Favorite::all();
    }
    public function UserUpdate($req){
        $user = User::find(Auth::user()->id);
        $user->name = $req->name;
        $user->save();
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
        return  Auth::user()->admin;
    }
    public function isPremium(){
        return Auth::user()->premium;
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
    public function updateComment($reg){
        $comment = UserComment::find($reg->id);
        $comment->comment = $reg->comment;
        $comment->save();
    }
    public function setFavorite($reg){
        $favorite = new Favorite();
        $favorite->id_good = $reg->id_good;
        $favorite->id_user = Auth::user()->id;
        $favorite->save();
    }
    public function deleteFavorite($reg){
        $favorite = Favorite::find($reg->id);
        $favorite->delete();
    }
    public function changeAdminPassword($reg){
        $currency = Currency::find(1);
        $currency->admin_pass = $reg->password;
        $currency->save();
    }
    public function updateCurrencies(){
        $content = file_get_contents('https://finance.i.ua/');

        $usd = strpos($content, '<span>');
        $rate_usd= substr($content, $usd);
        $usd = strpos($rate_usd, '</span>');
        $rate_usd = substr($rate_usd, 106, $usd);
        $usd = substr($rate_usd, 6);
        $result_usd = substr($usd, 0, -2);

        $eur = strpos($content, 'EUR');
        $rate_eur = substr($content, $eur);
        $eur = strpos($rate_eur, '</span>');
        $rate_eur = substr($rate_eur, 106, $eur);
        $eur = substr($rate_eur, 48);
        $result_eur = substr($eur, 0, -2);

        $currency = Currency::find(1);
        $currency->usd = $result_usd;
        $currency->eur = $result_eur;
        $currency->save();
    }
    public function takeCurrencyUsd(){
        $currency = Currency::find(1);
        return $currency->usd;
    }
    public function takeCurrencyEur(){
        $currency = Currency::find(1);
        return $currency->eur;
    }
    public function checkNullofCurrency(){
        if(!Currency::find(1)){
            $currency = new Currency();
            $currency->usd = '28.00';
            $currency->eur = '33.00';
            $currency->admin_pass = 'admin228';
            $currency->save();
        }
    }
    public function test(){
        $content = file_get_contents('http://www.avtodim.com/parts/ae-V91174/?search=1');
        $teg = strpos($content, 'sepator');
        $string = substr($content, $teg);
        $teg = strpos($string, '</a>');
        $string = substr($string, 5, $teg);

        $start = strpos($string,'</h2>');
        $end = substr($string, 0, $start);
        $title = substr($end, 29);

        $start = strrchr($string,'замінників');
        $start1 = strrchr($start,'">');
        $code = substr($start1, 5, -5);

        return $end;
    }
   // public function randomComment(){
   //     $posts = UserComment::factory()
   //         ->count(1)
   //         ->for( User::factory(),'user')
   //         ->create();
   // }
}
