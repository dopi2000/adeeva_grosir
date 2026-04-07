<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class LoginUser extends Component
{
    public $user_cred = '';
    public $password = '';
    public $remember_me = false;

    public function getCredentials() : array {
        $user_type = filter_var($this->user_cred, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        return [
            $user_type => $this->user_cred,
            'password' => $this->password,
        ];
    }

    protected function rules() {
        return [
            'user_cred' => ['required', 'max:255'],
            'password' => ['required', 'max:16']
        ];
    }

    protected function messages() {
        return [
            'user_cred.required' => 'Email atau nama pengguna tidak boleh kosong.',
            'user_cred.max' => 'Email atau nama pengguna maksimal 255 karakter.',
            'password.required' => 'Kata sandi tidak boleh kosong.',
            'password.max' => 'Kata sandi maksimal 16 karakter.',
        ];
    }
    
    public function loginUser() {
        $this->validate();
        
        $credentials = $this->getCredentials();

        $throttleKey = Str::lower(Arr::first($credentials)) . '|' . request()->ip();

        if(RateLimiter::tooManyAttempts($throttleKey, 5)) {

            $seconds = RateLimiter::availableIn($throttleKey);

            return back()->with('error', "Terlalu banyak percobaan login. Silakan coba lagi dalam $seconds detik.");
        }


        $user = User::where(array_key_first($credentials), Arr::first($credentials))->first();

        if($user === null || !Auth::attempt($credentials)) {

            RateLimiter::hit($throttleKey, 60);

            return back()->with('error', 'Nama pengguna atau email dan kata sandi salah, silahkan periksa kembali');
        }
        if(!$user->hasVerifiedEmail()) {

            $user->sendEmailVerificationNotification();

            $verificationToken = Str::random(40);

            session()->put('verification_token', $verificationToken);
            
            return redirect()->route('verification.notice', [
                'username' => $user->username,
                'token' => $verificationToken
            ])->with('status', 'Akun Anda belum diverifikasi, Silakan cek email dan klik tautan verifikasi yang telah kami kirimkan ke email Anda. ');
        }
        
        if(Auth::attempt($credentials, $this->remember_me)) {
            RateLimiter::clear($throttleKey);
            return redirect()->intended('/');
        }
    }

    public function render()
    {
        return view('livewire.auth.login-user');
    }
}
