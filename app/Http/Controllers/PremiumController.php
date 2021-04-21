<?php

namespace App\Http\Controllers;

use App\Services\PremiumService;
use Illuminate\Http\Request;

class PremiumController extends Controller
{
    private $premiumService;

    public function __construct(PremiumService $premiumService)
    {
        $this->premiumService = $premiumService;
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
