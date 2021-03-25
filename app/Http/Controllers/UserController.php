<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\BasketService;
use App\Services\GoodsService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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

    public function openUserPage(){
        $this->userService->checkUserPremium();
        return view('user',[
            'users'=>$this->userService->getAllUsers(),
            'user_admin'=>$this->userService->isAdmin(),
            'user_premium'=>$this->userService->isPremium(),
            'res'=>$this->basketService->takeCountOfBasket(),
            'product'=>$this->basketService->takeAllOfBasket(),
            'today'=>$this->userService->getDateOfEndingPremium()]);
    }
    public function openUserSettingsPage(){
        $this->userService->checkUserPremium();
        return view('user_setting',[
            'res'=>$this->basketService->takeCountOfBasket(),
            'product'=>$this->basketService->takeAllOfBasket()]);
    }
    public function updateUser(UserRequest $req){
        $this->userService->Userupdate($req);
        return redirect()->route('user');
    }
    public function buyUserPremium(){
        $this->userService->setUserPremium();
        return redirect()->route('user');
    }
    public function takeUserAdmin(Request $request){
        $this->userService->setUserAdmin($request);
        return redirect()->route('user');
    }
}
