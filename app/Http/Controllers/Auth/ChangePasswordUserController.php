<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangePasswordUserController extends Controller
{

    public function index() {
        $title = 'Ganti Kata Sandi Baru | Adeeva Grosir';
        return view('auth.change-password-user',['title' => $title]);
    }
}
