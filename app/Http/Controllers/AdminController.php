<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{   
    public function getProduct(){
        $product  = Product::all();
        $data = [
             'status' => 200,
             'product' => $product
        ];
        return response()->json($data,200);
 
     }

    public function createProduct(Request $request){
        $validator = Validator::make($request->all(),
        
        [
            'name' => 'required',
            'stock' => 'required',
            'image' => 'required',
            'price' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 422,
                'message' => $validator->messages()
            ], 422);
        }
        
        $product = new Product;

        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->image = $request->image;
        $product->price = $request->price;

        $product->save();

        return response()->json([
            'status' => 200,
            'message' => 'Data Uploaded'
        ], 200);
    }


    public function editProduct(Request $request,$id){
        $validator = Validator::make($request->all(),
        
        [
            'name' => 'required',
            'stock' => 'required',
            'image' => 'required',
            'price' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 422,
                'message' => $validator->messages()
            ], 422);
        }

        else{
            $product = Product::find($id);

            $product->name = $request->name;
            $product->stock = $request->stock;
            $product->image = $request->image;
            $product->price = $request->price;
            

            $product->save();

            return response()->json([
                'status' => 200,
                'message' => 'Data Updated'
            ], 200);

        }
        
    }


    public function deleteProduct($id){
        {
            $product=Product::find($id);

            if (!$product) {
                return response()->json(['message'=>'Item Not Found'],404);
            }

            $isInOrder = Order::where('product_id', $id)->exists();

            if ($isInOrder) {
                return response()->json(['message'=>'Item cannot be deleted as it is part of an ordered list'],404);
            }


            $product->delete();

            $data=[
                'status'=>200,
                'message'=>"Data Deleted"
            ];

            return response()->json($data, 200);
        }
    }
}
