@extends('CRUD.layouts.admin')

@section('title', 'Edit Berita - Admin')
@section('page-title', 'Edit Berita')
@section('page-description', 'Perbarui informasi berita')

@push('styles')
<style>
    .form-card {
        background: #fff; border-radius: 16px;
        border: 1px solid rgba(0,0,0,0.06);
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        padding: 2rem; margin-bottom: 1.5rem;
    }
    .form-section-title {
        font-size: 0.7rem; font-weight: 700; letter-spacing: 1.2px;
        text-transform: uppercase; color: #9ca3af;
        margin-bottom: 1.25rem; padding-bottom: 0.6rem;
        border-bottom: 1px dashed #e5e7eb;
    }
    .form-label { font-weight: 600; font-size: 0.87rem; color: #374151; margin-bottom: 0.4rem; }
    .form-control, .form-select {
        border: 1.5px solid #e5e7eb; border-radius: 10px;
        padding: 0.65rem 0.9rem; font-size: 0.9rem; color: #111827;
        transition: border-color 0.2s, box-shadow 0.2s; background: #fafafa;
    }
    .form-control:focus, .form-select:focus {
        border-color: #2d5016; box-shadow: 0 0 0 3px rgba(45,80,22,0.1); background: #fff;
    }
    .form-control::placeholder { color: #c4c9d4; }
    .form-control.is-invalid, .form-select.is-invalid { border-color: #ef4444; }
    .form-hint { font-size: 0.77rem; color: #9ca3af; margin-top: 0.35rem; }

    .current-img-box {
        display: flex; align-items: center; gap: 1rem;
        background: #f9fafb; border: 1.5px solid #e5e7eb;
        border-radius: 12px; padding: 0.85rem 1rem; margin-bottom: 1rem;
    }
    .current-img-box img { width: 70px; height: 70px; object-fit: cover; border-radius: 10px; flex-shrink: 0; }
    .current-img-box .img-meta { font-size: 0.82rem; color: #6b7280; }
    .current-img-box .img-meta strong { display: block; color: #374151; font-size: 0.85rem; margin-bottom: 2px; }

    .file-upload-area {
        border: 2px dashed #e5e7eb; border-radius: 12px;
        padding: 1.25rem; text-align: center; cursor: pointer;
        transition: all 0.2s; background: #fafafa; position: relative;
    }
    .file-upload-area:hover { border-color: #2d5016; background: #f0f7eb; }
    .file-upload-area input[type="file"] {
        position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
    }
    .file-upload-area .upload-icon { font-size: 1.5rem; color: #d1d5db; margin-bottom: 0.4rem; }
    .file-upload-area .upload-text  { font-size: 0.83rem; color: #6b7280; }
    .file-upload-area .upload-hint  { font-size: 0.73rem; color: #9ca3af; margin-top: 0.15rem; }
    #imagePreview img { max-width: 100%; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.1); margin-top: 1rem; }

    /* Toggle */
    .toggle-wrapper { display: flex; align-items: center; gap: 0.75rem; }
    .toggle-wrapper input[type="checkbox"] { display: none; }
    .toggle-track {
        width: 44px; height: 24px; border-radius: 99px; background: #e5e7eb;
        cursor: pointer; position: relative; transition: background 0.2s; flex-shrink: 0;
    }
    .toggle-track::after {
        content: ''; position: absolute; top: 3px; left: 3px;
        width: 18px; height: 18px; border-radius: 50%; background: white;
        box-shadow: 0 1px 4px rgba(0,0,0,0.2); transition: transform 0.2s;
    }
    input[type="checkbox"]:checked + .toggle-track { background: #2d5016; }
    input[type="checkbox"]:checked + .toggle-track::after { transform: translateX(20px); }
    .toggle-label { font-size: 0.87rem; color: #374151; font-weight: 500; cursor: pointer; }

    /* Tag chip */
    .tag-input-wrapper {
        border: 1.5px solid #e5e7eb; border-radius: 10px;
        padding: 0.5rem 0.9rem; display: flex; flex-wrap: wrap; gap: 6px;
        background: #fafafa; cursor: text; transition: border-color 0.2s;
    }
    .tag-input-wrapper:focus-within { border-color: #2d5016; box-shadow: 0 0 0 3px rgba(45,80,22,0.1); background: #fff; }
    .tag-chip {
        display: inline-flex; align-items: center; gap: 5px;
        background: #f0fdf4; color: #15803d; border-radius: 99px;
        padding: 2px 10px; font-size: 0.78rem; font-weight: 600;
    }
    .tag-chip button { background: none; border: none; padding: 0; color: #15803d; cursor: pointer; font-size: 0.75rem; line-height: 1; }
    .tag-real-input { border: none; outline: none; background: transparent; font-size: 0.88rem; flex: 1; min-width: 120px; color: #111827; }

    /* Buttons */
    .btn-submit {
        background: #152c0a; color: #fff; border: none; border-radius: 10px;
        padding: 0.65rem 1.5rem; font-weight: 700; font-size: 0.9rem;
        display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s; cursor: pointer;
    }
    .btn-submit:hover { background: #2d5016; transform: translateY(-1px); box-shadow: 0 6px 16px rgba(21,44,10,0.25); }
    .btn-cancel {
        background: #f3f4f6; color: #374151; border: none; border-radius: 10px;
        padding: 0.65rem 1.3rem; font-weight: 600; font-size: 0.9rem;
        display: inline-flex; align-items: center; gap: 8px; text-decoration: none; transition: all 0.2s;
    }
    .btn-cancel:hover { background: #e5e7eb; color: #111827; }

    /* Sidebar */
    .info-card {
        background: #fff; border-radius: 16px;
        border: 1px solid rgba(0,0,0,0.06);
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        overflow: hidden; margin-bottom: 1.25rem;
    }
    .info-card-header {
        background: #f9fafb; padding: 0.85rem 1.25rem;
        border-bottom: 1px solid #f3f4f6;
        display: flex; align-items: center; gap: 0.6rem;
        font-weight: 700; font-size: 0.87rem; color: #374151;
    }
    .info-card-body { padding: 1.25rem; }
    .meta-row {
        display: flex; flex-direction: column; gap: 0.15rem;
        padding: 0.6rem 0; border-bottom: 1px dashed #f3f4f6; font-size: 0.83rem;
    }
    .meta-row:last-child { border-bottom: none; }
    .meta-row .meta-label { color: #9ca3af; font-weight: 600; font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.8px; }
    .meta-row .meta-value { color: #111827; font-weight: 500; }
    .sidebar-btn {
        display: flex; align-items: center; gap: 0.6rem;
        padding: 0.65rem 1rem; border-radius: 10px; font-weight: 600;
        font-size: 0.87rem; text-decoration: none; transition: all 0.2s;
        border: none; width: 100%; cursor: pointer;
    }
    .sidebar-btn.preview { background: #f0fdf4; color: #15803d; border: 1.5px solid #bbf7d0; }
    .sidebar-btn.preview:hover { background: #dcfce7; }
    .sidebar-btn.danger  { background: #fff5f5; color: #b91c1c; border: 1.5px solid #fecaca; }
    .sidebar-btn.danger:hover  { background: #fee2e2; }

    /* Delete modal */
    .del-modal-overlay {
        display: none; position: fixed; inset: 0;
        background: rgba(0,0,0,0.45); z-index: 9998;
        align-items: center; justify-content: center;
    }
    .del-modal-overlay.show { display: flex; }
    .del-modal {
        background: #fff; border-radius: 18px; padding: 2rem;
        max-width: 400px; width: 90%; text-align: center;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }
    .del-modal .icon-wrap {
        width: 60px; height: 60px; background: #fee2e2; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1rem; font-size: 1.6rem; color: #b91c1c;
    }
</style>
@endpush

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Informasi Utama -->
            <div class="form-card">
                <div class="form-section-title">Informasi Utama</div>

                <div class="mb-4">
                    <label for="title" class="form-label">Judul Berita <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                           id="title" name="title"
                           value="{{ old('title', $berita->title) }}"
                           placeholder="Masukkan judul berita" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label for="excerpt" class="form-label">Ringkasan / Excerpt <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('excerpt') is-invalid @enderror"
                              id="excerpt" name="excerpt" rows="3"
                              placeholder="Ringkasan singkat berita..." required>{{ old('excerpt', $berita->excerpt) }}</textarea>
                    @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="form-hint">Akan tampil di halaman daftar berita sebagai teaser</div>
                </div>

                <div class="mb-0">
                    <label for="content" class="form-label">Isi Berita <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                    <textarea class="form-control @error('content') is-invalid @enderror"
                              id="content" name="content" rows="8"
                              placeholder="Tulis isi lengkap berita di sini...">{{ old('content', $berita->content) }}</textarea>
                    @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <!-- Gambar -->
            <div class="form-card">
                <div class="form-section-title">Gambar Sampul</div>
                @if($berita->image)
                <div class="current-img-box">
                    <img src="{{ Str::startsWith($berita->image, ['http://', 'https://']) ? $berita->image : asset('storage/' . $berita->image) }}" alt="{{ $berita->title }}">
                    <div class="img-meta">
                        <strong>Gambar saat ini</strong>
                        Ganti dengan mengunggah gambar baru, atau biarkan kosong untuk mempertahankan gambar ini.
                    </div>
                </div>
                @endif
                <div class="file-upload-area">
                    <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                    <div class="upload-icon"><i class="bi bi-cloud-arrow-up"></i></div>
                    <div class="upload-text fw-semibold">{{ $berita->image ? 'Ganti gambar' : 'Unggah gambar' }}</div>
                    <div class="upload-hint">JPG, PNG, GIF, WEBP &mdash; Maksimal 2MB</div>
                </div>
                @error('image')<div class="text-danger mt-2" style="font-size:0.82rem;">{{ $message }}</div>@enderror
                <div id="imagePreview" style="display:none;">
                    <p class="form-hint mb-1 mt-3">Preview gambar baru:</p>
                    <img id="preview" src="" alt="Preview">
                </div>
            </div>

            <!-- Meta & Pengaturan -->
            <div class="form-card">
                <div class="form-section-title">Meta & Pengaturan</div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select class="form-select @error('category') is-invalid @enderror"
                                id="category" name="category" required>
                            <option value="" disabled>Pilih kategori...</option>
                            @foreach(['Pemerintahan','Kesehatan','Pendidikan','Infrastruktur','Ekonomi','Sosial','Budaya','Lingkungan','Olahraga','Lainnya'] as $cat)
                            <option value="{{ $cat }}" {{ old('category', $berita->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                        @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="author" class="form-label">Penulis <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('author') is-invalid @enderror"
                               id="author" name="author"
                               value="{{ old('author', $berita->author) }}"
                               placeholder="Nama penulis" required>
                        @error('author')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="date" class="form-label">Tanggal Berita <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror"
                               id="date" name="date"
                               value="{{ old('date', $berita->date->format('Y-m-d')) }}" required>
                        @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="read_time" class="form-label">Estimasi Baca</label>
                        <input type="text" class="form-control"
                               id="read_time" name="read_time"
                               value="{{ old('read_time', $berita->read_time) }}"
                               placeholder="Contoh: 5 menit">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label d-block">Tags</label>
                    <div class="tag-input-wrapper" id="tagWrapper" onclick="document.getElementById('tagInput').focus()">
                        <input type="text" id="tagInput" class="tag-real-input" placeholder="Ketik tag lalu tekan Enter atau koma...">
                    </div>
                    <input type="hidden" name="tags" id="tagsHidden" value="{{ old('tags', is_array($berita->tags) ? implode(',', $berita->tags) : $berita->tags) }}">
                    <div class="form-hint">Pisahkan dengan koma atau tekan Enter</div>
                </div>

                <div class="mb-0">
                    <label class="form-label d-block">Tandai sebagai Trending</label>
                    <div class="toggle-wrapper">
                        <input type="checkbox" id="trending" name="trending" {{ old('trending', $berita->trending) ? 'checked' : '' }}>
                        <label class="toggle-track" for="trending"></label>
                        <span class="toggle-label">Tampilkan di bagian Trending / Unggulan</span>
                    </div>
                </div>
            </div>

            <!-- Action -->
            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-lg"></i> Perbarui Berita
                </button>
                <a href="{{ route('admin.berita.index') }}" class="btn-cancel">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Metadata -->
        <div class="info-card">
            <div class="info-card-header"><i class="bi bi-info-circle-fill" style="color:#6b7280;"></i> Info Berita</div>
            <div class="info-card-body">
                <div class="meta-row">
                    <span class="meta-label">ID</span>
                    <span class="meta-value">#{{ $berita->id }}</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Kategori</span>
                    <span class="meta-value">{{ $berita->category }}</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Penulis</span>
                    <span class="meta-value">{{ $berita->author }}</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Views</span>
                    <span class="meta-value">{{ number_format($berita->views) }} kali dibaca</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Dibuat</span>
                    <span class="meta-value">{{ $berita->created_at->format('d M Y, H:i') }}</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Terakhir diubah</span>
                    <span class="meta-value">{{ $berita->updated_at->format('d M Y, H:i') }}</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Trending</span>
                    <span class="meta-value">
                        @if($berita->trending)
                            <span style="color:#c2410c; font-weight:700;">🔥 Ya</span>
                        @else
                            <span style="color:#9ca3af;">Tidak</span>
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="info-card">
            <div class="info-card-header"><i class="bi bi-lightning-fill" style="color:#d97706;"></i> Aksi Cepat</div>
            <div class="info-card-body d-flex flex-column gap-2">
                <a href="{{ route('berita.show', $berita->id) }}"
                   class="sidebar-btn preview"
                   target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i> Lihat di Website
                </a>
                <button type="button"
                        class="sidebar-btn danger"
                        onclick="document.getElementById('deleteModal').classList.add('show')">
                    <i class="bi bi-trash3"></i> Hapus Berita Ini
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Form -->
<form id="delete-form" action="{{ route('admin.berita.destroy', $berita) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

<!-- Delete Modal -->
<div class="del-modal-overlay" id="deleteModal">
    <div class="del-modal">
        <div class="icon-wrap"><i class="bi bi-trash3"></i></div>
        <h5 class="fw-bold mb-1" style="font-family:'Sora',sans-serif;">Hapus Berita?</h5>
        <p class="text-muted mb-1" style="font-size:0.9rem;">Anda akan menghapus:</p>
        <p class="fw-semibold text-dark mb-4" style="font-size:0.87rem;">&ldquo;{{ Str::limit($berita->title, 60) }}&rdquo;</p>
        <p class="text-muted mb-4" style="font-size:0.82rem;">Tindakan ini <strong>tidak dapat dibatalkan</strong>.</p>
        <div class="d-flex gap-2 justify-content-center">
            <button onclick="document.getElementById('deleteModal').classList.remove('show')"
                    class="btn btn-light fw-semibold px-4" style="border-radius:10px;">Batal</button>
            <button onclick="document.getElementById('delete-form').submit()"
                    class="btn btn-danger fw-semibold px-4" style="border-radius:10px;">Ya, Hapus</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('imagePreview').style.display = 'block';
            document.getElementById('preview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Tag input
const tagInput   = document.getElementById('tagInput');
const tagsHidden = document.getElementById('tagsHidden');
const tagWrapper = document.getElementById('tagWrapper');
let tags = [];

// Pre-load existing tags
const existingTags = tagsHidden.value.trim();
if (existingTags) {
    existingTags.split(',').forEach(t => t.trim() && addTag(t.trim()));
}

function addTag(text) {
    if (!text || tags.includes(text)) return;
    tags.push(text);
    const chip = document.createElement('span');
    chip.className = 'tag-chip';
    chip.innerHTML = `${text} <button type="button" onclick="removeTag('${text}', this)">&times;</button>`;
    tagWrapper.insertBefore(chip, tagInput);
    tagsHidden.value = tags.join(',');
    tagInput.value = '';
}

function removeTag(text, btn) {
    tags = tags.filter(t => t !== text);
    btn.parentElement.remove();
    tagsHidden.value = tags.join(',');
}

tagInput.addEventListener('keydown', e => {
    if (e.key === 'Enter' || e.key === ',') {
        e.preventDefault();
        addTag(tagInput.value.trim().replace(/,$/, ''));
    } else if (e.key === 'Backspace' && !tagInput.value && tags.length) {
        const lastChip = tagWrapper.querySelector('.tag-chip:last-of-type');
        if (lastChip) removeTag(tags[tags.length - 1], lastChip.querySelector('button'));
    }
});
tagInput.addEventListener('blur', () => {
    if (tagInput.value.trim()) addTag(tagInput.value.trim());
});

// Close modal on overlay click
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) this.classList.remove('show');
});
</script>
@endpush
