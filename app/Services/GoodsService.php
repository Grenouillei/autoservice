<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Good;
use Illuminate\Support\Facades\DB;

class GoodsService
{
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
    public function getForPageBrand(Request $request1){
        $brand = $request1->brand;
        $sort = DB::table('goods')
                ->select('*')
                ->where('brand', '=', "$brand")->get();
        return  $sort->take(15);
    }
}
