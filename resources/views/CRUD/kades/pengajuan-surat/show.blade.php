@extends('CRUD.layouts.kades')

@section('title', 'Tinjau Pengajuan Surat')
@section('page-title', 'Tinjau Pengajuan Surat')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="admin-card mb-4">
            <h6 class="fw-bold mb-4 border-bottom pb-2">Informasi Pemohon</h6>
            <table class="table table-borderless">
                <tr>
                    <td width="30%" class="text-muted">Nama Lengkap</td>
                    <td class="fw-bold">: {{ $pengajuanSurat->nama_lengkap }}</td>
                </tr>
                <tr>
                    <td class="text-muted">NIK</td>
                    <td>: {{ $pengajuanSurat->nik }}</td>
                </tr>
                <tr>
                    <td class="text-muted">No. KK</td>
                    <td>: {{ $pengajuanSurat->no_kk }}</td>
                </tr>
            </table>

            <h6 class="fw-bold mb-4 mt-5 border-bottom pb-2">Detail Surat</h6>
            <table class="table table-borderless">
                <tr>
                    <td width="30%" class="text-muted">Jenis Surat</td>
                    <td>: <span class="badge bg-secondary">{{ $pengajuanSurat->jenis_surat }}</span></td>
                </tr>
                <tr>
                    <td class="text-muted">Keperluan</td>
                    <td>: {{ $pengajuanSurat->keperluan }}</td>
                </tr>
            </table>

            @if($pengajuanSurat->dokumen->count() > 0)
            <h6 class="fw-bold mb-4 mt-5 border-bottom pb-2">Dokumen Pendukung</h6>
            <div class="list-group">
                @foreach($pengajuanSurat->dokumen as $doc)
                <a href="{{ asset('storage/' . $doc->filepath) }}" target="_blank" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div>
                        <i class="bi bi-file-earmark-text me-2 text-primary"></i>
                        {{ $doc->filename }}
                    </div>
                    <span class="badge bg-primary rounded-pill">Lihat</span>
                </a>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card">
            <h6 class="fw-bold mb-3">Status Saat Ini</h6>
            <div class="alert alert-{{ $pengajuanSurat->status_badge }} d-flex align-items-center">
                <i class="bi bi-info-circle-fill me-2"></i>
                <div class="fw-bold">
                    {{ $pengajuanSurat->status_label }}
                </div>
            </div>

            @if($pengajuanSurat->catatan_admin)
            <div class="alert alert-light border mb-3">
                <strong>Catatan Verifikasi Admin:</strong><br>
                {{ $pengajuanSurat->catatan_admin }}
            </div>
            @endif

            <hr>

            <h6 class="fw-bold mb-3">Tindakan Kepala Desa</h6>
            <form action="{{ route('kades.pengajuan-surat.update-status', $pengajuanSurat) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label text-muted small">Catatan (Opsional)</label>
                    <textarea name="catatan_kades" class="form-control" rows="3" placeholder="Contoh: Disetujui, harap segera diterbitkan..."></textarea>
                </div>

                @if($pengajuanSurat->status == 'menunggu_kades')
                <div class="d-grid gap-2">
                    <button type="submit" name="action" value="setujui" class="btn btn-warning fw-bold text-dark">
                        <i class="bi bi-pen me-1"></i> Tanda Tangani Elektronik
                    </button>
                    <button type="submit" name="action" value="tolak" class="btn btn-outline-danger" onclick="return confirm('Yakin ingin menolak pengajuan ini?')">
                        <i class="bi bi-x-circle me-1"></i> Tolak Pengajuan
                    </button>
                </div>
                @elseif($pengajuanSurat->status == 'selesai')
                <div class="alert alert-success small">
                    <i class="bi bi-check-circle"></i> Surat ini telah Anda setujui dan ditandatangani.
                </div>
                @endif
            </form>

            <div class="mt-4">
                <a href="{{ route('kades.pengajuan-surat.index') }}" class="btn btn-light w-100">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
