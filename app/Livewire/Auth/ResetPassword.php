<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ResetPassword extends Component
{
    public $email;
    public $password;
    public $confirm_password;
    public $token;

    public function rules() {
        return [
            'email' => ['required', 'max:255', 'email:dns'],
            'password' => ['required', 'min:8', 'max:16', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
            'confirm_password' => ['required', 'same:password', 'min:8', 'max:16'],
            'token' => ['required']
        ];
    }

    public function messages() {
        return [
            'email.required' => 'Kolom nama pengguna wajib diisi',
            'email.max' => 'Email harus maksimal 255 karakter.',
            'email.email' => 'Email harus berisi alamat email yang valid.',
            'email.unique' => 'Email sudah digunakan, silahakan gunakan email lain.',
            'password.required' => 'Kolom kata sandi tidak boleh kosong.',
            'password.min' => 'Kata sandi harus minimal 8 karakter.',
            'password.max' => 'Kata sandi harus maksimal 16 karakter.',
            'password.regex' => 'Kata sandi harus terdiri dari kombinasi huruf, angka, atau karater lain.',
            'confirm_password.required' => 'Kolom konfimasi kata sandi wajib di isi.',
            'confirm_password.same' => 'Konfirmasi kata sandi tidak cocok.',
            'token.required' => 'Token tidak ada'
        ];
    }
    public function mount(Request $request) {
        $email = urldecode($request->get('email'));
        $this->email = $email;
    }

    public function resetPassword() {
        $this->validate();
        $status = Password::reset([
            'email' => $this->email,
            'password' => $this->password,
            'confirm_password' => $this->confirm_password,
            'token' => $this->token
        ], function(User $user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ]);
            $user->save();
            event(new PasswordReset($user));
        });

        $this->resetValidation();

        return $status === Password::PasswordReset ? redirect()->route('login')->with('status', 'Silahkan masuk dengan kata sandi baru Anda') : back()->with('error', 'Gagal Mengganti kata sandi baru.');
    }

    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}
