<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Classes;

class classController extends Controller
{
    public function datakelas()
    {
        try {
            $kelas = Classes::with('teacher.user')->get();
            return view('class.index', compact('kelas'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Tidak Dapat Dimuat😵');
        }
    }

    public function tambahkelas()
    {
        try {
            $gurus = Teacher::all();
            return view('class.add', ['hideNavbar' => true], compact('gurus'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Form Gagal Dimuat😵');
        }
    }

    public function createclass(Request $request)
    {
        $validated = $request->validate([
            'class_name' => 'required|string',
            'teacher_id' => 'required|exists:teachers,id'
        ]);
        try {
            Classes::create($validated);
            return redirect('/class')->with('sukses', 'Data Berhasil Ditambah🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Ditambah😵');
        }
    }

    public function editkelas($id)
    {
        $kelas = Classes::find($id);

        if (!$kelas) {
            return back()->with('gagal', 'Kelas Tidak Ditemukan😵');
        }

        $gurus = Teacher::all();
        return view('class.update', ['hideNavbar' => true], compact('kelas', 'gurus'));
    }

    public function updateclass(Request $request, $id)
    {
        $validated = $request->validate([
            'class_name' => 'required|string',
            'teacher_id' => 'required|exists:teachers,id'
        ]);

        try {
            $kelas = Classes::findOrFail($id);
            $kelas->update($validated);

            return redirect('/class')->with('sukses', 'Data Berhasil Diedit🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Diedit😵');
        }
    }

    public function deleteclass($id)
    {
        try {
            Classes::findOrFail($id);
            Classes::destroy($id);

            return back()->with('sukses', 'Data Berhasil Dihapus🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dihapus😵');
        }
    }

    public function main()
    {
        $role = auth()->user()->role;
        $classes = null;

        if ($role == 'teacher') {
            $classes = ClassSubject::with('class', 'subject', 'teacher')->where('academic_year_id', 1)->where('teacher_id', auth()->user()->teacher->id)->get();
        } else if ($role == 'student') {
            $classes = ClassSubject::with('class', 'subject', 'teacher')->where('academic_year_id', 1)->where('class_id', auth()->user()->student->studentClass->class_id)->get();
        }

        return view('class.main', compact('classes', 'role'));
    }
}
