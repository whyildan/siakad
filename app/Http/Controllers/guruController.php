<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use Illuminate\Http\Request;

class guruController extends Controller
{
    public function dataguru()
    {
        try {

            $gurus = Guru::with('mapel')->get();
            return view('manajemen-guru.guru', compact('gurus'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dimuat😵');
        }
    }

    public function tambahguru()
    {
        try {
            $mapels = Mapel::all();
            return view('manajemen-guru.tambah-guru', ['hideNavbar' => true], compact('mapels'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Form Gagal Dimuat😵');
        }
    }

    public function createteacher(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'mapel_id' => 'required|exists:mapels,id',
            'telepon' => 'required|string|max:13|regex:/^[0-9]+$/',
            'alamat' => 'required|string'
        ]);

        try {
            Guru::create($validated);
            return redirect('/teacher')->with('sukses', 'Data Berhasil Ditambah🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Ditambah😵');
        }
    }

    public function editguru($id)
    {
        $guru = Guru::find($id);

        if (!$guru) {
            return back()->with('gagal', 'Guru Tidak Ditemukan😵');
        }

        $mapels = Mapel::all();
        return view('manajemen-guru.edit-guru', ['hideNavbar' => true], compact('mapels', 'guru'));
    }

    public function updateteacher(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'mapel_id' => 'required|exists:mapels,id',
            'telepon' => 'required|string|max:13|regex:/^[0-9]+$/',
            'alamat' => 'required|string'
        ]);

        try {
            $guru = Guru::findOrFail($id);
            $guru->update($validated);

            return redirect('/teacher')->with('sukses', 'Data Sukses Diedit🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Diedit😵');
        }
    }

    public function hapusguru($id)
    {
        try {
            Guru::findOrFail($id);
            Guru::destroy($id);

            return back()->with('sukses', 'Data Berhasil Dihapus🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dihapus😵');
        }
    }
}
