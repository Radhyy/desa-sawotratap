<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            [
                'title' => 'Pemandangan Sawah',
                'description' => 'Hamparan sawah hijau yang asri di pagi hari',
                'image' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=800',
                'category' => 'Alam',
                'author' => 'Tim Desa',
                'published_at' => '2026-03-05',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Balai Desa Sawotratap',
                'description' => 'Pusat pemerintahan dan pelayanan masyarakat desa',
                'image' => 'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800',
                'category' => 'Fasilitas',
                'author' => 'Admin Desa',
                'published_at' => '2026-03-03',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Wisata Alam Desa',
                'description' => 'Destinasi wisata alam yang menarik di desa',
                'image' => 'https://images.unsplash.com/photo-1577495508326-19a1b3cf65b7?w=800',
                'category' => 'Wisata',
                'author' => 'Karang Taruna',
                'published_at' => '2026-03-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Produk UMKM Lokal',
                'description' => 'Produk unggulan dari masyarakat desa',
                'image' => 'https://images.unsplash.com/photo-1599490659213-e2b9527bd087?w=800',
                'category' => 'UMKM',
                'author' => 'Tim UMKM',
                'published_at' => '2026-02-28',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kegiatan Warga',
                'description' => 'Kerja bakti rutin setiap minggu ke-4',
                'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800',
                'category' => 'Kegiatan',
                'author' => 'RW 01',
                'published_at' => '2026-02-25',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        \App\Models\Galeri::insert($galleries);
    }
}
