<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // Menghubungkan dengan tabel users
            $table->date('tanggal_izin');            // Tanggal pengajuan izin
            $table->string('keterangan');            // Keterangan (sakit, cuti, izin, dll.)
            $table->text('deskripsi')->nullable();   // Deskripsi tambahan
            $table->string('gambar')->nullable();    // Nama file gambar bukti
            $table->timestamps();

            // Foreign key untuk user_id yang menghubungkan dengan tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
