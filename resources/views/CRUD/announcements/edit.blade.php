@extends('CRUD.layouts.admin')

@section('title', 'Edit Pengumuman - Admin')
@section('page-title', 'Edit Pengumuman')
@section('page-description', 'Perbarui informasi pengumuman')

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

    /* Current image box */
    .current-img-box {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: #f9fafb;
        border: 1.5px solid #e5e7eb;
        border-radius: 12px;
        padding: 0.85rem 1rem;
        margin-bottom: 1rem;
    }
    .current-img-box img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 10px;
        flex-shrink: 0;
    }
    .current-img-box .img-meta { font-size: 0.82rem; color: #6b7280; }
    .current-img-box .img-meta strong { display: block; color: #374151; font-size: 0.85rem; margin-bottom: 2px; }

    /* File input custom */
    .file-upload-area {
        border: 2px dashed #e5e7eb;
        border-radius: 12px;
        padding: 1.25rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background: #fafafa;
        position: relative;
    }
    .file-upload-area:hover { border-color: #2d5016; background: #f0f7eb; }
    .file-upload-area input[type="file"] {
        position: absolute; inset: 0;
        opacity: 0; cursor: pointer;
        width: 100%; height: 100%;
    }
    .file-upload-area .upload-icon { font-size: 1.5rem; color: #d1d5db; margin-bottom: 0.4rem; }
    .file-upload-area .upload-text  { font-size: 0.83rem; color: #6b7280; }
    .file-upload-area .upload-hint  { font-size: 0.73rem; color: #9ca3af; margin-top: 0.15rem; }

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

    /* Sidebar cards */
    .info-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid rgba(0,0,0,0.06);
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        overflow: hidden;
        margin-bottom: 1.25rem;
    }
    .info-card-header {
        background: #f9fafb;
        padding: 0.85rem 1.25rem;
        border-bottom: 1px solid #f3f4f6;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-weight: 700;
        font-size: 0.87rem;
        color: #374151;
    }
    .info-card-body { padding: 1.25rem; }

    .meta-row {
        display: flex;
        flex-direction: column;
        gap: 0.15rem;
        padding: 0.6rem 0;
        border-bottom: 1px dashed #f3f4f6;
        font-size: 0.83rem;
    }
    .meta-row:last-child { border-bottom: none; }
    .meta-row .meta-label { color: #9ca3af; font-weight: 600; font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.8px; }
    .meta-row .meta-value { color: #111827; font-weight: 500; }

    .sidebar-btn {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.65rem 1rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.87rem;
        text-decoration: none;
        transition: all 0.2s;
        border: none;
        width: 100%;
        cursor: pointer;
    }
    .sidebar-btn.preview {
        background: #f0fdf4;
        color: #15803d;
        border: 1.5px solid #bbf7d0;
    }
    .sidebar-btn.preview:hover { background: #dcfce7; }
    .sidebar-btn.danger {
        background: #fff5f5;
        color: #b91c1c;
        border: 1.5px solid #fecaca;
    }
    .sidebar-btn.danger:hover { background: #fee2e2; }

    /* Delete confirm modal */
    .del-modal-overlay {
        display: none;
        position: fixed; inset: 0;
        background: rgba(0,0,0,0.45);
        z-index: 9998;
        align-items: center;
        justify-content: center;
    }
    .del-modal-overlay.show { display: flex; }
    .del-modal {
        background: #fff;
        border-radius: 18px;
        padding: 2rem;
        max-width: 400px;
        width: 90%;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }
    .del-modal .icon-wrap {
        width: 60px; height: 60px;
        background: #fee2e2;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.6rem;
        color: #b91c1c;
    }
</style>
@endpush

@section('content')
<div class="row g-4">
    <!-- Main Form -->
    <div class="col-lg-8">
        <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Informasi Dasar -->
            <div class="form-card">
                <div class="form-section-title">Informasi Dasar</div>

                <div class="mb-4">
                    <label for="title" class="form-label">Judul Pengumuman <span class="text-danger">*</span></label>
                    <input type="text"
                           class="form-control @error('title') is-invalid @enderror"
                           id="title"
                           name="title"
                           value="{{ old('title', $announcement->title) }}"
                           placeholder="Masukkan judul pengumuman"
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
                              placeholder="Ringkasan singkat pengumuman"
                              required>{{ old('description', $announcement->description) }}</textarea>
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
                              placeholder="Tulis isi lengkap pengumuman di sini...">{{ old('content', $announcement->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Gambar -->
            <div class="form-card">
                <div class="form-section-title">Gambar</div>

                @if($announcement->image)
                <div class="current-img-box">
                    <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }}">
                    <div class="img-meta">
                        <strong>Gambar saat ini</strong>
                        Ganti dengan mengunggah gambar baru, atau biarkan kosong untuk mempertahankan gambar ini.
                    </div>
                </div>
                @endif

                <div class="file-upload-area">
                    <input type="file"
                           id="image"
                           name="image"
                           accept="image/*"
                           onchange="previewImage(this)">
                    <div class="upload-icon"><i class="bi bi-cloud-arrow-up"></i></div>
                    <div class="upload-text fw-semibold">{{ $announcement->image ? 'Ganti gambar' : 'Unggah gambar' }}</div>
                    <div class="upload-hint">JPG, PNG, GIF &mdash; Maksimal 2MB</div>
                </div>
                @error('image')
                    <div class="text-danger mt-2" style="font-size:0.82rem;">{{ $message }}</div>
                @enderror

                <div id="imagePreview" style="display:none;">
                    <p class="form-hint mb-1 mt-3">Preview gambar baru:</p>
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
                               value="{{ old('date', $announcement->date->format('Y-m-d')) }}"
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
                            <option value="active"   {{ old('status', $announcement->status) == 'active'   ? 'selected' : '' }}>Aktif — Tampil di Website</option>
                            <option value="inactive" {{ old('status', $announcement->status) == 'inactive' ? 'selected' : '' }}>Nonaktif — Disembunyikan</option>
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
                    <i class="bi bi-check-lg"></i> Perbarui Pengumuman
                </button>
                <a href="{{ route('admin.announcements.index') }}" class="btn-cancel">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Metadata -->
        <div class="info-card">
            <div class="info-card-header">
                <i class="bi bi-info-circle-fill" style="color:#6b7280;"></i> Info Pengumuman
            </div>
            <div class="info-card-body">
                <div class="meta-row">
                    <span class="meta-label">ID</span>
                    <span class="meta-value">#{{ $announcement->id }}</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Dibuat</span>
                    <span class="meta-value">{{ $announcement->created_at->format('d M Y, H:i') }}</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Terakhir diubah</span>
                    <span class="meta-value">{{ $announcement->updated_at->format('d M Y, H:i') }}</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Status Saat Ini</span>
                    <span class="meta-value">
                        @if($announcement->status == 'active')
                            <span style="color:#15803d; font-weight:700;">● Aktif</span>
                        @else
                            <span style="color:#6b7280; font-weight:700;">● Nonaktif</span>
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="info-card">
            <div class="info-card-header">
                <i class="bi bi-lightning-fill" style="color:#d97706;"></i> Aksi Cepat
            </div>
            <div class="info-card-body d-flex flex-column gap-2">
                <a href="{{ route('announcements.show', $announcement) }}"
                   class="sidebar-btn preview"
                   target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i> Lihat di Website
                </a>
                <button type="button"
                        class="sidebar-btn danger"
                        onclick="document.getElementById('deleteModal').classList.add('show')">
                    <i class="bi bi-trash3"></i> Hapus Pengumuman Ini
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Form -->
<form id="delete-form"
      action="{{ route('admin.announcements.destroy', $announcement) }}"
      method="POST"
      class="d-none">
    @csrf
    @method('DELETE')
</form>

<!-- Delete Confirm Modal -->
<div class="del-modal-overlay" id="deleteModal">
    <div class="del-modal">
        <div class="icon-wrap"><i class="bi bi-trash3"></i></div>
        <h5 class="fw-bold mb-1" style="font-family:'Sora',sans-serif;">Hapus Pengumuman?</h5>
        <p class="text-muted mb-1" style="font-size:0.9rem;">Anda akan menghapus:</p>
        <p class="fw-semibold text-dark mb-4" style="font-size:0.88rem;">&ldquo;{{ Str::limit($announcement->title, 60) }}&rdquo;</p>
        <p class="text-muted mb-4" style="font-size:0.82rem;">Tindakan ini <strong>tidak dapat dibatalkan</strong>.</p>
        <div class="d-flex gap-2 justify-content-center">
            <button onclick="document.getElementById('deleteModal').classList.remove('show')"
                    class="btn btn-light fw-semibold px-4"
                    style="border-radius:10px;">
                Batal
            </button>
            <button onclick="document.getElementById('delete-form').submit()"
                    class="btn btn-danger fw-semibold px-4"
                    style="border-radius:10px;">
                Ya, Hapus
            </button>
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

// Close modal on overlay click
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) this.classList.remove('show');
});
</script>
@endpush
