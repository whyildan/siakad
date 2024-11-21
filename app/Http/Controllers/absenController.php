<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\JurnalAbsensi;
use Illuminate\Http\Request;

class absenController extends Controller
{
    public function dataabsen($id)
    {
        try {
            $jurnal = Jurnal::with('mappingmapel.kelas', 'mappingmapel.mapel')->findOrFail($id);

            $absensis = JurnalAbsensi::with('jurnal', 'siswa')->get();
            return view('manajemen-absen.absen', compact('absensis'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dimuat😵');
        }
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
