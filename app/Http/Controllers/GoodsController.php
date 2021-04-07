<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\GoodsService;
use App\Services\UserService;
use App\Services\CartService;
use Illuminate\Http\Request;
use App\Models\Good;
use App\Models\Cart;


class GoodsController extends Controller
{
    private $cartService;
    private $goodService;
    private $userService;

    public function __construct(CartService $cartService,GoodsService $goodsService,UserService $userService)
    {
        $this->cartService = $cartService;
        $this->goodService = $goodsService;
        $this->userService = $userService;
    }

    /**
     * open home page
     * @return mixed
     */
    public function openHomePage(){
        $this->userService->checkUserPremium();
        return view('home' , [
            'parts'=>$this->goodService->getForPageHome(),
            'res'=>$this->cartService->takeCountOfCart()]);
    }

    /**
     * open certain product page
     * @return mixed
     */
    public function openNewPage(){
        $this->userService->checkUserPremium();
        return view('new',[
            'product'=>Cart::all(),
            'news'=>$this->goodService->getAllOfGoods(),
            'res'=>$this->cartService->takeCountOfCart(),
            'comments'=>$this->userService->getAllComments(),
            'favorites'=>$this->userService->getAllFavorites(),
            'saw'=>rand(0,500),
            'buy'=>rand(0,100),
            'like'=>rand(0,30)]);
    }

    /**
     * open search page certain product
     * @return mixed
     */
    public function openSearchPage(Request $request){
        $this->userService->checkUserPremium();
            return view('search', [
                'array'=>$this->goodService->getForPageSearch($request),
                'res'=>$this->cartService->takeCountOfCart()]);
    }

    /**
     * open search page certain brand
     * @param Request $request1
     * @return mixed
     */
    public function openSortByBrandPage(Request $request1){
        $this->userService->checkUserPremium();
            return view('brands' , [
                'parts' =>$this->goodService->getForPageSortByBrand($request1),
                'res'=>$this->cartService->takeCountOfCart()]);
    }

    /**
     * changing available of product in goods table
     * @param Request $request
     * @return mixed
     */
    public function changeAvailabilityOfGoods(Request $request){
        $this->goodService->getAvailability($request);
        return redirect()->back();
    }

    /**
     * create new product in goods table
     * @param ProductRequest $request
     * @return mixed
     */
    public function createNewProduct(ProductRequest $request){
        $this->goodService->setNewProduct($request);
        return redirect()->route('user');
    }

    /**
     * remove product form goods table
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function removeProduct(Request $request){
        $product = Good::find($request->id);
        $carts = Cart::all();
            foreach ($carts as $cart) {
                    if($cart->id_good==$product->id){
                        $cart->delete();
                    }
                }
        $product->delete();
        return redirect()->route('home');
    }

    /**
     * open page to create new product
     * @return mixed
     */
    public function openNewProductPage( ){
        return view('create_product',[
            'res'=>$this->cartService->takeCountOfCart()]);
    }

    /**
     * open about page
     * @return mixed
     */
    public function openAboutPage( ){
        return view('about',[
            'res'=>$this->cartService->takeCountOfCart()]);
    }

    /**
     * open contact page
     * @return mixed
     */
    public function openContactPage( ){
        return view('contact',[
            'res'=>$this->cartService->takeCountOfCart()]);
    }
}
