@extends('CRUD.layouts.admin')

@section('title', 'Detail Perizinan - Admin')
@section('page-title', 'Detail Perizinan')
@section('page-description', 'Tinjau dan proses pengajuan izin dari warga')

@section('content')
@php
    $badge = match($perizinan->status) {
        'menunggu_admin' => 'warning text-dark',
        'diproses'       => 'info text-dark',
        'menunggu_kades' => 'primary',
        'selesai'        => 'success',
        'ditolak'        => 'danger',
        default          => 'secondary',
    };
    $label = match($perizinan->status) {
        'menunggu_admin' => 'Menunggu Admin',
        'diproses'       => 'Diproses',
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
                    <td class="text-muted py-1">Akun Terdaftar</td>
                    <td class="py-1">: {{ $perizinan->user->name ?? '-' }}
                        <small class="text-muted">({{ $perizinan->user->email ?? '-' }})</small>
                    </td>
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

            @if($perizinan->catatan_kades)
            <div class="alert alert-warning mt-3">
                <strong><i class="bi bi-person-badge me-1"></i> Catatan Kepala Desa:</strong><br>
                {{ $perizinan->catatan_kades }}
            </div>
            @endif
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card">
            <h6 class="fw-bold mb-3">Tindakan Admin</h6>

            <form action="{{ route('admin.perizinan.update-status', $perizinan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold small">Catatan (Opsional)</label>
                    <textarea name="catatan_admin" class="form-control" rows="3"
                        placeholder="Catatan verifikasi, kekurangan berkas, dll...">{{ $perizinan->catatan_admin }}</textarea>
                </div>

                @if(in_array($perizinan->status, ['menunggu_admin']))
                <div class="d-grid gap-2">
                    <button type="submit" name="action" value="proses" class="btn btn-primary"
                        onclick="confirmAction(event, 'Verifikasi dan proses pengajuan izin ini?')">
                        <i class="bi bi-check-circle me-1"></i> Verifikasi & Proses
                    </button>
                    <button type="submit" name="action" value="tolak" class="btn btn-outline-danger"
                        onclick="confirmAction(event, 'Yakin ingin menolak pengajuan ini?')">
                        <i class="bi bi-x-circle me-1"></i> Tolak Pengajuan
                    </button>
                </div>
                @elseif($perizinan->status === 'diproses')
                <div class="d-grid gap-2">
                    <button type="submit" name="action" value="selesai" class="btn btn-success"
                        onclick="confirmAction(event, 'Tandai perizinan ini telah selesai?')">
                        <i class="bi bi-check2-all me-1"></i> Tandai Selesai
                    </button>
                </div>
                @elseif($perizinan->status === 'menunggu_kades')
                <div class="alert alert-warning small mb-0">
                    <i class="bi bi-hourglass-split me-1"></i>
                    Menunggu persetujuan Kepala Desa.
                </div>
                @elseif($perizinan->status === 'selesai')
                <div class="alert alert-success small mb-0">
                    <i class="bi bi-check-circle me-1"></i>
                    Perizinan telah selesai diproses.
                </div>
                @elseif($perizinan->status === 'ditolak')
                <div class="alert alert-danger small mb-0">
                    <i class="bi bi-x-circle me-1"></i>
                    Pengajuan ini telah ditolak.
                </div>
                @endif
            </form>

            <hr class="my-4">
            <a href="{{ route('admin.perizinan.index') }}" class="btn btn-light w-100">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
            </a>
        </div>

        <div class="admin-card mt-3">
            <h6 class="fw-bold mb-3">Alur Proses</h6>
            @php
                $alur = ['menunggu_admin' => 'Menunggu Admin', 'diproses' => 'Diproses', 'menunggu_kades' => 'Menunggu Kades', 'selesai' => 'Selesai'];
                $keys = array_keys($alur);
                $currentIdx = array_search($perizinan->status, $keys);
            @endphp
            @foreach($alur as $key => $stepLabel)
            @php $i = array_search($key, $keys); @endphp
            <div class="d-flex align-items-center gap-2 mb-2 small">
                @if($perizinan->status === 'ditolak')
                    <i class="bi bi-x-circle-fill text-danger"></i>
                @elseif($currentIdx !== false && $i < $currentIdx)
                    <i class="bi bi-check-circle-fill text-success"></i>
                @elseif($currentIdx !== false && $i === $currentIdx)
                    <i class="bi bi-record-circle-fill text-primary"></i>
                @else
                    <i class="bi bi-circle text-muted"></i>
                @endif
                <span class="{{ ($currentIdx !== false && $i === $currentIdx) ? 'fw-bold text-dark' : '' }}">
                    {{ $stepLabel }}
                </span>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
