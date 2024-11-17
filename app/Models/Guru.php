<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus';

    protected $fillable = [
        'nama',
        'mapel_id',
        'telepon',
        'alamat'
    ];

    protected $hidden;

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    public function ekstrakurikuler()
    {
        return $this->hasOne(Ekstrakurikuler::class);
    }

    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'guru_id');
    }
}
