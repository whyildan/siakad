<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }
}
