<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensi'; 

        protected $fillable = [

            'user_id',
            'divisi_id',
            'tanggal',
            'jam_masuk',
            'jam_pulang',
            'jam_masuk_seharusnya',
            'jam_pulang_seharusnya',
            'location',
            'keterangan',
            'no_hp',
            'latitude',
            'longitude',
            'jarak',
        ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}