<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;


class PengajuanController extends Controller
{
    public function index() 
    {
        return view('absensi.PengajuanAbsensi');
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'tanggal_izin' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        // Menyimpan file gambar jika ada
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('gambar', 'public');
        }

        
        Pengajuan::create([
            'user_id' => $request->user_id,
            'tanggal_izin' => $request->tanggal_izin,
            'keterangan' => $request->keterangan,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
        ]);

        // Redirect ke halaman tertentu dengan pesan sukses
        return redirect()->back()->with('success', 'Pengajuan absensi berhasil dikirim.');
    }

}
