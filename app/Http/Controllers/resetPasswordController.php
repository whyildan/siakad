<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class resetPasswordController extends Controller
{
    public function resetpassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT 
                    ? back()->with(['status' => __($status)]) 
                    : back()->with(['email' => __($status)]);
    }


}
