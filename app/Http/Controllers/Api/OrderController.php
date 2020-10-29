<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetails;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function today_orders(){
        $data = date('d/m/Y');
        $order = Order::where('order_date',$data)->orderBy('id','DESC')->get();
        return response()->json($order);
    }

    public function order($id){

        $order = Order::findorfail($id);
        return response()->json($order);
    }

    public function order_details($id){

        $details = OrderDetails::join('products','order_details.product_id','products.id')
            ->where('order_details.order_id',$id)
            ->select('products.name','products.code','products.image','order_details.*')
            ->get();
        return response()->json($details);


    }

    public function search_order_date(Request $request){
        $date = $request->date;
        $search_date = new DateTime($date);
        $order_date = $search_date->format('d/m/Y');

        $order = Order::where('order_date',$order_date)->get();

        return response()->json($order);

    }


}
