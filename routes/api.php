<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


// Route::get('/student',function(){
//     return 'Student API';
// });

Route::get('customer',[CustomerController::class,'getCustomer']);
Route::post('customer',[CustomerController::class,'createCustomer']);
Route::put('customer/edit/{id}',[CustomerController::class,'editCustomer']);
Route::delete('customer/edit/{id}',[CustomerController::class,'deleteCustomer']);


Route::get('admin',[AdminController::class,'getProduct']);
Route::post('admin',[AdminController::class,'createProduct']);
Route::put('admin/edit/{id}',[AdminController::class,'editProduct']);
Route::delete('admin/edit/{id}',[AdminController::class,'deleteProduct']);


Route::get('order',[OrderController::class,'getOrder']);
Route::post('order',[OrderController::class,'createOrder']);
