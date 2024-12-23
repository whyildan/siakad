<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';

    protected $fillable = [
        'user_id',
        'telephone',
        'address'
    ];

    protected $hidden;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function extracurricular()
    {
        return $this->hasOne(Extracurricular::class);
    }

    public function class()
    {
        return $this->hasOne(Classes::class, 'teacher_id');
    }
}
