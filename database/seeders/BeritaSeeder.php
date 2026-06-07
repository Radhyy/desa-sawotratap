<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Berita;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allNewsData = [
            [
                'title' => 'Perayaan Bersih Desa: Masyarakat Desa Gotong Royong Membersihkan Lingkungan',
                'date' => '2026-03-05',
                'category' => 'Sosial',
                'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800',
                'excerpt' => 'Warga Desa Sawotratap bergotong royong membersihkan lingkungan desa dalam rangka menyambut bulan suci Ramadhan. Kegiatan ini diikuti oleh ratusan warga dari berbagai kalangan.',
                'content' => "Pada hari Minggu, 5 Maret 2026, warga Desa Sawotratap menunjukkan semangat gotong royong yang luar biasa dalam kegiatan Bersih Desa. Kegiatan ini merupakan bagian dari persiapan menyambut bulan suci Ramadhan yang akan segera tiba.\n\nLebih dari 300 warga dari berbagai RT dan RW turut berpartisipasi dalam kegiatan ini. Mereka membawa berbagai peralatan seperti sapu lidi, cangkul, dan alat kebersihan lainnya. Area yang dibersihkan meliputi jalan-jalan desa, saluran air, makam, dan fasilitas umum lainnya.\n\nKepala Desa Sawotratap, Bapak Samsul Hadi, menyampaikan apresiasi yang tinggi atas partisipasi masyarakat. \"Ini adalah bukti bahwa semangat gotong royong di desa kita masih sangat kuat. Kebersihan adalah sebagian dari iman, dan kita harus menjaga lingkungan kita bersama-sama,\" ujarnya.\n\nKegiatan dimulai pukul 06.00 WIB dan berlangsung hingga siang hari. Setelah selesai, warga berkumpul untuk menikmati hidangan sederhana yang telah disiapkan oleh ibu-ibu PKK. Kegiatan Bersih Desa ini akan rutin dilaksanakan setiap bulan untuk menjaga kebersihan dan keindahan desa.\n\nBeberapa warga mengungkapkan kegembiraan mereka dapat berkumpul dan bekerja sama. \"Kegiatan seperti ini tidak hanya membuat desa lebih bersih, tapi juga mempererat tali persaudaraan antar warga,\" kata Ibu Siti, salah satu peserta kegiatan.",
                'read_time' => '5 menit',
                'author' => 'Admin Desa',
                'views' => 268,
                'trending' => true,
                'tags' => ['Gotong Royong', 'Kebersihan', 'Ramadhan', 'Lingkungan']
            ],
            [
                'title' => 'Prosesi Nadran untuk Keselamatan dan Tolak Bala',
                'date' => '2026-03-03',
                'category' => 'Budaya',
                'image' => 'https://images.unsplash.com/photo-1533900298318-6b8da08a523e?w=800',
                'excerpt' => 'Tradisi nadran kembali digelar di Desa Sawotratap sebagai bentuk syukur dan doa keselamatan. Acara ini menghadirkan berbagai ritual adat yang turun-temurun.',
                'content' => "Desa Sawotratap kembali menggelar upacara adat Nadran pada tanggal 3 Maret 2026. Tradisi yang telah berlangsung turun-temurun ini merupakan bentuk rasa syukur masyarakat atas hasil panen dan doa untuk keselamatan desa.\n\nUpacara Nadran dimulai dengan kenduri bersama di Balai Desa, dilanjutkan dengan prosesi arak-arakan menuju pantai. Ratusan warga mengenakan pakaian adat dan membawa berbagai sesaji dan hasil bumi sebagai persembahan.\n\nSesepuh Desa, Mbah Karso (85 tahun), memimpin ritual doa dan pembacaan mantra-mantra leluhur. \"Nadran adalah warisan nenek moyang kita yang harus dijaga. Ini adalah cara kita memohon keselamatan dan keberkahan dari Yang Maha Kuasa,\" ungkapnya dengan khidmat.\n\nAcara puncak adalah pelepasan gunungan ke laut sebagai simbol penolakan bala dan harapan akan hasil laut yang melimpah. Gunungan berisi berbagai hasil bumi, bunga, dan sesaji yang telah didoakan.\n\nBupati yang hadir sebagai tamu kehormatan mengapresiasi upaya masyarakat Desa Sawotratap dalam melestarikan budaya lokal. Beliau berharap tradisi ini terus diwariskan kepada generasi muda sebagai identitas budaya yang berharga.\n\nAcara ditutup dengan pertunjukan kesenian tradisional seperti tari topeng, wayang kulit, dan musik gamelan yang memeriahkan suasana hingga malam hari.",
                'read_time' => '6 menit',
                'author' => 'Sekretaris Desa',
                'views' => 154,
                'trending' => true,
                'tags' => ['Budaya', 'Tradisi', 'Nadran', 'Adat']
            ],
            [
                'title' => 'Program Pelatihan Digital Marketing untuk UMKM Desa',
                'date' => '2026-03-01',
                'category' => 'Program',
                'image' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800',
                'excerpt' => 'Pemerintah desa mengadakan pelatihan digital marketing bagi pelaku UMKM untuk meningkatkan penjualan produk lokal melalui platform online.',
                'content' => "Pemerintah Desa Sawotratap bekerja sama dengan Dinas Koperasi dan UKM menggelar pelatihan Digital Marketing untuk para pelaku UMKM desa pada 1 Maret 2026. Pelatihan ini diikuti oleh 45 pelaku UMKM dari berbagai sektor usaha.\n\nMateri pelatihan meliputi pengenalan e-commerce, pembuatan konten menarik untuk media sosial, strategi pemasaran online, dan cara memanfaatkan platform marketplace. Pelatihan dipandu oleh praktisi digital marketing berpengalaman yang telah membantu banyak UMKM naik kelas.\n\nIbu Ratna, salah satu pelaku UMKM kerajinan batik, mengaku sangat terbantu dengan pelatihan ini. \"Selama ini saya hanya jualan offline dan terbatas pada pembeli lokal. Sekarang saya tahu cara menjual online dan bisa menjangkau pembeli dari luar daerah,\" ujarnya antusias.\n\nKepala Desa menyampaikan bahwa program ini merupakan bagian dari upaya meningkatkan ekonomi desa melalui digitalisasi UMKM. \"Era digital ini adalah peluang besar bagi pelaku UMKM kita. Dengan pemasaran online, produk lokal kita bisa dikenal lebih luas,\" jelasnya.\n\nPeserta juga mendapat bantuan pembuatan akun marketplace dan konsultasi gratis selama 3 bulan. Selain itu, produk UMKM Desa Sawotratap akan dipromosikan melalui website resmi desa dan media sosial pemerintah daerah.\n\nKegiatan pelatihan akan dilanjutkan dengan pendampingan intensif dan monitoring perkembangan usaha peserta. Diharapkan dalam 6 bulan ke depan, minimal 70% peserta sudah aktif berjualan online.",
                'read_time' => '4 menit',
                'author' => 'Tim PKK',
                'views' => 216,
                'trending' => false,
                'tags' => ['UMKM', 'Digital Marketing', 'Pelatihan', 'Ekonomi Digital']
            ],
            [
                'title' => 'Peresmian Jalan Desa yang Baru Diperbaiki',
                'date' => '2026-02-28',
                'category' => 'Pembangunan',
                'image' => 'https://images.unsplash.com/photo-1486162928267-e6274cb3106f?w=800',
                'excerpt' => 'Kepala Desa meresmikan jalan desa sepanjang 2 kilometer yang telah diperbaiki menggunakan dana desa. Infrastruktur ini diharapkan memperlancar akses transportasi warga.',
                'content' => "Kepala Desa Sawotratap, Bapak Samsul Hadi, meresmikan jalan desa yang baru selesai diperbaiki pada 28 Februari 2026. Perbaikan jalan sepanjang 2 kilometer ini menggunakan dana desa tahun anggaran 2025.\n\nProyek perbaikan jalan ini dimulai pada Oktober 2025 dan selesai tepat waktu sesuai jadwal. Jalan yang sebelumnya rusak parah dengan banyak lubang kini sudah diaspal dengan baik dan dilengkapi dengan saluran drainase.\n\nDalam sambutannya, Kepala Desa menyampaikan bahwa perbaikan infrastruktur adalah prioritas utama pemerintah desa. \"Jalan yang baik akan memudahkan mobilitas warga, terutama untuk mengangkut hasil pertanian ke pasar,\" jelasnya.\n\nWarga sangat bersyukur dengan adanya perbaikan ini. Bapak Sutomo, petani yang tinggal di ujung desa, mengungkapkan kelegaannya. \"Sekarang saya bisa membawa hasil panen dengan motor atau mobil pickup. Tidak perlu lagi susah-susah lewat jalan yang berlumpur,\" katanya.\n\nSelain memperlancar akses transportasi, jalan yang baik juga diharapkan dapat meningkatkan perekonomian warga. Akses yang mudah akan memudahkan distribusi produk UMKM dan menarik lebih banyak pembeli dari luar desa.\n\nPemerintah desa berencana melanjutkan perbaikan jalan di segmen lainnya secara bertahap. Target tahun 2026 adalah memperbaiki 3 kilometer jalan tambahan dengan menggunakan dana desa dan bantuan dari pemerintah kabupaten.",
                'read_time' => '3 menit',
                'author' => 'Admin Desa',
                'views' => 189,
                'trending' => false,
                'tags' => ['Pembangunan', 'Infrastruktur', 'Jalan Desa', 'Dana Desa']
            ],
            [
                'title' => 'Panen Raya Padi: Petani Sawotratap Panen Melimpah',
                'date' => '2026-02-25',
                'category' => 'Ekonomi',
                'image' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=800',
                'excerpt' => 'Musim panen padi tahun ini memberikan hasil yang melimpah bagi petani Desa Sawotratap. Hasil panen meningkat 20% dibanding tahun lalu berkat program pupuk bersubsidi.',
                'content' => "Petani Desa Sawotratap merayakan panen raya padi dengan hasil yang sangat memuaskan pada musim tanam kali ini. Hasil panen meningkat hingga 20% dibandingkan tahun lalu, mencapai rata-rata 7 ton per hektar.\n\nBapak Karman, Ketua Kelompok Tani Makmur Jaya, menjelaskan bahwa keberhasilan ini adalah hasil dari beberapa faktor. \"Kami mendapat bantuan pupuk bersubsidi tepat waktu, cuaca mendukung, dan ada pendampingan dari penyuluh pertanian,\" ungkapnya.\n\nPemerintah desa juga turut mendukung dengan menyediakan alat-alat pertanian modern seperti traktor dan mesin perontok padi yang dapat digunakan secara bergantian oleh kelompok tani. Hal ini sangat membantu mempercepat proses panen dan mengurangi biaya operasional.\n\nHarga gabah kering panen di tingkat petani saat ini mencapai Rp 5.500 per kilogram, lebih tinggi dari musim sebelumnya. Kenaikan harga ini memberikan keuntungan yang lebih baik bagi petani.\n\nIbu Sumiati, salah satu petani wanita, mengungkapkan kebahagiaannya. \"Alhamdulillah, tahun ini panen melimpah. Saya bisa melunasi hutang dan menyisihkan uang untuk biaya sekolah anak,\" katanya sambil tersenyum.\n\nPemerintah desa berencana membuat lumbung padi bersama untuk menyimpan cadangan pangan dan mengantisipasi gagal panen di musim mendatang. Selain itu, akan ada program diversifikasi pertanian untuk mengurangi ketergantungan pada satu jenis tanaman.",
                'read_time' => '5 menit',
                'author' => 'Ketua Kelompok Tani',
                'views' => 342,
                'trending' => true,
                'tags' => ['Pertanian', 'Panen Raya', 'Ekonomi', 'Petani']
            ],
            [
                'title' => 'Lomba Kebersihan Antar RT Dalam Menyambut HUT RI',
                'date' => '2026-02-22',
                'category' => 'Sosial',
                'image' => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=800',
                'excerpt' => 'Pemerintah desa mengadakan lomba kebersihan antar RT sebagai persiapan menyambut HUT RI. Setiap RT berlomba-lomba menciptakan lingkungan yang bersih dan asri.',
                'content' => "Pemerintah desa mengadakan lomba kebersihan antar RT sebagai persiapan menyambut HUT RI. Setiap RT berlomba-lomba menciptakan lingkungan yang bersih dan asri.",
                'read_time' => '4 menit',
                'author' => 'Karang Taruna',
                'views' => 120,
                'trending' => false,
                'tags' => ['Sosial', 'HUT RI']
            ],
            [
                'title' => 'Workshop Pembuatan Kompos dari Sampah Organik',
                'date' => '2026-02-20',
                'category' => 'Program',
                'image' => 'https://images.unsplash.com/photo-1586348943529-beaae6c28db9?w=800',
                'excerpt' => 'Dinas Lingkungan Hidup mengadakan workshop pembuatan kompos untuk mengolah sampah organik rumah tangga menjadi pupuk berkualitas.',
                'content' => "Dinas Lingkungan Hidup mengadakan workshop pembuatan kompos untuk mengolah sampah organik rumah tangga menjadi pupuk berkualitas.",
                'read_time' => '6 menit',
                'author' => 'Tim Lingkungan',
                'views' => 105,
                'trending' => false,
                'tags' => ['Lingkungan', 'Workshop']
            ],
            [
                'title' => 'Musyawarah Desa Pembahasan APBDes 2026',
                'date' => '2026-02-18',
                'category' => 'Pembangunan',
                'image' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=800',
                'excerpt' => 'Musyawarah desa digelar untuk membahas alokasi APBDes tahun 2026. Berbagai program prioritas diusulkan untuk kesejahteraan masyarakat.',
                'content' => "Musyawarah desa digelar untuk membahas alokasi APBDes tahun 2026. Berbagai program prioritas diusulkan untuk kesejahteraan masyarakat.",
                'read_time' => '7 menit',
                'author' => 'Sekretaris Desa',
                'views' => 200,
                'trending' => false,
                'tags' => ['Pembangunan', 'Musyawarah']
            ],
            [
                'title' => 'Festival Kuliner Nusantara di Alun-Alun Desa',
                'date' => '2026-02-15',
                'category' => 'Budaya',
                'image' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=800',
                'excerpt' => 'Festival kuliner digelar menampilkan berbagai makanan khas daerah. Acara ini sukses menarik ratusan pengunjung dari berbagai desa sekitar.',
                'content' => "Festival kuliner digelar menampilkan berbagai makanan khas daerah. Acara ini sukses menarik ratusan pengunjung dari berbagai desa sekitar.",
                'read_time' => '5 menit',
                'author' => 'Karang Taruna',
                'views' => 310,
                'trending' => true,
                'tags' => ['Kuliner', 'Festival']
            ],
            [
                'title' => 'Bantuan Sosial untuk Warga Kurang Mampu',
                'date' => '2026-02-12',
                'category' => 'Sosial',
                'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=800',
                'excerpt' => 'Pemerintah desa menyalurkan bantuan sosial berupa sembako kepada 150 kepala keluarga kurang mampu sebagai bentuk kepedulian sosial.',
                'content' => "Pemerintah desa menyalurkan bantuan sosial berupa sembako kepada 150 kepala keluarga kurang mampu sebagai bentuk kepedulian sosial.",
                'read_time' => '4 menit',
                'author' => 'Admin Desa',
                'views' => 150,
                'trending' => false,
                'tags' => ['Sosial', 'Bansos']
            ],
            [
                'title' => 'Kerjasama dengan Investor untuk Pengembangan Wisata Desa',
                'date' => '2026-02-10',
                'category' => 'Ekonomi',
                'image' => 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=800',
                'excerpt' => 'Desa Sawotratap menjalin kerjasama dengan investor lokal untuk mengembangkan potensi wisata desa yang melimpah dan menarik wisatawan.',
                'content' => "Desa Sawotratap menjalin kerjasama dengan investor lokal untuk mengembangkan potensi wisata desa yang melimpah dan menarik wisatawan.",
                'read_time' => '6 menit',
                'author' => 'Kepala Desa',
                'views' => 230,
                'trending' => false,
                'tags' => ['Ekonomi', 'Wisata']
            ],
            [
                'title' => 'Posyandu Balita: Cek Kesehatan Rutin Bulan Februari',
                'date' => '2026-02-08',
                'category' => 'Sosial',
                'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=800',
                'excerpt' => 'Kegiatan posyandu balita rutin dilaksanakan setiap bulan untuk memantau tumbuh kembang anak dan memberikan imunisasi.',
                'content' => "Kegiatan posyandu balita rutin dilaksanakan setiap bulan untuk memantau tumbuh kembang anak dan memberikan imunisasi.",
                'read_time' => '4 menit',
                'author' => 'Kader Posyandu',
                'views' => 110,
                'trending' => false,
                'tags' => ['Kesehatan', 'Posyandu']
            ],
        ];

        foreach ($allNewsData as $news) {
            Berita::create($news);
        }
    }
}
