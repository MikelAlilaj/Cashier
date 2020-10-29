<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
use App\OrderProduct;
use App\Pos;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{


    public function add_to_cart(Request $request, $id){

        $product = Product::findorfail($id);

        $check = Pos::where('product_id',$id)->first();

        if ($check) {
            Pos::where('product_id',$id)->increment('product_quantity');

            $product = Pos::where('product_id',$id)->first();
            $subtotal = $product->product_quantity * $product->product_price;

            Pos::where('product_id', $id)->update(['sub_total' => $subtotal]);

        }else{
            $data = array();
            $data['product_id'] = $id;
            $data['product_name'] = $product->name;
            $data['product_quantity'] = 1;
            $data['product_price'] = $product->selling_price;
            $data['sub_total'] = $product->selling_price;

            Pos::insert($data);
        }

    }

    public function product_cart(){
        $cart =  Pos::all();
        return response()->json($cart);
    }

    public function remove_product_cart($id){
        Pos::findorfail($id)->delete();
        return response('Done');

    }

    public function increment($id){
        Pos::findorfail($id)->increment('product_quantity');

        $product = Pos::findorfail($id);
        $subtotal = $product->product_quantity * $product->product_price;
        Pos::where('id',$id)->update(['sub_total'=> $subtotal]);
        return response('Done');
    }


    public function decrement($id){
        Pos::findorfail($id)->decrement('product_quantity');

        $product = Pos::findorfail($id);
        $subtotal = $product->product_quantity * $product->product_price;
        Pos::where('id',$id)->update(['sub_total'=> $subtotal]);
        return response('Done');
    }


}
