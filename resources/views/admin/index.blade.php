@extends('layouts.master')
@section('title', 'dashboard admin')

@section('content')
Dashboard Admin
@include('components.admin')
<p>Halo, {{ Auth::user()->name }}!</p>

<a href="{{ route('admin.jobs') }}">Jobs</a>

        <div style="margin-top: 30px;">
            <a href="{{ route('logout') }}" class="logout-btn">Logout</a>
        </div>
@endsection('')