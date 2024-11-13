<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kelasController extends Controller
{
    public function datakelas()
    {
        return view('manajemen-kelas.kelas');
    }

    public function tambahkelas()
    {
        return view('manajemen-kelas.tambah-kelas', ['hideNavbar' => true]);
    }

    public function editkelas() 
    {
        return view('manajemen-kelas.edit-kelas', ['hideNavbar' => true]);
    }
}
