<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentGrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'class_subject_id',
        'semester',
        'category',
        'grade',
    ];

    protected $casts = [
        'grade' => 'array'
    ];

    // Relasi untuk student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relasi untuk class_subject
    public function classSubject()
    {
        return $this->belongsTo(ClassSubject::class);
    }
}
