<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Override username field jika menggunakan kolom "username" untuk login
    public function username()
    {
        return 'username'; // Ganti dengan kolom yang digunakan untuk login
    }

    // Redirect setelah login berhasil
    protected function redirectTo()
    {
        return '/dashboard'; // Ganti dengan halaman setelah login
    }

    // Tampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }
}