<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Good;
use Illuminate\Support\Facades\DB;

class GoodsService {


    public function getForPageHome(){
        //set_time_limit(300);
        $goods = $this->getAllOfGoods();
        foreach ($goods as $good) {
            $good->qty=rand(0,2);
        }
        return $goods->unique('brand')->take(24);
    }

    public function getForPageSearch(Request $request){
        $str = $request->search_text;
        if($str==null) {
            return redirect()->back();
        }
        else {
            $mass2 = DB::table('goods')
                ->select('*')
                ->where('name', 'like', "%$str%")->get();
            return $mass2->take(16);
        }
    }

    public function getForPageSortByBrand(Request $request1){
        $brand = $request1->brand;
        $sort = DB::table('goods')
            ->select('*')
            ->where('brand', '=', "$brand")->get();
        return  $sort->take(15);
    }

    public function getAvailability($request){
        $good = Good::find($request->id);
        if ($good->able)
            $good->able = false;
        else
            $good->able = true;
        $good->save();
    }

    public function getAllOfGoods(){
        return Good::all();
    }

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

}
