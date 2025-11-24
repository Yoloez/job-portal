<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller{
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request){
    // 1. Validasi input
    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    // 2. Coba login
    if (!Auth::attempt($validated)) {

        // Jika request API / AJAX
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah'
            ], 401);
        }

        // Jika request Web
        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->withInput();
    }

    // 3. Login berhasil
    $user = Auth::user();

    // Jika request API / AJAX
    if ($request->expectsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'user' => $user,
        ], 200);
    }

    // 4. Redirect berdasarkan role
    switch ($user->role) {
        case 'admin':
            return redirect()
                ->route('admin.index')
                ->with('success', 'Selamat datang, admin!');

        case 'user':
            return redirect()
                ->route('user')
                ->with('success', 'Login berhasil.');
        
        default:
            Auth::logout();
            return redirect('/')
                ->withErrors(['role' => 'Role tidak dikenali.']);
    }
}


    public function showRegisterForm(){
        return view('auth.register');
    }

    public function register (Request $request) {
        $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:4|confirmed',
        'role' => 'required|in:admin,user'

    ]);
        User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,]);
            return redirect()->route('login')->with('success','Registrasi berhasil! Silakan login.');
        }
        
    public function logout() {
        Auth::logout();
    return redirect()->route('login');}
}