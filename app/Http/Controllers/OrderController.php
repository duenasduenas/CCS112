<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function getOrder(){
        $order  = Order::all();
        $data = [
             'status' => 200,
             'order' => $order
        ];
        return response()->json($data,200);
 
     }


     

     public function createOrder(Request $request){
        $validator = Validator::make($request->all(),
        
        [
            'product_id' => 'required|integer|exists:products,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 422,
                'message' => $validator->messages()
            ], 422);
        }
        
        $order = new Order;
        $product = Product::findOrFail($request->product_id);

        $order->product_id = $request->product_id;
        $order->name = $product->name;
        $order->stock = $product->stock;
        $order->details = $request->details;
        $order->price = $product->price;

        $order->save();

        return response()->json([
            'status' => 200,
            'message' => 'Data Uploaded'
        ], 200);
    }

}
