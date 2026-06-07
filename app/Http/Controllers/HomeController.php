<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Umkm;
use App\Models\Berita;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 4 pengumuman terbaru yang aktif
        $announcements = Announcement::active()
            ->latest()
            ->take(4)
            ->get();

        // Ambil 4 UMKM terbaru
        $umkms = Umkm::latest()->take(4)->get();

        $data = [
            'village_name' => 'Desa Sawotratap',
            'statistics' => [
                'population' => 8234,
                'families' => 927,
                'hamlets' => 297
            ],
            'announcements' => $announcements,
            'umkm' => $umkms,
            'news' => Berita::latest('date')->take(3)->get(),
            'apbdes' => [
                'year' => 2026,
                'total' => 2708000000,
                'target' => 1450000000,
                'realization' => 1258000000
            ],
            'gallery' => [
                ['image' => 'gallery1.jpg', 'title' => 'Sawah Desa'],
                ['image' => 'gallery2.jpg', 'title' => 'Kegiatan Warga'],
                ['image' => 'gallery3.jpg', 'title' => 'Landmark Desa'],
                ['image' => 'gallery4.jpg', 'title' => 'Produk UMKM']
            ],
            'demographics' => [
                'total' => 8234,
                'male' => 4123,
                'female' => 4111,
                'age_groups' => [
                    ['range' => '0-4', 'count' => 523],
                    ['range' => '5-9', 'count' => 601],
                    ['range' => '10-14', 'count' => 678],
                    ['range' => '15-19', 'count' => 734],
                    ['range' => '20-24', 'count' => 812]
                ]
            ]
        ];

        return view('home', $data);
    }

    public function announcements()
    {
        $announcements = Announcement::active()
            ->latest()
            ->paginate(10);

        return view('announcements.index', compact('announcements'));
    }

    public function show(Announcement $announcement)
    {
        // Pastikan pengumuman aktif
        if ($announcement->status !== 'active') {
            abort(404);
        }

        // Ambil pengumuman terkait (3 pengumuman terbaru selain yang sedang dilihat)
        $relatedAnnouncements = Announcement::active()
            ->where('id', '!=', $announcement->id)
            ->latest()
            ->take(3)
            ->get();

        return view('announcements.show', compact('announcement', 'relatedAnnouncements'));
    }

    public function umkm()
    {
        $products = $this->getUmkmProducts();

        return view('umkm.index', compact('products'));
    }

    public function showUmkm($id)
    {
        $products = $this->getUmkmProducts();
        $product = $products->firstWhere('id', (int) $id);

        if (!$product) {
            abort(404);
        }

        $relatedProducts = $products
            ->where('id', '!=', $product['id'])
            ->where('category', $product['category'])
            ->take(3);

        if ($relatedProducts->count() < 3) {
            $additionalProducts = $products
                ->where('id', '!=', $product['id'])
                ->whereNotIn('id', $relatedProducts->pluck('id'))
                ->take(3 - $relatedProducts->count());

            $relatedProducts = $relatedProducts->merge($additionalProducts);
        }

        return view('umkm.show', compact('product', 'relatedProducts'));
    }

    public function berita()
    {
        $allNews = Berita::orderBy('date', 'desc')->get();

        return view('berita.index', compact('allNews'));
    }

    public function agenda()
    {
        $agendaItems = collect([
            [
                'title' => 'Rapat Koordinasi RT/RW',
                'date' => '2026-06-12',
                'time' => '19.00 WIB',
                'location' => 'Balai Desa Sawotratap',
                'type' => 'Pemerintahan',
                'icon' => 'bi-people',
                'description' => 'Koordinasi rutin bersama RT/RW untuk membahas pelayanan warga, keamanan lingkungan, dan program desa bulan berjalan.',
            ],
            [
                'title' => 'Posyandu Balita & Ibu',
                'date' => '2026-06-14',
                'time' => '08.00 WIB',
                'location' => 'Posyandu Melati 1',
                'type' => 'Kesehatan',
                'icon' => 'bi-heart-pulse',
                'description' => 'Pelayanan kesehatan dasar untuk balita dan ibu hamil, termasuk penimbangan, pemeriksaan, dan penyuluhan gizi.',
            ],
            [
                'title' => 'Kerja Bakti Lingkungan',
                'date' => '2026-06-16',
                'time' => '06.30 WIB',
                'location' => 'RW 03 dan RW 04',
                'type' => 'Lingkungan',
                'icon' => 'bi-tree',
                'description' => 'Gotong royong membersihkan selokan, jalan lingkungan, dan fasilitas umum untuk menjaga kebersihan desa.',
            ],
            [
                'title' => 'Pelatihan UMKM dan Pemasaran Digital',
                'date' => '2026-06-20',
                'time' => '13.00 WIB',
                'location' => 'Aula PKK Desa',
                'type' => 'Ekonomi',
                'icon' => 'bi-shop',
                'description' => 'Sesi pendampingan untuk pelaku UMKM lokal agar produk lebih siap dipasarkan secara online dan offline.',
            ],
        ]);

        return view('agenda.index', compact('agendaItems'));
    }

    public function showBerita($id)
    {
        $news = Berita::findOrFail($id);

        $relatedNews = Berita::where('id', '!=', $id)
            ->where('category', $news->category)
            ->take(3)
            ->get();

        if ($relatedNews->count() < 3) {
            $additionalNews = Berita::where('id', '!=', $id)
                ->whereNotIn('id', $relatedNews->pluck('id'))
                ->take(3 - $relatedNews->count())
                ->get();
            
            $relatedNews = $relatedNews->merge($additionalNews);
        }

        return view('berita.show', compact('news', 'relatedNews'));
    }

    public function galeri()
    {
        $galleries = $this->getGalleryData();
        return view('galeri.index', compact('galleries'));
    }

    public function showGaleri($id)
    {
        $galleries = $this->getGalleryData();
        $gallery = $galleries->firstWhere('id', (int) $id);

        if (!$gallery) {
            abort(404);
        }

        // Get related galleries from same category
        $relatedGalleries = $galleries
            ->where('id', '!=', $gallery['id'])
            ->where('category', $gallery['category'])
            ->take(3);

        if ($relatedGalleries->count() < 3) {
            $additionalGalleries = $galleries
                ->where('id', '!=', $gallery['id'])
                ->whereNotIn('id', $relatedGalleries->pluck('id'))
                ->take(3 - $relatedGalleries->count());

            $relatedGalleries = $relatedGalleries->merge($additionalGalleries);
        }

        return view('galeri.show', compact('gallery', 'relatedGalleries'));
    }

    private function getGalleryData()
    {
        return collect([
            [
                'id' => 1,
                'title' => 'Pemandangan Sawah',
                'description' => 'Hamparan sawah hijau yang asri di pagi hari',
                'image' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=800',
                'category' => 'Alam',
                'date' => '2026-03-05',
                'photographer' => 'Tim Desa',
                'location' => 'Area Persawahan RT 02',
                'full_description' => 'Pemandangan sawah yang menghijau di pagi hari menunjukkan kesuburan tanah di Desa Sawotratap. Hamparan padi yang mulai berbuah ini menjadi pemandangan yang menenangkan dan menggambarkan kesejahteraan petani desa.',
            ],
            [
                'id' => 2,
                'title' => 'Balai Desa Sawotratap',
                'description' => 'Pusat pemerintahan dan pelayanan masyarakat desa',
                'image' => 'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800',
                'category' => 'Fasilitas',
                'date' => '2026-03-03',
                'photographer' => 'Admin Desa',
                'location' => 'Jalan Raya Desa',
                'full_description' => 'Balai Desa Sawotratap yang telah direnovasi menjadi tempat yang nyaman untuk pelayanan administrasi warga. Gedung ini juga sering digunakan untuk pertemuan warga dan kegiatan masyarakat.',
            ],
            [
                'id' => 3,
                'title' => 'Wisata Alam Desa',
                'description' => 'Destinasi wisata alam yang menarik di desa',
                'image' => 'https://images.unsplash.com/photo-1577495508326-19a1b3cf65b7?w=800',
                'category' => 'Wisata',
                'date' => '2026-03-01',
                'photographer' => 'Karang Taruna',
                'location' => 'Kawasan Wisata Desa',
                'full_description' => 'Wisata alam desa dengan pemandangan yang indah dan udara yang sejuk. Tempat ini menjadi destinasi favorit warga untuk bersantai dan wisatawan yang berkunjung ke desa.',
            ],
            [
                'id' => 4,
                'title' => 'Produk UMKM Lokal',
                'description' => 'Hasil karya dan produk unggulan warga desa',
                'image' => 'https://images.unsplash.com/photo-1599490659213-e2b9527bd087?w=800',
                'category' => 'UMKM',
                'date' => '2026-02-28',
                'photographer' => 'Tim PKK',
                'location' => 'Sentra UMKM Desa',
                'full_description' => 'Berbagai produk UMKM lokal yang dihasilkan oleh warga desa. Dari kerajinan tangan hingga produk kuliner, semua dibuat dengan kualitas terbaik dan harga yang terjangkau.',
            ],
            [
                'id' => 5,
                'title' => 'Kegiatan Gotong Royong',
                'description' => 'Semangat gotong royong masyarakat desa',
                'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800',
                'category' => 'Kegiatan',
                'date' => '2026-02-25',
                'photographer' => 'Sekretaris Desa',
                'location' => 'Berbagai Lokasi Desa',
                'full_description' => 'Kegiatan gotong royong rutin yang dilakukan warga desa untuk membersihkan lingkungan dan mempererat tali persaudaraan. Semangat kebersamaan ini menjadi ciri khas masyarakat Desa Sawotratap.',
            ],
            [
                'id' => 6,
                'title' => 'Festival Budaya Desa',
                'description' => 'Perayaan budaya dan tradisi lokal',
                'image' => 'https://images.unsplash.com/photo-1533900298318-6b8da08a523e?w=800',
                'category' => 'Kegiatan',
                'date' => '2026-02-22',
                'photographer' => 'Tim Dokumentasi',
                'location' => 'Alun-Alun Desa',
                'full_description' => 'Festival budaya tahunan yang menampilkan berbagai kesenian tradisional, kuliner khas, dan pertunjukan seni. Acara ini menjadi ajang pelestarian budaya dan memperkenalkan desa kepada masyarakat luas.',
            ],
            [
                'id' => 7,
                'title' => 'Masjid Agung Desa',
                'description' => 'Pusat kegiatan keagamaan masyarakat',
                'image' => 'https://images.unsplash.com/photo-1564769610747-39eff08d0ffc?w=800',
                'category' => 'Fasilitas',
                'date' => '2026-02-20',
                'photographer' => 'Admin Desa',
                'location' => 'Pusat Desa',
                'full_description' => 'Masjid Agung Desa Sawotratap yang megah dan luas. Tempat ibadah ini tidak hanya digunakan untuk sholat berjamaah, tetapi juga untuk kegiatan pengajian dan kajian Islam.',
            ],
            [
                'id' => 8,
                'title' => 'Pasar Tradisional',
                'description' => 'Pusat jual beli hasil pertanian dan kebutuhan sehari-hari',
                'image' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=800',
                'category' => 'Fasilitas',
                'date' => '2026-02-18',
                'photographer' => 'Tim Ekonomi',
                'location' => 'Area Pasar Desa',
                'full_description' => 'Pasar tradisional yang ramai setiap hari dengan berbagai produk segar dari petani lokal. Pasar ini menjadi pusat ekonomi desa dan tempat bertemunya para pedagang dan pembeli.',
            ],
            [
                'id' => 9,
                'title' => 'Taman Bermain Anak',
                'description' => 'Fasilitas bermain untuk anak-anak desa',
                'image' => 'https://images.unsplash.com/photo-1587616211892-e5e9e0c0b6c3?w=800',
                'category' => 'Fasilitas',
                'date' => '2026-02-15',
                'photographer' => 'PKK Desa',
                'location' => 'Taman Desa RT 03',
                'full_description' => 'Taman bermain yang dibangun dengan fasilitas lengkap dan aman untuk anak-anak. Tempat ini menjadi favorit keluarga di sore hari untuk bersantai sambil bermain dengan anak-anak.',
            ],
            [
                'id' => 10,
                'title' => 'Sunrise di Perbukitan',
                'description' => 'Keindahan matahari terbit dari perbukitan desa',
                'image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800',
                'category' => 'Alam',
                'date' => '2026-02-12',
                'photographer' => 'Pemuda Desa',
                'location' => 'Puncak Bukit Desa',
                'full_description' => 'Pemandangan matahari terbit yang spektakuler dari puncak bukit. Spot ini menjadi favorit para fotografer dan pengunjung yang ingin menikmati keindahan alam desa di pagi hari.',
            ],
            [
                'id' => 11,
                'title' => 'Upacara Adat',
                'description' => 'Pelaksanaan upacara adat tradisional',
                'image' => 'https://images.unsplash.com/photo-1527525443983-6e60c75fff46?w=800',
                'category' => 'Kegiatan',
                'date' => '2026-02-10',
                'photographer' => 'Sekretaris Desa',
                'location' => 'Pendopo Desa',
                'full_description' => 'Upacara adat yang diselenggarakan sebagai bentuk pelestarian tradisi leluhur. Acara ini dihadiri oleh seluruh warga dan tokoh masyarakat untuk mendoakan keselamatan dan kesejahteraan desa.',
            ],
            [
                'id' => 12,
                'title' => 'Pelatihan Petani Modern',
                'description' => 'Program peningkatan kemampuan petani',
                'image' => 'https://images.unsplash.com/photo-1574943320219-553eb213f72d?w=800',
                'category' => 'Kegiatan',
                'date' => '2026-02-08',
                'photographer' => 'Dinas Pertanian',
                'location' => 'Balai Pelatihan Desa',
                'full_description' => 'Pelatihan pertanian modern yang mengajarkan teknik-teknik baru untuk meningkatkan hasil panen. Program ini didukung oleh dinas pertanian dan disambut antusias oleh para petani.',
            ],
        ]);
    }

    private function getUmkmProducts()
    {
        return collect([
            [
                'id' => 1,
                'name' => 'Kerupuk Bola Tahu Sawotratap',
                'category' => 'Kuliner',
                'price' => 15000,
                'image' => 'https://images.unsplash.com/photo-1598515214211-89d3c73ae83b?w=400',
                'description' => 'Kerupuk bola tahu renyah khas Sawotratap dengan cita rasa yang nikmat dan gurih',
                'full_description' => 'Kerupuk bola tahu ini dibuat dari bahan pilihan dengan resep keluarga turun-temurun. Teksturnya renyah di luar dan gurih di setiap gigitan, cocok untuk camilan keluarga atau oleh-oleh khas desa.',
                'seller' => 'Ibu Siti',
                'location' => 'RT 03 RW 05',
                'stock' => 45,
            ],
            [
                'id' => 2,
                'name' => 'Batang Cabai Isi Teri',
                'category' => 'Kuliner',
                'price' => 25000,
                'image' => 'https://images.unsplash.com/photo-1600886455078-e9b73c58f09f?w=400',
                'description' => 'Camilan pedas dan gurih dengan isian teri pilihan, sempurna untuk dihidangkan',
                'full_description' => 'Batang cabai isi teri menghadirkan kombinasi rasa pedas, gurih, dan sedikit manis. Isian teri segar dipadukan bumbu khas Sawotratap membuat produk ini jadi favorit untuk teman makan nasi maupun camilan.',
                'seller' => 'Bapak Ahmad',
                'location' => 'RT 02 RW 04',
                'stock' => 32,
            ],
            [
                'id' => 3,
                'name' => 'Batik Tulis Khas Desa',
                'category' => 'Kerajinan',
                'price' => 150000,
                'image' => 'https://images.unsplash.com/photo-1607623814075-e51df1bdc82f?w=400',
                'description' => 'Batik tulis dengan motif tradisional yang indah, dibuat oleh pengrajin lokal',
                'full_description' => 'Batik tulis ini dikerjakan manual oleh pengrajin lokal dengan motif terinspirasi dari kehidupan desa dan alam sekitar. Cocok untuk acara formal maupun koleksi, dengan kualitas warna yang tahan lama.',
                'seller' => 'Ibu Ratih',
                'location' => 'RT 01 RW 03',
                'stock' => 12,
            ],
            [
                'id' => 4,
                'name' => 'Anyaman Bambu',
                'category' => 'Kerajinan',
                'price' => 35000,
                'image' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=400',
                'description' => 'Kerajinan anyaman tangan dari bambu berkualitas, cocok untuk dekorasi rumah',
                'full_description' => 'Anyaman bambu dibuat dengan teknik tradisional yang rapi dan kuat. Produk ini multifungsi, bisa digunakan untuk dekorasi, tempat buah, hingga perlengkapan rumah tangga.',
                'seller' => 'Bapak Hendra',
                'location' => 'RT 04 RW 05',
                'stock' => 28,
            ],
            [
                'id' => 5,
                'name' => 'Tape Singkong Premium',
                'category' => 'Kuliner',
                'price' => 20000,
                'image' => 'https://images.unsplash.com/photo-1590080876-6022d3a23896?w=400',
                'description' => 'Tape singkong yang difermentasi dengan baik, manis dan lezat alami',
                'full_description' => 'Tape singkong premium difermentasi dengan ragi pilihan selama waktu yang pas untuk menghasilkan rasa manis alami dan tekstur lembut. Nikmat disantap langsung atau diolah jadi aneka kudapan.',
                'seller' => 'Ibu Marni',
                'location' => 'RT 05 RW 02',
                'stock' => 50,
            ],
            [
                'id' => 6,
                'name' => 'Tempe Goreng Crispy',
                'category' => 'Kuliner',
                'price' => 12000,
                'image' => 'https://images.unsplash.com/photo-1599599810694-b5ac4dd577b7?w=400',
                'description' => 'Tempe goreng dengan tepung khusus yang membuat tekstur super renyah',
                'full_description' => 'Tempe goreng crispy menggunakan balutan tepung berbumbu racikan khusus. Cocok dijadikan lauk, camilan, atau pelengkap menu harian dengan rasa gurih yang konsisten.',
                'seller' => 'Ibu Dewi',
                'location' => 'RT 03 RW 04',
                'stock' => 60,
            ],
            [
                'id' => 7,
                'name' => 'Tas Rajut Handmade',
                'category' => 'Kerajinan',
                'price' => 85000,
                'image' => 'https://images.unsplash.com/photo-1590736969955-71cc94901144?w=400',
                'description' => 'Tas anyaman tangan dengan desain unik dan berwarna cerah, tahan lama',
                'full_description' => 'Tas rajut handmade dibuat dengan benang berkualitas dan teknik rajut rapi. Desainnya modern namun tetap menonjolkan sentuhan lokal, cocok untuk penggunaan harian maupun hadiah.',
                'seller' => 'Ibu Eni',
                'location' => 'RT 02 RW 02',
                'stock' => 18,
            ],
            [
                'id' => 8,
                'name' => 'Dodol Nangka Sawotratap',
                'category' => 'Kuliner',
                'price' => 30000,
                'image' => 'https://images.unsplash.com/photo-1599599810964-92ff8742f3f3?w=400',
                'description' => 'Dodol dengan isi nangka segar, lembut dan nikmat di lidah',
                'full_description' => 'Dodol nangka ini menggunakan daging buah nangka matang berkualitas. Teksturnya lembut dengan aroma buah yang khas, cocok sebagai camilan tradisional dan oleh-oleh.',
                'seller' => 'Bapak Sugiono',
                'location' => 'RT 01 RW 05',
                'stock' => 25,
            ],
            [
                'id' => 9,
                'name' => 'Keramik Gerabah',
                'category' => 'Kerajinan',
                'price' => 40000,
                'image' => 'https://images.unsplash.com/photo-1578500494198-246f612d03b3?w=400',
                'description' => 'Gerabah buatan tangan dengan desain artistik, cocok untuk koleksi',
                'full_description' => 'Keramik gerabah ini diproses secara manual mulai dari pembentukan hingga pembakaran. Setiap produk memiliki karakter unik, menjadikannya pilihan tepat untuk dekorasi dan koleksi.',
                'seller' => 'Bapak Toto',
                'location' => 'RT 04 RW 03',
                'stock' => 15,
            ],
            [
                'id' => 10,
                'name' => 'Minyak Kelapa Murni',
                'category' => 'Kuliner',
                'price' => 45000,
                'image' => 'https://images.unsplash.com/photo-1599022051969-91e6c3b35797?w=400',
                'description' => 'Minyak kelapa murni tanpa pengawet, menggunakan proses tradisional',
                'full_description' => 'Minyak kelapa murni diproduksi dengan proses tradisional tanpa bahan tambahan. Cocok untuk kebutuhan memasak sehat, perawatan rambut, maupun perawatan kulit alami.',
                'seller' => 'Ibu Rohani',
                'location' => 'RT 03 RW 01',
                'stock' => 35,
            ],
            [
                'id' => 11,
                'name' => 'Boneka Kain Tradisional',
                'category' => 'Kerajinan',
                'price' => 50000,
                'image' => 'https://images.unsplash.com/photo-1595777712802-46a16b984e58?w=400',
                'description' => 'Boneka buatan tangan dengan kain batik lokal, unik dan bercerita',
                'full_description' => 'Boneka kain tradisional ini dijahit manual dengan detail khas dan sentuhan kain batik lokal. Cocok dijadikan koleksi, hadiah, maupun mainan edukatif untuk anak-anak.',
                'seller' => 'Ibu Tri',
                'location' => 'RT 02 RW 03',
                'stock' => 22,
            ],
            [
                'id' => 12,
                'name' => 'Kacang Goreng Pedas',
                'category' => 'Kuliner',
                'price' => 18000,
                'image' => 'https://images.unsplash.com/photo-1585707002059-3b73199cff31?w=400',
                'description' => 'Kacang goreng dengan bumbu pedas khas yang membuat ketagihan',
                'full_description' => 'Kacang goreng pedas ini diolah dari kacang pilihan dan bumbu rempah khas. Renyah dan gurih pedasnya pas untuk camilan sehari-hari atau sajian saat berkumpul bersama keluarga.',
                'seller' => 'Ibu Sunik',
                'location' => 'RT 05 RW 04',
                'stock' => 55,
            ]
        ]);
    }
}

