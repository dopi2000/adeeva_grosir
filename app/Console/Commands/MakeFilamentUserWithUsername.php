<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeFilamentUserWithUsername extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:filament-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat user baru untuk Filament dengan field username';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Name');
        $phone = $this->ask('Phone');
        $username = $this->ask('Username');
        $email = $this->ask('Email');
        $password = $this->secret('Password');
        $roles = ['owner', 'staff', 'customer'];

        $role = $this->choice('Role', $roles, 'customer');

        $user = User::create([
            'name' => $name,
            'username' => $username,
            'phone' => $phone,
            'email' => $email,
            'role' => $role,
            'password' => Hash::make($password),
        ]);

        $this->info("User {$user->name} dengan username {$user->username} berhasil dibuat!");
    }
}
