<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyRequest;
use App\Services\GoodsService;
use App\Services\OrderService;
use App\Services\CartService;
use App\Models\Order;

class OrderController extends Controller
{
    private $cartService;
    private $goodService;
    private $orderService;

    public function __construct(CartService $cartService,GoodsService $goodsService,OrderService $orderService)
    {
        $this->cartService = $cartService;
        $this->goodService = $goodsService;
        $this->orderService = $orderService;
    }

    /**
     * open archive of orders page
     * @return mixed
     */
    public function openArchivePage(){
        return view('archive' , [
            'orders'=>Order::all(),
            'products'=>$this->orderService->getForPageOrder(),
            'empty'=>$this->orderService->checkNullOfOrder(),
            'res'=>$this->cartService->takeCountOfCart()]);
    }

    /**
     * create new order
     * @return mixed
     * @throws \Exception
     */
    public function createNewOrder(BuyRequest $reg){
        $this->orderService->createOrder($reg);
        return view('home' , [
            'confirm'=>true,
            'parts'=>$this->goodService->getForPageHome(),
            'res'=>$this->cartService->takeCountOfCart()]);
    }
}
