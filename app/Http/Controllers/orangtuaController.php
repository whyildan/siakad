<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use Illuminate\Http\Request;
use App\Models\Siswa;

class orangtuaController extends Controller
{
    public function dataorangtua()
    {
        try {
            $orangtuas = OrangTua::with('siswa')->get();
            return view('manajemen-orangtua.orangtua', compact('orangtuas'));
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return back()->with('gagal', "Data Gagal Dimuat, {$message}");
        }
    }

    public function tambahorangtua()
    {
        try {
            $siswas = Siswa::all();
            return view('manajemen-orangtua.tambah-orangtua', ['hideNavbar' => true], compact('siswas'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Form Gagal Dimuat');
        }
    }

    public function createparent(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'telepon' => 'required|string|max:13|regex:/^[0-9]+$/',
            'alamat' => 'required|string',
            'siswa_id' => 'required|exists:siswas,id'
        ]);

        try {
            OrangTua::create($validated);
            return redirect('/parent')->with('sukses', 'Data Berhasil Ditambah!');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Ditambah!');
        }
    }

    public function editorangtua()
    {
        return view('manajemen-orangtua.edit-orangtua', ['hideNavbar' => true]);
    }
}
