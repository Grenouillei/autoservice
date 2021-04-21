<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartService
{
    /**
     * create new cart element
     * @param $request
     */
    public function createCart($request){
        $cart = new Cart();
        $cart->id_user = Auth::user()->id;
        $cart->id_good = $request->id;
        $cart->save();
    }

    /**
     * delete cart
     * @param $request
     */
    public function deleteCart($request){
        $cart = Cart::find($request->id);
        $cart->delete();
    }

    /**
     * return quantity of elements in carts table certain user
     * @return mixed
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
