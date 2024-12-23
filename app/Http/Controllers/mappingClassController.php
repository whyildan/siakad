<?php

namespace App\Http\Controllers;

use App\Models\ClassStudent;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;

class mappingClassController extends Controller
{
    public function index(Request $request)
    {
        $classes = Classes::with('teacher')->orderBy('class_name')->get();

        return view('mapping-classes.index', compact('classes'));
    }

    public function detailMapping(Request $request, $id)
    {
        $mapClass = Classes::with('teacher')->where('id', $id)->orderBy('class_name')->first();
        $classStudents = ClassStudent::with('student')->where('class_id', $mapClass->id)->get()->sortBy('student.fullname');

        return view('mapping-classes.map', compact('mapClass', 'classStudents'));
    }

    public function getStudentsMap(Request $request)
    {
        $search = $request->input('search');

        $query = Student::query();

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }

        $students = $query->select('id', 'name')->paginate(10);

        return response()->json($students);
    }

    public function insertMapping(Request $request)
    {
        try {
            $count = ClassStudent::where('student_id', $request->student_id)->count();

            if($count == 0){
                ClassStudent::create([
                    'student_id' => $request->student_id,
                    'class_id' => $request->class_id,
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
