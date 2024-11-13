<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class jurnalController extends Controller
{
    public function datajurnal()
    {
        return view('manajemen-jurnal.jurnal');
    }

    public function tambahjurnal() 
    {
        return view('manajemen-jurnal.tambah-jurnal', ['hideNavbar' => true]);
    }
    public function editjurnal() 
    {
        return view('manajemen-jurnal.edit-jurnal', ['hideNavbar' => true]);
    }
}
