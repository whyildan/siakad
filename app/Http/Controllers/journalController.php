<?php

namespace App\Http\Controllers;

use App\Exports\JournalExport;
use App\Models\ClassStudent;
use App\Models\ClassSubject;
use App\Models\TeacherJournal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;

class journalController extends Controller
{
    public function journal($id)
    {
        $classSubjectId = Crypt::decryptString($id);
        $classSubject = ClassSubject::with('class', 'subject', 'teacher', 'academicyear')->where('id', $classSubjectId)->first();

        return view('journal.index', compact('classSubject'));
    }

    public function get(Request $request)
    {
        $query = TeacherJournal::with('classSubject.subject', 'classSubject.class', 'classSubject.teacher');

        if ($request->has('class_subject_id')) {
            $query->where('class_subject_id', $request->input('class_subject_id'));
        }

        $journals = $query->paginate($request->input('length'));

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $journals->total(),
            'recordsFiltered' => $journals->total(),
            'data' => $journals->items(),
        ]);
    }

    public function journalGrade($id)
    {
        $classSubjectId = Crypt::decryptString($id);
        $classSubject = ClassSubject::with('class', 'teacher', 'subject', 'academicyear')->findOrFail($classSubjectId);

        return view('journal.grade', compact('classSubject'));
    }

    public function insert(Request $request)
    {
        try {
            TeacherJournal::create([
                'class_subject_id' => $request->class_subject_id,
                'teacher_id' => $request->teacher_id,
                'date' => $request->date,
                'content' => $request->content,
                'meet' => $request->meet,
                'schedule' => $request->schedule,
            ]);

            return response()->json([
                'msg' => 'Data jurnal berhasil ditambahkan',
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Data jurnal gagal ditambahkan',
                'throw' => $th->getMessage()
            ], 400);
        }
    }

    public function destroy($id)
    {
        $journal = TeacherJournal::findOrFail($id);
        $journal->delete();

        return response()->json(['message' => 'Jurnal berhasil dihapus.']);
    }

    public function getAttendance($id)
    {
        $journal = TeacherJournal::with('classSubject')->findOrFail($id);

        $classSubjectId = $journal->classSubject->id;
        $classId = $journal->classSubject->class_id;

        $classStudents = ClassStudent::where('class_id', $classId)->get();

        $attendance = $classStudents->map(function ($classStudent) use ($journal) {
            $student = $classStudent->student;
            $record = $journal->attendances()->where('student_id', $student->id)->first();
            return [
                'student_id' => $student->id,
                'student_name' => $student->user->name,
                'status' => $record ? $record->status : '-',
            ];
        });

        return response()->json([
            'journal_id' => $id,
            'attendance' => $attendance,
        ]);
    }

    public function saveAttendance(Request $request, $id)
    {
        $journal = TeacherJournal::findOrFail($id);
        $attendanceData = $request->input('attendance', []);

        foreach ($attendanceData as $data) {
            $journal->attendances()->updateOrCreate(
                ['student_id' => $data['student_id']],
                ['status' => $data['status']]
            );
        }

        return response()->json(['message' => 'Attendance saved successfully.']);
    }

    public function journalExport($id)
    {
        $classSubjectId = Crypt::decryptString($id);
        $classSubject = ClassSubject::with('class', 'subject', 'teacher', 'academicyear')->where('id', $classSubjectId)->first();

        $filename = 'jurnal_' . $classSubject->teacher->fullname . '_' . $classSubject->subject->name . '_' . str_replace('/', '-', $classSubject->academicyear->year) . time() . '.xlsx';

        return (new JournalExport($classSubjectId))->download($filename);
    }
}
