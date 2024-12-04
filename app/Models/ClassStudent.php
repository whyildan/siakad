<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassStudent extends Model
{
    use HasFactory;

    protected $table = 'class_students';

    protected $fillable = ['kelas_id', 'siswa_id'];

    // Relasi dengan Student
    public function student()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
