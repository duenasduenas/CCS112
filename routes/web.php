<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return ['Error' => app()->version()];
});


// Route::get('customer',[CustomerController::class,'createCustomer']);
Route::get('student',function(){
    return 'Student';
});




    
require __DIR__.'/auth.php';
