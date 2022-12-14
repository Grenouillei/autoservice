<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\Telegram;
use App\Services\PremiumService;
use App\Services\CartService;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Http;

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
            if ($request->telegram){
                $this->sendTelegramNotification($request);
                return redirect()->back();
            }
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

    public function sendTelegramNotification(Request $request){
        $order = Good::find($request->telegram);
        $order->telegram_status = auth()->user()->id;
        $order->save();
        $tel = auth()->user()->email;
        $telegram = Telegram::find(1);
        if ($telegram)
            Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://api.telegram.org/bot$telegram->token/sendMessage",[
                'chat_id'=> $telegram->chat_id,
                   'parse_mode' => 'HTML',
                   'text'=>"User: $tel"
           ]);
    }
}
