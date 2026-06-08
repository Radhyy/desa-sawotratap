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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('ticket')->unique();
            $table->string('nama');
            $table->string('no_whatsapp');
            $table->string('kategori');
            $table->string('lokasi');
            $table->string('tingkat_urgensi');
            $table->date('waktu_kejadian')->nullable();
            $table->text('deskripsi');
            $table->string('status')->default('Menunggu Verifikasi');
            $table->string('lampiran_path')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->text('catatan_kades')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
