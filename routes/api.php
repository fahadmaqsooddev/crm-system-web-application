<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\LeadController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login',[UserController::class,'store'])->name('login');
Route::group(['middleware'=>'auth:sanctum'],function(){
   Route::resource('/leads',LeadController::class);
   Route::get('/logout',[UserController::class,'logout']);
  
});

