@component('mail::message')
# Application Status Update

Hi {{ $application->user->name }},

Your application for the position **{{ $application->job->title }}** has been reviewed.

@switch($application->status)

    @case('accepted')
        <p>Congratulations! Your application has been accepted.</p>
        
        @component('mail::button', ['url' => url('/dashboard')])
        View Details
        @endcomponent
    @break

    @case('rejected')
        <p>**❗Unfortunately, your application was not selected.**</p>
    @break

    @default
</h1>Your application status is: **{{ ucfirst($application->status) }}**.<h1>
@endswitch

Thanks,<br>
{{ config('app.name') }}
@endcomponent
