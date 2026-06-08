@extends('CRUD.layouts.admin')

@section('title', 'Edit Kategori UMKM - Desa Sawotratap')
@section('page-title', 'Edit Kategori')
@section('page-description', 'Ubah data kategori UMKM')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="admin-card">
            <div class="d-flex align-items-center mb-4 pb-3" style="border-bottom: 1px solid #f0f0f0;">
                <a href="{{ route('admin.kategori-umkm.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <h5 class="mb-0" style="font-family: 'Playfair Display', serif; font-weight: 700; color: #2d5016;">Form Edit Kategori</h5>
            </div>

            <form action="{{ route('admin.kategori-umkm.update', $kategori_umkm->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="form-label fw-bold">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $kategori_umkm->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2 mt-5">
                    <a href="{{ route('admin.kategori-umkm.index') }}" class="btn btn-light px-4">Batal</a>
                    <button type="submit" class="btn px-4" style="background: #2d5016; color: white;">
                        <i class="bi bi-save me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
