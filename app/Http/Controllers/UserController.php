<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\CurrencyService;
use App\Services\FavoriteService;
use App\Services\PremiumService;
use App\Services\CartService;
use App\Services\UserService;

class UserController extends Controller
{
    private $cartService;
    private $userService;
    private $premiumService;
    private $currencyService;
    private $favoriteService;

    public function __construct(CartService $cartService,UserService $userService,PremiumService $premiumService,FavoriteService $favoriteService,CurrencyService $currencyService)
    {
        $this->cartService = $cartService;
        $this->userService = $userService;
        $this->premiumService = $premiumService;
        $this->favoriteService = $favoriteService;
        $this->currencyService = $currencyService;
    }

    /**
     * open user page
     * @throws \Exception
     * @return mixed
     */
    public function openUserPage(){
        $this->premiumService->checkUserPremium();
        return view('user',[
            'users'=>$this->userService->getAllUsers(),
            'res'=>$this->cartService->takeCountOfCart(),
            'usd'=>$this->currencyService->takeCurrencyUsd(),
            'eur'=>$this->currencyService->takeCurrencyEur(),
            'favorites'=>$this->favoriteService->getAllFavorites(),
            'today'=>$this->premiumService->getDateOfEndingPremium()]);
    }

    /**
     * open changing name user page
     * @return mixed
     */
    public function openUserSettingsPage(){
        $this->premiumService->checkUserPremium();
        return view('user_setting',[
            'res'=>$this->cartService->takeCountOfCart(),]);
    }

    /**
     * user change name
     * @param UserRequest $req
     * @return mixed
     */
    public function updateUser(UserRequest $req){
        $this->userService->updateUser($req);
        return redirect()->route('page.user');
    }
}
