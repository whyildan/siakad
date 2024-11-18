<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class mapelController extends Controller
{
    public function datamapel()
    {
        try {
            $mapels = Mapel::all();

            return view('manajemen-mapel.mapel', compact('mapels'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dimuat😵');
        }
    }

    public function tambahmapel()
    {
        return view('manajemen-mapel.tambah-mapel', ['hideNavbar' => true]);
    }

    public function storesubject(Request $request)
    {
        $validated = $request->validate([
            'nama_mapel' => 'required|string|max:50'
        ]);

        try {
            Mapel::create([
                'nama_mapel' => $validated['nama_mapel']
            ]);

            return redirect('/subject')->with('sukses', "Data Berhasil Ditambahkan🥳");
        } catch (\Exception $e) {
            return redirect("/addsubject")->with('gagal', "Data Gagal Ditambahkan😵");
        }
    }

    public function editmapel($id)
    {
        $mapel = Mapel::find($id);

        if (!$mapel) {
            return back()->with('gagal', 'Mapel Tidak Ditemukan😵');
        }

        return view('manajemen-mapel.edit-mapel', ['hideNavbar' => true], compact('mapel'));
    }

    public function updatesubject(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_mapel' => 'required|string|max:50'
        ]);

        $mapel = Mapel::findOrFail($id);

        try {
            $mapel->update([
                'nama_mapel' => $validated['nama_mapel']
            ]);

            return redirect('/subject')->with('sukses', "Data Berhasil Diedit🥳");
        } catch (\Exception $e) {
            return redirect("/editsubject/$mapel->id")->with('gagal', "Data Gagal Diedit😵");
        }
    }

    public function hapusmapel($id)
    {
        try {
            Mapel::findOrFail($id);
            Mapel::destroy($id);

            return redirect()->back()->with('sukses', "Data Berhasil Dihapus🥳");
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', "Data Gagal Dihapus😵");
        }
    }
}
