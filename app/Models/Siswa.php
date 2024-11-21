<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';

    protected $fillable = [
        'nama',
        'nis',
        'kelas_id',
        'tanggal_lahir',
        'telepon',
        'alamat'
    ];

    protected $hidden;

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function orangtua()
    {
        return $this->hasOne(OrangTua::class);
    }

    public function absensis()
    {
        return $this->hasMany(JurnalAbsensi::class, 'siswa_id');
    }
}
