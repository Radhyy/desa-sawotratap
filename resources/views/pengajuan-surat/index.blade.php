@extends('layouts.app')

@section('title', 'Pengajuan Surat - Desa Sawotratap')

@section('styles')
<style>
    .letter-page {
        margin-top: 0;
        padding-bottom: 70px;
        min-height: 100vh;
        background:
            linear-gradient(180deg, #f8fbf7 0%, #f4f7fa 100%);
        position: relative;
        overflow: hidden;
    }

    .letter-breadcrumb {
        margin-top: 80px;
        background: #f8f9fa;
        border-bottom: 1px solid #e8ecef;
    }

    .letter-shell {
        position: relative;
        z-index: 1;
    }

    .letter-header {
        background: #f8f9fa;
        border-bottom: 1px solid #e8ecef;
    }

    .letter-header .container {
        padding-top: 44px;
        padding-bottom: 44px;
    }

    .hero-content-box {
        padding: 0;
        margin-bottom: 0;
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: 2.5rem;
    }

    .hero-subtitle {
        color: #6c757d;
        max-width: 760px;
        margin: 0 auto;
        font-size: 1.08rem;
        line-height: 1.6;
        font-weight: 400;
    }

    .letter-grid {
        display: grid;
        grid-template-columns: 1.4fr 0.9fr;
        gap: 1rem;
    }

    .letter-card {
        background: #fff;
        border: 1px solid #e4ecdf;
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(45, 80, 22, 0.08);
        overflow: hidden;
    }

    .letter-card .head {
        padding: 22px 24px;
        background: linear-gradient(135deg, rgba(74, 124, 36, 0.12), rgba(45, 80, 22, 0.08));
        border-bottom: 1px solid #e9f0e3;
        display: flex;
        align-items: center;
        gap: 0.55rem;
    }

    .letter-card .head h2 {
        font-size: 1.15rem;
        font-weight: 700;
        color: #24381f;
        margin: 0;
    }

    .letter-body {
        padding: 22px 24px 24px;
    }

    .form-label {
        color: #2c4225;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-control,
    .form-select,
    textarea {
        border-radius: 11px !important;
        border: 1px solid #c9d8c1 !important;
        padding: 0.7rem 0.86rem !important;
        font-size: 0.95rem;
    }

    .form-control:focus,
    .form-select:focus,
    textarea:focus {
        box-shadow: 0 0 0 0.2rem rgba(74, 124, 36, 0.2) !important;
        border-color: var(--light-green) !important;
    }

    .help-text {
        font-size: 0.84rem;
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

    .document-upload-container {
        margin-bottom: 1rem;
    }

    .document-item {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
        align-items: flex-start;
    }

    .document-item .form-control {
        flex: 1;
    }

    .btn-add-document {
        background: #22c55e;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-add-document:hover {
        background: #16a34a;
    }

    .btn-remove-document {
        background: #ef4444;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-remove-document:hover {
        background: #dc2626;
    }

    @media (max-width: 992px) {
        .letter-grid {
            grid-template-columns: 1fr;
        }

        .letter-header .container {
            padding-top: 34px;
            padding-bottom: 34px;
        }

        .hero-title {
            font-size: 2rem;
            line-height: 1.24;
            margin-bottom: 10px;
        }

        .hero-subtitle {
            font-size: 0.97rem;
            line-height: 1.62;
        }
    }

    @media (max-width: 767.98px) {
        .letter-page {
            padding-bottom: 40px;
        }

        .letter-card .head,
        .letter-body {
            padding: 18px;
        }
    }
</style>
@endsection

@section('content')
<div class="letter-page">
    <div class="letter-breadcrumb py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary-green);">
                            <i class="bi bi-house-door"></i> Beranda
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Pengajuan Surat</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="letter-header py-5">
        <div class="container">
            <div class="hero-content-box text-center">
                <h1 class="section-title-center hero-title">Pengajuan Surat</h1>
                <p class="hero-subtitle">
                    Ajukan kebutuhan surat administrasi desa secara online. Isi formulir dengan lengkap,
                    lalu tim desa akan memproses pengajuan Anda.
                </p>
            </div>
        </div>
    </section>

    <div class="container letter-shell section-wrap pt-4">
        <div class="letter-grid">
            <section class="letter-card">
                <div class="head">
                    <i class="bi bi-file-earmark-text"></i>
                    <h2>Form Pengajuan Surat</h2>
                </div>
                <div class="letter-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <form action="{{ route('pengajuan-surat.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('nama_lengkap') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">NIK <span class="text-danger">*</span></label>
                                <input type="text" name="nik" class="form-control" placeholder="16 digit NIK" value="{{ old('nik') }}" maxlength="16" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. KK <span class="text-danger">*</span></label>
                                <input type="text" name="no_kk" class="form-control" placeholder="Nomor kartu keluarga" value="{{ old('no_kk') }}" maxlength="16" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. WhatsApp <span class="text-danger">*</span></label>
                                <input type="text" name="no_whatsapp" class="form-control" placeholder="Contoh: 08xxxxxxxxxx" value="{{ old('no_whatsapp') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenis Surat <span class="text-danger">*</span></label>
                                <select name="jenis_surat" class="form-select" required>
                                    <option value="" selected disabled>Pilih jenis surat</option>
                                    <option value="Surat Keterangan Domisili" {{ old('jenis_surat') == 'Surat Keterangan Domisili' ? 'selected' : '' }}>Surat Keterangan Domisili</option>
                                    <option value="Surat Keterangan Usaha" {{ old('jenis_surat') == 'Surat Keterangan Usaha' ? 'selected' : '' }}>Surat Keterangan Usaha</option>
                                    <option value="Surat Keterangan Tidak Mampu" {{ old('jenis_surat') == 'Surat Keterangan Tidak Mampu' ? 'selected' : '' }}>Surat Keterangan Tidak Mampu</option>
                                    <option value="Surat Pengantar SKCK" {{ old('jenis_surat') == 'Surat Pengantar SKCK' ? 'selected' : '' }}>Surat Pengantar SKCK</option>
                                    <option value="Surat Pengantar Nikah" {{ old('jenis_surat') == 'Surat Pengantar Nikah' ? 'selected' : '' }}>Surat Pengantar Nikah</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Pengambilan <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_pengambilan" class="form-control" value="{{ old('tanggal_pengambilan') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Keperluan <span class="text-danger">*</span></label>
                                <textarea name="keperluan" rows="4" class="form-control" placeholder="Tuliskan keperluan pengajuan surat" required>{{ old('keperluan') }}</textarea>
                                <div class="help-text">Isi alasan/keperluan secara jelas agar proses verifikasi lebih cepat.</div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Upload Dokumen Pendukung (Opsional)</label>
                                <div id="document-upload-container" class="document-upload-container">
                                    <div class="document-item">
                                        <input type="file" name="dokumen[]" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                                        <button type="button" class="btn-remove-document" onclick="removeDocument(this)" style="display: none;">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="button" class="btn-add-document" onclick="addDocument()">
                                    <i class="bi bi-plus-circle me-1"></i>Tambah Dokumen
                                </button>
                                <div class="help-text">Format: PDF/JPG/PNG, maksimal 2MB per file. Anda dapat mengunggah lebih dari satu dokumen.</div>
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

@push('scripts')
<script>
    let documentCount = 1;

    function addDocument() {
        documentCount++;
        const container = document.getElementById('document-upload-container');
        const newItem = document.createElement('div');
        newItem.className = 'document-item';
        newItem.innerHTML = `
            <input type="file" name="dokumen[]" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
            <button type="button" class="btn-remove-document" onclick="removeDocument(this)">
                <i class="bi bi-trash"></i>
            </button>
        `;
        container.appendChild(newItem);
        updateRemoveButtons();
    }

    function removeDocument(button) {
        if (documentCount > 1) {
            button.closest('.document-item').remove();
            documentCount--;
            updateRemoveButtons();
        }
    }

    function updateRemoveButtons() {
        const items = document.querySelectorAll('.document-item');
        items.forEach((item, index) => {
            const removeBtn = item.querySelector('.btn-remove-document');
            if (items.length > 1) {
                removeBtn.style.display = 'block';
            } else {
                removeBtn.style.display = 'none';
            }
        });
    }

    // Validate file size on change
    document.addEventListener('change', function(e) {
        if (e.target.type === 'file' && e.target.name === 'dokumen[]') {
            const file = e.target.files[0];
            if (file && file.size > 2048 * 1024) { // 2MB in bytes
                alert('Ukuran file maksimal 2MB!');
                e.target.value = '';
            }
        }
    });
</script>
@endpush
