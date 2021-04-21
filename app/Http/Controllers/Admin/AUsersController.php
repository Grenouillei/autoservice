<?php

namespace App\Http\Controllers\Admin;

use App\Services\Admin\AdminUserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\CartService;
use Illuminate\Http\Request;

class AUsersController extends Controller
{
    private $cartService;
    private $adminUserService;

    public function __construct(CartService $cartService,AdminUserService $adminUserService)
    {
        $this->adminUserService = $adminUserService;
        $this->cartService = $cartService;
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
     * delete user
     * @param Request $request
     * @throws \Exception
     * @return mixed
     */
    public function removeUser(Request $request){
        $this->adminUserService->deleteUser($request);
        return redirect()->route('page.user');
    }

    /**
     * create new user by admin
     * @param UserRequest $request
     * @return mixed
     */
    public function createUser(UserRequest $request){
        $this->adminUserService->createUser($request);
        return redirect()->route('page.user');
    }

    /**
     * set admin for users
     * @param Request $request
     * @return mixed
     */
    public function takeUserAdmin(Request $request){
        $this->adminUserService->setUserAdmin($request);
        return redirect()->route('page.user');
    }
}
