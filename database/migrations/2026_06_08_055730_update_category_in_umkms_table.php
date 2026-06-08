<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('umkm', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_umkm_id')->nullable()->after('name');
        });

        // Migrate data
        $categories = DB::table('umkm')->select('category')->distinct()->get();
        foreach ($categories as $cat) {
            $slug = Str::slug($cat->category);
            $existing = DB::table('kategori_umkms')->where('slug', $slug)->first();
            if (!$existing) {
                DB::table('kategori_umkms')->insert([
                    'name' => $cat->category,
                    'slug' => $slug,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Update umkm with new category ids
        $allCategories = DB::table('kategori_umkms')->get();
        foreach ($allCategories as $kategori) {
            DB::table('umkm')
                ->where('category', $kategori->name)
                ->update(['kategori_umkm_id' => $kategori->id]);
        }

        // Make the column required
        Schema::table('umkm', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_umkm_id')->nullable(false)->change();
            $table->foreign('kategori_umkm_id')->references('id')->on('kategori_umkms')->onDelete('cascade');
        });

        // Remove old column (Requires doctrine/dbal if using older Laravel, but Laravel 11 handles it)
        Schema::table('umkm', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            //
        });
    }
};
