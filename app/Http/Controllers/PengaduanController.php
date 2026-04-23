<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengaduanController extends Controller
{
    private const REPORTS_FILE = 'private/pengaduan_reports.json';

    public function index()
    {
        $reports = collect($this->loadReports())
            ->sortByDesc('submitted_at')
            ->take(6)
            ->map(function (array $report) {
                return [
                    'ticket' => $report['ticket'] ?? '-',
                    'nama' => $report['nama'] ?? 'Warga',
                    'kategori' => $report['kategori'] ?? '-',
                    'lokasi' => $report['lokasi'] ?? '-',
                    'status' => $report['status'] ?? 'Diproses',
                    'urgensi' => $report['tingkat_urgensi'] ?? 'Sedang',
                    'deskripsi' => $report['deskripsi'] ?? '-',
                    'submitted_at' => isset($report['submitted_at'])
                        ? Carbon::parse($report['submitted_at'])->locale('id')->translatedFormat('d M Y H:i')
                        : '-',
                ];
            })
            ->values();

        $infrastrukturTypes = [
            [
                'title' => 'Jalan Rusak',
                'icon' => 'bi-sign-turn-right-fill',
                'description' => 'Lubang jalan, paving rusak, akses gang tidak layak, atau bahu jalan berbahaya.',
                'color' => '#d7263d',
            ],
            [
                'title' => 'Lampu Jalan Mati',
                'icon' => 'bi-lightbulb-off-fill',
                'description' => 'Lampu padam total, redup, atau titik gelap yang rawan pada malam hari.',
                'color' => '#f46036',
            ],
            [
                'title' => 'Drainase & Banjir',
                'icon' => 'bi-water',
                'description' => 'Selokan tersumbat, genangan lama surut, serta saluran air yang meluap.',
                'color' => '#1b998b',
            ],
            [
                'title' => 'Fasilitas Umum',
                'icon' => 'bi-building-fill-gear',
                'description' => 'Kerusakan trotoar, taman, pos ronda, tempat sampah, dan fasilitas layanan warga.',
                'color' => '#2e294e',
            ],
        ];

        return view('pengaduan.index', compact('reports', 'infrastrukturTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:120',
            'no_whatsapp' => 'required|string|max:25',
            'kategori' => 'required|in:Jalan Rusak,Lampu Jalan Mati,Drainase & Banjir,Fasilitas Umum,Lainnya',
            'lokasi' => 'required|string|max:255',
            'tingkat_urgensi' => 'required|in:Rendah,Sedang,Tinggi',
            'waktu_kejadian' => 'nullable|date',
            'deskripsi' => 'required|string|min:20|max:2000',
            'lampiran' => 'nullable|image|max:4096',
            'setuju' => 'required|accepted',
        ], [
            'setuju.required' => 'Anda harus menyetujui pernyataan kebenaran laporan.',
            'setuju.accepted' => 'Anda harus menyetujui pernyataan kebenaran laporan.',
        ]);

        $existingReports = $this->loadReports();

        $report = [
            'ticket' => 'PGD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5)),
            'nama' => $validated['nama'],
            'no_whatsapp' => $validated['no_whatsapp'],
            'kategori' => $validated['kategori'],
            'lokasi' => $validated['lokasi'],
            'tingkat_urgensi' => $validated['tingkat_urgensi'],
            'waktu_kejadian' => $validated['waktu_kejadian'] ?? null,
            'deskripsi' => $validated['deskripsi'],
            'status' => 'Menunggu Verifikasi',
            'submitted_at' => now()->toDateTimeString(),
        ];

        if ($request->hasFile('lampiran')) {
            $report['lampiran_path'] = $request->file('lampiran')->store('pengaduan', 'public');
        }

        array_unshift($existingReports, $report);

        $this->saveReports(array_slice($existingReports, 0, 50));

        return redirect()
            ->route('pengaduan.index')
            ->with('success', 'Laporan Anda berhasil dikirim dengan nomor tiket ' . $report['ticket'] . '.');
    }

    private function loadReports(): array
    {
        if (!Storage::exists(self::REPORTS_FILE)) {
            return [];
        }

        $decoded = json_decode((string) Storage::get(self::REPORTS_FILE), true);

        return is_array($decoded) ? $decoded : [];
    }

    private function saveReports(array $reports): void
    {
        Storage::put(
            self::REPORTS_FILE,
            json_encode($reports, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
    }
}
