<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'Students';

    protected $fillable = [
        'name',
        'student_identification_number',
        'class_id',
        'date_of_birth',
        'phone_number',
        'parent_id',
        'address'
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
}
