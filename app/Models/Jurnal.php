<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;

    protected $table = 'jurnals';

    protected $fillable = [
        'mapping_mapel_id',
        'tanggal',
        'deskripsi'
    ];

    protected $hidden;

    public function mappingmapel()
    {
        return $this->belongsTo(MappingMapel::class);
    }
}
