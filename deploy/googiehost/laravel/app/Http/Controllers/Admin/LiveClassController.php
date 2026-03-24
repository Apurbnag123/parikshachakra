<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\LiveClass;
use Illuminate\Http\Request;

class LiveClassController extends Controller
{
    public function index()
    {
        $classes = LiveClass::with('batch')
            ->orderByDesc('starts_at')
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.live_classes.index', [
            'classes' => $classes,
        ]);
    }

    public function create()
    {
        return view('admin.live_classes.create', [
            'batches' => Batch::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'meeting_url' => ['required', 'string', 'max:2048'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date'],
            'batch_id' => ['nullable', 'integer', 'exists:batches,id'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        LiveClass::create([
            'title' => $data['title'],
            'meeting_url' => $data['meeting_url'],
            'starts_at' => $data['starts_at'] ?? null,
            'ends_at' => $data['ends_at'] ?? null,
            'batch_id' => $data['batch_id'] ?? null,
            'is_published' => (bool) ($data['is_published'] ?? false),
            'created_by' => $request->user()?->id,
        ]);

        return redirect()->route('admin.live-classes.index')->with('status', 'Live class saved.');
    }

    public function edit(LiveClass $liveClass)
    {
        return view('admin.live_classes.edit', [
            'liveClass' => $liveClass,
            'batches' => Batch::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, LiveClass $liveClass)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'meeting_url' => ['required', 'string', 'max:2048'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date'],
            'batch_id' => ['nullable', 'integer', 'exists:batches,id'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $liveClass->fill([
            'title' => $data['title'],
            'meeting_url' => $data['meeting_url'],
            'starts_at' => $data['starts_at'] ?? null,
            'ends_at' => $data['ends_at'] ?? null,
            'batch_id' => $data['batch_id'] ?? null,
            'is_published' => (bool) ($data['is_published'] ?? false),
        ])->save();

        return redirect()->route('admin.live-classes.index')->with('status', 'Live class updated.');
    }

    public function destroy(LiveClass $liveClass)
    {
        $liveClass->delete();

        return redirect()->route('admin.live-classes.index')->with('status', 'Live class deleted.');
    }
}

