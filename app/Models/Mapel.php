<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapels';

    protected $fillable = [
        'nama_mapel'
    ];

    public function gurus()
    {
        return $this->hasMany(Guru::class, 'mapel_id');
    }

    protected $hidden;
}
