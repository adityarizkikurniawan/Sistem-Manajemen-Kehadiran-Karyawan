<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $fillable = ['nama_divisi', 'ketua_id', 'jam_masuk_kerja', 'jam_pulang_kerja'];

    // Relasi ke User sebagai Ketua
    public function ketua()
    {
        return $this->belongsTo(User::class, 'ketua_id');
    }

    // Relasi ke User sebagai anggota divisi
    public function anggota()
    {
        return $this->hasMany(User::class, 'divisi_id');
    }
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
}