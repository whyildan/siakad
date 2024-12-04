<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function main()
    {
        if(auth()){
            return redirect('/dashboard');
        }

        return redirect('/login');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            session()->flash('login_success', true);

            return redirect()->intended('/dashboard');
        }

        return back()->with('login_error', true);
    }
    
    public function register()
    {
        return view('auth.register');
    }

    public function logout()
    {
        Auth::logout();

        session()->flash('logout_success', true);

        return redirect('/login');
    }
}
