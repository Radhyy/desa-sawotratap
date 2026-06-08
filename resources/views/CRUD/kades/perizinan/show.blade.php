@extends('CRUD.layouts.kades')

@section('title', 'Detail Perizinan - Kepala Desa')
@section('page-title', 'Detail Perizinan')
@section('page-description', 'Tinjau dan setujui perizinan warga')

@section('content')
@php
    $badge = match($perizinan->status) {
        'menunggu_kades' => 'primary',
        'selesai'        => 'success',
        'ditolak'        => 'danger',
        default          => 'secondary',
    };
    $label = match($perizinan->status) {
        'menunggu_kades' => 'Menunggu Kades',
        'selesai'        => 'Selesai',
        'ditolak'        => 'Ditolak',
        default          => ucfirst($perizinan->status),
    };
@endphp

<div class="row">
    <div class="col-lg-8">
        <div class="admin-card mb-4">
            <div class="d-flex justify-content-between align-items-start mb-4 border-bottom pb-3">
                <div>
                    <h6 class="fw-bold mb-1">Nomor Izin</h6>
                    <code class="fs-6">{{ $perizinan->nomor_izin }}</code>
                </div>
                <span class="badge bg-{{ $badge }} fs-6 px-3 py-2">{{ $label }}</span>
            </div>

            <h6 class="fw-bold mb-3 text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">Informasi Pemohon</h6>
            <table class="table table-borderless mb-4">
                <tr>
                    <td width="30%" class="text-muted py-1">Nama Pemohon</td>
                    <td class="fw-bold py-1">: {{ $perizinan->nama_pemohon }}</td>
                </tr>
                <tr>
                    <td class="text-muted py-1">NIK</td>
                    <td class="py-1">: {{ $perizinan->nik }}</td>
                </tr>
                <tr>
                    <td class="text-muted py-1">Tanggal Pengajuan</td>
                    <td class="py-1">: {{ $perizinan->created_at->format('d M Y H:i') }}</td>
                </tr>
            </table>

            <h6 class="fw-bold mb-3 text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">Detail Perizinan</h6>
            <table class="table table-borderless mb-4">
                <tr>
                    <td width="30%" class="text-muted py-1">Jenis Izin</td>
                    <td class="py-1">: <span class="badge bg-secondary">{{ $perizinan->jenis_izin }}</span></td>
                </tr>
            </table>

            <h6 class="fw-bold mb-2 text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">Keterangan / Keperluan</h6>
            <div class="p-3 bg-light rounded-3 mb-4" style="line-height: 1.7;">
                {{ $perizinan->keterangan }}
            </div>

            @if($perizinan->lampiran_path)
            <h6 class="fw-bold mb-2 text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">Lampiran Dokumen</h6>
            <a href="{{ asset('storage/' . $perizinan->lampiran_path) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-file-earmark-text me-1"></i> Lihat Lampiran
            </a>
            @endif

            @if($perizinan->catatan_admin)
            <div class="alert alert-info mt-4">
                <strong><i class="bi bi-chat-dots me-1"></i> Catatan Admin:</strong><br>
                {{ $perizinan->catatan_admin }}
            </div>
            @endif
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card">
            <h6 class="fw-bold mb-3">Tindakan Kepala Desa</h6>

            <form action="{{ route('kades.perizinan.update-status', $perizinan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold small">Catatan / Pesan (Opsional)</label>
                    <textarea name="catatan_kades" class="form-control" rows="3"
                        placeholder="Tambahkan catatan jika ditolak, atau pesan persetujuan...">{{ $perizinan->catatan_kades }}</textarea>
                </div>

                @if($perizinan->status === 'menunggu_kades')
                <div class="d-grid gap-2">
                    <button type="submit" name="action" value="selesai" class="btn btn-success"
                        onclick="return confirm('Setujui dan tanda tangani perizinan ini secara elektronik?')">
                        <i class="bi bi-pen me-1"></i> Setujui & TTD
                    </button>
                    <button type="submit" name="action" value="tolak" class="btn btn-outline-danger"
                        onclick="return confirm('Tolak permohonan izin ini?')">
                        <i class="bi bi-x-circle me-1"></i> Tolak Permohonan
                    </button>
                </div>
                @elseif($perizinan->status === 'selesai')
                <div class="alert alert-success small mb-0">
                    <i class="bi bi-check-circle me-1"></i>
                    Telah disetujui oleh Anda.
                </div>
                @elseif($perizinan->status === 'ditolak')
                <div class="alert alert-danger small mb-0">
                    <i class="bi bi-x-circle me-1"></i>
                    Telah Anda tolak.
                </div>
                @endif
            </form>

            <hr class="my-4">
            <a href="{{ route('kades.perizinan.index') }}" class="btn btn-light w-100">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection
