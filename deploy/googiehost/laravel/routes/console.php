<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('pc:create-admin {name} {email} {password} {--login_id=}', function () {
    $name = (string) $this->argument('name');
    $email = (string) $this->argument('email');
    $password = (string) $this->argument('password');
    $loginId = (string) ($this->option('login_id') ?: 'ADMIN'.str_pad((string) random_int(1, 9999), 4, '0', STR_PAD_LEFT));

    if (User::where('email', $email)->exists()) {
        $this->error('Email already exists.');
        return 1;
    }

    if (User::where('login_id', $loginId)->exists()) {
        $this->error('Login ID already exists.');
        return 1;
    }

    $user = User::create([
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'role' => User::ROLE_ADMIN,
        'login_id' => $loginId,
    ]);

    $this->info("Admin created: {$user->email} | Login ID: {$user->login_id}");
    return 0;
})->purpose('Create an admin user (ParikshaChakra)');
