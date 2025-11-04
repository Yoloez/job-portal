@extends('layouts.master')
@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 60px 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh;">
    
    <!-- Header Section -->
    <div style="margin-bottom: 50px;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); padding: 40px; border-radius: 24px; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">
            <div>
                <h1 style="font-size: 42px; font-weight: 800; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin: 0 0 12px 0; letter-spacing: -1px;">
                    Daftar Lowongan Pekerjaan
                </h1>
                <p style="color: #64748b; font-size: 16px; margin: 0;">Kelola semua lowongan pekerjaan Anda di sini</p>
            </div>
            <a href="{{ route('jobs.create') }}" 
               style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 16px 32px; border-radius: 16px; text-decoration: none; font-weight: 700; font-size: 16px; box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4); transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 10px; border: none; cursor: pointer;"
               onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 32px rgba(102, 126, 234, 0.5)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 24px rgba(102, 126, 234, 0.4)';">
                <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Lowongan
            </a>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
    <div style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 20px 30px; border-radius: 16px; margin-bottom: 30px; box-shadow: 0 8px 24px rgba(16, 185, 129, 0.3); display: flex; align-items: center; gap: 15px; animation: slideIn 0.5s ease;">
        <svg style="width: 24px; height: 24px; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span style="font-weight: 600;">{{ session('success') }}</span>
    </div>
    @endif

    <!-- Jobs Grid -->
    @if($jobs->count() > 0)
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(360px, 1fr)); gap: 30px;">
        @foreach($jobs as $job)
        <div style="background: white; border-radius: 24px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.08); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); position: relative; border: 2px solid transparent;"
             onmouseover="this.style.transform='translateY(-12px) scale(1.02)'; this.style.boxShadow='0 20px 60px rgba(0,0,0,0.15)'; this.style.borderColor='#667eea';"
             onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 10px 40px rgba(0,0,0,0.08)'; this.style.borderColor='transparent';">
            
            <!-- Gradient Overlay -->
            <div style="position: absolute; top: 0; left: 0; right: 0; height: 6px; background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);"></div>
            
            <!-- Company Logo -->
            <div style="text-align: center; padding: 40px 30px 20px; background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);">
                @if($job->logo)
                    <div style="width: 100px; height: 100px; margin: 0 auto; border-radius: 24px; overflow: hidden; box-shadow: 0 12px 40px rgba(0,0,0,0.12); border: 4px solid white; background: white;">
                        <img src="{{ asset('storage/' . $job->logo) }}" 
                             alt="{{ $job->company }}"
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                @else
                    <div style="width: 100px; height: 100px; margin: 0 auto; border-radius: 24px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; box-shadow: 0 12px 40px rgba(102, 126, 234, 0.3); border: 4px solid white;">
                        <span style="color: white; font-size: 42px; font-weight: 800;">{{ substr($job->company, 0, 1) }}</span>
                    </div>
                @endif
            </div>

            <!-- Job Details -->
            <div style="padding: 0 30px 30px;">
                <h3 style="font-size: 22px; font-weight: 700; color: #1e293b; margin: 0 0 20px 0; line-height: 1.3; min-height: 60px;">
                    {{ $job->title }}
                </h3>
                
                <!-- Info Items -->
                <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 24px;">
                    <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: #f1f5f9; border-radius: 12px;">
                        <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 20px; height: 20px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <span style="color: #475569; font-weight: 600; font-size: 15px;">{{ $job->company }}</span>
                    </div>
                    
                    <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: #fef2f2; border-radius: 12px;">
                        <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #f87171 0%, #dc2626 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 20px; height: 20px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <span style="color: #dc2626; font-weight: 600; font-size: 15px;">{{ $job->location }}</span>
                    </div>
                    
                    <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: #f0fdf4; border-radius: 12px;">
                        <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 20px; height: 20px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span style="color: #059669; font-weight: 700; font-size: 15px;">Rp {{ number_format($job->salary, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <a href="{{ route('jobs.edit', $job->id) }}" 
                       style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; padding: 14px; border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 14px; text-align: center; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);"
                       onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(245, 158, 11, 0.4)';"
                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(245, 158, 11, 0.3)';">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" style="margin: 0;"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?')">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" 
                                style="width: 100%; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; padding: 14px; border-radius: 12px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 8px; border: none; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);"
                                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(239, 68, 68, 0.4)';"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(239, 68, 68, 0.3)';">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <!-- Empty State -->
    <div style="text-align: center; padding: 80px 20px; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border-radius: 24px; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">
        <div style="width: 120px; height: 120px; margin: 0 auto 30px; background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
            <svg style="width: 60px; height: 60px; color: #94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
        </div>
        <h3 style="font-size: 28px; font-weight: 800; color: #1e293b; margin: 0 0 12px 0;">Belum Ada Lowongan</h3>
        <p style="color: #64748b; font-size: 16px; margin: 0 0 32px 0;">Mulai tambahkan lowongan pekerjaan pertama Anda</p>
        <a href="{{ route('jobs.create') }}" 
           style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 16px 40px; border-radius: 16px; text-decoration: none; font-weight: 700; font-size: 16px; box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4); transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 10px;"
           onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 32px rgba(102, 126, 234, 0.5)';"
           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 24px rgba(102, 126, 234, 0.4)';">
            <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Tambah Lowongan Sekarang
        </a>
    </div>
    @endif
</div>

<style>
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
@endsection