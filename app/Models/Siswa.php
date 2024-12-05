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
        'orang_tua_id',
        'alamat'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function absensis()
    {
        return $this->hasMany(JurnalAbsensi::class, 'siswa_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'orang_tua_id');
    }
}
