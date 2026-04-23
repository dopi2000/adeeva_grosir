<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

#[Title('Register | Adeeva Grosir')]
class Register extends Component
{
    public $name = '';
    public $username = '';
    public $email = '';
    public $phone = '';
    public $password = '';
    public $confirm_password = '';
    public $terms = false;

    public function rules() {
        
        return [
            'name' => ['required', 'max:255', 'string'],
            'username' => ['required', 'min:5', 'max:16', 'unique:users'],
            'email' => ['required', 'max:255', 'email:dns', 'unique:users'],
            'phone' => ['required', 'min:6', 'max:12', 'unique:users'],
            'password' => ['required', Password::min(8)->max(16)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
            'confirm_password' => ['required', 'same:password'],
            'terms' => ['accepted']
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Kolom nama wajib diisi.',
            'name.max' => 'Nama harus maksimal 255 karakter.',
            'name.string' => 'Nama harus berupa karakter huruf.',
            'username.required' => 'Kolom nama pengguna wajib diisi',
            'username.min' => 'Nama pengguna harus minimal 5 karakter.',
            'username.max' => 'Nama pengguna harus maksimal 16 karakter.',
            'username.unique' => 'Nama pengguna sudah digunakan, silahkan gunakan nama pengguna lain.',
            'email.required' => 'Kolom nama wajib diisi.',
            'email.max' => 'Email harus maksimal 255 karakter.',
            'email.email' => 'Email harus berisi alamat email yang valid.',
            'email.unique' => 'Email sudah digunakan, silahakan gunakan email lain.',
            'phone.required' => 'Kolom nomor hp wajib diisi.',
            'phone.min' => 'Nomor HP minimal 6 digit angka.',
            'phone.max' => 'Nomor HP maksimal 12 digit angka.',
            'phone.unique' => 'Nomor HP sudah digunakan, silahkan gunakan nomor HP lain.',
            'password.required' => 'Kolom kata sandi tidak boleh kosong.',
            'password.min' => 'Kata sandi harus minimal 8 karakter.',
            'password.max' => 'Kata sandi harus maksimal 16 karakter.',
            'password.letters' => 'Kata sandi harus mengandung setidaknya satu huruf.',
            'password.mixed' => 'Kata sandi harus mengandung kombinasi huruf besar dan kecil.',
            'password.numbers' => 'Kata sandi harus mengandung setidaknya satu angka.',
            'password.symbols' => 'Kata sandi harus mengandung setidaknya satu simbol(!@#$%^&*).',
            'password.uncompromised' => 'Kata sandi ini telah muncul dalam kebocoran data (data leak), harap pilih kata sandi lain..',
            'confirm_password.required' => 'Kolom konfimasi kata sandi wajib di isi.',
            'confirm_password.same' => 'Konfirmasi kata sandi tidak cocok.',
            'terms' => 'Anda harus menyetujui syarat dan ketentuan, tolong di centang'
        ];
    }

    public function createNewUser() {

        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'username' => $this->username,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'terms' => $this->terms,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('verification.notice')->with('status', 'Link verifikasi telah dikirim ke email anda');
        
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
