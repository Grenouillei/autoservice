<?php

namespace App\Http\Controllers;

use App\Services\GoodsService;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\View;


class GoodsController extends Controller
{
    public $sklad1;
    public $sklad;
    public $temp;
    public $arr = array();
    private $goodService;

    public function __construct(GoodsService $goodsService)
    {
        $this->goodService = $goodsService;
    }

    public function openHomePage(){
        return view('home' , [
            'parts'=>$this->goodService->getForPageHome(),
            'res'=>$this->goodService->takeCountOfBasket(),
            'product'=>$this->goodService->takeAllOfBasket()]);
    }

    public function openNewPage(){
        $saw = rand(0,500);
        $buy = rand(0,100);
        $like = rand(0,30);
        return view('new',[
            'news'=>$this->goodService->takeAllOfGoods(),
            'product'=>$this->goodService->takeAllOfBasket(),
            'res'=>$this->goodService->takeCountOfBasket(),
            'saw'=>$saw,
            'buy'=>$buy,
            'like'=>$like]);
    }

    public function openSearchPage(Request $request){

            return view('search', [
                'array'=>$this->goodService->getForPageSearch($request),
                'mass' =>$this->goodService->takeAllOfGoods(),
                'res'=>$this->goodService->takeCountOfBasket(),
                'product'=>$this->goodService->takeAllOfBasket()
            ]);
    }

    public function openSortByBrandPage(Request $request1){

        return view('brands' , [
                'parts' =>$this->goodService->getForPageSortByBrand($request1),
                'res'=>$this->goodService->takeCountOfBasket(),
                'product'=>$this->goodService->takeAllOfBasket()
        ]);
    }
}
