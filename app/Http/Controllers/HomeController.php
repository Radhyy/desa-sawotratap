<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 2 pengumuman terbaru yang aktif
        $announcements = Announcement::active()
            ->latest()
            ->take(2)
            ->get();

        $data = [
            'village_name' => 'Desa Sawotratap',
            'statistics' => [
                'population' => 8234,
                'families' => 927,
                'hamlets' => 297
            ],
            'announcements' => $announcements,
            'umkm' => [
                [
                    'id' => 1,
                    'name' => 'Kerupuk Bola Tahu Sawotratap',
                    'category' => 'Kuliner',
                    'price' => 15000,
                    'image' => 'umkm1.jpg',
                    'description' => 'Kerupuk bola tahu khas desa'
                ],
                [
                    'id' => 2,
                    'name' => 'Batang Cabai Isi Teri',
                    'category' => 'Kuliner',
                    'price' => 25000,
                    'image' => 'umkm2.jpg',
                    'description' => 'Camilan pedas khas desa'
                ]
            ],
            'news' => [
                [
                    'id' => 1,
                    'title' => 'Perayaan Bersih Desa: Masyarakat Desa Gotong Royong Membersihkan Lingkungan',
                    'date' => '2026-02-12',
                    'image' => 'news1.jpg',
                    'category' => 'Sosial'
                ],
                [
                    'id' => 2,
                    'title' => 'Prosesi Nadran untuk Keselamatan dan Tolak Bala',
                    'date' => '2026-02-11',
                    'image' => 'news2.jpg',
                    'category' => 'Budaya'
                ]
            ],
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
        $products = collect([
            [
                'id' => 1,
                'name' => 'Kerupuk Bola Tahu Sawotratap',
                'category' => 'Kuliner',
                'price' => 15000,
                'image' => 'https://images.unsplash.com/photo-1598515214211-89d3c73ae83b?w=400',
                'description' => 'Kerupuk bola tahu renyah khas Sawotratap dengan cita rasa yang nikmat dan gurih',
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
                'description' => 'Dodol dengan isi nangka segar, lembutdan nikmat di lidah',
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
                'seller' => 'Ibu Sunik',
                'location' => 'RT 05 RW 04',
                'stock' => 55,
            ]
        ]);

        return view('umkm.index', compact('products'));
    }
}
