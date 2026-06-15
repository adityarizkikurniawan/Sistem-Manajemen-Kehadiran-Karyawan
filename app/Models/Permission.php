<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'user_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'kategori',
        'alasan',
        'image',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}