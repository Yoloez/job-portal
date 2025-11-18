<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewApplicationNotification extends Notification
{
    use Queueable;

    public $application;
    /**
     * Create a new notification instance.
     */
    public function __construct($application)
    {
        $this->application = $application;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $applicationUrl = route('applications.index', ['jobId' => $this->application->job_id]);
        $downloadUrl = route('applications.download-cv', $this->application->id);

        return (new MailMessage)
            ->subject('New Application Received')
            ->line('Ada lamaran baru untuk pekerjaan: ' . $this->application->job->title)
            ->line('Pelamar: ' . $this->application->user->name)
            ->action('Lihat Semua Lamaran', $applicationUrl)
            ->action('Download CV', $downloadUrl);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
