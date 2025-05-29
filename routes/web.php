<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\LeadController;
use App\Http\Middleware\Checklogin;
use App\Mail\LeadAssignedMail;
use App\Notifications\LeadAssigned;
use Illuminate\Support\Facades\Notification;

use App\Models\Lead;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])
    ->middleware(Checklogin::class)
    ->name('index');

Route::post('/login',[LoginController::class,'store'])->name('login');

Route::group(['middleware'=>'auth'],function(){
    Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
    Route::get('logout',[LogoutController::class,'logout'])->name('logout');
    Route::resource('leads',LeadController::class);
    
});

