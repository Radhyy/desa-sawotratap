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
        Schema::create('umkm', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('category', ['Kuliner', 'Kerajinan', 'Fashion', 'Pertanian', 'Lainnya'])->default('Kuliner');
            $table->integer('price');
            $table->string('image')->nullable();
            $table->text('description');
            $table->string('seller');
            $table->string('location');
            $table->integer('stock')->default(0);
            $table->string('phone');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};
