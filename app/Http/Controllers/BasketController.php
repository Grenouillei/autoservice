<?php

namespace App\Http\Controllers;

use App\Models\goods_remake;
use Illuminate\Http\Request;
use App\Models\good;
use App\Models\goods_brand;
use App\Models\basket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class BasketController extends Controller
{
    public function basketOpen()
    {
        $countOfBasket = $this->basketheader();
        $product = basket::all();
        return view('basket', ['product' => $product])->with('res',$countOfBasket);
    }

    public function delElBasket(Request $request)
    {
        $deleteEl = $request->id;
        DB::table('baskets')->where('id_s', '=', $deleteEl)->delete();
        return redirect()->route('basket');
    }

    public function addToBasket(Request $request)
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

}
