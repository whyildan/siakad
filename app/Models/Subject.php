<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';

    protected $fillable = [
        'subject_name'
    ];

    protected $hidden;

    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'subject_id');
    }
}
