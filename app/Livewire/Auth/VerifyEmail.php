<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Title('Pemberitahuan Verifikasi | Adeeva Grosir')]
class VerifyEmail extends Component
{

    public function resend() {
        
        if(Auth::check() && Auth::user()->hasVerifiedEmail()) {
            Auth::logout();
            return redirect()->route('login')->with('status', 'Email anda sudah terverifikasi, silahkan masuk dengan akun yang sudah terdaftar');;
        }

        Auth::user()->sendEmailVerificationNotification();

        session()->flash('resend', 'Link verifikasi baru telah dikirim!');
    }

    public function render()
    {
        return view('livewire.auth.verify-email');
    }
}
