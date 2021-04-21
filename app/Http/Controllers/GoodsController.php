<?php

namespace App\Http\Controllers;

use App\Services\FavoriteService;
use App\Services\GoodsService;
use App\Services\CommentService;
use App\Services\PremiumService;
use App\Services\CartService;
use Illuminate\Http\Request;
use App\Models\Cart;


class GoodsController extends Controller
{
    private $cartService;
    private $goodService;
    private $commentService;
    private $premiumService;
    private $favoriteService;

    public function __construct(CartService $cartService,FavoriteService $favoriteService, GoodsService $goodsService,CommentService $commentService, PremiumService $premiumService)
    {
        $this->cartService = $cartService;
        $this->goodService = $goodsService;
        $this->commentService = $commentService;
        $this->premiumService = $premiumService;
        $this->favoriteService = $favoriteService;
    }

    /**
     * open home page
     * @return mixed
     */
    public function openHomePage(){
        $this->premiumService->checkUserPremium();
        return view('home' , [
            'confirm'=>false,
            'parts'=>$this->goodService->getForPageHome(),
            'res'=>$this->cartService->takeCountOfCart()]);
    }

    /**
     * open certain product page
     * @return mixed
     */
    public function openProductPage(){
        $this->premiumService->checkUserPremium();
        return view('new',[
            'product'=>Cart::all(),
            'news'=>$this->goodService->getAllOfGoods(),
            'res'=>$this->cartService->takeCountOfCart(),
            'comments'=>$this->commentService->getAllComments(),
            'favorites'=>$this->favoriteService->getAllFavorites(),
            'saw'=>rand(0,500),
            'buy'=>rand(0,100),
            'like'=>rand(0,30)]);
    }

    /**
     * open search page certain product
     * @return mixed
     */
    public function openSearchPage(Request $request){
        $this->premiumService->checkUserPremium();
            return view('search', [
                'array'=>$this->goodService->getForPageSearch($request),
                'res'=>$this->cartService->takeCountOfCart()]);
    }

    /**
     * open search page certain brand
     * @param Request $request1
     * @return mixed
     */
    public function openBrandPage(Request $request1){
        $this->premiumService->checkUserPremium();
            return view('brands' , [
                'parts' =>$this->goodService->getForPageBrand($request1),
                'res'=>$this->cartService->takeCountOfCart()]);
    }

    /**
     * open about page
     * @return mixed
     */
    public function openAboutPage(){
        return view('about',[
            'res'=>$this->cartService->takeCountOfCart()]);
    }

    /**
     * open contact page
     * @return mixed
     */
    public function openContactPage(){
        return view('contact',[
            'res'=>$this->cartService->takeCountOfCart()]);
    }
}
