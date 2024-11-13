<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class siswaController extends Controller
{
    public function datasiswa()
    {
        return view('manajemen-siswa.siswa');
    }

    public function tambahsiswa()
    {
        return view('manajemen-siswa.tambah-siswa', ['hideNavbar' => true]);
    }

    public function editsiswa()
    {
        return view('manajemen-siswa.edit-siswa', ['hideNavbar' => true]);
    }
}
