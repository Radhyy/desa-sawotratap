@extends('CRUD.layouts.admin')

@section('title', 'Edit Foto Galeri - Admin')
@section('page-title', 'Edit Foto Galeri')
@section('page-description', 'Perbarui informasi foto galeri')

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

    /* Upload tabs */
    .upload-tabs { display: flex; gap: 8px; margin-bottom: 1rem; }
    .upload-tab {
        padding: 7px 16px; border-radius: 8px; font-size: 0.83rem;
        font-weight: 600; cursor: pointer; border: 1.5px solid #e5e7eb;
        color: #6b7280; background: #fafafa; transition: all 0.2s;
    }
    .upload-tab.active { border-color: #2d5016; color: #2d5016; background: #f0fdf4; }

    .file-upload-area {
        border: 2px dashed #e5e7eb; border-radius: 12px;
        padding: 1.5rem; text-align: center; cursor: pointer;
        transition: all 0.2s; background: #fafafa; position: relative;
    }
    .file-upload-area:hover { border-color: #2d5016; background: #f0f7eb; }
    .file-upload-area input[type="file"] {
        position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
    }
    .file-upload-area .upload-icon { font-size: 2rem; color: #d1d5db; margin-bottom: 0.5rem; }
    .file-upload-area .upload-text  { font-size: 0.87rem; color: #6b7280; font-weight: 600; }
    .file-upload-area .upload-hint  { font-size: 0.75rem; color: #9ca3af; margin-top: 0.3rem; }

    .current-img-wrap {
        border: 1.5px solid #e5e7eb; border-radius: 12px;
        overflow: hidden; margin-bottom: 1rem;
        background: #f9fafb; position: relative;
    }
    .current-img-wrap img {
        width: 100%; max-height: 260px; object-fit: cover; display: block;
    }
    .current-img-label {
        position: absolute; top: 10px; left: 10px;
        background: rgba(0,0,0,0.55); color: #fff;
        font-size: 0.72rem; font-weight: 600; padding: 3px 10px;
        border-radius: 99px; letter-spacing: 0.4px;
    }

    #newPreview { margin-top: 1rem; }
    #newPreview img { max-width: 100%; max-height: 260px; border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1); object-fit: cover; }

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
</style>
@endpush

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <form action="{{ route('admin.galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Informasi Utama -->
            <div class="form-card">
                <div class="form-section-title">Informasi Foto</div>

                <div class="mb-4">
                    <label for="title" class="form-label">Judul Foto <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                           id="title" name="title" value="{{ old('title', $galeri->title) }}"
                           placeholder="Contoh: Pemandangan Sawah Pagi Hari" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-0">
                    <label for="description" class="form-label">Deskripsi <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description" name="description" rows="3"
                              placeholder="Ceritakan tentang foto ini...">{{ old('description', $galeri->description) }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <!-- Gambar -->
            <div class="form-card">
                <div class="form-section-title">Foto</div>

                @if($galeri->image)
                <div class="current-img-wrap">
                    <span class="current-img-label">Foto Saat Ini</span>
                    <img src="{{ Str::startsWith($galeri->image, ['http://', 'https://']) ? $galeri->image : asset('storage/' . $galeri->image) }}"
                         alt="{{ $galeri->title }}"
                         onerror="this.onerror=null;this.src='https://via.placeholder.com/800x400?text=No+Image'">
                </div>
                @endif

                <p class="form-hint mb-3" style="font-size:0.82rem; color:#6b7280;">
                    <i class="bi bi-info-circle me-1"></i>
                    Kosongkan jika tidak ingin mengganti foto. Upload file atau masukkan URL baru untuk mengganti.
                </p>

                <div class="upload-tabs">
                    <div class="upload-tab active" onclick="switchTab('file', this)">
                        <i class="bi bi-upload me-1"></i> Upload File Baru
                    </div>
                    <div class="upload-tab" onclick="switchTab('url', this)">
                        <i class="bi bi-link-45deg me-1"></i> Ganti dengan URL
                    </div>
                </div>

                <div id="tab-file">
                    <div class="file-upload-area">
                        <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                        <div class="upload-icon"><i class="bi bi-cloud-arrow-up"></i></div>
                        <div class="upload-text">Klik atau seret foto baru ke sini</div>
                        <div class="upload-hint">JPG, PNG, GIF, WEBP &mdash; Maks. 4MB</div>
                    </div>
                    @error('image')<div class="text-danger mt-2" style="font-size:0.82rem;">{{ $message }}</div>@enderror
                </div>

                <div id="tab-url" style="display:none;">
                    <input type="url" class="form-control @error('image_url') is-invalid @enderror"
                           id="image_url" name="image_url" value="{{ old('image_url') }}"
                           placeholder="https://contoh.com/gambar.jpg"
                           oninput="previewUrl(this.value)">
                    @error('image_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="form-hint">Masukkan URL gambar baru untuk mengganti</div>
                </div>

                <div id="newPreview" style="display:none;">
                    <p class="form-hint mt-2 mb-1"><i class="bi bi-eye me-1"></i> Preview Foto Baru</p>
                    <img id="preview" src="" alt="Preview Baru">
                </div>
            </div>

            <!-- Meta -->
            <div class="form-card">
                <div class="form-section-title">Informasi Tambahan</div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select class="form-select @error('category') is-invalid @enderror"
                                id="category" name="category" required>
                            <option value="" disabled>Pilih kategori...</option>
                            @foreach(['Alam','Fasilitas','Wisata','UMKM','Kegiatan','Pemerintahan','Lainnya'] as $cat)
                            <option value="{{ $cat }}" {{ old('category', $galeri->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                        @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="author" class="form-label">Fotografer / Sumber</label>
                        <input type="text" class="form-control @error('author') is-invalid @enderror"
                               id="author" name="author" value="{{ old('author', $galeri->author) }}"
                               placeholder="Nama fotografer">
                        @error('author')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="mb-0">
                    <label for="published_at" class="form-label">Tanggal Foto <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('published_at') is-invalid @enderror"
                           id="published_at" name="published_at"
                           value="{{ old('published_at', $galeri->published_at ? date('Y-m-d', strtotime($galeri->published_at)) : '') }}" required>
                    @error('published_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <!-- Action -->
            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-lg"></i> Perbarui Foto
                </button>
                <a href="{{ route('admin.galeri.index') }}" class="btn-cancel">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <div class="info-card">
            <div class="info-card-header"><i class="bi bi-info-circle-fill text-primary"></i> Info Foto</div>
            <div class="info-card-body">
                <div class="info-row"><i class="bi bi-calendar3"></i><span>Ditambahkan: <strong>{{ $galeri->created_at->format('d M Y') }}</strong></span></div>
                <div class="info-row"><i class="bi bi-pencil"></i><span>Terakhir diubah: <strong>{{ $galeri->updated_at->format('d M Y, H:i') }}</strong></span></div>
                <div class="info-row"><i class="bi bi-eye"></i>
                    <span>
                        <a href="{{ route('galeri.show', $galeri->id) }}" target="_blank"
                           style="color:#2d5016; font-weight:600; text-decoration:none;">
                            Lihat di halaman galeri <i class="bi bi-box-arrow-up-right ms-1"></i>
                        </a>
                    </span>
                </div>
            </div>
        </div>

        <div class="info-card">
            <div class="info-card-header"><i class="bi bi-lightbulb-fill text-warning"></i> Tips Edit</div>
            <div class="info-card-body">
                <div class="info-row"><i class="bi bi-image"></i><span>Kosongkan kolom foto jika hanya ingin mengubah teks atau data saja.</span></div>
                <div class="info-row"><i class="bi bi-link-45deg"></i><span>Gunakan tab <strong>URL</strong> jika foto sudah tersedia secara online.</span></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function switchTab(type, el) {
    document.querySelectorAll('.upload-tab').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
    document.getElementById('tab-file').style.display = type === 'file' ? 'block' : 'none';
    document.getElementById('tab-url').style.display  = type === 'url'  ? 'block' : 'none';
    if (type === 'file') {
        document.getElementById('image_url').value = '';
    } else {
        document.getElementById('image').value = '';
    }
    document.getElementById('newPreview').style.display = 'none';
}

function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('newPreview').style.display = 'block';
            document.getElementById('preview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function previewUrl(url) {
    const preview = document.getElementById('newPreview');
    const img     = document.getElementById('preview');
    if (url.trim()) {
        img.src = url;
        img.onload  = () => { preview.style.display = 'block'; };
        img.onerror = () => { preview.style.display = 'none'; };
    } else {
        preview.style.display = 'none';
    }
}
</script>
@endpush
