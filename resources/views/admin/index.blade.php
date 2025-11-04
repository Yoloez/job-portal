@extends('layouts.master')
@section('title', 'dashboard admin')

@section('content')
<h1>Dashboard Admin</h1>
@include('components.admin')
<p>Halo, {{ Auth::user()->name }}!</p>

<a href="{{ route('jobs.index') }}">Jobs</a>
<div style="margin-top: 30px;">
    <a href="{{ route('logout') }}" class="logout-btn">
        <Button>LOGOUT</Button>
    </a>
</div>
@endsection('')

