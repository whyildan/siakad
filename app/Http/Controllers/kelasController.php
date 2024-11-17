<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Kelas;

class kelasController extends Controller
{
    public function datakelas()
    {
        try {
            $kelas = Kelas::with('guru')->get();
            return view('manajemen-kelas.kelas', compact('kelas'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Tidak Dapat Dimuat');
        }
    }

    public function tambahkelas()
    {
        try {
            $gurus = Guru::all();
            return view('manajemen-kelas.tambah-kelas', ['hideNavbar' => true], compact('gurus'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Form Gagal Dimuat');
        }
    }

    public function createclass(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string',
            'guru_id' => 'required|exists:gurus,id'
        ]);
        try {
            Kelas::create($validated);
            return redirect('/class')->with('sukses', 'Data Berhasil Ditambah');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Diubah');
        }
    }

    public function editkelas($id)
    {
        $kelas = Kelas::find($id);

        if (!$kelas) {
            return back()->with('gagal', 'Kelas Tidak Ditemukan');
        }

        $gurus = Guru::all();
        return view('manajemen-kelas.edit-kelas', ['hideNavbar' => true], compact('kelas', 'gurus'));
    }

    public function updateclass(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string',
            'guru_id' => 'required|exists:gurus,id'
        ]);

        try {
            $kelas = Kelas::findOrFail($id);
            $kelas->update($validated);

            return redirect('/class')->with('sukses', 'Data Berhasil Diedit');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Diedit');
        }
    }

    public function deleteclass($id)
    {
        try {
            Kelas::findOrFail($id);
            Kelas::destroy($id);

            return back()->with('sukses', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dihapus');
        }
    }
}
