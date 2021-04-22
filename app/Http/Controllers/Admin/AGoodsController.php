<?php

namespace App\Http\Controllers\Admin;

use App\Services\Admin\AdminGoodService;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;
use App\Services\GoodsService;
use App\Services\CartService;
use Illuminate\Http\Request;

class AGoodsController extends Controller
{
    private $cartService;
    private $goodService;
    private $adminGoodService;

    public function __construct(CartService $cartService, GoodsService $goodsService, AdminGoodService $adminGoodService)
    {
        $this->cartService = $cartService;
        $this->goodService = $goodsService;
        $this->adminGoodService = $adminGoodService;
    }

    /**
     * open page to change value product
     * @return mixed
     */
    public function openUpdateProductPage(){
        return view('product_setting',[
            'products'=>$this->goodService->getAllOfGoods(),
            'res'=>$this->cartService->takeCountOfCart()]);
    }

    /**
     * open page to create new product
     * @return mixed
     */
    public function openNewProductPage(){
        return view('create_product',[
            'res'=>$this->cartService->takeCountOfCart()]);
    }

    /**
     * changing available of product in goods table
     * @param Request $request
     * @return mixed
     */
    public function changeAvailableProduct(Request $request){
        $this->adminGoodService->setAvailability($request);
        return redirect()->back();
    }

    /**
     * create new product in goods table
     * @param ProductRequest $request
     * @return mixed
     */
    public function createProduct(ProductRequest $request){
        $this->adminGoodService->create($request);
        return redirect()->route('page.user');
    }

    /**
     * update product in goods table
     * @param ProductRequest $req
     * @return mixed
     */
    public function updateProduct(ProductRequest $req){
        $this->adminGoodService->update($req);
        return redirect()->route('page.home');
    }

    /**
     * remove product form goods table
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function removeProduct(Request $request){
        $this->adminGoodService->delete($request);
        return redirect()->route('page.home');
    }
}
