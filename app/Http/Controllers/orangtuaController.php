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
            return back()->with('gagal', "Data Gagal Dimuat😵");
        }
    }

    public function tambahorangtua()
    {
        try {
            $siswas = Siswa::all();
            return view('manajemen-orangtua.tambah-orangtua', ['hideNavbar' => true], compact('siswas'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Form Gagal Dimuat😵');
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
            return redirect('/parent')->with('sukses', 'Data Berhasil Ditambah🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Ditambah😵');
        }
    }

    public function editorangtua($id)
    {
        $orangtua = OrangTua::find($id);

        if (!$orangtua) {
            return back()->with('gagal', 'Orang Tua Tidak Ditemukan😵');
        }

        $siswas = Siswa::all();
        return view('manajemen-orangtua.edit-orangtua', ['hideNavbar' => true], compact('siswas', 'orangtua'));
    }

    public function updateparent(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'telepon' => 'required|string|max:13|regex:/^[0-9]+$/',
            'alamat' => 'required|string',
            'siswa_id' => 'required|exists:siswas,id'
        ]);

        try {
            $orangtua = OrangTua::findOrFail($id);
            $orangtua->update($validated);

            return redirect('/parent')->with('sukses', 'Data Berhasil Diedit🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Diedit😵');
        }
    }

    public function deleteparent($id)
    {
        try {
            OrangTua::findOrFail($id);
            OrangTua::destroy($id);

            return back()->with('sukses', 'Data Berhasil Dihapus🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dihapus😵');
        }
    }
}
