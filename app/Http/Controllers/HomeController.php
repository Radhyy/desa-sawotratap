<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Umkm;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 2 pengumuman terbaru yang aktif
        $announcements = Announcement::active()
            ->latest()
            ->take(2)
            ->get();

        // Ambil 2 UMKM terbaru yang aktif
        $umkm = Umkm::active()
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
            'umkm' => $umkm,
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
        // Ambil semua produk UMKM yang aktif
        $products = Umkm::active()
            ->latest()
            ->get();

        return view('umkm.index', compact('products'));
    }

    public function umkmShow($id)
    {
        // Cari produk berdasarkan ID
        $product = Umkm::active()->findOrFail($id);

        // Generate WhatsApp URL
        $message = "Halo, saya tertarik dengan produk *" . $product->name . "* seharga Rp " . number_format($product->price, 0, ',', '.') . ". Apakah masih tersedia?";
        $whatsappUrl = "https://wa.me/" . $product->phone . "?text=" . urlencode($message);

        // Ambil produk terkait (4 produk dari kategori yang sama, exclude produk saat ini)
        $relatedProducts = Umkm::active()
            ->where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        // Jika produk terkait kurang dari 4, ambil produk lain
        if ($relatedProducts->count() < 4) {
            $additionalProducts = Umkm::active()
                ->where('id', '!=', $product->id)
                ->whereNotIn('id', $relatedProducts->pluck('id'))
                ->latest()
                ->take(4 - $relatedProducts->count())
                ->get();
            
            $relatedProducts = $relatedProducts->merge($additionalProducts);
        }

        return view('umkm.show', compact('product', 'relatedProducts', 'whatsappUrl'));
    }
}

