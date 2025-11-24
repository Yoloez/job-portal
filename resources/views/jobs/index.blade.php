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
                    <a href="{{ route('jobs.create') }}" class="btn btn-add text-white d-flex align-items-center gap-2">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Lowongan
                    </a>

                    <a href="{{ route('jobs.import.template') }}" class="btn btn-secondary text-white d-flex align-items-center gap-2">
                        <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Download Template Import
                    </a>
                </div>
            </div>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
        <div class="alert alert-custom d-flex align-items-center gap-3 mb-4" role="alert">
            <svg style="width: 24px; height: 24px; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        <div class="card h-100 shadow-sm">
            @if($job->logo)
                <img src="{{ asset('storage/' . $job->logo) }}" 
                     class="card-img-top" 
                     alt="{{ $job->company }}"
                     style="height: 200px; object-fit: cover;">
            @else
                <div class="card-img-top bg-primary text-white d-flex align-items-center justify-content-center" 
                     style="height: 200px; font-size: 3rem; font-weight: bold;">
                    {{ substr($job->company, 0, 1) }}
                </div>
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $job->title }}</h5>
                <div class="mb-3">
                    <p class="card-text mb-2">
                        <strong>{{ $job->company }}</strong>
                    </p>     
                    <p class="card-text mb-2">
                        {{ $job->location }}</p>
                    <p class="card-text mb-0">
                        <strong>Rp {{ number_format($job->salary, 0, ',', '.') }}</strong>
                    </p>
                </div>
                <div class="d-grid gap-2">
                    <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-warning">
                        Edit
                    </a>
                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="m-0"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?')">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            Hapus
                        </button>
                    </form>                
                        </div>
                        <a href={{ route("application.index", $job->id) }}>Lihat pelamar</a>
                    </div>
                </div>
            </div>
            @endforeach

            <form action="/jobs/import" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" required>
                <button type="submit" class="btn btn-info">Import Lowongan</button>
            </form>

        </div>
        @else
        <!-- Empty State -->
<div class="text-center py-5">
    <svg style="width: 60px; height: 60px; color: #94a3b8;" class="mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
    </svg>
    <h3>Belum Ada Lowongan</h3>
    <p class="text-muted">Mulai tambahkan lowongan pekerjaan pertama Anda</p>
    <a href="{{ route('jobs.create') }}" class="btn btn-primary">
        <svg style="width: 20px; height: 20px;" class="me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Tambah Lowongan Sekarang
    </a>
</div>
@endif
    </div>
</div>
@endsection
        <style>
            .jobs-container {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                padding: 60px 0;
            }
        
            .page-header {
                background: rgba(255,255,255,0.95);
                backdrop-filter: blur(10px);
                border-radius: 24px;
                box-shadow: 0 20px 60px rgba(0,0,0,0.15);
                padding: 40px;
                margin-bottom: 50px;
            }
        
            .page-title {
                font-size: 42px;
                font-weight: 800;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                margin-bottom: 12px;
                letter-spacing: -1px;
            }
        
            .page-subtitle {
                color: #64748b;
                font-size: 16px;
                margin: 0;
            }
        
            .btn-add {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border: none;
                padding: 16px 32px;
                border-radius: 16px;
                font-weight: 700;
                font-size: 16px;
                box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);
                transition: all 0.3s ease;
            }
        
            .btn-add:hover {
                transform: translateY(-3px);
                box-shadow: 0 12px 32px rgba(102, 126, 234, 0.5);
            }
        
            .alert-custom {
                background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                color: white;
                border: none;
                border-radius: 16px;
                box-shadow: 0 8px 24px rgba(16, 185, 129, 0.3);
                animation: slideIn 0.5s ease;
            }
        
            .job-card {
                border: 2px solid transparent;
                border-radius: 24px;
                overflow: hidden;
                box-shadow: 0 10px 40px rgba(0,0,0,0.08);
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                height: 100%;
            }
        
            .job-card:hover {
                transform: translateY(-12px) scale(1.02);
                box-shadow: 0 20px 60px rgba(0,0,0,0.15);
                border-color: #667eea;
            }
        
            .card-accent {
                height: 6px;
                background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            }
        
            .logo-section {
                background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
                padding: 40px 30px 20px;
                text-align: center;
            }
        
            .logo-container {
                width: 100px;
                height: 100px;
                margin: 0 auto;
                border-radius: 24px;
                overflow: hidden;
                box-shadow: 0 12px 40px rgba(0,0,0,0.12);
                border: 4px solid white;
            }
        
            .logo-img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        
            .logo-placeholder {
                width: 100px;
                height: 100px;
                margin: 0 auto;
                border-radius: 24px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 12px 40px rgba(102, 126, 234, 0.3);
                border: 4px solid white;
                color: white;
                font-size: 42px;
                font-weight: 800;
            }
        
            .card-title {
                font-size: 22px;
                font-weight: 700;
                color: #1e293b;
                min-height: 60px;
                line-height: 1.3;
            }
        
            .info-badge {
                padding: 12px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                gap: 12px;
            }
        
            .info-badge.company {
                background: #f1f5f9;
            }
        
            .info-badge.location {
                background: #fef2f2;
            }
        
            .info-badge.salary {
                background: #f0fdf4;
            }
        
            .badge-icon {
                width: 36px;
                height: 36px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            }
        
            .badge-icon.company {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
        
            .badge-icon.location {
                background: linear-gradient(135deg, #f87171 0%, #dc2626 100%);
            }
        
            .badge-icon.salary {
                background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            }
        
            .badge-text {
                font-weight: 600;
                font-size: 15px;
            }
        
            .badge-text.company {
                color: #475569;
            }
        
            .badge-text.location {
                color: #dc2626;
            }
        
            .badge-text.salary {
                color: #059669;
                font-weight: 700;
            }
        
            .btn-edit {
                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
                border: none;
                padding: 14px;
                border-radius: 12px;
                font-weight: 700;
                font-size: 14px;
                box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
                transition: all 0.3s ease;
            }
        
            .btn-edit:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 16px rgba(245, 158, 11, 0.4);
            }
        
            .btn-delete {
                background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
                border: none;
                padding: 14px;
                border-radius: 12px;
                font-weight: 700;
                font-size: 14px;
                box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
                transition: all 0.3s ease;
            }
        
            .btn-delete:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
            }
        
            .empty-state {
                background: rgba(255,255,255,0.95);
                backdrop-filter: blur(10px);
                border-radius: 24px;
                box-shadow: 0 20px 60px rgba(0,0,0,0.15);
                padding: 80px 20px;
                text-align: center;
            }
        
            .empty-icon {
                width: 120px;
                height: 120px;
                margin: 0 auto 30px;
                background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        
            .empty-title {
                font-size: 28px;
                font-weight: 800;
                color: #1e293b;
                margin-bottom: 12px;
            }
        
            .empty-text {
                color: #64748b;
                font-size: 16px;
                margin-bottom: 32px;
            }
        
            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>