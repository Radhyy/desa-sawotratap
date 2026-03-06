@extends('CRUD.layouts.admin')

@section('title', 'Edit Pengumuman - Admin')
@section('page-title', 'Edit Pengumuman')
@section('page-description', 'Perbarui informasi pengumuman')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="admin-card">
            <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="title" class="form-label fw-bold">Judul Pengumuman <span class="text-danger">*</span></label>
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
                    <label for="description" class="form-label fw-bold">Deskripsi Singkat <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                id="description" 
                                name="description" 
                                rows="3"
                                placeholder="Ringkasan singkat pengumuman"
                                required>{{ old('description', $announcement->description) }}</textarea>
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
                                placeholder="Isi lengkap pengumuman (opsional)">{{ old('content', $announcement->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label fw-bold">Gambar</label>
                    
                    @if($announcement->image)
                    <div class="mb-3">
                        <p class="small text-muted mb-2">Gambar saat ini:</p>
                        <img src="{{ asset('storage/' . $announcement->image) }}" 
                                alt="{{ $announcement->title }}"
                                style="max-width: 300px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                    </div>
                    @endif
                    
                    <input type="file" 
                            class="form-control @error('image') is-invalid @enderror" 
                            id="image" 
                            name="image"
                            accept="image/*"
                            onchange="previewImage(this)">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB. {{ $announcement->image ? 'Kosongkan jika tidak ingin mengubah gambar.' : '' }}</small>
                    
                    <!-- Image Preview -->
                    <div id="imagePreview" class="mt-3" style="display: none;">
                        <p class="small text-muted mb-2">Preview gambar baru:</p>
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
                                value="{{ old('date', $announcement->date->format('Y-m-d')) }}"
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
                            <option value="active" {{ old('status', $announcement->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status', $announcement->status) == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Perbarui Pengumuman
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
            <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-2"></i>Informasi</h6>
            <ul class="list-unstyled small">
                <li class="mb-2">
                    <strong>Dibuat:</strong><br>
                    {{ $announcement->created_at->format('d M Y H:i') }}
                </li>
                <li class="mb-2">
                    <strong>Terakhir diubah:</strong><br>
                    {{ $announcement->updated_at->format('d M Y H:i') }}
                </li>
                <li class="mb-2">
                    <strong>ID:</strong> {{ $announcement->id }}
                </li>
            </ul>
            
            <hr>
            
            <div class="d-grid">
                <a href="{{ route('announcements.show', $announcement) }}" 
                    class="btn btn-outline-info btn-sm mb-2"
                    target="_blank">
                    <i class="bi bi-eye me-2"></i>Lihat di Website
                </a>
                <button type="button" 
                        class="btn btn-outline-danger btn-sm"
                        onclick="confirmDelete()">
                    <i class="bi bi-trash me-2"></i>Hapus Pengumuman
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

function confirmDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus pengumuman ini? Tindakan ini tidak dapat dibatalkan.')) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endpush
