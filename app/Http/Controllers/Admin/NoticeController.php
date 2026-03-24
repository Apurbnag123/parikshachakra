<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::with('batch')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.notices.index', [
            'notices' => $notices,
        ]);
    }

    public function create()
    {
        return view('admin.notices.create', [
            'batches' => Batch::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'batch_id' => ['nullable', 'integer', 'exists:batches,id'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $isPublished = (bool) ($data['is_published'] ?? false);

        Notice::create([
            'title' => $data['title'],
            'body' => $data['body'],
            'batch_id' => $data['batch_id'] ?? null,
            'is_published' => $isPublished,
            'published_at' => $isPublished ? now() : null,
            'created_by' => $request->user()?->id,
        ]);

        return redirect()->route('admin.notices.index')->with('status', 'Notice saved.');
    }

    public function edit(Notice $notice)
    {
        return view('admin.notices.edit', [
            'notice' => $notice,
            'batches' => Batch::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Notice $notice)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'batch_id' => ['nullable', 'integer', 'exists:batches,id'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $isPublished = (bool) ($data['is_published'] ?? false);

        $notice->fill([
            'title' => $data['title'],
            'body' => $data['body'],
            'batch_id' => $data['batch_id'] ?? null,
            'is_published' => $isPublished,
        ]);

        if ($isPublished && ! $notice->published_at) {
            $notice->published_at = now();
        }
        if (! $isPublished) {
            $notice->published_at = null;
        }

        $notice->save();

        return redirect()->route('admin.notices.index')->with('status', 'Notice updated.');
    }

    public function destroy(Notice $notice)
    {
        $notice->delete();

        return redirect()->route('admin.notices.index')->with('status', 'Notice deleted.');
    }
}

