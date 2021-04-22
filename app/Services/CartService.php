<?php

namespace App\Services;

use App\Interfaces\EditorInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartService implements EditorInterface
{
    /**
     * create new cart element
     * @param $req
     */
    public function create($req){
        $cart = new Cart();
        $cart->id_user = Auth::user()->id;
        $cart->id_good = $req->id;
        $cart->save();
    }

    /**
     * delete cart
     * @param $req
     */
    public function delete($req){
        $cart = Cart::find($req->id);
        $cart->delete();
    }

    /**
     * return quantity of elements in carts table certain user
     * @return bool|int
     */
    public  function takeCountOfCart(){
        $carts = Cart::all();
        $result = 0;
        foreach ($carts as $el){
            if ($el->id_user==Auth::user()->id)
                $result++;
        }
        if ($result==0)
            return false;
        return $result;
    }
}
