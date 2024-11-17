<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use App\Models\Guru;

class ekskulController extends Controller
{
    public function dataekskul()
    {
        try {
            $ekskuls = Ekstrakurikuler::with('guru')->get();

            return view('manajemen-ekskul.ekskul', compact('ekskuls'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dimuat');
        }
    }

    public function tambahekskul()
    {
        try {
            $gurus = Guru::doesntHave('ekstrakurikuler')->get();

            return view('manajemen-ekskul.tambah-ekskul', ['hideNavbar' => true], compact('gurus'));
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return back()->with('gagal', "Form Gagal Dimuat! {$message} ");
        }
    }

    public function createextra(Request $request)
    {
        $validated = $request->validate([
            'nama_ekstrakurikuler' => 'required|string',
            'guru_id' => 'required|exists:gurus,id'
        ]);

        try {
            Ekstrakurikuler::create($validated);
            return redirect('/extracurricular')->with('sukses', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Ditambahkan');
        }
    }

    public function editekskul($id)
    {
        $ekskul = Ekstrakurikuler::find($id);

        if (!$ekskul) {
            return back()->with('gagal', 'Ekstrakurikuler Tidak Ditemukan');
        }

        $gurus = Guru::all();
        return view('manajemen-ekskul.edit-ekskul', ['hideNavbar' => true], compact('ekskul', 'gurus'));
    }

    public function updateextra(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_ekstrakurikuler' => 'required|string',
            'guru_id' => 'required|exists:gurus,id'
        ]);

        try {
            $ekskul = Ekstrakurikuler::findOrFail($id);
            $ekskul->update($validated);

            return redirect('/extracurricular')->with('sukses', 'Data Berhasil Diedit');
        } catch (\Exception $e) {
            return Back()->with('gagal', "Data Gagal Diedit");
        }
    }

    public function deleteextra($id)
    {
        try {
            Ekstrakurikuler::findOrFail($id);
            Ekstrakurikuler::destroy($id);

            return back()->with('sukses', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dihapus');
        }
    }
}
