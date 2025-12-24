<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordUserController extends Controller
{
    public function index() {
        $title = 'Lupa Kata Sandi | Adeeva Grosir';
        return view('auth.forgot-password-request', ['title' => $title]);
    }

    public function resetPassword(Request $request, string $token) {
        $user = DB::table('password_reset_tokens')->where('email', urldecode($request->get('email')))->first();
        if(!$user) {
            abort(403, 'Data email atau token tidak valid');
        }
        if(!Hash::check($token, $user->token )) {
            abort('403', 'Reset Token Kata Sandi Tidak Valid');
        }
        $title = 'Reset Kata Sandi';
        return view('auth.reset-password', ['token' => $token, 'title' => $title]);
    }
}
