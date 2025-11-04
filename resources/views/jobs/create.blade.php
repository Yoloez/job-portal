@extends('layouts.master')
@section('content')
<div class="container" style="padding: 40px 0; display: flex; align-items: center; justify-content: center; flex-direction: column; min-height: 70vh;">
    <!-- Header -->
    <div style="text-align: center; margin-bottom: 40px;">
        <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);">
            <svg style="width: 40px; height: 40px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
        </div>
        <h2 style="font-size: 32px; font-weight: 700; color: #1a202c; margin-bottom: 10px;">Tambah Lowongan Baru</h2>
        <p style="color: #718096; font-size: 16px;">Lengkapi form di bawah untuk menambahkan lowongan pekerjaan</p>
    </div>

    <!-- Form Card -->
    <div style="background: white; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.08); padding: 40px; border: 1px solid #e2e8f0;">
        <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Job Title -->
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #2d3748; margin-bottom: 8px; font-size: 14px;">
                    <svg style="width: 16px; height: 16px; display: inline-block; margin-right: 6px; vertical-align: text-bottom;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Judul Lowongan
                </label>
                <input type="text" name="title" placeholder="Contoh: Full Stack Developer" 
                       class="form-control" 
                       style="border: 2px solid #e2e8f0; border-radius: 12px; padding: 14px 18px; font-size: 15px; transition: all 0.3s ease; width: 100%;"
                       onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 3px rgba(102, 126, 234, 0.1)';"
                       onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';"
                       required>
            </div>

            <!-- Description -->
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #2d3748; margin-bottom: 8px; font-size: 14px;">
                    <svg style="width: 16px; height: 16px; display: inline-block; margin-right: 6px; vertical-align: text-bottom;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                    </svg>
                    Deskripsi Pekerjaan
                </label>
                <textarea name="description" placeholder="Jelaskan detail pekerjaan, requirements, dan benefit..." 
                          class="form-control" rows="5"
                          style="border: 2px solid #e2e8f0; border-radius: 12px; padding: 14px 18px; font-size: 15px; transition: all 0.3s ease; width: 100%; resize: vertical;"
                          onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 3px rgba(102, 126, 234, 0.1)';"
                          onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';"
                          required></textarea>
            </div>

            <!-- Company Name -->
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #2d3748; margin-bottom: 8px; font-size: 14px;">
                    <svg style="width: 16px; height: 16px; display: inline-block; margin-right: 6px; vertical-align: text-bottom;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Nama Perusahaan
                </label>
                <input type="text" name="company" placeholder="Contoh: PT Tech Indonesia" 
                       class="form-control"
                       style="border: 2px solid #e2e8f0; border-radius: 12px; padding: 14px 18px; font-size: 15px; transition: all 0.3s ease; width: 100%;"
                       onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 3px rgba(102, 126, 234, 0.1)';"
                       onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';"
                       required>
            </div>

            <!-- Location and Salary Row -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                <!-- Location -->
                <div>
                    <label style="display: block; font-weight: 600; color: #2d3748; margin-bottom: 8px; font-size: 14px;">
                        <svg style="width: 16px; height: 16px; display: inline-block; margin-right: 6px; vertical-align: text-bottom;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Lokasi
                    </label>
                    <input type="text" name="location" placeholder="Jakarta" 
                           class="form-control"
                           style="border: 2px solid #e2e8f0; border-radius: 12px; padding: 14px 18px; font-size: 15px; transition: all 0.3s ease; width: 100%;"
                           onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 3px rgba(102, 126, 234, 0.1)';"
                           onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';"
                           required>
                </div>

                <!-- Salary -->
                <div>
                    <label style="display: block; font-weight: 600; color: #2d3748; margin-bottom: 8px; font-size: 14px;">
                        <svg style="width: 16px; height: 16px; display: inline-block; margin-right: 6px; vertical-align: text-bottom;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Gaji (Rp)
                    </label>
                    <input type="number" name="salary" placeholder="8000000" 
                           class="form-control"
                           style="border: 2px solid #e2e8f0; border-radius: 12px; padding: 14px 18px; font-size: 15px; transition: all 0.3s ease; width: 100%;"
                           onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 3px rgba(102, 126, 234, 0.1)';"
                           onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';"
                           required>
                </div>
            </div>

            <!-- Logo Upload -->
            <div style="margin-bottom: 30px;">
                <label style="display: block; font-weight: 600; color: #2d3748; margin-bottom: 8px; font-size: 14px;">
                    <svg style="width: 16px; height: 16px; display: inline-block; margin-right: 6px; vertical-align: text-bottom;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Logo Perusahaan
                </label>
                <div style="position: relative;">
                    <input type="file" name="logo" id="logo" class="form-control" accept="image/*"
                           style="border: 2px dashed #cbd5e0; border-radius: 12px; padding: 14px 18px; font-size: 15px; transition: all 0.3s ease; width: 100%; cursor: pointer; background: #f7fafc;"
                           onchange="previewImage(event)"
                           onfocus="this.style.borderColor='#667eea'; this.style.backgroundColor='#edf2f7';"
                           onblur="this.style.borderColor='#cbd5e0'; this.style.backgroundColor='#f7fafc';">
                </div>
                <div id="imagePreview" style="margin-top: 15px; text-align: center; display: none;">
                    <img id="preview" src="" alt="Preview" style="max-width: 150px; max-height: 150px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                </div>
            </div>

            <!-- Action Buttons -->
            <div style="display: flex; gap: 12px; margin-top: 30px;">
                <button type="submit" 
                        style="flex: 1; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 12px; padding: 16px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(102, 126, 234, 0.5)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(102, 126, 234, 0.4)';">
                    <svg style="width: 20px; height: 20px; display: inline-block; margin-right: 8px; vertical-align: text-bottom;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Lowongan
                </button>
                <a href="{{ route('jobs.index') }}" 
                   style="flex: 0.4; background: white; color: #4a5568; border: 2px solid #e2e8f0; border-radius: 12px; padding: 16px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center;"
                   onmouseover="this.style.borderColor='#cbd5e0'; this.style.backgroundColor='#f7fafc';"
                   onmouseout="this.style.borderColor='#e2e8f0'; this.style.backgroundColor='white';">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const preview = document.getElementById('preview');
        const previewDiv = document.getElementById('imagePreview');
        preview.src = reader.result;
        previewDiv.style.display = 'block';
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection