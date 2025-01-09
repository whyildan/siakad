<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherJournal extends Model
{
    use HasFactory;

    protected $table = 'teacher_journals';

    protected $fillable = [
        'class_subject_id',
        'teacher_id',
        'date',
        'meet',
        'schedule',
        'content'
    ];

    public function classSubject()
    {
        return $this->belongsTo(ClassSubject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function attendances()
    {
        return $this->hasMany(TeacherJournalAttendance::class);
    }

    public function countSiswa()
    {
        return $this->hasMany(TeacherJournalAttendance::class)->whereNotIn('status', ['izin', 'sakit', 'alfa']);
    }
}
