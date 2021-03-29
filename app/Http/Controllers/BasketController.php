<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\BasketService;
use App\Services\GoodsService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\Basket;
use App\Models\Good;

class BasketController extends Controller
{
    public function __construct(BasketService $basketService,GoodsService $goodsService,Basket $basket,UserService $userService){
        $this->basket = $basket;
        $this->basketService = $basketService;
        $this->goodService = $goodsService;
        $this->userService = $userService;
    }
    public function openBuyPage(){
        return view('buy', [
            'res'=>$this->basketService->takeCountOfBasket(),]);
    }

    public function openBasketPage(){
        $this->userService->checkUserPremium();
        return view('basket', [
            'empty'=>$this->basketService->checkNullOfBasket(),
            'user_premium'=>$this->userService->isPremium(),
            'res'=>$this->basketService->takeCountOfBasket(),
            'product'=>$this->basketService->takeAllOfBasket()
            ]);
    }

    public function deleteElementFromBasket(Request $request){
        $basket = Basket::find($request->id);
        $basket->delete();
        return redirect()->route('basket');
    }

    public function addElementToBasket(Request $request){
        $goods = Good::find($request->id);
        $basket_el = new Basket();
        $basket_el->id_g = $request->id;
        $basket_el->name = $goods->name;
        $basket_el->brand = $goods->brand;
        $basket_el->code = $goods->code;
        $basket_el->qty = 1;
        $basket_el->price = $goods->price;
        $basket_el->user_id = Auth::user()->id;
        $basket_el->save();
        return redirect()->back();
    }

}
