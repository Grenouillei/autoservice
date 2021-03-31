<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Basket;
use App\Models\Good;
use App\Services\BasketService;
use App\Services\GoodsService;
use App\Services\UserService;
use Illuminate\Http\Request;


class GoodsController extends Controller
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

    public function openHomePage(){
        $this->userService->checkUserPremium();
            if (!$this->goodService->getForPageHome()){
                return view('user',[
                    'users'=>$this->userService->getAllUsers(),
                    'user_admin'=>$this->userService->isAdmin(),
                    'user_premium'=>$this->userService->isPremium(),
                    'res'=>$this->basketService->takeCountOfBasket(),
                    'today'=>$this->userService->getDateOfEndingPremium()]);
            }
        return view('home' , [
            'parts'=>$this->goodService->getForPageHome(),
            'res'=>$this->basketService->takeCountOfBasket()]);
    }

    public function openNewPage(){
        $this->userService->checkUserPremium();
        $saw = rand(0,500);
        $buy = rand(0,100);
        $like = rand(0,30);
        return view('new',[
            'news'=>$this->goodService->getAllOfGoods(),
            'user_admin'=>$this->userService->isAdmin(),
            'user_premium'=>$this->userService->isPremium(),
            'comments'=>$this->userService->getAllComments(),
            'res'=>$this->basketService->takeCountOfBasket(),
            'favorites'=>$this->userService->getAllFavorites(),
            'product'=>$this->basketService->takeAllOfBasket(),
            'saw'=>$saw,
            'buy'=>$buy,
            'like'=>$like]);
    }

    public function openSearchPage(Request $request){
        $this->userService->checkUserPremium();
            return view('search', [
                'user_premium'=>$this->userService->isPremium(),
                'array'=>$this->goodService->getForPageSearch($request),
                'mass' =>$this->goodService->getAllOfGoods(),
                'res'=>$this->basketService->takeCountOfBasket()]);
    }

    public function openSortByBrandPage(Request $request1){
        $this->userService->checkUserPremium();
        return view('brands' , [
                'user_premium'=>$this->userService->isPremium(),
                'parts' =>$this->goodService->getForPageSortByBrand($request1),
                'res'=>$this->basketService->takeCountOfBasket()]);
    }

    public function changeAvailabilityOfGoods(Request $request){
        $this->goodService->getAvailability($request);
        return redirect()->back();
    }

    public function createNewProduct(ProductRequest $request){
        $this->goodService->setNewProduct($request);
        return redirect()->route('user');
    }
    public function removeProduct(Request $request){
        $product = Good::find($request->id);
        $baskets = $this->basketService->takeAllOfBasket();
            foreach ($baskets as $item) {
                    if($item->id_g==$product->id){
                        $item->delete();
                    }
                }
        $product->delete();
        return redirect()->route('home');
    }

    public function openNewProductPage( ){
        return view('create_product',[
            'res'=>$this->basketService->takeCountOfBasket()]);
    }

    public function openAboutPage( ){
        return view('about',[
            'res'=>$this->basketService->takeCountOfBasket()]);
    }

    public function openContactPage( ){
        return view('contact',[
            'res'=>$this->basketService->takeCountOfBasket()]);
    }

}
