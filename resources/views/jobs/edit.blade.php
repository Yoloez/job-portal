@extends('layouts.master')
@section('content')

<style>
.container-job-form {
    padding: 40px 0;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    min-height: 70vh;
}

.header {
    text-align: center;
    margin-bottom: 40px;
}

.header-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    margin: 0 auto 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
}

.header h2 {
    font-size: 32px;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 10px;
}

.header p {
    color: #718096;
    font-size: 16px;
}

.form-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
    padding: 40px;
    border: 1px solid #e2e8f0;
    width: 100%;
    max-width: 600px;
    display: flex;
    align-items: center;
    justify-content: center;
}

label {
    display: block;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 8px;
    font-size: 14px;
}

.form-control {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 14px 18px;
    font-size: 15px;
    transition: all 0.3s ease;
    width: 100%;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

textarea.form-control {
    resize: vertical;
}

.row-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

#logo {
    border: 2px dashed #cbd5e0;
    border-radius: 12px;
    padding: 14px 18px;
    font-size: 15px;
    transition: all 0.3s ease;
    width: 100%;
    cursor: pointer;
    background: #f7fafc;
}

#logo:focus {
    border-color: #667eea;
    background-color: #edf2f7;
}

#imagePreview {
    margin-top: 15px;
    text-align: center;
    display: none;
}

#preview {
    max-width: 150px;
    max-height: 150px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.button-save {
    flex: 1;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 16px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.button-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
}

.button-cancel {
    flex: 0.4;
    background: white;
    color: #4a5568;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 16px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
}

.button-cancel:hover {
    border-color: #cbd5e0;
    background-color: #f7fafc;
}
</style>

<div class="container-job-form">
    <!-- Header -->
    <div class="header">
        <div class="header-icon">
            <svg style="width: 40px; height: 40px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                </path>
            </svg>
        </div>
        <h2>Edit Lowongan</h2>
        <p>Perbarui informasi lowongan pekerjaan</p>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <form action="{{ route('jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div style="margin-bottom: 25px;">
                <label>Judul Lowongan</label>
                <input type="text" name="title" class="form-control" value="{{ $job->title }}" placeholder="Contoh: Full Stack Developer" required>
            </div>
            <div style="margin-bottom: 25px;">
                <label>Deskripsi Pekerjaan</label>
                <textarea name="description" class="form-control" rows="5" placeholder="Jelaskan detail pekerjaan, requirements, dan benefit..." required>{{ $job->description }}</textarea>
            </div>
            <div style="margin-bottom: 25px;">
                <label>Nama Perusahaan</label>
                <input type="text" name="company" class="form-control" value="{{ $job->company }}" placeholder="Contoh: PT Tech Indonesia" required>
            </div>
            <div class="row-2" style="margin-bottom: 25px;">
                <div>
                    <label>Lokasi</label>
                    <input type="text" name="location" class="form-control" value="{{ $job->location }}" placeholder="Jakarta" required>
                </div>
                <div>
                    <label>Gaji (Rp)</label>
                    <input type="number" name="salary" class="form-control" value="{{ $job->salary }}" placeholder="8000000" required>
                </div>
            </div>
            <div style="margin-bottom: 30px;">
                <label>Logo Perusahaan</label>
                <input type="file" name="logo" id="logo" class="form-control" accept="image/*" onchange="previewImage(event)">
                @if($job->logo)
                <div id="imagePreview" style="display: block;">
                    <img id="preview" src="{{ asset('storage/' . $job->logo) }}" alt="Current Logo">
                </div>
                @else
                <div id="imagePreview">
                    <img id="preview" src="" alt="Preview">
                </div>
                @endif
            </div>
            <div style="display: flex; gap: 12px; margin-top: 30px;">
                <button type="submit" class="button-save">Update Lowongan</button>
                <a href="{{ route('jobs.index') }}" class="button-cancel">Batal</a>
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
