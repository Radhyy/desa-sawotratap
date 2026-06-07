@extends('CRUD.layouts.admin')

@section('title', 'Tambah Pengumuman - Admin')
@section('page-title', 'Tambah Pengumuman')
@section('page-description', 'Buat pengumuman baru untuk website desa')

@push('styles')
<style>
    .form-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid rgba(0,0,0,0.06);
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        padding: 2rem;
        margin-bottom: 1.5rem;
    }
    .form-section-title {
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        color: #9ca3af;
        margin-bottom: 1.25rem;
        padding-bottom: 0.6rem;
        border-bottom: 1px dashed #e5e7eb;
    }
    .form-label {
        font-weight: 600;
        font-size: 0.87rem;
        color: #374151;
        margin-bottom: 0.4rem;
    }
    .form-control, .form-select {
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        padding: 0.65rem 0.9rem;
        font-size: 0.9rem;
        color: #111827;
        transition: border-color 0.2s, box-shadow 0.2s;
        background: #fafafa;
    }
    .form-control:focus, .form-select:focus {
        border-color: #2d5016;
        box-shadow: 0 0 0 3px rgba(45,80,22,0.1);
        background: #fff;
    }
    .form-control::placeholder { color: #c4c9d4; }
    .form-control.is-invalid, .form-select.is-invalid { border-color: #ef4444; }
    .form-hint {
        font-size: 0.77rem;
        color: #9ca3af;
        margin-top: 0.35rem;
    }

    /* File input custom */
    .file-upload-area {
        border: 2px dashed #e5e7eb;
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background: #fafafa;
        position: relative;
    }
    .file-upload-area:hover { border-color: #2d5016; background: #f0f7eb; }
    .file-upload-area input[type="file"] {
        position: absolute; inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%; height: 100%;
    }
    .file-upload-area .upload-icon {
        font-size: 1.8rem;
        color: #d1d5db;
        margin-bottom: 0.5rem;
    }
    .file-upload-area .upload-text { font-size: 0.85rem; color: #6b7280; }
    .file-upload-area .upload-hint { font-size: 0.75rem; color: #9ca3af; margin-top: 0.2rem; }

    #imagePreview img {
        max-width: 100%;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        margin-top: 1rem;
    }

    /* Buttons */
    .btn-submit {
        background: #152c0a;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 0.65rem 1.5rem;
        font-weight: 700;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        cursor: pointer;
    }
    .btn-submit:hover { background: #2d5016; transform: translateY(-1px); box-shadow: 0 6px 16px rgba(21,44,10,0.25); }

    .btn-cancel {
        background: #f3f4f6;
        color: #374151;
        border: none;
        border-radius: 10px;
        padding: 0.65rem 1.3rem;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-cancel:hover { background: #e5e7eb; color: #111827; }

    /* Sidebar info card */
    .info-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid rgba(0,0,0,0.06);
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    .info-card-header {
        background: #f9fafb;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #f3f4f6;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-weight: 700;
        font-size: 0.88rem;
        color: #374151;
    }
    .info-card-body { padding: 1.25rem; }
    .info-row {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.55rem 0;
        border-bottom: 1px dashed #f3f4f6;
        font-size: 0.83rem;
        color: #6b7280;
    }
    .info-row:last-child { border-bottom: none; }
    .info-row i { margin-top: 2px; color: #2d5016; flex-shrink: 0; }
</style>
@endpush

@section('content')
<div class="row g-4">
    <!-- Main Form -->
    <div class="col-lg-8">
        <form action="{{ route('admin.announcements.store') }}" method="POST" enctype="multipart/form-data" id="createForm">
            @csrf

            <!-- Informasi Dasar -->
            <div class="form-card">
                <div class="form-section-title">Informasi Dasar</div>

                <div class="mb-4">
                    <label for="title" class="form-label">Judul Pengumuman <span class="text-danger">*</span></label>
                    <input type="text"
                           class="form-control @error('title') is-invalid @enderror"
                           id="title"
                           name="title"
                           value="{{ old('title') }}"
                           placeholder="Contoh: Jadwal Posyandu Bulan Februari 2026"
                           required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">Deskripsi Singkat <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description"
                              name="description"
                              rows="3"
                              placeholder="Ringkasan singkat yang akan muncul di daftar pengumuman..."
                              required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-hint">Akan tampil sebagai preview di halaman daftar pengumuman</div>
                </div>

                <div class="mb-0">
                    <label for="content" class="form-label">Konten Lengkap <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                    <textarea class="form-control @error('content') is-invalid @enderror"
                              id="content"
                              name="content"
                              rows="7"
                              placeholder="Tulis isi lengkap pengumuman di sini...">{{ old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Gambar -->
            <div class="form-card">
                <div class="form-section-title">Gambar</div>
                <div class="file-upload-area" id="uploadArea">
                    <input type="file"
                           id="image"
                           name="image"
                           accept="image/*"
                           onchange="previewImage(this)">
                    <div class="upload-icon"><i class="bi bi-image-alt"></i></div>
                    <div class="upload-text fw-semibold">Klik atau seret gambar ke sini</div>
                    <div class="upload-hint">JPG, PNG, GIF &mdash; Maksimal 2MB</div>
                </div>
                @error('image')
                    <div class="text-danger mt-2" style="font-size:0.82rem;">{{ $message }}</div>
                @enderror
                <div id="imagePreview" style="display:none;">
                    <img id="preview" src="" alt="Preview">
                </div>
            </div>

            <!-- Tanggal & Status -->
            <div class="form-card">
                <div class="form-section-title">Pengaturan</div>
                <div class="row g-3 mb-0">
                    <div class="col-md-6">
                        <label for="date" class="form-label">Tanggal Pengumuman <span class="text-danger">*</span></label>
                        <input type="date"
                               class="form-control @error('date') is-invalid @enderror"
                               id="date"
                               name="date"
                               value="{{ old('date', date('Y-m-d')) }}"
                               required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror"
                                id="status"
                                name="status"
                                required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif — Tampil di Website</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Nonaktif — Disembunyikan</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-lg"></i> Simpan Pengumuman
                </button>
                <a href="{{ route('admin.announcements.index') }}" class="btn-cancel">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>

    <!-- Sidebar Panduan -->
    <div class="col-lg-4">
        <div class="info-card">
            <div class="info-card-header">
                <i class="bi bi-lightbulb-fill text-warning"></i> Panduan Pengisian
            </div>
            <div class="info-card-body">
                <div class="info-row">
                    <i class="bi bi-type-h1"></i>
                    <span><strong>Judul</strong> maksimal 255 karakter. Gunakan judul yang jelas dan deskriptif.</span>
                </div>
                <div class="info-row">
                    <i class="bi bi-card-text"></i>
                    <span><strong>Deskripsi singkat</strong> akan tampil di halaman daftar pengumuman sebagai preview.</span>
                </div>
                <div class="info-row">
                    <i class="bi bi-file-text"></i>
                    <span><strong>Konten lengkap</strong> bisa dikosongkan jika tidak ada detail tambahan.</span>
                </div>
                <div class="info-row">
                    <i class="bi bi-image"></i>
                    <span><strong>Gambar</strong> bersifat opsional. Format JPG/PNG/GIF, maks. 2MB.</span>
                </div>
                <div class="info-row">
                    <i class="bi bi-toggle-on"></i>
                    <span>Pilih <strong>"Aktif"</strong> agar pengumuman langsung tampil di website.</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').style.display = 'block';
            document.getElementById('preview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
