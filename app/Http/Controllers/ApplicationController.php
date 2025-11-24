<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ApplicationsExport;
use App\Models\JobVacancy as Job;
use App\Mail\JobAppliedMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Notifications\NewApplicationNotification;
use App\Jobs\SendApplicationMailJob;
use App\Mail\ApplicationStatusMail;

use Symfony\Component\HttpFoundation\StreamedResponse;


class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($jobId){
        $job = Job::findOrFail($jobId);
        $applications = Application::with('user', 'job')->where('job_id', $jobId)->get();
        return view('application.index', compact('applications', 'job'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request, $jobId)
        {
            $request->validate([
                'cv' => 'required|mimes:pdf|max:2048',
            ]);

            $cvPath = $request->file('cv')->store('cvs', 'public');

            $job = Job::findOrFail($jobId);
            $application = Application::create([
                'user_id' => Auth::id(),
                'job_id' => $jobId,
                'cv' => $cvPath,
            ]); 
            
            dispatch(new SendApplicationMailJob($job, Auth::user())); 
            
            $admin = User::where('role', 'admin')->first();
            $admin->notify(new NewApplicationNotification($application));
            return back()->with('success', 'Lamaran berhasil dikirim, cek email Anda untuk konfirmasi.');

        }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
        'status' => 'required|in:Accepted,Rejected',
    ]);

    // Cari aplikasi berdasarkan ID
    $application = Application::findOrFail($id);

    // Update status aplikasi
    $application->update([
        'status' => $request->input('status'),
    ]);

    // == Kirim Email ke Pelamar ==
    Mail::to($application->user->email)
        ->send(new ApplicationStatusMail($application));

    $statusMessage = $request->input('status') === 'Accepted' ? 'diterima' : 'ditolak';

    return back()->with('success', 'Aplikasi berhasil ' . $statusMessage . ' dan email sudah dikirim.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Download CV from application
     */

    public function downloadCv(string $id)
    {
        $application = Application::findOrFail($id);

        if (!Storage::disk('public')->exists($application->cv)) {
            return back()->with('error', 'File CV tidak ditemukan.');
        }

        $filePath = storage_path('app/public/' . $application->cv);      
        $fileName = $application->user->name . '_CV_' . $application->id . '.pdf';

        return response()->download($filePath, $fileName);
    }

    /**
     * Export applications to Excel
     */
    public function export($jobId = null)
    {
        // Cari nama pekerjaan jika jobId tersedia
        $jobName = '';
        if ($jobId) {
            $job = Job::findOrFail($jobId);
            $jobName = '_' . str_replace(' ', '_', $job->title);
        }

        $fileName = 'applications' . $jobName . '_' . date('d-m-Y') . '.xlsx';
        
        return Excel::download(new ApplicationsExport($jobId), $fileName);
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
        }
        return back()->with('success', 'Notification marked as read.');
    }
}

