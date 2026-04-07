<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPasswordRequest extends Component
{
    public $email;

    public function rules() {
        return [
            'email' => ['required', 'email:dns', 'exists:users,email']
        ];
    }

    public function messages() {
        return [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.exists' => 'Email belum terdaftar'
        ];
    }

    public function sendPasswordResetLink() {
        $this->validate();

        $status = Password::sendResetLink([
            'email' => $this->email
        ]);

        
        return $status === Password::ResetLinkSent ? back()->with('status', 'Tautan ganti kata sandi sudah dikirim email Anda, silahkan periksa email anda.') : back()->with('error', 'Tautan gagal terkirim email anda, coba periksa email anda yang terdaftar.');
    }

    public function render()
    {
        return view('livewire.auth.forgot-password-request');
    }
}
