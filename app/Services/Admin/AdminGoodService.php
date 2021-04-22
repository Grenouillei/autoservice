<?php

namespace App\Services\Admin;

use App\Models\Cart;
use App\Models\Good;
use App\Models\Favorite;
use App\Interfaces\EditorInterface;
use App\Interfaces\UpdaterInterface;
use Illuminate\Database\Eloquent\Model;

class AdminGoodService implements EditorInterface,UpdaterInterface
{
    /**
     * create new product in goods table
     * @param $req
     */
    public function create($req){
        $good = new Good();
        $good->name = $req->name;
        $good->brand = $req->brand;
        $good->price = $req->price;
        $good->code = $req->code;
        $good->qty = $req->qty;
        $good->able = $req->able;
        $good->save();
    }

    /**
     * change value of product
     * @param $req
     */
    public function update($req){
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
     * @param $req
     * @throws \Exception
     */
    public function delete($req){
        $product = Good::find($req->id);
        $favorites = Favorite::all();
        $carts = Cart::all();
        foreach ($carts as $cart){
            if($cart->id_good==$product->id)
                $cart->delete();
        }
        foreach ($favorites as $favorite){
            if($favorite->id_good==$product->id)
                $favorite->delete();
        }
        $product->delete();
    }

    /**
     * changing available of products
     * @param $request
     */
    public function setAvailability($request){
        $good = Good::find($request->id);
        $good->able = !$good->able;
        $good->save();
    }
}
