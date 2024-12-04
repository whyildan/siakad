<?php

namespace App\Http\Controllers;

use App\Models\ClassStudent;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class mappingKelasController extends Controller
{
    public function index(Request $request)
    {
        $classes = Kelas::with('guru')->orderBy('nama_kelas')->get();

        return view('mapping-classes.index', compact('classes'));
    }

    public function detailMapping(Request $request, $id)
    {
        $mapClass = Kelas::with('guru')->where('id', $id)->orderBy('nama_kelas')->first();
        $classStudents = ClassStudent::with('student')->where('kelas_id', $mapClass->id)->get()->sortBy('student.fullname');

        return view('mapping-classes.map', compact('mapClass', 'classStudents'));
    }

    public function getStudentsMap(Request $request)
    {
        $search = $request->input('search');

        $query = Siswa::query();

        if ($search) {
            $query->where('nama', 'LIKE', "%{$search}%");
        }

        $students = $query->select('id', 'nama')->paginate(10);

        return response()->json($students);
    }

    public function insertMapping(Request $request)
    {
        try {
            $count = ClassStudent::where('siswa_id', $request->student_id)->count();

            if($count == 0){
                ClassStudent::create([
                    'siswa_id' => $request->student_id,
                    'kelas_id' => $request->class_id,
                ]);
    
                return response()->json([
                    'msg' => 'Data siswa berhasil ditambahkan',
                ], 201);
            }

            return response()->json([
                'msg' => 'Data siswa sudah termaping'
            ], 409);

        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Data siswa gagal ditambahkan',
                'throw' => $th->getMessage()
            ], 400);
        }
    }
}
