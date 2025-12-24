<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginUserController extends Controller
{
    public function index() {
        session()->forget('data_user');
        $title = 'Masuk ke akun kamu | Adeeva Grosir';
        return view('auth.login-user', ['title' => $title]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
