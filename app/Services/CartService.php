<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartService {

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

    /**
     * checking if empty carts table certain user
     * @return boolean
     */
    public function checkNullOfCart(){
        $carts = Cart::all();
        foreach ($carts as $item) {
            if($item->id_user==Auth::user()->id)
                return true;
        }
        return false;
    }
}
