<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private $cartService;
    private $userService;

    public function __construct(CartService $cartService,UserService $userService){
        $this->cartService = $cartService;
        $this->userService = $userService;
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
        $this->userService->checkUserPremium();
        return view('basket', [
            'empty'=>$this->cartService->checkNullOfCart(),
            'res'=>$this->cartService->takeCountOfCart(),
            'product'=>Cart::all()
        ]);
    }

    /**
     * remove element from cart table
     * @param Request $request
     * @return mixed
     */
    public function removeCart(Request $request){
        $cart = Cart::find($request->id);
        $cart->delete();
        return redirect()->route('basket');
    }

    /**
     * add element to cart table
     * @param Request $request
     * @return mixed
     */
    public function addCart(Request $request){
        $cart = new Cart();
        $cart->id_user = Auth::user()->id;
        $cart->id_good = $request->id;
        $cart->save();
        return redirect()->back();
    }
}
