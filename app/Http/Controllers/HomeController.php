<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\User;

class HomeController extends Controller
{
    public function index() {
        if(Auth::check()) {
            $user = Auth::user();
            if( ($user->role)==1)
                return redirect()->route('home');
            else
                return redirect()->route('dashboard.main');
        }
        else 
            return redirect()->route('home');
    }
}
