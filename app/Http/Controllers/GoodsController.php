<?php

namespace App\Http\Controllers;

use App\Models\basket;
use Illuminate\Http\Request;
use App\Models\good;
use App\Models\goods_brand;
use App\Models\goods_remake;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\View;


class GoodsController extends Controller
{
    public $sklad;
    public $temp;
    public $arr = array();

    public function takeBrand()
    {
        $brands = goods_brand::all();
        $goods = good::all();
        foreach ($brands as $elB) {
            foreach ($goods as $elG) {
                if($elG->brand_id==$elB->g_id)
                {
                    $remake = DB::table('goods')
                        ->join('goods_brands', 'g_id', '=', 'goods.brand_id')
                        ->select('goods_brands.name_i', 'goods.price', 'goods.code_i', 'goods.name')
                        ->get();

                }
            }
        }
               foreach ($remake as $item) {
                      DB::table('goods_remakes')
                       ->insert(['name' => $item->name,'brand'=>$item->name_i,
                           'price'=>$item->price,'code' => $item->code_i]);
               }

    }

    public static function getPrice()
    {
        for($i=1;$i<=1000;$i++)
        {
            $random_price = rand(50, 15000);
            DB::table('goods')
                ->where('id', $i)
                ->update(['price' => $random_price]);
        }
    }

    public function getBrand($id)
    {
        $sklad [] = DB::table('goods')
            ->join('goods_brands', 'g_id', '=', 'goods.brand_id')
            ->select('goods_brands.name_i')->distinct()
            ->where('goods_brands.g_id', '=', "$id")->get();
        return ($sklad);
    }

    public function basketheader(){
        $baskets = basket::all();
        $result = 0;
        foreach ($baskets as $el){
            if ($el->user_id==Auth::user()->id){
                $result++;
            }
        }
        $res = count($baskets);
        return ($result);
    }

    public function outPuttOnPageHome(){
       //set_time_limit(300);            ->orderBy('brand','asc')
        $brands = DB::table('goods_remakes')
            ->select('brand','qty')->distinct()
            ->get();
            foreach ($brands as $up)
                {
                    $up->qty=rand(0,2);
                }
        $remakes = goods_remake::all();
            $countOfBasket = $this->basketheader();
        return view('home' , ['parts' => $brands->take(24)])->with('res',$countOfBasket)
            ->with(['product'=>basket::all()]);
    }

    public function openNewBuyPage(){
        $saw = rand(0,500);
        $buy = rand(0,100);
        $like = rand(0,30);
        $countOfBasket = $this->basketheader();
        return view('new' , ['news' => goods_remake::all()])->with('res',$countOfBasket)
            ->with(['product' => basket::all()])->with('saw',$saw)->with('buy',$buy)->with('like',$like);
    }

    public function searchNew(Request $request){
        $str = $request->text;
        $countOfBasket = $this->basketheader();
        //$current = Route::current()->getName();
        if($str==null)
        {
            return redirect()->back();
        }
        else
        {
            $mass2 = DB::table('goods')
                ->where('name', 'like', "%$str%")->get('name')->take(24);
            return view('search', ['array'=>$mass2->take(16)], ['mass' => goods_remake::all()])
                ->with('res',$countOfBasket) ->with(['product'=>basket::all()]);
        }
        //$_GET['text']
    }

    public function SortByBrand(Request $request1){
        $brand = $request1->brand;
        $countOfBasket = $this->basketheader();
         $sort = DB::table('goods_remakes')
                ->select('*')
                ->where('brand', '=', "$brand")->get();

        return view('brands' , ['parts' => $sort->take(15)])
            ->with('res',$countOfBasket)->with(['product'=>basket::all()]);
    }




}
