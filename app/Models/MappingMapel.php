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

}
