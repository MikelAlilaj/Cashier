<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function sales_today(){
        $date = date('d/m/Y');
        $sales = Order::where('order_date',$date)->sum('sub_total');
        return response()->json($sales);
    }

    public function sales_this_month(){
        $month = date('F');
        $sales = Order::where('order_month',$month)->sum('sub_total');
        return response()->json($sales);
    }

    public function sales_this_year(){
        $year = date('Y');
        $sales = Order::where('order_year',$year)->sum('sub_total');
        return response()->json($sales);
    }

    public function all_sales(){
        $sales = Order::sum('sub_total');
        return response()->json($sales);
    }

    public function stockout(){
        $product = Product::where('quantity','<','1')->get();
        return response()->json($product);

    }
}
