<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\BuyRequest;
use App\Services\GoodsService;
use App\Services\UserService;
use App\Services\CartService;
use Illuminate\Http\Request;
use App\Models\Order;
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
            'confirm'=>false,
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

    /**
     * forming an order with manipulations
     * with the quantity of goods
     * @param BuyRequest $reg
     * @return mixed
     * @throws \Exception
     */
    public function createNewOrder(BuyRequest $reg){
        $order = new Order();
        $order->id_user = Auth()->user()->id;
        $order->name = $reg->name;
        $order->last_name = $reg->lastName;
        $order->phone = $reg->phone;
        $order->city = $reg->city;
        $order->id_goods = $reg->id_array;
        $order->qty_goods = $reg->qty_array;
        $order->sum_goods = $reg->sum_array;
        $order->save();

        $array_id = $reg->id_array;
        $array_qty = $reg->qty_array;
        $arr_id = explode(',',$array_id);
        $arr_qty = explode(',',$array_qty);
            for($i=0;$i<count($arr_id);$i++){
                $good = Good::find($arr_id[$i]);
                $good->qty = $good->qty - $arr_qty[$i];
                $good->save();
            }
        $carts = Cart::all();
            foreach ($carts as $cart) {
                if($cart->id_user==Auth()->user()->id)
                    $cart->delete();
            }
        return view('home' , [
            'confirm'=>true,
            'parts'=>$this->goodService->getForPageHome(),
            'res'=>$this->cartService->takeCountOfCart()]);
    }

    /**
     * open archive of orders page
     * @return mixed
     */
    public function openArchivePage(){
        $orders = Order::all();
        $goods = array();
            foreach ($orders as $order){
                if($order->id_user==Auth()->user()->id){
                    $array_id = $order->id_goods;
                    $array_qty = $order->qty_goods;
                    $arr_id = explode(',', $array_id);
                    $arr_qty = explode(',', $array_qty);
                        for ($i = 0; $i < count($arr_id); $i++) {
                            $good = Good::find($arr_id[$i]);
                            $good->qty = $arr_qty[$i];
                            $good->id = $order->id;
                            $good->code = $good->price*$good->qty;
                            array_push($goods, $good);
                        }
                }
            }
        return view('archive' , [
            'orders'=>$orders,
            'products'=>$goods,
            'empty'=>$this->goodService->checkNullOfOrder(),
            'res'=>$this->cartService->takeCountOfCart()]);
    }
}
