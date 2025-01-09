<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\ClassSubject;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class subjectController extends Controller
{
    /**
     * Convert schedule string to JSON format.
     *
     * @param  string  $schedules
     * @return string
     */
    private function convertScheduleToJson($schedule)
    {
        $days = [];
        $entries = explode(';', $schedule);

        // Map untuk konversi nama hari dari Indonesia ke Inggris
        $dayMap = [
            'Senin' => 'Monday',
            'Selasa' => 'Tuesday',
            'Rabu' => 'Wednesday',
            'Kamis' => 'Thursday',
            'Jumat' => 'Friday',
            'Sabtu' => 'Saturday',
            'Minggu' => 'Sunday'
        ];

        foreach ($entries as $entry) {
            list($day, $times) = explode(',', $entry);
            $day = trim($day);
            list($start_time, $end_time) = explode('-', $times);

            // Konversi nama hari ke bahasa Inggris
            if (isset($dayMap[$day])) {
                $day = $dayMap[$day];
            }

            if (!isset($days[$day])) {
                $days[$day] = [];
            }

            $days[$day][] = [
                'start_time' => trim($start_time),
                'end_time' => trim($end_time)
            ];
        }

        return json_encode($days);
    }

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

    public function mapping(Request $request)
    {
        $classes = Classes::with('advisor', 'academicyear')->orderBy('name')->get();

        return view('mapping-subject.index', compact('classes'));
    }

    public function detailMapping(Request $request, $id)
    {
        $mapClass = Classes::with('advisor', 'academicyear')->where('id', $id)->orderBy('name')->first();
        $classSubjects = ClassSubject::with('subject', 'teacher')->where('class_id', $mapClass->id)->get()->sortBy('subject.name');

        return view('mapping-subject.detail', compact('mapClass', 'classSubjects'));
    }

    public function getSubjects(Request $request)
    {
        $search = $request->input('search');

        $query = Subject::query();

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }

        $subjects = $query->select('id', 'name')->paginate(10);

        return response()->json($subjects);
    }

    public function getTeachers(Request $request)
    {
        $search = $request->input('search');

        $query = Teacher::query();

        if ($search) {
            $query->where('fullname', 'LIKE', "%{$search}%");
        }

        $teachers = $query->select('id', 'fullname')->paginate(10);

        return response()->json($teachers);
    }

    public function insertMapping(Request $request)
    {
        try {
            ClassSubject::create([
                'subject_id' => $request->subject_id,
                'teacher_id' => $request->teacher_id,
                'class_id' => $request->class_id,
                'academic_year_id' => 1,
                'schedule' => $this->convertScheduleToJson($request->schedules),
            ]);

            return response()->json([
                'msg' => 'Data jadwal berhasil ditambahkan',
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Data jadwal gagal ditambahkan',
                'throw' => $th->getMessage()
            ], 400);
        }
    }
}
