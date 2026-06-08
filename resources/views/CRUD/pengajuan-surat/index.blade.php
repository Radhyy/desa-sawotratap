@extends('CRUD.layouts.admin')

@section('title', 'Kelola Pengajuan Surat')
@section('page-title', 'Pengajuan Surat Warga')
@section('page-description', 'Daftar semua permohonan surat dari warga')

@section('content')
<div class="admin-card">
    <div class="card-header-custom">
        <h5><i class="bi bi-envelope-paper me-2"></i>Daftar Pengajuan Surat</h5>
    </div>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive mt-3">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Nama Pemohon</th>
                    <th width="25%">Jenis Surat</th>
                    <th width="15%">Tanggal Pengambilan</th>
                    <th width="15%">Status</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengajuanSurats as $index => $surat)
                <tr>
                    <td>{{ $pengajuanSurats->firstItem() + $index }}</td>
                    <td>
                        <div class="fw-bold">{{ $surat->nama_lengkap }}</div>
                        <small class="text-muted">{{ $surat->nik }}</small>
                    </td>
                    <td>
                        <span class="badge bg-secondary">{{ $surat->jenis_surat }}</span>
                    </td>
                    <td>{{ $surat->tanggal_pengambilan->format('d M Y') }}</td>
                    <td>
                        <span class="badge bg-{{ $surat->status_badge }}">
                            {{ $surat->status_label }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.pengajuan-surat.show', $surat) }}" class="btn btn-sm btn-info text-white">
                            <i class="bi bi-eye"></i> Detail & Konfirmasi
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">Belum ada pengajuan surat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $pengajuanSurats->links() }}
    </div>
</div>
@endsection
