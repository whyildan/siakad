<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class orangtuaController extends Controller
{
    public function dataorangtua()
    {
        return view('manajemen-orangtua.orangtua');
    }

    public function tambahorangtua()
    {
        return view('manajemen-orangtua.tambah-orangtua', ['hideNavbar' => true]);
    }

    public function editorangtua()
    {
        return view('manajemen-orangtua.edit-orangtua', ['hideNavbar' => true]);
    }
}
