<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Services\BasketService;
use App\Services\GoodsService;
use App\Services\UserService;
use Illuminate\Http\Request;

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
            'favorites'=>$this->userService->getAllFavorites(),
            'today'=>$this->userService->getDateOfEndingPremium()]);
    }
    public function openUserSettingsPage(){
        $this->userService->checkUserPremium();
        return view('user_setting',[
            'res'=>$this->basketService->takeCountOfBasket(),]);
    }
    public function openNewUserPage(){
        return view('create_user',[
            'res'=>$this->basketService->takeCountOfBasket(),]);
    }
    public function updateUser(UserRequest $req){
        $this->userService->UserUpdate($req);
        return redirect()->route('user');
    }
    public function removeUser(Request $request){
        $this->userService->UserDelete($request);
        return redirect()->route('user');
    }
    public function createUser(UserRequest $request){
        $this->userService->UserAdd($request);
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
    public function createComment(CommentRequest $reg){
        $this->userService->setComment($reg);
        return redirect()->back();
    }
    public function removeComment(Request $reg){
        $this->userService->deleteComment($reg);
        return redirect()->back();
    }
    public function updateComment(Request $reg){
        $this->userService->updateComment($reg);
        return redirect()->back();
    }
    public function addFavorite(Request $reg){
        $this->userService->setFavorite($reg);
        return redirect()->back();
    }
    public function deleteFavorite(Request $reg){
        $this->userService->deleteFavorite($reg);
        return redirect()->back();
    }
}
