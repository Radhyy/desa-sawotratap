@extends('CRUD.layouts.admin')

@section('title', 'Tambah Pengumuman - Admin')
@section('page-title', 'Tambah Pengumuman')
@section('page-description', 'Buat pengumuman baru untuk website desa')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="admin-card">
            <form action="{{ route('admin.announcements.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4">
                    <label for="title" class="form-label fw-bold">Judul Pengumuman <span class="text-danger">*</span></label>
                    <input type="text" 
                            class="form-control @error('title') is-invalid @enderror" 
                            id="title" 
                            name="title" 
                            value="{{ old('title') }}"
                            placeholder="Masukkan judul pengumuman"
                            required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label fw-bold">Deskripsi Singkat <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                id="description" 
                                name="description" 
                                rows="3"
                                placeholder="Ringkasan singkat pengumuman"
                                required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Deskripsi ini akan muncul di halaman daftar pengumuman</small>
                </div>

                <div class="mb-4">
                    <label for="content" class="form-label fw-bold">Konten Lengkap</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" 
                                id="content" 
                                name="content" 
                                rows="8"
                                placeholder="Isi lengkap pengumuman (opsional)">{{ old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label fw-bold">Gambar</label>
                    <input type="file" 
                            class="form-control @error('image') is-invalid @enderror" 
                            id="image" 
                            name="image"
                            accept="image/*"
                            onchange="previewImage(this)">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                    
                    <!-- Image Preview -->
                    <div id="imagePreview" class="mt-3" style="display: none;">
                        <img id="preview" src="" alt="Preview" style="max-width: 300px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="date" class="form-label fw-bold">Tanggal Pengumuman <span class="text-danger">*</span></label>
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

                    <div class="col-md-6 mb-4">
                        <label for="status" class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" 
                                id="status" 
                                name="status" 
                                required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Simpan Pengumuman
                    </button>
                    <a href="{{ route('admin.announcements.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle me-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card">
            <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-2"></i>Panduan</h6>
            <ul class="list-unstyled small">
                <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Judul maksimal 255 karakter
                </li>
                <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Deskripsi singkat untuk preview
                </li>
                <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Konten lengkap bisa dikosongkan
                </li>
                <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Gambar opsional, maksimal 2MB
                </li>
                <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Status "Aktif" akan tampil di website
                </li>
            </ul>
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
