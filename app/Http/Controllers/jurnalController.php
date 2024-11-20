<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Illuminate\Http\Request;
use App\Models\MappingMapel;

class jurnalController extends Controller
{
    public function datajurnal()
    {
        try {
            $journals = Jurnal::with('mappingmapel.kelas', 'mappingmapel.mapel')->get();

            return view('manajemen-jurnal.jurnal', compact('journals'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dimuat😵');
        }
    }

    public function tambahjurnal()
    {
        try {
            $mappings = MappingMapel::with('kelas', 'mapel')->get();

            return view('manajemen-jurnal.tambah-jurnal', ['hideNavbar' => true], compact('mappings'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Form Gagal Dimuat😵');
        }
    }

    public function createjournal(Request $request)
    {
        $validated = $request->validate([
            'mapping_mapel_id' => 'required|exists:mapping_mapels,id',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string'
        ]);

        try {
            Jurnal::create($validated);
            return redirect('/journal')->with('sukses', 'Data Berhasil Ditambah🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Ditambah😵');
        }
    }

    public function editjurnal($id)
    {
        $jurnal = Jurnal::with('mappingmapel.kelas', 'mappingmapel.mapel')->findOrFail($id);
        $mappings = MappingMapel::with('kelas', 'mapel')->get();
        return view('manajemen-jurnal.edit-jurnal', ['hideNavbar' => true], compact('mappings', 'jurnal'));
    }

    public function updatejournal(Request $request, $id)
    {
        $validated = $request->validate([
            'mapping_mapel_id' => 'required|exists:mapping_mapels,id',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string'
        ]);

        try {
            $jurnal = Jurnal::findOrFail($id);
            $jurnal->update($validated);
            return redirect('/journal')->with('sukses', 'Data Berhasil Diedit🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Diedit😵');
        }
    }

    public function deletejournal($id)
    {
        try {
            Jurnal::findOrFail($id);
            Jurnal::destroy($id);

            return back()->with('sukses', 'Data Berhasil Dihapus🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dihapus😵');
        }
    }
}