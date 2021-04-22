<?php

namespace App\Http\Controllers;

use App\Services\PremiumService;
use App\Services\CartService;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    private $cartService;
    private $premiumService;

    public function __construct(CartService $cartService,PremiumService $premiumService){
        $this->cartService = $cartService;
        $this->premiumService = $premiumService;
    }

    /**
     * open buy page
     * @return mixed
     */
    public function openBuyPage(){
        return view('buy', [
            'res'=>$this->cartService->takeCountOfCart(),
            'products'=>Cart::all(),
            ]);
    }

    /**
     * open cart page
     * @return mixed
     */
    public function openCartPage(){
        $this->premiumService->checkUserPremium();
        return view('basket', [
            'product'=>Cart::all(),
            'res'=>$this->cartService->takeCountOfCart()]);
    }

    /**
     * add product to cart table
     * @param Request $request
     * @return mixed
     */
    public function addCart(Request $request){
        $this->cartService->create($request);
        return redirect()->back();
    }

    /**
     * remove element from cart table
     * @param Request $request
     * @return mixed
     */
    public function removeCart(Request $request){
        $this->cartService->delete($request);
        return redirect()->route('page.basket');
    }
}
