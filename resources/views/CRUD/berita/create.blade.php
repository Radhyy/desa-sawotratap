@extends('CRUD.layouts.admin')

@section('title', 'Tambah Berita - Admin')
@section('page-title', 'Tambah Berita')
@section('page-description', 'Tulis berita baru untuk website desa')

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

    .file-upload-area {
        border: 2px dashed #e5e7eb; border-radius: 12px;
        padding: 1.5rem; text-align: center; cursor: pointer;
        transition: all 0.2s; background: #fafafa; position: relative;
    }
    .file-upload-area:hover { border-color: #2d5016; background: #f0f7eb; }
    .file-upload-area input[type="file"] {
        position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
    }
    .file-upload-area .upload-icon { font-size: 1.8rem; color: #d1d5db; margin-bottom: 0.5rem; }
    .file-upload-area .upload-text  { font-size: 0.85rem; color: #6b7280; }
    .file-upload-area .upload-hint  { font-size: 0.75rem; color: #9ca3af; margin-top: 0.2rem; }
    #imagePreview img { max-width: 100%; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.1); margin-top: 1rem; }

    /* Toggle trending */
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

    /* Tags input */
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
        display: inline-flex; align-items: center; gap: 8px;
        transition: all 0.2s; cursor: pointer;
    }
    .btn-submit:hover { background: #2d5016; transform: translateY(-1px); box-shadow: 0 6px 16px rgba(21,44,10,0.25); }
    .btn-cancel {
        background: #f3f4f6; color: #374151; border: none; border-radius: 10px;
        padding: 0.65rem 1.3rem; font-weight: 600; font-size: 0.9rem;
        display: inline-flex; align-items: center; gap: 8px; text-decoration: none; transition: all 0.2s;
    }
    .btn-cancel:hover { background: #e5e7eb; color: #111827; }

    /* Info sidebar */
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
    .info-row {
        display: flex; align-items: flex-start; gap: 0.75rem;
        padding: 0.55rem 0; border-bottom: 1px dashed #f3f4f6; font-size: 0.83rem; color: #6b7280;
    }
    .info-row:last-child { border-bottom: none; }
    .info-row i { margin-top: 2px; color: #2d5016; flex-shrink: 0; }

    /* Category select options styling */
    .category-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; }
    .cat-option {
        border: 1.5px solid #e5e7eb; border-radius: 10px; padding: 0.5rem 0.75rem;
        cursor: pointer; text-align: center; font-size: 0.82rem; font-weight: 600;
        color: #6b7280; background: #fafafa; transition: all 0.2s;
    }
    .cat-option:hover, .cat-option.selected { border-color: #2d5016; color: #2d5016; background: #f0fdf4; }
    .cat-option input { display: none; }
</style>
@endpush

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Informasi Utama -->
            <div class="form-card">
                <div class="form-section-title">Informasi Utama</div>

                <div class="mb-4">
                    <label for="title" class="form-label">Judul Berita <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                           id="title" name="title" value="{{ old('title') }}"
                           placeholder="Masukkan judul berita yang menarik" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label for="excerpt" class="form-label">Ringkasan / Excerpt <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('excerpt') is-invalid @enderror"
                              id="excerpt" name="excerpt" rows="3"
                              placeholder="Ringkasan singkat berita yang menarik perhatian pembaca..." required>{{ old('excerpt') }}</textarea>
                    @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="form-hint">Akan tampil di halaman daftar berita sebagai teaser</div>
                </div>

                <div class="mb-0">
                    <label for="content" class="form-label">Isi Berita <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                    <textarea class="form-control @error('content') is-invalid @enderror"
                              id="content" name="content" rows="8"
                              placeholder="Tulis isi lengkap berita di sini...">{{ old('content') }}</textarea>
                    @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <!-- Gambar -->
            <div class="form-card">
                <div class="form-section-title">Gambar Sampul</div>
                <div class="file-upload-area">
                    <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                    <div class="upload-icon"><i class="bi bi-image-alt"></i></div>
                    <div class="upload-text fw-semibold">Klik atau seret gambar ke sini</div>
                    <div class="upload-hint">JPG, PNG, GIF, WEBP &mdash; Maksimal 2MB</div>
                </div>
                @error('image')<div class="text-danger mt-2" style="font-size:0.82rem;">{{ $message }}</div>@enderror
                <div id="imagePreview" style="display:none;">
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
                            <option value="" disabled selected>Pilih kategori...</option>
                            @foreach(['Pemerintahan','Kesehatan','Pendidikan','Infrastruktur','Ekonomi','Sosial','Budaya','Lingkungan','Olahraga','Lainnya'] as $cat)
                            <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                        @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="author" class="form-label">Penulis <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('author') is-invalid @enderror"
                               id="author" name="author" value="{{ old('author', Auth::user()->name) }}"
                               placeholder="Nama penulis" required>
                        @error('author')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="date" class="form-label">Tanggal Berita <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror"
                               id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                        @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="read_time" class="form-label">Estimasi Baca</label>
                        <input type="text" class="form-control @error('read_time') is-invalid @enderror"
                               id="read_time" name="read_time" value="{{ old('read_time', '3 menit') }}"
                               placeholder="Contoh: 5 menit">
                        @error('read_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label d-block">Tags</label>
                    <div class="tag-input-wrapper" id="tagWrapper" onclick="document.getElementById('tagInput').focus()">
                        <input type="text" id="tagInput" class="tag-real-input" placeholder="Ketik tag lalu tekan Enter atau koma...">
                    </div>
                    <input type="hidden" name="tags" id="tagsHidden" value="{{ old('tags') }}">
                    <div class="form-hint">Pisahkan dengan koma atau tekan Enter</div>
                </div>

                <div class="mb-0">
                    <label class="form-label d-block">Tandai sebagai Trending</label>
                    <div class="toggle-wrapper">
                        <input type="checkbox" id="trending" name="trending" {{ old('trending') ? 'checked' : '' }}>
                        <label class="toggle-track" for="trending"></label>
                        <span class="toggle-label">Tampilkan di bagian Trending / Unggulan</span>
                    </div>
                </div>
            </div>

            <!-- Action -->
            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-lg"></i> Simpan Berita
                </button>
                <a href="{{ route('admin.berita.index') }}" class="btn-cancel">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <div class="info-card">
            <div class="info-card-header"><i class="bi bi-lightbulb-fill text-warning"></i> Panduan Penulisan</div>
            <div class="info-card-body">
                <div class="info-row"><i class="bi bi-type-h1"></i><span><strong>Judul</strong> yang baik singkat, jelas, dan mengandung kata kunci.</span></div>
                <div class="info-row"><i class="bi bi-card-text"></i><span><strong>Ringkasan</strong> 2-3 kalimat pembuka yang menarik pembaca.</span></div>
                <div class="info-row"><i class="bi bi-image"></i><span><strong>Gambar sampul</strong> disarankan ukuran landscape (16:9), min. 800x450px.</span></div>
                <div class="info-row"><i class="bi bi-tags"></i><span><strong>Tags</strong> membantu pencarian. Tambahkan 2-5 tag relevan.</span></div>
                <div class="info-row"><i class="bi bi-fire"></i><span>Aktifkan <strong>Trending</strong> agar berita muncul di seksi unggulan homepage.</span></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Image preview
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

// Load old tags if any
const oldVal = tagsHidden.value.trim();
if (oldVal) { oldVal.split(',').forEach(t => t.trim() && addTag(t.trim())); }

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
        if (lastChip) {
            removeTag(tags[tags.length - 1], lastChip.querySelector('button'));
        }
    }
});
tagInput.addEventListener('blur', () => {
    if (tagInput.value.trim()) addTag(tagInput.value.trim());
});
</script>
@endpush
