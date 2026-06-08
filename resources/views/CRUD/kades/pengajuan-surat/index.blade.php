@extends('CRUD.layouts.kades')

@section('title', 'Persetujuan Surat Warga')
@section('page-title', 'Persetujuan Surat Warga')

@section('content')
<div class="admin-card">
    <div class="card-header-custom mb-3">
        <h5><i class="bi bi-envelope-paper me-2"></i>Daftar Pengajuan Menunggu Persetujuan</h5>
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
                        <a href="{{ route('kades.pengajuan-surat.show', $surat) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-square"></i> Tinjau & Proses
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">Belum ada surat yang menunggu persetujuan Anda.</td>
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
