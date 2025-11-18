<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobAppliedMail;
use App\Models\JobVacancy as Job;

class SendApplicationMailJob implements ShouldQueue
{
    use Dispatchable, Queueable, InteractsWithQueue, Queueable, SerializesModels;

    public $jobModel;
    public $user;

    public function __construct($jobModel, $user)
    {
        $this->jobModel = $jobModel;
        $this->user = $user;
    }
    public function handle(): void
    {
        Mail::to($this->user->email) ->send(new JobAppliedMail($this->jobModel, $this->user));
    }
}
