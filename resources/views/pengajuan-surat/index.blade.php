@extends('layouts.app')

@section('title', 'Pengajuan Surat - Desa Sawotratap')

@section('styles')
<style>
    .letter-page {
        padding-top: 138px;
        padding-bottom: 56px;
        min-height: 100vh;
        background:
            radial-gradient(circle at top right, rgba(22, 163, 74, 0.09), transparent 42%),
            radial-gradient(circle at bottom left, rgba(34, 197, 94, 0.08), transparent 40%),
            #f7fbf8;
        position: relative;
        overflow: hidden;
    }

    .letter-shell {
        position: relative;
        z-index: 1;
    }

    .letter-hero {
        border-radius: 22px;
        padding: 2rem;
        margin-bottom: 1.25rem;
        color: #fff;
        background: linear-gradient(135deg, #166534 0%, #15803d 55%, #22c55e 100%);
        box-shadow: 0 16px 36px rgba(22, 101, 52, 0.25);
        position: relative;
        overflow: hidden;
    }

    .letter-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.08) 1px, transparent 1px);
        background-size: 30px 30px;
        opacity: 0.2;
    }

    .letter-hero h1 {
        position: relative;
        z-index: 1;
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 0.45rem;
    }

    .letter-hero p {
        position: relative;
        z-index: 1;
        margin: 0;
        color: rgba(255, 255, 255, 0.92);
        max-width: 760px;
    }

    .letter-grid {
        display: grid;
        grid-template-columns: 1.4fr 0.9fr;
        gap: 1rem;
    }

    .letter-card {
        background: #fff;
        border: 1px solid #dcfce7;
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.06);
    }

    .letter-card .head {
        padding: 1rem 1.2rem;
        border-bottom: 1px solid #ecfdf5;
        display: flex;
        align-items: center;
        gap: 0.55rem;
    }

    .letter-card .head h2 {
        font-size: 1.08rem;
        font-weight: 700;
        color: #166534;
        margin: 0;
    }

    .letter-body {
        padding: 1.1rem 1.2rem 1.2rem;
    }

    .form-label {
        font-weight: 600;
        color: #166534;
        margin-bottom: 0.4rem;
    }

    .form-control,
    .form-select,
    textarea {
        border-radius: 12px !important;
        border: 1px solid #bbf7d0 !important;
        padding: 0.72rem 0.85rem !important;
    }

    .form-control:focus,
    .form-select:focus,
    textarea:focus {
        box-shadow: 0 0 0 0.2rem rgba(34, 197, 94, 0.15) !important;
        border-color: #22c55e !important;
    }

    .help-text {
        font-size: 0.82rem;
        color: #6b7280;
        margin-top: 0.25rem;
    }

    .btn-submit {
        background: linear-gradient(135deg, #15803d, #22c55e);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        padding: 0.75rem 1.2rem;
        transition: all 0.2s ease;
    }

    .btn-submit:hover {
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(22, 163, 74, 0.25);
    }

    .btn-reset {
        border-radius: 12px;
        font-weight: 700;
        padding: 0.75rem 1.2rem;
    }

    .requirements {
        margin: 0;
        padding-left: 1.1rem;
    }

    .requirements li {
        color: #374151;
        margin-bottom: 0.5rem;
        line-height: 1.55;
        font-size: 0.92rem;
    }

    .letter-mini {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 12px;
        padding: 0.85rem;
        margin-bottom: 0.75rem;
    }

    .letter-mini h3 {
        margin: 0 0 0.3rem;
        color: #166534;
        font-size: 0.94rem;
        font-weight: 700;
    }

    .letter-mini p {
        margin: 0;
        color: #4b5563;
        font-size: 0.86rem;
        line-height: 1.45;
    }

    @media (max-width: 992px) {
        .letter-grid {
            grid-template-columns: 1fr;
        }

        .letter-page {
            padding-top: 130px;
        }
    }
</style>
@endsection

@section('content')
<div class="letter-page">
    <div class="container letter-shell">
        <section class="letter-hero">
            <h1>Pengajuan Surat</h1>
            <p>
                Ajukan kebutuhan surat administrasi desa secara online. Isi formulir dengan lengkap,
                lalu tim desa akan memproses pengajuan Anda.
            </p>
        </section>

        <div class="letter-grid">
            <section class="letter-card">
                <div class="head">
                    <i class="bi bi-file-earmark-text"></i>
                    <h2>Form Pengajuan Surat</h2>
                </div>
                <div class="letter-body">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" placeholder="Masukkan nama lengkap">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">NIK</label>
                                <input type="text" class="form-control" placeholder="16 digit NIK">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. KK</label>
                                <input type="text" class="form-control" placeholder="Nomor kartu keluarga">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. WhatsApp</label>
                                <input type="text" class="form-control" placeholder="Contoh: 08xxxxxxxxxx">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenis Surat</label>
                                <select class="form-select">
                                    <option selected disabled>Pilih jenis surat</option>
                                    <option>Surat Keterangan Domisili</option>
                                    <option>Surat Keterangan Usaha</option>
                                    <option>Surat Keterangan Tidak Mampu</option>
                                    <option>Surat Pengantar SKCK</option>
                                    <option>Surat Pengantar Nikah</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Pengambilan</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Keperluan</label>
                                <textarea rows="4" class="form-control" placeholder="Tuliskan keperluan pengajuan surat"></textarea>
                                <div class="help-text">Isi alasan/keperluan secara jelas agar proses verifikasi lebih cepat.</div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Upload Dokumen Pendukung (Opsional)</label>
                                <input type="file" class="form-control">
                                <div class="help-text">Format: PDF/JPG/PNG, maksimal 2MB.</div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-2 mt-4">
                            <button type="submit" class="btn btn-submit">
                                <i class="bi bi-send me-1"></i>Kirim Pengajuan
                            </button>
                            <button type="reset" class="btn btn-outline-secondary btn-reset">
                                <i class="bi bi-arrow-counterclockwise me-1"></i>Reset Form
                            </button>
                        </div>
                    </form>
                </div>
            </section>

            <aside class="letter-card">
                <div class="head">
                    <i class="bi bi-info-circle"></i>
                    <h2>Informasi Layanan</h2>
                </div>
                <div class="letter-body">
                    <div class="letter-mini">
                        <h3><i class="bi bi-clock-history me-1"></i>Estimasi Proses</h3>
                        <p>1-2 hari kerja setelah data diverifikasi oleh petugas desa.</p>
                    </div>
                    <div class="letter-mini">
                        <h3><i class="bi bi-person-check me-1"></i>Verifikasi Data</h3>
                        <p>Pastikan NIK dan No. KK sesuai data kependudukan.</p>
                    </div>
                    <div class="letter-mini">
                        <h3><i class="bi bi-telephone me-1"></i>Butuh Bantuan?</h3>
                        <p>Hubungi kantor desa pada jam pelayanan untuk informasi lanjutan.</p>
                    </div>

                    <h3 style="font-size:0.98rem; color:#166534; font-weight:700; margin-top:1rem;">Persyaratan Umum</h3>
                    <ul class="requirements">
                        <li>Warga berdomisili di wilayah Desa Sawotratap.</li>
                        <li>Data identitas harus valid dan aktif.</li>
                        <li>Membawa dokumen asli saat pengambilan surat.</li>
                        <li>Pengajuan dapat ditolak jika data tidak sesuai.</li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection
