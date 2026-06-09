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

        // Ambil 4 UMKM terbaru yang disetujui
        $umkms = Umkm::where('approval_status', 'approved')->latest()->take(4)->get();

        $activeApbdes = \App\Models\Apbdes::where('is_active', true)->first();
        if (!$activeApbdes) {
            $activeApbdes = (object) [
                'year' => date('Y'),
                'target_amount' => 0,
                'realization_amount' => 0,
                'pie_belanja' => 0,
                'pie_pendapatan' => 0,
                'pie_pembiayaan' => 0,
                'chart_months' => [],
                'chart_pendapatan' => [],
                'chart_belanja' => [],
                'chart_surplus' => []
            ];
        }

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
            'apbdes' => collect($activeApbdes)->toArray(),
            'apbdesObj' => $activeApbdes,
            'gallery' => \App\Models\Galeri::latest('published_at')->take(4)->get(),
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
        $products = Umkm::with('kategori')->where('status', 'active')->where('approval_status', 'approved')->latest()->get();

        return view('umkm.index', compact('products'));
    }

    public function showUmkm($id)
    {
        $product = Umkm::with('kategori')->where('status', 'active')->where('approval_status', 'approved')->findOrFail($id);

        $relatedProducts = Umkm::with('kategori')
            ->where('status', 'active')
            ->where('approval_status', 'approved')
            ->where('id', '!=', $product->id)
            ->where('kategori_umkm_id', $product->kategori_umkm_id)
            ->latest()
            ->take(3)
            ->get();

        if ($relatedProducts->count() < 3) {
            $additionalProducts = Umkm::with('kategori')
                ->where('status', 'active')
                ->where('id', '!=', $product->id)
                ->whereNotIn('id', $relatedProducts->pluck('id'))
                ->latest()
                ->take(3 - $relatedProducts->count())
                ->get();

            $relatedProducts = $relatedProducts->merge($additionalProducts);
        }

        return view('umkm.show', compact('product', 'relatedProducts'));
    }

    public function createUmkm()
    {
        $kategori_umkms = \App\Models\KategoriUmkm::all();
        return view('umkm.create', compact('kategori_umkms'));
    }

    public function storeUmkm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'kategori_umkm_id' => 'required|exists:kategori_umkms,id',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'seller' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('umkm', 'public');
        }

        $validated['status'] = 'active';
        $validated['approval_status'] = 'pending';
        if (auth()->check()) {
            $validated['user_id'] = auth()->id();
        }

        Umkm::create($validated);

        return redirect()->route('umkm-saya.index')->with('success', 'Pengajuan UMKM berhasil dikirim! Menunggu persetujuan admin.');
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
        $galleries = \App\Models\Galeri::latest('published_at')->get();
        return view('galeri.index', compact('galleries'));
    }

    public function showGaleri($id)
    {
        $gallery = \App\Models\Galeri::findOrFail($id);

        // Get related galleries from same category
        $relatedGalleries = \App\Models\Galeri::where('id', '!=', $gallery->id)
            ->where('category', $gallery->category)
            ->take(3)
            ->get();

        if ($relatedGalleries->count() < 3) {
            $additionalGalleries = \App\Models\Galeri::where('id', '!=', $gallery->id)
                ->whereNotIn('id', $relatedGalleries->pluck('id'))
                ->take(3 - $relatedGalleries->count())
                ->get();

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
}
