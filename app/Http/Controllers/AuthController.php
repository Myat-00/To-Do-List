<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //direct login page
    public function loginPage() {
    return view('login');
    }

    //direct register page
    public function registerPage() 
    {
        return view('register');
    }

    // public function dashboard()
    // {
    //     // if(auth()::check())
    //     // {
    //     //     return view('home');
    //     // }else{
    //     //     return redirect()->route('auth#loginPage');
    //     // }
    // }
        
}

