<?php

use App\Http\Controllers\CustomerApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/customer',[CustomerApiController::class,'index']);
Route::post('/customer',[CustomerApiController::class,'store']);
Route::post('/customer/login',[CustomerApiController::class,'login']);
// Route::apiResource('/customer',CustomerApiController::class);