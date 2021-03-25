<?php

namespace App\Http\Controllers;

use App\Services\BasketService;
use App\Services\GoodsService;
use App\Services\UserService;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\View;


class GoodsController extends Controller
{
    private $basketService;
    private $goodService;
    private $userService;

    public function __construct(BasketService $basketService,GoodsService $goodsService,UserService $userService)
    {
        $this->basketService = $basketService;
        $this->goodService = $goodsService;
        $this->userService = $userService;
    }

    public function openHomePage(){
        $this->userService->checkUserPremium();
        return view('home' , [
            'parts'=>$this->goodService->getForPageHome(),
            'res'=>$this->basketService->takeCountOfBasket(),
            'product'=>$this->basketService->takeAllOfBasket()]);
    }

    public function openNewPage(){
        $this->userService->checkUserPremium();
        $saw = rand(0,500);
        $buy = rand(0,100);
        $like = rand(0,30);
        return view('new',[
            'news'=>$this->goodService->takeAllOfGoods(),
            'user_premium'=>$this->userService->isPremium(),
            'res'=>$this->basketService->takeCountOfBasket(),
            'product'=>$this->basketService->takeAllOfBasket(),
            'saw'=>$saw,
            'buy'=>$buy,
            'like'=>$like]);
    }

    public function openSearchPage(Request $request){
        $this->userService->checkUserPremium();
            return view('search', [
                'user_premium'=>$this->userService->isPremium(),
                'array'=>$this->goodService->getForPageSearch($request),
                'mass' =>$this->goodService->takeAllOfGoods(),
                'res'=>$this->basketService->takeCountOfBasket(),
                'product'=>$this->basketService->takeAllOfBasket()
            ]);
    }

    public function openSortByBrandPage(Request $request1){
        $this->userService->checkUserPremium();
        return view('brands' , [
                'user_premium'=>$this->userService->isPremium(),
                'parts' =>$this->goodService->getForPageSortByBrand($request1),
                'res'=>$this->basketService->takeCountOfBasket(),
                'product'=>$this->basketService->takeAllOfBasket()
        ]);
    }

    public function ChangeAvailabilityOfGoods(Request $request){
        $this->goodService->getAvailability($request);
        return redirect()->back();
    }
}
