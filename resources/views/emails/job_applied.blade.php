<!DOCTYPE html>
<html>
<head>
    <title>Lamaran Diterima</title>
</head>
<body>
    <h2>Halo {{ $user->name }},</h2>
    <p>Terima kasih telah melamar pekerjaan <b>{{ $job->title }}</b> di {{ $job->company }}.</p>
    <p>Lamaran Anda telah kami terima dan sedang diproses oleh tim HR kami.</p>
    
    @if(isset($application) && $application->cv)
    <p>
        <strong>CV yang Anda kirimkan:</strong><br>
        <a href="{{ route('applications.download-cv', $application->id) }}" 
           style="display: inline-block; margin-top: 10px; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">
            Download CV Anda
        </a>
    </p>
    @endif
    
    <br>
    <p>Salam,</p>
    <p><b>Tim {{ config('app.name') }}</b></p>
</body>
</html>