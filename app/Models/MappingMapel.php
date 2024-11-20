<?php

namespace App\Models;

use Illuminate\Cache\HasCacheLock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingMapel extends Model
{
    use HasFactory;

    protected $table = 'mapping_mapels';

    protected $fillable = [
        'kelas_id',
        'mapel_id'
    ];

    protected $hidden;

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class,'mapel_id');
    }

    public function jurnals()
    {
        return $this->hasMany(Jurnal::class, 'mapping_mapel_id');
    }
}
