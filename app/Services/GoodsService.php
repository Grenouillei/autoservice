<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Good;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GoodsService {

    /**
     * return all goods
     * @return mixed
     */
    public function getAllOfGoods(){
        return Good::all();
    }

    /**
     * return unique value of brands from goods table for home page
     * @return mixed
     */
    public function getForPageHome(){
        $goods = $this->getAllOfGoods();
        foreach ($goods as $good) {
            $good->qty=rand(0,2);
        }
        return $goods->unique('brand')->take(24);
    }

    /**
     * search by name in goods table with Query builder
     * @param Request $request
     * @return mixed
     */
    public function getForPageSearch(Request $request){
        $str = $request->search_text;
        if($str==null){
            return redirect()->back();
        } else {
            return DB::table('goods')
                    ->select('*')
                    ->where('name', 'like', "%$str%")
                    ->paginate(16);
        }
    }

    /**
     * search by brand in goods table with Query builder
     * @param Request $request1
     * @return mixed
     */
    public function getForPageSortByBrand(Request $request1){
        $brand = $request1->brand;
        $sort = DB::table('goods')
                ->select('*')
                ->where('brand', '=', "$brand")->get();
        return  $sort->take(15);
    }

    /**
     * changing available of products
     * @param $request
     */
    public function getAvailability($request){
        $good = Good::find($request->id);
        if ($good->able)
            $good->able = false;
        else
            $good->able = true;
        $good->save();
    }

    /**
     * create new product in goods table
     * @param $request
     */
    public function setNewProduct($request){
        $good = new Good();
        $good->name = $request->name;
        $good->brand = $request->brand;
        $good->price = $request->price;
        $good->code = $request->code;
        $good->qty = $request->qty;
        $good->able = $request->able;
        $good->save();
    }

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
     * checking if empty order table certain user
     * @return boolean
     */
    public function checkNullOfOrder(){
        $orders = Order::all();
        foreach ($orders as $item) {
            if($item->id_user==Auth::user()->id)
                return true;
        }
        return false;
    }
}
