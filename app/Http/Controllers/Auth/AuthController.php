<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
            'remember' => ['nullable', 'boolean'],
        ]);

        $throttleKey = Str::lower($data['login']).'|'.$request->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 10)) {
            throw ValidationException::withMessages([
                'login' => 'Too many login attempts. Please try again later.',
            ]);
        }

        $credentials = Str::contains($data['login'], '@')
            ? ['email' => $data['login'], 'password' => $data['password']]
            : ['login_id' => $data['login'], 'password' => $data['password']];

        if (! Auth::attempt($credentials, (bool) ($data['remember'] ?? false))) {
            RateLimiter::hit($throttleKey, 60);
            throw ValidationException::withMessages([
                'login' => 'Invalid credentials.',
            ]);
        }

        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();

        return $this->redirectAfterAuth($request->user());
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $loginId = $this->generateAdminLoginId();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => User::ROLE_ADMIN,
            'login_id' => $loginId,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()
            ->route('admin.dashboard')
            ->with('status', 'Admin created. Your Login ID is: '.$loginId);
    }

    public function showStudentRegister()
    {
        return view('auth.student_register');
    }

    public function registerStudent(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:120'],
            'last_name' => ['required', 'string', 'max:120'],
            'father_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:male,female,other'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'address' => ['required', 'string'],
            'pincode' => ['required', 'string', 'max:10'],
            'photo' => ['nullable', 'image', 'max:5120'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $loginId = $this->generateStudentLoginId();

        $fullName = trim($data['first_name'].' '.$data['last_name']);

        $user = User::create([
            'name' => $fullName,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'father_name' => $data['father_name'],
            'gender' => $data['gender'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'address' => $data['address'],
            'pincode' => $data['pincode'],
            'password' => $data['password'],
            'role' => User::ROLE_STUDENT,
            'login_id' => $loginId,
        ]);

        if ($request->hasFile('photo')) {
            $user->photo_path = $request->file('photo')->store('profile_photos', 'public');
            $user->save();
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()
            ->route('student.dashboard')
            ->with('status', 'Student registered. Your Login ID is: '.$loginId);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Logged out.');
    }

    private function redirectAfterAuth(?User $user)
    {
        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->role === User::ROLE_ADMIN) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('student.dashboard');
    }

    private function generateLoginId(): string
    {
        do {
            $candidate = 'PC'.str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (User::where('login_id', $candidate)->exists());

        return $candidate;
    }

    private function generateStudentLoginId(): string
    {
        return $this->generateLoginId();
    }

    private function generateAdminLoginId(): string
    {
        do {
            $candidate = 'ADMIN'.str_pad((string) random_int(1, 9999), 4, '0', STR_PAD_LEFT);
        } while (User::where('login_id', $candidate)->exists());

        return $candidate;
    }
}
