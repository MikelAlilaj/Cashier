<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
use App\OrderDetails;
use App\OrderProduct;
use App\Pos;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function get_product($id){

        $product = Product::where('category_id',$id)->get();
        return response()->json($product);
    }


    public function order_done(Request $request){

        $data = array();
        $data['qty'] = $request->qty;
        $data['sub_total'] = $request->subtotal;
        $data['order_date'] = date('d/m/Y');
        $data['order_month'] = date('F');
        $data['order_year'] = date('Y');
        $order_id = Order::insertGetId($data);

        $contents = Pos::all();

        $odata = array();
        foreach ($contents as $content) {
            $odata['order_id'] = $order_id;
            $odata['product_id'] = $content->product_id;
            $odata['product_quantity'] = $content->product_quantity;
            $odata['product_price'] = $content->product_price;
            $odata['sub_total'] = $content->sub_total;
            OrderDetails::insert($odata);


            Product::where('id',$content->product_id)
                ->update(['quantity' => DB::raw('quantity -' .$content->product_quantity)]);

        }
        DB::table('pos')->delete();
        return response('Done');

    }


}
