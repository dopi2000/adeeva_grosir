<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Title('Pemberitahuan Verifikasi | Adeeva Grosir')]
class VerifyEmail extends Component
{

    public function resend() {
        $user = User::where('username', session('data_user'))->first();
        
        if($user === null) {
            return redirect()->route('login');
        }
        if($user->hasVerifiedEmail()) {
            session()->forget('data_user');
            return redirect()->route('login')->with('status', 'Akun anda sudah terverifikasi, silahkan masuk dengan akun yang sudah terdaftar');
        }

        $user->sendEmailVerificationNotification();

        session()->flash('resend', 'Link verifikasi baru telah dikirim!');
    }

    public function render()
    {
        return view('livewire.auth.verify-email');
    }
}
