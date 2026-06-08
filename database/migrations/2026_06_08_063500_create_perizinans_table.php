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
        Schema::create('perizinans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('nomor_izin')->unique();
            $table->string('nama_pemohon');
            $table->string('nik', 16);
            $table->string('jenis_izin');
            $table->text('keterangan');
            $table->string('status')->default('menunggu_admin');
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
        Schema::dropIfExists('perizinans');
    }
};
