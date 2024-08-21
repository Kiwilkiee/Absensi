<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';

    protected $fillable = [ 
        'user_id',
        'tanggal_izin',
        'keterangan',
        'deskripsi',
        'gambar'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

