<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Services\CartService;
use App\Http\Requests\UserRequest;
use App\Services\GoodsService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $cartService;
    private $userService;

    public function __construct(CartService $cartService,UserService $userService)
    {
        $this->cartService = $cartService;
        $this->userService = $userService;
    }

    /**
     * open user page
     * @throws \Exception
     * @return mixed
     */
    public function openUserPage(){
        $this->userService->checkUserPremium();
        return view('user',[
            'users'=>$this->userService->getAllUsers(),
            'usd'=>$this->userService->takeCurrencyUsd(),
            'eur'=>$this->userService->takeCurrencyEur(),
            'res'=>$this->cartService->takeCountOfCart(),
            'favorites'=>$this->userService->getAllFavorites(),
            'today'=>$this->userService->getDateOfEndingPremium()]);
    }

    /**
     * open changing name user page
     * @return mixed
     */
    public function openUserSettingsPage(){
        $this->userService->checkUserPremium();
        return view('user_setting',[
            'res'=>$this->cartService->takeCountOfCart(),]);
    }

    /**
     * open creating new user page
     * @return mixed
     */
    public function openNewUserPage(){
        return view('create_user',[
            'res'=>$this->cartService->takeCountOfCart(),]);
    }

    /**
     * @param UserRequest $req
     * @return mixed
     */
    public function updateUser(UserRequest $req){
        $this->userService->UserUpdate($req);
        return redirect()->route('page.user');
    }

    /**
     * @param Request $request
     * @throws \Exception
     * @return mixed
     */
    public function removeUser(Request $request){
        $this->userService->UserDelete($request);
        return redirect()->route('page.user');
    }

    /**
     * @param UserRequest $request
     * @return mixed
     */
    public function createUser(UserRequest $request){
        $this->userService->UserAdd($request);
        return redirect()->route('page.user');
    }

    /**
     * @return mixed
     */
    public function buyUserPremium(){
        $this->userService->setUserPremium();
        return redirect()->route('page.user');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function takeUserAdmin(Request $request){
        $this->userService->setUserAdmin($request);
        return redirect()->route('page.user');
    }

    /**
     * @param CommentRequest $reg
     * @return mixed
     */
    public function createComment(CommentRequest $reg){
        $this->userService->setComment($reg);
        return redirect()->back();
    }

    /**
     * @param Request $reg
     * @return mixed
     */
    public function removeComment(Request $reg){
        $this->userService->deleteComment($reg);
        return redirect()->back();
    }

    /**
     * @param Request $reg
     * @return mixed
     */
    public function updateComment(Request $reg){
        $this->userService->updateComment($reg);
        return redirect()->back();
    }

    /**
     * @param Request $reg
     * @return mixed
     */
    public function addFavorite(Request $reg){
        $this->userService->setFavorite($reg);
        return redirect()->back();
    }

    /**
     * @param Request $reg
     * @return mixed
     */
    public function deleteFavorite(Request $reg){
        $this->userService->deleteFavorite($reg);
        return redirect()->back();
    }

    /**
     * @param Request $reg
     * @return mixed
     */
    public function updateAdminPassword(Request $reg){
        $this->userService->changeAdminPassword($reg);
        return redirect()->back();
    }

    /**
     * @return mixed
     */
    public function updateCurrencies(){
        $this->userService->updateCurrencies();
        return redirect()->back();
    }
}
