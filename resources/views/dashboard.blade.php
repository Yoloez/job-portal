@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
<div class="dashboard-container">
    <div class="dashboard-card">
        <h1>Welcome to Your Dashboard</h1>
        <p>Hello, {{ Auth::user()->name }}!</p>

        @if(Auth::user()->role === 'admin')
            @include('components.admin')
        @else
            @include('components.user')
        @endif

        <div style="margin-top: 30px;">
            <a href="{{ route('logout') }}" class="logout-btn">Logout</a>
        </div>
    </div>
</div>

    <style>
        .dashboard-container {
            min-height: 70vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
    
        .dashboard-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
            text-align: center;
        }
    
        .dashboard-card h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 2.5em;
            font-weight: 700;
        }
    
        .dashboard-card p {
            color: #666;
            font-size: 1.2em;
            margin-bottom: 30px;
        }
    
        .logout-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            font-weight: 600;
        }
    
        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }
    </style>
@endsection
