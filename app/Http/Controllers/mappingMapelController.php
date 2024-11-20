<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\MappingMapel;

class mappingMapelController extends Controller
{
    public function mappingmapel()
    {
        try {
            $mappings = MappingMapel::with('kelas', 'mapel')->get();

            return view('manajemen-mapping-mapel.mapping-mapel', compact('mappings'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dimuat😵');
        }
    }

    public function tambahmapping()
    {
        try {
            $kelas = Kelas::all();
            $mapels = Mapel::all();

            return view('manajemen-mapping-mapel.tambah-mapping-mapel', ['hideNavbar' => true], compact('kelas', 'mapels'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Form Gagal Dimuat😵');
        }
    }

    public function createmapping(Request $request)
    {
        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id'
        ]);

        try {
            MappingMapel::create($validated);
            return redirect('/mapping/subject')->with('sukses', 'Data Berhasil Ditambah🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Ditambah😵');
        }
    }

    public function editmapping($id)
    {
        $mapping = MappingMapel::find($id);

        if (!$mapping) {
            return back()->with('gagal', 'Mapping Mapel Tidak Ditemukan😵');
        }

        $kelas = Kelas::all();
        $mapels = Mapel::all();
        return view('manajemen-mapping-mapel.edit-mapping-mapel', ['hideNavbar' => true], compact('mapping', 'kelas', 'mapels'));
    }

    public function updatemapping(Request $request, $id)
    {
        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id'
        ]);

        try {
            $mapping = MappingMapel::findOrFail($id);
            $mapping->update($validated);

            return redirect('/mapping/subject')->with('sukses', 'Data Berhasil Diedit🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Diedit😵');
        }
    }

    public function deletemapping($id)
    {
        try {
            MappingMapel::findOrFail($id);
            MappingMapel::destroy($id);

            return back()->with('sukses', 'Data Berhasil Dihapus🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dihapus😵');
        }
    }
}
