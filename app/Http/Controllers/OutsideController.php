<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutsideController extends Controller
{
    public function login(){
        return view('outside.login');
    }

    public function register(){
        return view('outside.register');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
