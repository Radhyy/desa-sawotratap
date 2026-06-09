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
        Schema::create('apbdes', function (Blueprint $table) {
            $table->id();
            $table->string('year');
            $table->bigInteger('target_amount');
            $table->bigInteger('realization_amount');
            $table->integer('pie_belanja');
            $table->integer('pie_pendapatan');
            $table->integer('pie_pembiayaan');
            $table->json('chart_months')->nullable();
            $table->json('chart_pendapatan')->nullable();
            $table->json('chart_belanja')->nullable();
            $table->json('chart_surplus')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apbdes');
    }
};
