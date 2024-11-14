<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mapelController extends Controller
{
    public function datamapel()
    {
        return view('manajemen-mapel.mapel');
    }

    public function tambahmapel()
    {
        return view('manajemen-mapel.tambah-mapel', ['hideNavbar' => true]);
    }

    public function editmapel()
    {
        return view('manajemen-mapel.edit-mapel', ['hideNavbar' => true]);
    }
}
