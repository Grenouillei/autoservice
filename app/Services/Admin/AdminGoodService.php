<?php

namespace App\Services\Admin;

use App\Models\Cart;
use App\Models\Good;
use Illuminate\Database\Eloquent\Model;

class AdminGoodService
{
    /**
     * changing available of products
     * @param $request
     */
    public function setAvailability($request){
        $good = Good::find($request->id);
        $good->able = !$good->able;
        $good->save();
    }

    /**
     * create new product in goods table
     * @param $request
     */
    public function createProduct($request){
        $good = new Good();
        $good->name = $request->name;
        $good->brand = $request->brand;
        $good->price = $request->price;
        $good->code = $request->code;
        $good->qty = $request->qty;
        $good->able = $request->able;
        $good->save();
    }

    /**
     * change value of product
     * @param $req
     */
    public function updateProduct($req){
        $product = Good::find($req->id);
        $product->name = $req->name;
        $product->brand = $req->brand;
        $product->code = $req->code;
        $product->price = $req->price;
        $product->qty = $req->qty;
        $product->able = $req->able;
        $product->save();
    }

    /**
     * delete product
     * @param $request
     * @throws \Exception
     */
    public function deleteProduct($request){
        $product = Good::find($request->id);
        $carts = Cart::all();
        foreach ($carts as $cart) {
            if($cart->id_good==$product->id){
                $cart->delete();
            }
        }
        $product->delete();
    }

}
