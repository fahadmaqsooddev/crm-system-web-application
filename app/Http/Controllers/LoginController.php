<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function store(LoginRequest $request){
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('index')->with('msg','Invalid Credentials');
        }
    }
}
