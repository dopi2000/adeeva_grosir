<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordUser extends Component
{
    public $old_password;
    public $new_password;
    public $confirm_new_password;

    public function rules() {
        return [
            'old_password' => ['required'],
            'new_password' => ['required', 'min:8', 'max:16', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
            'confirm_new_password' => ['required', 'same:new_password']
        ];
    }

    public function messages() {
        return [
            'old_password.required' => 'Kolom kata sandi lama tidak boleh kosong.',
            'new_password.required' => 'Kolom kata sandi baru tidak boleh kosong.',
            'new_password.min' => 'Kata sandi harus minimal 8 karakter.',
            'new_password.max' => 'Kata sandi harus maksimal 16 karakter.',
            'new_password.regex' => 'Kata sandi harus terdiri dari kombinasi huruf, angka, atau karater lain.',
            'confirm_new_password.required' => 'Kolom konfimasi kata sandi wajib di isi.',
            'confirm_new_password.same' => 'Konfirmasi kata sandi tidak sama.',
        ];
    }

    public function changeNewPassword() {
        $this->validate();
        $checkOldPassword = Hash::check($this->old_password, Auth::user()->password);
        $checkNewPassword = Hash::check($this->new_password, Auth::user()->password);

        if(!$checkOldPassword) {
            $this->reset();
            return redirect()->route('change.password.user')->with('error', 'Kata sandi lama yang diinputkan tidak cocok');
        }

        if($checkNewPassword) {
            $this->reset();
            return redirect()->route('change.password.user')->with('warning', 'Kata sandi baru tidak boleh sama dengan kata sandi lama');
        }

        if($checkOldPassword) {
            Auth::user()->update([
                'password' => Hash::make($this->new_password)
            ]);
            $this->reset();
            return redirect()->route('change.password.user')->with('success', 'Kata sandi anda berhasil diganti');
        }
    }
    public function render()
    {
        return view('livewire.auth.change-password-user');
    }
}
