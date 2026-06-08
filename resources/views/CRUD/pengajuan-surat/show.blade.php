@extends('CRUD.layouts.admin')

@section('title', 'Detail Pengajuan Surat')
@section('page-title', 'Detail Pengajuan Surat')
@section('page-description', 'Verifikasi dan proses pengajuan surat warga')

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
                <tr>
                    <td class="text-muted">No. WhatsApp</td>
                    <td>: <a href="https://wa.me/{{ $pengajuanSurat->no_whatsapp }}" target="_blank" class="text-decoration-none">
                        {{ $pengajuanSurat->no_whatsapp }} <i class="bi bi-box-arrow-up-right small"></i>
                    </a></td>
                </tr>
            </table>

            <h6 class="fw-bold mb-4 mt-5 border-bottom pb-2">Detail Surat</h6>
            <table class="table table-borderless">
                <tr>
                    <td width="30%" class="text-muted">Jenis Surat</td>
                    <td>: <span class="badge bg-secondary">{{ $pengajuanSurat->jenis_surat }}</span></td>
                </tr>
                <tr>
                    <td class="text-muted">Tanggal Rencana Pengambilan</td>
                    <td>: {{ $pengajuanSurat->tanggal_pengambilan->format('d M Y') }}</td>
                </tr>
                <tr>
                    <td class="text-muted">Keperluan</td>
                    <td>: {{ $pengajuanSurat->keperluan }}</td>
                </tr>
                <tr>
                    <td class="text-muted">Tanggal Diajukan</td>
                    <td>: {{ $pengajuanSurat->created_at->format('d M Y H:i') }}</td>
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
            <div class="alert alert-light border">
                <strong>Catatan Admin Sebelumnya:</strong><br>
                {{ $pengajuanSurat->catatan_admin }}
            </div>
            @endif

            <hr>

            <h6 class="fw-bold mb-3">Tindakan Admin</h6>
            <form action="{{ route('admin.pengajuan-surat.update-status', $pengajuanSurat) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label text-muted small">Catatan untuk Warga (Opsional)</label>
                    <textarea name="catatan_admin" class="form-control" rows="3" placeholder="Contoh: Dokumen KTP kurang jelas, harap bawa yang asli saat pengambilan..."></textarea>
                </div>

                @if(in_array($pengajuanSurat->status, ['pending', 'menunggu_admin']))
                <div class="d-grid gap-2">
                    <button type="submit" name="action" value="proses" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i> Verifikasi & Proses
                    </button>
                    <button type="submit" name="action" value="tolak" class="btn btn-outline-danger" onclick="return confirm('Yakin ingin menolak pengajuan ini?')">
                        <i class="bi bi-x-circle me-1"></i> Tolak Pengajuan
                    </button>
                </div>
                @elseif($pengajuanSurat->status == 'diproses')
                <div class="d-grid gap-2">
                    <button type="submit" name="action" value="selesai" class="btn btn-success">
                        <i class="bi bi-check2-all me-1"></i> Tandai Selesai (Surat Siap Diambil)
                    </button>
                </div>
                @elseif($pengajuanSurat->status == 'menunggu_kades')
                <div class="alert alert-warning small">
                    <i class="bi bi-hourglass-split"></i> Sedang menunggu persetujuan/TTE dari Kepala Desa.
                </div>
                @endif
            </form>

            <div class="mt-4">
                <a href="{{ route('admin.pengajuan-surat.index') }}" class="btn btn-light w-100">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
