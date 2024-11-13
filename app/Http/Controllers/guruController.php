<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class guruController extends Controller
{
    public function dataguru()
    {
        return view('manajemen-guru.guru');
    }

    public function tambahguru()
    {
        return view('manajemen-guru.tambah-guru', ['hideNavbar' => true]);
    }

    public function editguru()
    {
        return view('manajemen-guru.edit-guru', ['hideNavbar' => true]);
    }
}
