@extends('layouts.admin')
@section('content')

<div class="jobs-container">
    <div class="container">
        <!-- Header Section -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h1 class="page-title">Daftar Lowongan Pekerjaan</h1>
                    <p class="page-subtitle">Kelola semua lowongan pekerjaan Anda di sini</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('jobs.create') }}" class="btn btn-add d-flex align-items-center gap-2">
                        <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Lowongan
                    </a>

                    <a href="{{ route('jobs.import.template') }}" class="btn btn-secondary d-flex align-items-center gap-2">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Download Template
                    </a>
                </div>
            </div>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
        <div class="alert alert-custom d-flex align-items-center gap-3 mb-4" role="alert">
            <svg style="width: 20px; height: 20px; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <!-- Jobs Grid -->
        @if($jobs->count() > 0)
        <div class="row g-4">
            @foreach($jobs as $job)
            <div class="col-lg-4 col-md-6">
                <div class="job-card">
                    <div class="card-image">
                        @if($job->logo)
                            <img src="{{ asset('storage/' . $job->logo) }}" 
                                 class="logo-img" 
                                 alt="{{ $job->company }}">
                        @else
                            <div class="logo-placeholder">
                                {{ substr($job->company, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="card-content">
                        <h5 class="job-title">{{ $job->title }}</h5>
                        
                        <div class="job-info">
                            <div class="info-item">
                                <svg class="info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <span class="info-text">{{ $job->company }}</span>
                            </div>
                            
                            <div class="info-item">
                                <svg class="info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="info-text">{{ $job->location }}</span>
                            </div>
                            
                            <div class="info-item salary">
                                <svg class="info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="info-text">Rp {{ number_format($job->salary, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        <div class="card-actions">
                            <a href="{{ route('jobs.edit', $job->id) }}" class="btn-action btn-edit">
                                Edit
                            </a>
                            <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="m-0"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?')">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">
                                    Hapus
                                </button>
                            </form>
                        </div>
                        
                        <a href="{{ route('application.index', $job->id) }}" class="view-applicants">
                            Lihat Pelamar →
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Import Form -->
        <div class="import-section">
            <form action="/jobs/import" method="POST" enctype="multipart/form-data" class="import-form">
                @csrf
                <div class="import-content">
                    <label for="file-upload" class="file-label">
                        <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <span>Pilih File Excel</span>
                    </label>
                    <input type="file" id="file-upload" name="file" required>
                    <button type="submit" class="btn-import">Import Lowongan</button>
                </div>
            </form>
        </div>

        @else
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon">
                <svg style="width: 64px; height: 64px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
            </div>
            <h3 class="empty-title">Belum Ada Lowongan</h3>
            <p class="empty-text">Mulai tambahkan lowongan pekerjaan pertama Anda</p>
            <a href="{{ route('jobs.create') }}" class="btn btn-add">
                <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Lowongan Sekarang
            </a>
        </div>
        @endif
    </div>
</div>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.jobs-container {
    background: #ffffff;
    min-height: 100vh;
    padding: 48px 0;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

/* Header Section */
.page-header {
    background: #ffffff;
    border-bottom: 1px solid #e5e7eb;
    padding: 32px 0;
    margin-bottom: 48px;
}

.page-title {
    font-size: 32px;
    font-weight: 600;
    color: #111827;
    margin-bottom: 4px;
    letter-spacing: -0.5px;
}

.page-subtitle {
    color: #6b7280;
    font-size: 15px;
    font-weight: 400;
    margin: 0;
}

/* Buttons */
.btn-add {
    background: #000000;
    color: #ffffff;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 500;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.2s ease;
    cursor: pointer;
}

.btn-add:hover {
    background: #1f2937;
    color: #ffffff;
    transform: translateY(-1px);
}

.btn-secondary {
    background: #ffffff;
    color: #111827;
    border: 1px solid #e5e7eb;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 500;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.2s ease;
}

.btn-secondary:hover {
    background: #f9fafb;
    color: #111827;
    border-color: #d1d5db;
}

/* Alert */
.alert-custom {
    background: #000000;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    padding: 16px 20px;
    font-size: 14px;
}

/* Job Cards */
.job-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.job-card:hover {
    border-color: #000000;
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
}

.card-image {
    width: 100%;
    height: 200px;
    background: #f9fafb;
    display: flex;
    align-items: center;
    justify-content: center;
    border-bottom: 1px solid #e5e7eb;
    overflow: hidden;
}

.logo-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.logo-placeholder {
    width: 80px;
    height: 80px;
    background: #000000;
    color: #ffffff;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    font-weight: 600;
}

.card-content {
    padding: 24px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.job-title {
    font-size: 18px;
    font-weight: 600;
    color: #111827;
    margin-bottom: 20px;
    line-height: 1.4;
    min-height: 50px;
}

.job-info {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 24px;
    flex: 1;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 10px;
}

.info-icon {
    width: 18px;
    height: 18px;
    color: #6b7280;
    flex-shrink: 0;
}

.info-item.salary .info-icon {
    color: #111827;
}

.info-text {
    font-size: 14px;
    color: #4b5563;
    line-height: 1.4;
}

.info-item.salary .info-text {
    font-weight: 600;
    color: #111827;
}

/* Card Actions */
.card-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-bottom: 16px;
}

.btn-action {
    padding: 10px 16px;
    border-radius: 8px;
    font-weight: 500;
    font-size: 14px;
    text-align: center;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
    width: 100%;
}

.btn-edit {
    background: #ffffff;
    color: #111827;
    border: 1px solid #e5e7eb;
}

.btn-edit:hover {
    background: #f9fafb;
    border-color: #d1d5db;
}

.btn-delete {
    background: #000000;
    color: #ffffff;
}

.btn-delete:hover {
    background: #1f2937;
}

.view-applicants {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    color: #111827;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
    padding-top: 12px;
    border-top: 1px solid #f3f4f6;
}

.view-applicants:hover {
    color: #000000;
    gap: 8px;
}

/* Import Section */
.import-section {
    margin-top: 48px;
    padding-top: 48px;
    border-top: 1px solid #e5e7eb;
}

.import-form {
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 32px;
}

.import-content {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

.file-label {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    color: #111827;
    cursor: pointer;
    transition: all 0.2s ease;
}

.file-label:hover {
    border-color: #000000;
}

#file-upload {
    display: none;
}

.btn-import {
    background: #000000;
    color: #ffffff;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 500;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-import:hover {
    background: #1f2937;
}

/* Empty State */
.empty-state {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 80px 32px;
    text-align: center;
}

.empty-icon {
    width: 96px;
    height: 96px;
    margin: 0 auto 24px;
    background: #f9fafb;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #9ca3af;
}

.empty-title {
    font-size: 20px;
    font-weight: 600;
    color: #111827;
    margin-bottom: 8px;
}

.empty-text {
    color: #6b7280;
    font-size: 14px;
    margin-bottom: 24px;
}

/* Responsive */
@media (max-width: 768px) {
    .page-header .d-flex {
        flex-direction: column;
        align-items: flex-start !important;
    }
    
    .card-actions {
        grid-template-columns: 1fr;
    }
    
    .import-content {
        flex-direction: column;
        align-items: stretch;
    }
    
    .btn-import {
        width: 100%;
    }
}
</style>

@endsection