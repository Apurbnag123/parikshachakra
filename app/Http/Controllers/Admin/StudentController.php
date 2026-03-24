<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\FeeAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $q = (string) $request->query('q', '');

        $students = User::query()
            ->where('role', User::ROLE_STUDENT)
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('login_id', 'like', "%{$q}%");
                });
            })
            ->with('batch')
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('admin.students.index', [
            'students' => $students,
            'q' => $q,
        ]);
    }

    public function create()
    {
        return view('admin.students.create', [
            'batches' => Batch::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
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
            'batch_id' => ['nullable', 'integer', 'exists:batches,id'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

        $loginId = $this->generateLoginId();
        $plainPassword = $data['password'] ?? $this->generatePassword();
        $fullName = trim($data['first_name'].' '.$data['last_name']);

        $student = User::create([
            'name' => $fullName,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'father_name' => $data['father_name'],
            'gender' => $data['gender'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'address' => $data['address'],
            'pincode' => $data['pincode'],
            'password' => $plainPassword,
            'role' => User::ROLE_STUDENT,
            'login_id' => $loginId,
            'batch_id' => $data['batch_id'] ?? null,
        ]);

        if ($request->hasFile('photo')) {
            $student->photo_path = $request->file('photo')->store('profile_photos', 'public');
            $student->save();
        }

        FeeAccount::firstOrCreate(
            ['user_id' => $student->id],
            ['created_by' => $request->user()?->id]
        );

        return redirect()
            ->route('admin.students.index')
            ->with('status', "Student created. Login ID: {$loginId} Password: {$plainPassword}");
    }

    public function edit(User $student)
    {
        abort_unless($student->role === User::ROLE_STUDENT, 404);

        return view('admin.students.edit', [
            'student' => $student->load('batch'),
            'batches' => Batch::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, User $student)
    {
        abort_unless($student->role === User::ROLE_STUDENT, 404);

        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:120'],
            'last_name' => ['required', 'string', 'max:120'],
            'father_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:male,female,other'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$student->id],
            'address' => ['required', 'string'],
            'pincode' => ['required', 'string', 'max:10'],
            'photo' => ['nullable', 'image', 'max:5120'],
            'batch_id' => ['nullable', 'integer', 'exists:batches,id'],
            'new_password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

        $fullName = trim($data['first_name'].' '.$data['last_name']);

        $student->fill([
            'name' => $fullName,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'father_name' => $data['father_name'],
            'gender' => $data['gender'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'address' => $data['address'],
            'pincode' => $data['pincode'],
            'batch_id' => $data['batch_id'] ?? null,
        ]);

        $newPassword = $data['new_password'] ?? null;
        if ($newPassword) {
            $student->password = $newPassword;
        }

        if ($request->hasFile('photo')) {
            $student->photo_path = $request->file('photo')->store('profile_photos', 'public');
        }

        $student->save();

        $msg = 'Student updated.';
        if ($newPassword) {
            $msg .= ' New Password: '.$newPassword;
        }

        return redirect()->route('admin.students.index')->with('status', $msg);
    }

    public function destroy(User $student)
    {
        abort_unless($student->role === User::ROLE_STUDENT, 404);

        $student->delete();

        return redirect()->route('admin.students.index')->with('status', 'Student deleted.');
    }

    private function generateLoginId(): string
    {
        do {
            $candidate = 'PC'.str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (User::where('login_id', $candidate)->exists());

        return $candidate;
    }

    private function generatePassword(): string
    {
        // No symbols to avoid typing issues.
        return Str::upper(Str::random(10));
    }
}
