<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class parentController extends Controller
{
    public function index()
    {
        try{
            $parents = User::where('role', 'parent')->with('students')->get();
            return view('parent.index', compact('parents'));

        }catch(\Exception $e){
            $msg = $e->getMessage();
            return back()->with('gagal', `Data Gagal Dimuat {$msg}`);
        }
    }
}
