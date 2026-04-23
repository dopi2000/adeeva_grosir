<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class EmailVerificationController extends Controller
{
    public function verification(Request $request) {

        if($request->user() && $request->user()->hasVerifiedEmail()) {
            return redirect()->route('login');
        }

        $title = 'Notifikasi Verifikasi Email | Adeeva Grosir';

        return view('auth.verify-email', compact('title'));
    }
    
    public function verify(Request $request, $id, $hash) {

            $user =  User::findOrFail($id);

            if(!URL::hasValidSignature($request)) {
                abort(403, 'Link verifikasi tidak valid atau telah kadaluarsa.');
            }

            if(!hash_equals((String) $hash, sha1($user->getEmailForVerification()))) {
                abort(403, 'Link verifikasi tidak valid.');
            }
            
            if ($user->hasVerifiedEmail()) {
                return redirect()->route('login')->with('status', 'Email anda sudah terverifikasi, silahkan masuk ke akun anda.');
            }

            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }
            return redirect()->route('verification.verified')->with('verified', true);

        }

    public function showPageVerifiedEmail() {
        if(!Session::get('verified')) {
            return redirect()->route('login')->with('error', 'Akses tidak diizinkan');
        }

        $title = "Verfikasi Berhasil | Adeeva Grosir";
        return view('auth.email-verified', ['title' => $title]);
    }
}



