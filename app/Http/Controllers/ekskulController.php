<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ekskulController extends Controller
{
    public function dataekskul()
    {
        return view('manajemen-ekskul.ekskul');
    }

    public function tambahekskul()
    {
        return view('manajemen-ekskul.tambah-ekskul', ['hideNavbar' => true]);
    }

    public function editekskul()
    {
        return view('manajemen-ekskul.edit-ekskul', ['hideNavbar' => true]);
    }
}
