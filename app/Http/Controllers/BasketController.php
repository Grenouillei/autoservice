<?php

namespace App\Http\Controllers;

use App\Models\goods_remake;
use App\Services\BasketService;
use App\Services\GoodsService;
use Illuminate\Http\Request;
use App\Models\basket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class BasketController extends Controller
{
    public function __construct(BasketService $basketService,GoodsService $goodsService,basket $basket){
        $this->basket = $basket;
        $this->basketService = $basketService;
        $this->goodService = $goodsService;
    }

    public function openBasketPage(){
        return view('basket', [
            'res'=>$this->basketService->takeCountOfBasket(),
            'product'=>$this->basketService->takeAllOfBasket()
            ]);
    }

    public function deleteElementFromBasket(Request $request){
        $deleteEl = $request->id;
        DB::table('baskets')->where('id_s', '=', $deleteEl)->delete();
        return redirect()->route('basket');
    }

    public function addElementToBasket(Request $request)
    {
        $user_id = Auth::user()->id;
        $basket = basket::all();
        $id = $request->id;
        $taked = DB::table('goods_remakes')
            ->select('name','code','price','brand','id')
            ->where('id', '=', "$id")->get();

        foreach ($taked as $element) {
            foreach ($basket as $baskets) {
                if($id==$baskets->id_s&&$baskets->user_id==Auth::user()->id) {
                    //$prev = url()->previous();
                    return redirect()->back();
                }
            }
            try{
                DB::table('baskets')
                    ->insert(['id_s'=>$id,'name' => $element->name, 'code' => $element->code,
                        'price'=>$element->price,'brand'=>$element->brand, 'qty'=>1,'user_id'=>$user_id]);
                print ('success append');
                return redirect()->back();
            }
            catch(\Illuminate\Database\QueryException $e) {
                print ('success append');//$e->getMessage();
                return redirect()->back();
            }
        }
    }
}
