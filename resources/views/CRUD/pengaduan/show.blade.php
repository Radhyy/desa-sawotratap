@extends('CRUD.layouts.admin')

@section('title', 'Detail Pengaduan - Admin')
@section('page-title', 'Detail Pengaduan')
@section('page-description', 'Tinjau dan proses laporan pengaduan warga')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="admin-card mb-4">
            <div class="d-flex justify-content-between align-items-start mb-4 border-bottom pb-3">
                <div>
                    <h6 class="fw-bold mb-1">Tiket Laporan</h6>
                    <code class="fs-6">{{ $pengaduan->ticket }}</code>
                </div>
                @php
                    $statusColor = match($pengaduan->status) {
                        'Menunggu Verifikasi' => 'warning text-dark',
                        'Menunggu Kades'      => 'primary',
                        'Diproses'            => 'info text-dark',
                        'Selesai'             => 'success',
                        'Ditolak'             => 'danger',
                        default               => 'secondary',
                    };
                    $label = match($pengaduan->status) {
                        'Menunggu Verifikasi' => 'Menunggu Verifikasi',
                        'Menunggu Kades'      => 'Menunggu Kades',
                        'Diproses'            => 'Diproses',
                        'Selesai'             => 'Selesai',
                        'Ditolak'             => 'Ditolak',
                        default               => ucfirst($pengaduan->status),
                    };
                @endphp
                <span class="badge bg-{{ $statusColor }} fs-6 px-3 py-2">{{ $label }}</span>
            </div>

            <h6 class="fw-bold mb-3 text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">Informasi Pelapor</h6>
            <table class="table table-borderless mb-4">
                <tr>
                    <td width="30%" class="text-muted py-1">Nama</td>
                    <td class="fw-bold py-1">: {{ $pengaduan->nama }}</td>
                </tr>
                <tr>
                    <td class="text-muted py-1">No. WhatsApp</td>
                    <td class="py-1">: <a href="https://wa.me/{{ $pengaduan->no_whatsapp }}" target="_blank" class="text-decoration-none text-success fw-bold">
                        <i class="bi bi-whatsapp"></i> {{ $pengaduan->no_whatsapp }}
                    </a></td>
                </tr>
                <tr>
                    <td class="text-muted py-1">Tanggal Laporan</td>
                    <td class="py-1">: {{ $pengaduan->created_at->format('d M Y H:i') }}</td>
                </tr>
            </table>

            <h6 class="fw-bold mb-3 text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">Detail Pengaduan</h6>
            <table class="table table-borderless mb-4">
                <tr>
                    <td width="30%" class="text-muted py-1">Kategori</td>
                    <td class="py-1">: <span class="badge bg-secondary">{{ $pengaduan->kategori }}</span></td>
                </tr>
                <tr>
                    <td class="text-muted py-1">Lokasi / Alamat</td>
                    <td class="fw-bold py-1">: {{ $pengaduan->lokasi }}</td>
                </tr>
                <tr>
                    <td class="text-muted py-1">Tingkat Urgensi</td>
                    <td class="py-1">:
                        @if($pengaduan->tingkat_urgensi == 'Tinggi')
                            <span class="badge bg-danger">🔴 Tinggi</span>
                        @elseif($pengaduan->tingkat_urgensi == 'Sedang')
                            <span class="badge bg-warning text-dark">🟡 Sedang</span>
                        @else
                            <span class="badge bg-success">🟢 Rendah</span>
                        @endif
                    </td>
                </tr>
                @if($pengaduan->waktu_kejadian)
                <tr>
                    <td class="text-muted py-1">Waktu Kejadian</td>
                    <td class="py-1">: {{ $pengaduan->waktu_kejadian->format('d M Y') }}</td>
                </tr>
                @endif
            </table>

            <h6 class="fw-bold mb-2 text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">Deskripsi Masalah</h6>
            <div class="p-3 bg-light rounded-3 mb-4" style="line-height: 1.7;">
                {{ $pengaduan->deskripsi }}
            </div>

            @if($pengaduan->lampiran_path)
            <h6 class="fw-bold mb-2 text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">Lampiran Foto</h6>
            <div>
                <img src="{{ asset('storage/' . $pengaduan->lampiran_path) }}"
                     alt="Lampiran Pengaduan"
                     class="img-fluid rounded-3"
                     style="max-height: 350px; object-fit: cover;"
                     onerror="this.style.display='none'">
            </div>
            @endif

            @if($pengaduan->catatan_admin)
            <div class="alert alert-info mt-4">
                <strong><i class="bi bi-chat-dots me-1"></i> Catatan Admin:</strong><br>
                {{ $pengaduan->catatan_admin }}
            </div>
            @endif

            @if($pengaduan->catatan_kades)
            <div class="alert alert-warning mt-3">
                <strong><i class="bi bi-person-badge me-1"></i> Catatan / Disposisi Kepala Desa:</strong><br>
                {{ $pengaduan->catatan_kades }}
            </div>
            @endif
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card">
            <h6 class="fw-bold mb-3">Update Status Pengaduan</h6>

            <form action="{{ route('admin.pengaduan.update-status', $pengaduan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold small">Catatan Admin (Opsional)</label>
                    <textarea name="catatan_admin" class="form-control" rows="3"
                        placeholder="Tulis catatan, disposisi, atau tanggapan untuk warga...">{{ $pengaduan->catatan_admin }}</textarea>
                </div>

                @if(in_array($pengaduan->status, ['Menunggu Verifikasi', 'Diverifikasi Admin', 'Didisposisi Kades']))
                <div class="d-grid gap-2">
                    <button type="submit" name="action" value="teruskan_kades" class="btn btn-primary"
                        onclick="return confirm('Verifikasi pengaduan ini dan teruskan ke Kepala Desa?')">
                        <i class="bi bi-arrow-right-circle me-1"></i> Verifikasi & Teruskan ke Kades
                    </button>
                    <button type="submit" name="action" value="tolak" class="btn btn-outline-danger"
                        onclick="return confirm('Tolak laporan pengaduan ini?')">
                        <i class="bi bi-x-circle me-1"></i> Tolak Pengaduan
                    </button>
                </div>
                @elseif($pengaduan->status === 'Diproses')
                <div class="d-grid gap-2">
                    <button type="submit" name="action" value="selesai" class="btn btn-success"
                        onclick="return confirm('Tandai laporan ini sebagai selesai/sudah diperbaiki?')">
                        <i class="bi bi-check2-all me-1"></i> Tandai Selesai (Sudah Diperbaiki)
                    </button>
                </div>
                @elseif($pengaduan->status === 'Menunggu Kades')
                <div class="alert alert-warning small mb-0">
                    <i class="bi bi-hourglass-split me-1"></i>
                    Sedang menunggu persetujuan / disposisi dari Kepala Desa.
                </div>
                @elseif($pengaduan->status === 'Selesai')
                <div class="alert alert-success small mb-0">
                    <i class="bi bi-check-circle me-1"></i>
                    Pengaduan telah selesai ditindaklanjuti.
                </div>
                @elseif($pengaduan->status === 'Ditolak')
                <div class="alert alert-danger small mb-0">
                    <i class="bi bi-x-circle me-1"></i>
                    Pengaduan ditolak.
                </div>
                @endif
            </form>

            <hr class="my-4">

            <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-light w-100">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
            </a>
        </div>

        <div class="admin-card mt-3">
            <h6 class="fw-bold mb-3">Alur Status</h6>
            <div class="small text-muted" style="line-height: 2;">
                @php
                    $alur = ['Menunggu Verifikasi', 'Menunggu Kades', 'Diproses', 'Selesai'];
                    $aktifIndex = array_search($pengaduan->status, $alur);
                @endphp
                @foreach($alur as $i => $step)
                <div class="d-flex align-items-center gap-2 mb-1">
                    @if($aktifIndex !== false && $i < $aktifIndex)
                        <i class="bi bi-check-circle-fill text-success"></i>
                    @elseif($aktifIndex !== false && $i == $aktifIndex)
                        <i class="bi bi-record-circle-fill text-primary"></i>
                    @else
                        <i class="bi bi-circle text-muted"></i>
                    @endif
                    <span class="{{ ($aktifIndex !== false && $i == $aktifIndex) ? 'fw-bold text-dark' : '' }}">{{ $step }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
