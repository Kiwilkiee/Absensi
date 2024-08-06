<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Absensi;

class Karyawan extends Model
{

    use HasFactory;

    // Izinkan pengisian massal pada kolom-kolom ini
    protected $fillable = [
        'nama',
        'email',
        'jabatan',
        'password',
        
        // tambahkan kolom lain yang diperlukan
    ];

    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }
}
