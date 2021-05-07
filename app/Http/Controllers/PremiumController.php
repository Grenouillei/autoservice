<?php

namespace App\Http\Controllers;

use App\Services\PremiumService;
use App\Services\CartService;
use Illuminate\Http\Request;

class PremiumController extends Controller
{
    private $premiumService;
    private $cartService;

    public function __construct(PremiumService $premiumService,CartService $cartService)
    {
        $this->premiumService = $premiumService;
        $this->cartService = $cartService;
    }

    /**
     * set user premium
     * @return mixed
     */
    public function openPremiumPage(){
       return view('premium', [
           'res'=>$this->cartService->takeCountOfCart(),]);
    }

    /**
     * set user premium
     * @return mixed
     */
    public function buyUserPremium(){
        $this->premiumService->setUserPremium();
        return redirect()->route('page.user');
    }
}
