<?php

namespace App\Http\Controllers;

use App\Models\StudentGrade;
use Illuminate\Http\Request;
use App\Models\ClassSubject;
use App\Models\Student;
use Illuminate\Support\Facades\Crypt;

class gradeController extends Controller
{
    private function convertGradesArray($request)
    {
        $studentIds = json_decode($request->studentIds);
        $classSubjectId = $request->classSubjectId;
        $semester = $request->semester;
        $category = $request->type;
        $studentGrades = [];

        foreach ($studentIds as $studentId) {
            $key = $studentId . '-grades';

            $studentGrades[] = [
                'class_subject_id' => $classSubjectId,
                'student_id' => $studentId,
                'semester' => $semester,
                'category' => $category,
                'grade' => json_encode($request[$key])
            ];
        }

        return $studentGrades;
    }

    private function studentGrades($classSubjectId, $classId, $semester, $category)
    {
        $students = Student::join('class_students', 'students.id', '=', 'class_students.student_id')
            ->where('class_students.class_id', $classId)
            ->select('students.id as student_id', 'students.fullname as student_name')
            ->get();

        $grades = [];

        foreach ($students as $student) {
            $grade = StudentGrade::where('category', $category)
                ->where('semester', $semester)
                ->where('student_id', $student->student_id)
                ->where('class_subject_id', $classSubjectId)->first();

            if ($category != 'summative') {
                $grades[] = (object) [
                    'class_subject_id' => $classSubjectId,
                    'student_id' => $student->student_id,
                    'name' => $student->student_name,
                    'grades' => $grade != null ? json_decode($grade->grade) : [null, null, null, null, null, null],
                ];
            } else {
                $grades[] = (object) [
                    'class_subject_id' => $classSubjectId,
                    'student_id' => $student->student_id,
                    'name' => $student->student_name,
                    'grades' => $grade != null ? json_decode($grade->grade) : [null, null],
                ];
            }
        }

        return (object) $grades;
    }

    public function projectGrade(Request $request, $classSubjectId)
    {
        $semester = 1;
        $type = 'project';

        if ($request->semester) {
            $semester = $request->semester;
        }

        $classSubjectId = Crypt::decryptString($classSubjectId);
        $classSubject = ClassSubject::with('class', 'teacher', 'subject', 'academicyear')->findOrFail($classSubjectId);

        $studentGrades = (object) $this->studentGrades($classSubjectId, $classSubject->class_id, $semester, $type);

        return view('app.grade.project', compact('classSubject', 'studentGrades', 'semester', 'type'));
    }

    public function formativeGrade(Request $request, $classSubjectId)
    {
        $semester = 1;
        $type = 'formative';

        if ($request->semester) {
            $semester = $request->semester;
        }

        $classSubjectId = Crypt::decryptString($classSubjectId);
        $classSubject = ClassSubject::with('class', 'teacher', 'subject', 'academicyear')->findOrFail($classSubjectId);

        $studentGrades = (object) $this->studentGrades($classSubjectId, $classSubject->class_id, $semester, $type);

        return view('app.grade.formative', compact('classSubject', 'studentGrades', 'semester', 'type'));
    }

    public function summativeGrade(Request $request, $classSubjectId)
    {
        $semester = 1;
        $type = 'summative';

        if ($request->semester) {
            $semester = $request->semester;
        }

        $classSubjectId = Crypt::decryptString($classSubjectId);
        $classSubject = ClassSubject::with('class', 'teacher', 'subject', 'academicyear')->findOrFail($classSubjectId);

        $studentGrades = (object) $this->studentGrades($classSubjectId, $classSubject->class_id, $semester, $type);

        return view('grade.summative', compact('classSubject', 'studentGrades', 'semester', 'type'));
    }

    public function viewGrade(Request $request, $classSubjectId)
    {
        $semester = 1;

        if ($request->semester) {
            $semester = $request->semester;
        }

        $classSubjectId = Crypt::decryptString($classSubjectId);
        $classSubject = ClassSubject::with('class', 'teacher', 'subject', 'academicyear')->findOrFail($classSubjectId);

        $students = Student::join('class_students', 'students.id', '=', 'class_students.student_id')
            ->where('class_students.class_id', $classSubject->class_id)
            ->select('students.id as student_id', 'students.fullname as student_name')
            ->get();

        $studentGrades = [];

        foreach ($students as $student) {
            $listGrade = StudentGrade::where('semester', $semester)
                ->where('student_id', $student->student_id)
                ->where('class_subject_id', $classSubjectId)->get();

            $tempGrade = [];
            $student = null;

            foreach ($listGrade as $grade) {
                $student = $grade->student;

                if ($grade->category != 'summative') {
                    $gradeAverage = [
                        'sum' => 0,
                        'average' => 0,
                        'total' => 0,
                    ];

                    foreach (json_decode($grade->grade) as $currGrade) {
                        if ($currGrade != null) {
                            $gradeAverage['sum'] += $currGrade;
                            $gradeAverage['total']++;
                        }
                    }

                    $gradeAverage['average'] = $gradeAverage['sum'] / $gradeAverage['total'];

                    $tempGrade[$grade->category] = (object) [
                        'lists' => json_decode($grade->grade),
                        'summary' => (object) $gradeAverage
                    ];
                } else {
                    $tempGrade[$grade->category] = (object) ['lists' => json_decode($grade->grade)];
                }
            }

            if ($student != null)
                $studentGrades[$student->id] = (object) [
                    'student' => $student,
                    'grades' => $tempGrade
                ];
            
        }

        return view('grade.view', compact('classSubject', 'studentGrades', 'students', 'semester'));
    }

    public function saveGrades(Request $request)
    {
        $studentGrades = $this->convertGradesArray($request);

        foreach ($studentGrades as $grade) {
            $currentGrade = StudentGrade::where('category', $grade['category'])
                ->where('semester', $grade['semester'])
                ->where('student_id', $grade['student_id'])
                ->where('class_subject_id', $grade['class_subject_id'])->first();

            if ($currentGrade == null) {
                StudentGrade::create($grade);
            } else {
                $currentGrade->update($grade);
            }
        }

        return redirect()->back()->with('success', 'Nilai berhasil disimpan!');
    }
}
