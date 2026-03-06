<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $announcements = [
            [
                'title' => 'Bantuan Langsung Tunai Dana Desa (BLT Dana Desa)',
                'description' => 'Pengumuman penerima bantuan langsung tunai untuk warga desa',
                'content' => 'Pemerintah Desa Sawotratap dengan ini mengumumkan bahwa program Bantuan Langsung Tunai Dana Desa (BLT Dana Desa) akan segera disalurkan kepada warga yang berhak menerima. Pencairan akan dilakukan secara bertahap mulai tanggal 15 Februari 2026.',
                'date' => Carbon::parse('2026-02-10'),
                'status' => 'active',
            ],
            [
                'title' => 'Pembersihan Saluran Air Desa Tahap Mendatang 02',
                'description' => 'Jadwal kegiatan gotong royong pembersihan saluran air',
                'content' => 'Mengingat musim hujan telah tiba, Pemerintah Desa mengajak seluruh warga untuk bergotong royong membersihkan saluran air di wilayah desa. Kegiatan akan dilaksanakan pada hari Minggu, 8 Februari 2026, pukul 07.00 WIB.',
                'date' => Carbon::parse('2026-02-08'),
                'status' => 'active',
            ],
            [
                'title' => 'Pekan Imunisasi Nasional untuk Balita',
                'description' => 'Program imunisasi gratis untuk balita di Posyandu Desa',
                'content' => 'Dinas Kesehatan bekerja sama dengan Pemerintah Desa akan mengadakan Pekan Imunisasi Nasional untuk balita. Kegiatan ini gratis dan akan dilaksanakan di Posyandu seluruh RT mulai tanggal 5-7 Februari 2026.',
                'date' => Carbon::parse('2026-02-05'),
                'status' => 'active',
            ],
            [
                'title' => 'Sosialisasi Program Desa Digital',
                'description' => 'Undangan sosialisasi program transformasi digital desa',
                'content' => 'Pemerintah Desa mengundang seluruh warga untuk mengikuti sosialisasi Program Desa Digital yang akan membahas tentang berbagai layanan online yang dapat diakses oleh warga. Kegiatan akan dilaksanakan di Balai Desa pada tanggal 3 Februari 2026.',
                'date' => Carbon::parse('2026-02-03'),
                'status' => 'active',
            ],
            [
                'title' => 'Penerimaan Usulan Musrenbang Desa 2026',
                'description' => 'Ajukan usulan pembangunan desa untuk periode 2026',
                'content' => 'Pemerintah Desa membuka kesempatan bagi seluruh warga untuk mengajukan usulan pembangunan dalam kegiatan Musyawarah Perencanaan Pembangunan (Musrenbang) Desa tahun 2026. Usulan dapat disampaikan melalui RT/RW masing-masing.',
                'date' => Carbon::parse('2026-01-28'),
                'status' => 'active',
            ],
        ];

        foreach ($announcements as $announcement) {
            Announcement::create($announcement);
        }
    }
}
