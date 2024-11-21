<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalAbsensi extends Model
{
    use HasFactory;

    protected $table = 'jurnal_absensis';

    protected $fillable = [
        'jurnal_id',
        'siswa_id',
        'status'
    ];

    protected $hidden;

    public function jurnal()
    {
        return $this->belongsTo(Jurnal::class, 'jurnal_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
