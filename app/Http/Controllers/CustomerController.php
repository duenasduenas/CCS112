<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
class CustomerController extends Controller
{
    public function getCustomer(){
       $customer = Customer::all();
       $data = [
            'status' => 200,
            'customer' => $customer
       ];
       return response()->json($data,200);

    }

    public function createCustomer(Request $request){
        $validator = Validator::make($request->all(),
        
        [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 422,
                'message' => $validator->messages()
            ], 422);
        }
        
        $customer = new Customer;

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);

        $customer->save();

        return response()->json([
            'status' => 200,
            'message' => 'Data Uploaded'
        ], 200);
    }

    public function editCustomer(Request $request,$id){
        $validator = Validator::make($request->all(),
        
        [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 422,
                'message' => $validator->messages()
            ], 422);
        }

        else{
            $customer = Customer::find($id);

            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->password = bcrypt($request->password);

            $customer->save();

            return response()->json([
                'status' => 200,
                'message' => 'Data Updated'
            ], 200);

        }
        
    }

    public function deleteCustomer($id){
        {
            $customer=Customer::find($id);
            $customer->delete();

            $data=[
                'status'=>200,
                'message'=>"Data Deleted"
            ];

            return response()->json($data, 200);
        }
    }

}
