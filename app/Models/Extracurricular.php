<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    use HasFactory;

    protected $table = 'extracurriculars';

    protected $fillable = [
        'extracurricular_name',
        'teacher_id'
    ];

    protected $hidden;

    public function teacher()
    {
        return $this->belongsTo(related: Teacher::class);
    }
}
