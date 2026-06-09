@extends('CRUD.layouts.admin')

@section('title', 'Tambah APBDes - Admin')
@section('page-title', 'Tambah APBDes')
@section('page-description', 'Masukkan data anggaran dan realisasi tahunan')

@section('styles')
<style>
    .form-section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2d5016;
        border-bottom: 2px solid #e5e7eb;
        padding-bottom: 0.5rem;
        margin-bottom: 1.5rem;
        margin-top: 2rem;
    }
</style>
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <a href="{{ route('admin.apbdes.index') }}" class="btn btn-outline-secondary rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 16px;">
    <div class="card-body p-4 p-lg-5">
        
        @if($errors->any())
            <div class="alert alert-danger mb-4 rounded-3">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.apbdes.store') }}" method="POST">
            @csrf

            <h5 class="form-section-title mt-0"><i class="bi bi-info-circle-fill me-2"></i>Informasi Umum Anggaran</h5>
            
            <div class="row mb-3">
                <div class="col-md-4 mb-3 mb-md-0">
                    <label class="form-label fw-bold">Tahun Anggaran <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="year" value="{{ old('year', date('Y')) }}" placeholder="Contoh: 2026" required>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <label class="form-label fw-bold">Target Anggaran (Rp) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="target_amount" value="{{ old('target_amount') }}" placeholder="Contoh: 1450000000" min="0" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Realisasi (Rp) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="realization_amount" value="{{ old('realization_amount') }}" placeholder="Contoh: 1258000000" min="0" required>
                </div>
            </div>

            <h5 class="form-section-title"><i class="bi bi-pie-chart-fill me-2"></i>Proporsi Total (Grafik Pie)</h5>
            <p class="text-muted small mb-3">Pastikan total ketiganya adalah 100%.</p>
            
            <div class="row mb-3">
                <div class="col-md-4 mb-3 mb-md-0">
                    <label class="form-label fw-bold">Belanja (%) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="pie_belanja" value="{{ old('pie_belanja', 45) }}" min="0" max="100" required>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <label class="form-label fw-bold">Pendapatan (%) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="pie_pendapatan" value="{{ old('pie_pendapatan', 35) }}" min="0" max="100" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Pembiayaan (%) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="pie_pembiayaan" value="{{ old('pie_pembiayaan', 20) }}" min="0" max="100" required>
                </div>
            </div>

            <h5 class="form-section-title"><i class="bi bi-bar-chart-fill me-2"></i>Data Bulanan (Grafik Batang)</h5>
            <p class="text-muted small mb-3">Pisahkan setiap nilai dengan koma (,). Pastikan jumlah datanya sama untuk setiap kolom.</p>
            
            <div class="mb-3">
                <label class="form-label fw-bold">Label Bulan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="chart_months" value="{{ old('chart_months', 'Jan, Feb, Mar, Apr, Mei, Jun') }}" placeholder="Contoh: Jan, Feb, Mar, Apr" required>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mb-3 mb-md-0">
                    <label class="form-label fw-bold">Pendapatan (Juta) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="chart_pendapatan" value="{{ old('chart_pendapatan', '220, 240, 260, 210, 230, 250') }}" placeholder="Contoh: 220, 240, 260, 210" required>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <label class="form-label fw-bold">Belanja (Juta) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="chart_belanja" value="{{ old('chart_belanja', '180, 200, 190, 185, 195, 210') }}" placeholder="Contoh: 180, 200, 190, 185" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Surplus (Juta) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="chart_surplus" value="{{ old('chart_surplus', '40, 40, 70, 25, 35, 40') }}" placeholder="Contoh: 40, 40, 70, 25" required>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-5">
                <button type="submit" class="btn btn-primary" style="background: #2d5016; border: none; padding: 10px 30px; border-radius: 10px; font-weight: 600;">
                    <i class="bi bi-save me-2"></i> Simpan APBDes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
