<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Basket;
use Illuminate\Support\Facades\Auth;

class BasketService {

    public function takeAllOfBasket(){
        return Basket::all();
    }
    public  function takeCountOfBasket(){
        $baskets = $this->takeAllOfBasket();
        $result = 0;
        foreach ($baskets as $el){
            if ($el->user_id==Auth::user()->id){
                $result++;
            }
        }
        if ($result==0){
            return false;
        }
        return $result;
    }
    public function checkNullOfBasket(){
        $baskets = $this->takeAllOfBasket();
        foreach ($baskets as $item) {
                if($item->user_id==Auth::user()->id){
                    return true;
                }
            }
        return false;
    }
}
