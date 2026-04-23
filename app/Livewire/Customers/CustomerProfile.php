<?php

namespace App\Livewire\Customers;


use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function Livewire\str;

class CustomerProfile extends Component
{
    public $name;
    public $username;
    public $email;
    public $phone;
    public $avatar;

    public function mount() {

        $this->name = $this->user->name;
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
    }

    public function rules() {
        return [
            'name' => ['required', 'max:255', 'string'],
            'username' => ['required', 'min:5', 'max:16', Rule::unique('users')->ignore($this->user->id)],
            'email' => ['required', 'max:255', 'email:dns', Rule::unique('users')->ignore($this->user->id)],
            'phone' => ['required', 'min:6', 'max:12', Rule::unique('users')->ignore($this->user->id)],
            'avatar' => ['nullable', 'string']
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
        ];
    }

    public function getUserProperty() {
        return Auth::user();
    }
    
    public function updateProfileCustomer() {
        $this->validate();

        if($this->avatar && $this->avatar !== $this->user->avatar) {

            if($this->user->avatar) {
                Storage::disk('public')->delete($this->user->avatar);
            }

            $newFileName = str($this->avatar)->after('tmp/')->toString();
            $finalNameFile = "avatar/$newFileName";

            if( Storage::disk('public')->exists($this->avatar)) {
                
                Storage::disk('public')->move($this->avatar, $finalNameFile);
                $this->avatar = $finalNameFile;
            }
        }

        $this->user->update([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->phone,
            'avatar' => $this->avatar ?? $this->user->avatar
        ]);

        return redirect()->route('customer.profile')->with('success', 'Profile anda berhasil di edit.');

    }

    public function render()
    {
        return view('livewire.customers.customer-profile');
    }
}
