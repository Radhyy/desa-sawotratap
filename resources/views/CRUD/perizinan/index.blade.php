@extends('CRUD.layouts.admin')

@section('title', 'Kelola Perizinan - Admin')
@section('page-title', 'Perizinan Warga')
@section('page-description', 'Daftar semua pengajuan perizinan dari warga')

@section('content')
<div class="admin-card">
    <div class="card-header-custom">
        <h5><i class="bi bi-file-earmark-check-fill me-2"></i>Daftar Pengajuan Perizinan</h5>
        <span class="badge bg-secondary">{{ $perizinans->total() }} Total</span>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive mt-2">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th width="4%">No</th>
                    <th width="12%">No. Izin</th>
                    <th width="18%">Pemohon</th>
                    <th width="22%">Jenis Izin</th>
                    <th width="16%">NIK</th>
                    <th width="13%">Status</th>
                    <th width="10%">Tanggal</th>
                    <th width="5%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($perizinans as $index => $izin)
                <tr>
                    <td>{{ $perizinans->firstItem() + $index }}</td>
                    <td><code class="small">{{ $izin->nomor_izin }}</code></td>
                    <td>
                        <div class="fw-bold">{{ $izin->nama_pemohon }}</div>
                        <small class="text-muted">{{ $izin->user->name ?? '-' }}</small>
                    </td>
                    <td>
                        <span class="badge bg-secondary">{{ $izin->jenis_izin }}</span>
                    </td>
                    <td><small>{{ $izin->nik }}</small></td>
                    <td>
                        @php
                            $badge = match($izin->status) {
                                'menunggu_admin'  => 'warning text-dark',
                                'diproses'        => 'info text-dark',
                                'menunggu_kades'  => 'primary',
                                'selesai'         => 'success',
                                'ditolak'         => 'danger',
                                default           => 'secondary',
                            };
                            $label = match($izin->status) {
                                'menunggu_admin'  => 'Menunggu Admin',
                                'diproses'        => 'Diproses',
                                'menunggu_kades'  => 'Menunggu Kades',
                                'selesai'         => 'Selesai',
                                'ditolak'         => 'Ditolak',
                                default           => ucfirst($izin->status),
                            };
                        @endphp
                        <span class="badge bg-{{ $badge }}">{{ $label }}</span>
                    </td>
                    <td><small class="text-muted">{{ $izin->created_at->format('d M Y') }}</small></td>
                    <td>
                        <a href="{{ route('admin.perizinan.show', $izin) }}" class="btn btn-sm btn-info text-white">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-5">
                        <i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
                        Belum ada pengajuan perizinan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $perizinans->links() }}
    </div>
</div>
@endsection
