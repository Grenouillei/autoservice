<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Good;

class OrderService
{
    /**
     * return all orders certain user
     * @return array
     */
    public function getForPageOrder(){
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
        return $goods;
    }

    /**
     * forming an order with manipulations
     * with the quantity of products
     * @param  $reg
     * @throws \Exception
     */
    public function createOrder($reg){
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
