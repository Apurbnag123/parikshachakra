<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('student.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'photo' => ['nullable', 'image', 'max:5120'], // 5MB
            'signature' => ['nullable', 'image', 'max:5120'],
        ]);

        $user->email = $data['email'];

        if ($request->hasFile('photo')) {
            $user->photo_path = $request->file('photo')->store('profile_photos', 'public');
        }

        if ($request->hasFile('signature')) {
            $user->signature_path = $request->file('signature')->store('signatures', 'public');
        }

        $user->save();

        return redirect()->route('student.profile.edit')->with('status', 'Profile updated.');
    }
}

