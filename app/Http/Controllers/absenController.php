<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class absenController extends Controller
{
    public function dataabsen() 
    {
        return view('manajemen-absen.absen');
    }

    public function tambahabsen()
    {
        return view('manajemen-absen.tambah-absen', ['hideNavbar' => true]);
    }

    public function editabsen()
    {
        return view('manajemen-absen.edit-absen', ['hideNavbar' => true]);
    }
}
