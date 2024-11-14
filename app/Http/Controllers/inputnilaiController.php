<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class inputnilaiController extends Controller
{
    public function datanilai()
    {
        return view('manajemen-nilai.nilai');
    }

    public function tambahnilai()
    {
        return view('manajemen-nilai.tambah-nilai');
    }

    public function editnilai()
    {
        return view('manajemen-nilai.edit-nilai');
    }
}
