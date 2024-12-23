<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class subjectController extends Controller
{
    public function datamapel()
    {
        try {
            $mapels = Subject::all();

            return view('subject.index', compact('mapels'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dimuat😵');
        }
    }

    public function tambahmapel()
    {
        return view('subject.add', ['hideNavbar' => true]);
    }

    public function storesubject(Request $request)
    {
        $validated = $request->validate([
            'subject_name' => 'required|string|max:50'
        ]);

        try {
            Subject::create([
                'subject_name' => $validated['subject_name']
            ]);

            return redirect('/subject')->with('sukses', "Data Berhasil Ditambahkan🥳");
        } catch (\Exception $e) {
            return redirect("/addsubject")->with('gagal', "Data Gagal Ditambahkan😵");
        }
    }

    public function editmapel($id)
    {
        $mapel = Subject::find($id);

        if (!$mapel) {
            return back()->with('gagal', 'Mapel Tidak Ditemukan😵');
        }

        return view('subject.update', ['hideNavbar' => true], compact('mapel'));
    }

    public function updatesubject(Request $request, $id)
    {
        $validated = $request->validate([
            'subject_name' => 'required|string|max:50'
        ]);

        $mapel = Subject::findOrFail($id);

        try {
            $mapel->update([
                'subject_name' => $validated['subject_name']
            ]);

            return redirect('/subject')->with('sukses', "Data Berhasil Diedit🥳");
        } catch (\Exception $e) {
            return redirect("/editsubject/$mapel->id")->with('gagal', "Data Gagal Diedit😵");
        }
    }

    public function hapusmapel($id)
    {
        try {
            Subject::findOrFail($id);
            Subject::destroy($id);

            return redirect()->back()->with('sukses', "Data Berhasil Dihapus🥳");
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', "Data Gagal Dihapus😵");
        }
    }
}
