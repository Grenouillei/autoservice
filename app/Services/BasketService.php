<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\basket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class BasketService {

    public function takeAllOfBasket(){
        return basket::all();
    }

    public  function takeCountOfBasket(){
        $baskets = basket::all();
        $result = 0;
        foreach ($baskets as $el){
            if ($el->user_id==Auth::user()->id){
                $result++;
            }
        }
        return $result;
    }


}
