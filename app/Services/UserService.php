<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use Carbon\Carbon;
use ErrorException;
use App\Models\User;
use App\Models\Currency;
use App\Models\Favorite;
use App\Models\UserComment;
use App\Models\UserPremium;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService{

    /**
     * return all users
     * @return mixed
    */
    public function getAllUsers(){
        return User::all();
    }

    /**
     * return all comments
     * @return mixed
     */
    public function getAllComments(){
        return UserComment::all();
    }

    /**
     * return all favorites
     * @return mixed
     */
    public function getAllFavorites(){
        return Favorite::all();
    }

    /**
     * change user name
     * @param $req
     */
    public function UserUpdate($req){
        $user = User::find(Auth::user()->id);
        $user->name = $req->name;
        $user->save();
    }

    /**
     * remove user and everything related with
     * @param $request
     * @throws \Exception
     */
    public function UserDelete($request){
        $user = User::find($request->id);
        $carts = Cart::all();
        $orders = Order::all();
        $comments = $this->getAllComments();
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
        $user_premium = UserPremium::find($request->id);
        try {
            if ($user_premium->id==$user->id)
                $user_premium->delete();
        }catch (ErrorException $errorException){}
        $user->delete();
    }

    /**
     * create new user
     * @param $request
     */
    public function UserAdd($request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
    }

    /**
     * set/remove admin for users
     * @param $request
     */
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

    /**
     * set premium for user
     */
    public function setUserPremium(){
        $user_p = new UserPremium();
        $user_p->id = Auth::user()->id;
        $user_p->on_date = strtotime('now');
        $user_p->off_date = strtotime("+1 minutes");
        $user_p->date = Carbon::now()->addDay()->addHours(3);
        $user_p->save();

        $user = User::find(Auth::user()->id);
        $user->premium = true;
        $user->save();
    }

    /**
     * checking user premium for further remove
     */
    public function checkUserPremium(){
        $current_date = strtotime('now');
        $user_p = UserPremium::find(Auth::user()->id);
        if ($user_p){
            if ($user_p->off_date <= $current_date) {
                $user = User::find(Auth::user()->id);
                $user->premium = false;
                $user->save();
                $user_p->delete();
            }
        }
    }

    /**
     * return date of ending premium for user page
     * @throws \Exception
     * @return mixed
     */
    public function getDateOfEndingPremium(){
        try{
            $user_p = UserPremium::find(Auth::user()->id);
            return $user_p->date;
        }catch (ErrorException $e) {
            return false;
        }
    }

    /**
     * create new comment by user
     * @param $reg
     */
    public function setComment($reg){
        $comment = new UserComment();
        $comment->id_user = $reg->id_user;
        $comment->id_good = $reg->id_good;
        $comment->comment = $reg->comment;
        $comment->save();
    }

    /**
     * remove comment
     * @param $reg
     */
    public function deleteComment($reg){
        $comment = UserComment::find($reg->id);
        $comment->delete();
    }

    /**
     * update comment
     * @param $reg
     */
    public function updateComment($reg){
        $comment = UserComment::find($reg->id);
        $comment->comment = $reg->comment;
        $comment->save();
    }

    /**
     * add product to favorites
     * @param $reg
     */
    public function setFavorite($reg){
        $favorite = new Favorite();
        $favorite->id_good = $reg->id_good;
        $favorite->id_user = Auth::user()->id;
        $favorite->save();
    }

    /**
     * remove product from favorites
     * @param $reg
     */
    public function deleteFavorite($reg){
        $favorite = Favorite::find($reg->id);
        $favorite->delete();
    }

    /**
     * change admin password
     * @param $reg
     */
    public function changeAdminPassword($reg){
        $currency = Currency::find(1);
        $currency->admin_pass = $reg->password;
        $currency->save();
    }

    /**
     * update currencies by parsing another site
     * with strpos and substr methods
     */
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

    /**
     * return currency usd for user page
     * @return string
     */
    public function takeCurrencyUsd(){
        $currency = Currency::find(1);
        return $currency->usd;
    }

    /**
     * return currency euro for user page
     * @return string
     */
    public function takeCurrencyEur(){
        $currency = Currency::find(1);
        return $currency->eur;
    }

//   public function test(){
//        $content = file_get_contents('http://www.avtodim.com/parts/ae-V91174/?search=1');
//        $teg = strpos($content, 'sepator');
//        $string = substr($content, $teg);
//        $teg = strpos($string, '</a>');
//        $string = substr($string, 5, $teg);
//
//        $start = strpos($string,'</h2>');
//        $end = substr($string, 0, $start);
//        $title = substr($end, 29);
//
//        $start = strrchr($string,'замінників');
//        $start1 = strrchr($start,'">');
//        $code = substr($start1, 5, -5);
//
//        return $end;
//    }
}
