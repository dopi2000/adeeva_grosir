<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPasswordRequest extends Component
{
    public $email;

    public function rules() {
        return [
            'email' => ['required', 'email:dns']
        ];
    }

    public function messages() {
        return [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid'
        ];
    }

    public function sendPasswordResetLink() {
        $this->validate();

        $status = Password::sendResetLink([
            'email' => $this->email
        ]);
        
        return $status === Password::ResetLinkSent ? back()->with(['status' => __($status)]) : back()->with('error', __($status));
    }

    public function render()
    {
        return view('livewire.auth.forgot-password-request');
    }
}
