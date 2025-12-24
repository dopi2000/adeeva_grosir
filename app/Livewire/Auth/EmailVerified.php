<?php

namespace App\Livewire\Auth;


use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerified extends Component
{
  
    public function logout() {
        redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.email-verified');
    }
}
