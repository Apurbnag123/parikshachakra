<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResultEntry;
use App\Models\User;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $results = ResultEntry::with('user')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.results.index', [
            'results' => $results,
        ]);
    }

    public function create()
    {
        return view('admin.results.create', [
            'students' => User::where('role', User::ROLE_STUDENT)->orderBy('name')->get(['id', 'name', 'login_id']),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'remarks' => ['nullable', 'string'],
            'file' => ['nullable', 'file', 'max:10240'], // 10MB
        ]);

        $student = User::findOrFail($data['user_id']);
        abort_unless($student->role === User::ROLE_STUDENT, 422);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('results', 'public');
        }

        ResultEntry::create([
            'user_id' => $student->id,
            'title' => $data['title'],
            'remarks' => $data['remarks'] ?? null,
            'file_path' => $filePath,
            'published_at' => now(),
            'created_by' => $request->user()?->id,
        ]);

        return redirect()->route('admin.results.index')->with('status', 'Result published.');
    }

    public function destroy(ResultEntry $result)
    {
        $result->delete();

        return redirect()->route('admin.results.index')->with('status', 'Result deleted.');
    }
}
