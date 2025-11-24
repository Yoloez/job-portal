@extends('layouts.admin')
@section('title', 'dashboard admin')

@section('content')
<div style="padding: 20px;">
    <h1>Dashboard Admin</h1>
    @include('components.admin')
    <p>Halo, {{ Auth::user()->name }}!</p>
    
    <a href="{{ route('jobs.index') }}">Jobs</a>

    <div style="margin-top: 30px;">
        <h2>Notifications</h2>
        @if($notifications->count() > 0)
            <ul class="list-group">
                @foreach($notifications as $notification)
                    <li class="list-group-item">
                        New application for <strong>{{ $notification->data['job_title'] }}</strong> by <strong>{{ $notification->data['user_name'] }}</strong>.
                        <a href="{{ route('admin.notification.read', $notification->id) }}" class="btn btn-sm btn-primary float-end">Mark as Read</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No new notifications.</p>
        @endif
    </div>

    <div style="margin-top: 30px;">
        <a href="{{ route('logout') }}" class="logout-btn">
            <Button>LOGOUT</Button>
        </a>
    </div>
</div>
@endsection
