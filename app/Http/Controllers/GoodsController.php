<?php

namespace App\Http\Controllers;

use App\Services\BasketService;
use App\Services\GoodsService;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\View;


class GoodsController extends Controller
{
    private $basketService;
    private $goodService;

    public function __construct(BasketService $basketService,GoodsService $goodsService)
    {
        $this->basketService = $basketService;
        $this->goodService = $goodsService;
    }

    public function openHomePage(){
        return view('home' , [
            'parts'=>$this->goodService->getForPageHome(),
            'res'=>$this->basketService->takeCountOfBasket(),
            'product'=>$this->basketService->takeAllOfBasket()]);
    }

    public function openNewPage(){
        $saw = rand(0,500);
        $buy = rand(0,100);
        $like = rand(0,30);
        return view('new',[
            'news'=>$this->goodService->takeAllOfGoods(),
            'product'=>$this->basketService->takeAllOfBasket(),
            'res'=>$this->basketService->takeCountOfBasket(),
            'saw'=>$saw,
            'buy'=>$buy,
            'like'=>$like]);
    }

    public function openSearchPage(Request $request){

            return view('search', [
                'array'=>$this->goodService->getForPageSearch($request),
                'mass' =>$this->goodService->takeAllOfGoods(),
                'res'=>$this->basketService->takeCountOfBasket(),
                'product'=>$this->basketService->takeAllOfBasket()
            ]);
    }

    public function openSortByBrandPage(Request $request1){

        return view('brands' , [
                'parts' =>$this->goodService->getForPageSortByBrand($request1),
                'res'=>$this->basketService->takeCountOfBasket(),
                'product'=>$this->basketService->takeAllOfBasket()
        ]);
    }
}
