<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class authController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function forgotpass()
    {
        return view('auth.forgot-password');
    }

    public function register() 
    {
        return view('auth.register');
    }
}
