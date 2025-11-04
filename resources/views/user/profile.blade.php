@extends('layouts.master')
@section('title', 'dashboard admin')

@section('content')
<h1>Profil User</h1>

<h2>Selamat datang, {{ Auth::user()->name }}!</h2>
@include('components.user')

@endsection('')

