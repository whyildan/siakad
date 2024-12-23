<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use Illuminate\Http\Request;
use App\Models\Teacher;

class extraController extends Controller
{
    public function dataekskul()
    {
        try {
            $ekskuls = Extracurricular::with('teacher')->get();

            return view('extracurricular.index', compact('ekskuls'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dimuat😵');
        }
    }

    public function tambahekskul()
    {
        try {
            $gurus = Teacher::doesntHave('extracurricular')->get();

            return view('extracurricular.add', ['hideNavbar' => true], compact('gurus'));
        } catch (\Exception $e) {
            return back()->with('gagal', "Form Gagal Dimuat😵");
        }
    }

    public function createextra(Request $request)
    {
        $validated = $request->validate([
            'extracurricular_name' => 'required|string',
            'teacher_id' => 'required|exists:teachers,id'
        ]);

        try {
            Extracurricular::create($validated);
            return redirect('/extracurricular')->with('sukses', 'Data Berhasil Ditambahkan🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Ditambahkan😵');
        }
    }

    public function editekskul($id)
    {
        $ekskul = Extracurricular::find($id);

        if (!$ekskul) {
            return back()->with('gagal', 'Ekstrakurikuler Tidak Ditemukan😵');
        }

        $gurus = Teacher::all();
        return view('extracurricular.update', ['hideNavbar' => true], compact('ekskul', 'gurus'));
    }

    public function updateextra(Request $request, $id)
    {
        $validated = $request->validate([
            'extracurricular_name' => 'required|string',
            'teacher_id' => 'required|exists:teachers,id'
        ]);

        try {
            $ekskul = Extracurricular::findOrFail($id);
            $ekskul->update($validated);

            return redirect('/extracurricular')->with('sukses', 'Data Berhasil Diedit🥳');
        } catch (\Exception $e) {
            return Back()->with('gagal', "Data Gagal Diedit😵");
        }
    }

    public function deleteextra($id)
    {
        try {
            Extracurricular::findOrFail($id);
            Extracurricular::destroy($id);

            return back()->with('sukses', 'Data Berhasil Dihapus🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dihapus😵');
        }
    }
}
