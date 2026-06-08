@extends('CRUD.layouts.kades')

@section('title', 'Kelola Pengaduan - Kepala Desa')
@section('page-title', 'Pengaduan Warga')
@section('page-description', 'Daftar pengaduan warga yang didisposisikan ke Kepala Desa')

@section('content')
<div class="admin-card">
    <div class="card-header-custom">
        <h5><i class="bi bi-chat-left-text-fill me-2"></i>Daftar Pengaduan</h5>
        <div class="d-flex gap-2">
            <span class="badge bg-warning text-dark">{{ $pengaduans->total() }} Total</span>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th width="5%">No</th>
                    <th width="12%">Tiket</th>
                    <th width="18%">Pelapor</th>
                    <th width="15%">Kategori</th>
                    <th width="15%">Lokasi</th>
                    <th width="10%">Urgensi</th>
                    <th width="12%">Status</th>
                    <th width="13%">Tanggal</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengaduans as $index => $aduan)
                <tr>
                    <td>{{ $pengaduans->firstItem() + $index }}</td>
                    <td>
                        <code class="small">{{ $aduan->ticket }}</code>
                    </td>
                    <td>
                        <div class="fw-bold">{{ $aduan->nama }}</div>
                        <small class="text-muted">
                            <i class="bi bi-whatsapp text-success"></i> {{ $aduan->no_whatsapp }}
                        </small>
                    </td>
                    <td>
                        <span class="badge bg-secondary">{{ $aduan->kategori }}</span>
                    </td>
                    <td>
                        <small>{{ Str::limit($aduan->lokasi, 30) }}</small>
                    </td>
                    <td>
                        @if($aduan->tingkat_urgensi == 'Tinggi')
                            <span class="badge bg-danger">🔴 Tinggi</span>
                        @elseif($aduan->tingkat_urgensi == 'Sedang')
                            <span class="badge bg-warning text-dark">🟡 Sedang</span>
                        @else
                            <span class="badge bg-success">🟢 Rendah</span>
                        @endif
                    </td>
                    <td>
                        @php
                            $statusClass = match($aduan->status) {
                                'Menunggu Verifikasi' => 'bg-warning text-dark',
                                'Menunggu Kades'      => 'bg-primary',
                                'Diproses'            => 'bg-info text-dark',
                                'Selesai'             => 'bg-success',
                                'Ditolak'             => 'bg-danger',
                                default               => 'bg-secondary'
                            };
                        @endphp
                        <span class="badge {{ $statusClass }}">{{ $aduan->status }}</span>
                    </td>
                    <td>
                        <small class="text-muted">{{ $aduan->created_at->format('d M Y') }}</small>
                    </td>
                    <td>
                        <a href="{{ route('kades.pengaduan.show', $aduan) }}" class="btn btn-sm btn-info text-white">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-5">
                        <i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
                        Belum ada pengaduan yang didisposisikan ke Kepala Desa.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $pengaduans->links() }}
    </div>
</div>
@endsection
