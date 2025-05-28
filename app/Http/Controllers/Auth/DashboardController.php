<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;

class DashboardController extends Controller
{
    public function dashboard(){
        $leads=Lead::countLeads();
        return view('pages.dashboard',compact('leads'));
    }
}
