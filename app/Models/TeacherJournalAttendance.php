<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherJournalAttendance extends Model
{
    use HasFactory;

    protected $fillable = ['journal_id', 'student_id', 'status'];

    public function teacherJournal()
    {
        return $this->belongsTo(TeacherJournal::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
