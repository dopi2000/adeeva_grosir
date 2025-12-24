<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Verified;;

class EmailVerificationController extends Controller
{
    public function verification(Request $request) {
        $user = User::where('username', $request->get('username'))->first();

        if($user === null) {
            return abort(403, 'Autentikasi token gagal');
        }
        if(!$request->get('token')) {
            return abort(403, 'Autentikasi token gagal');
        }

        if($request->get('token') !== session('verification_token')) {
            return abort(403, 'Token autentikasi tidak valid atau kadaluarsa');
        }

        session()->put('data_user', $user->username);
        Auth::logout($user);
        

        $title = 'Notifikasi Verifikasi Email | Adeeva Grosir';

        return view('auth.verify-email', ['title' => $title]);
    }
    
    public function verify(Request $request, $id, $hash) {
        
        $user = User::findOrFail($id);
        
        // verifikasi signature URL
        if(!URL::hasValidSignature($request)) {
            abort(403, 'Link verifikasi tidak valid ');
        }

        //  cek hash email apakah terdaftar atau tidak
        if(!hash_equals($hash, sha1($user->email))) {
            abort(403, 'Link verifikasi tidak valid');
        }

        if($user->hasVerifiedEmail()) {
            abort('403', 'Link verifikasi sudah kadaluarsa');
        }

        // jika kondisi semua terpenuhi, maka proses verifikasi
        if(!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }

        // redirect ke halaman verified dan token session
        $verificationToken = Str::random(40);
        session()->put('verification_token', $verificationToken);
        // hapus session token
        // session()->forget('verification_token');

        return redirect()->route('verification.verified', [
            'token' => $verificationToken,
        ]);
    }

    public function showPageVerifiedEmail(Request $request) {

        
        if(!$request->token) {
            return abort(403, 'Autentikasi gagal');
        }
        
        // validasi token session
        if($request->token !== session('verification_token')) {
            return abort(403, 'Token autentikasi tidak valid atau kadaluarsa');
        }

        
        // hapus session token
        session()->forget('verification_token');

        $title = "Verfikasi Berhasil | Adeeva Grosir";

        return view('auth.email-verified', ['title' => $title]);
    }
}



