<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'guru_id'
    ];

    protected $hidden;

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }

    public function mappingMapel()
    {
        return $this->hasMany(MappingMapel::class, 'kelas_id');
    }
}
