<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\LiveClass;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'meeting_provider' => ['nullable', 'string', 'in:external,jitsi'],
            'meeting_room' => ['nullable', 'string', 'max:128', 'alpha_dash'],
            'meeting_url' => ['nullable', 'string', 'max:2048', 'required_if:meeting_provider,external'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date'],
            'batch_id' => ['nullable', 'integer', 'exists:batches,id'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $provider = $data['meeting_provider'] ?? LiveClass::PROVIDER_EXTERNAL;
        $meetingRoom = null;
        $meetingUrl = $data['meeting_url'] ?? '';

        if ($provider === LiveClass::PROVIDER_JITSI) {
            $meetingRoom = $data['meeting_room'] ?? null;
            if (! $meetingRoom) {
                $meetingRoom = trim((string) Str::slug($data['title']));
                if ($meetingRoom === '') {
                    $meetingRoom = 'live-class';
                }
                $meetingRoom .= '-' . bin2hex(random_bytes(3));
            }
            $meetingUrl = 'https://' . config('live_classes.jitsi_domain', 'meet.jit.si') . '/' . $meetingRoom;
        }

        LiveClass::create([
            'title' => $data['title'],
            'meeting_url' => $meetingUrl,
            'meeting_provider' => $provider,
            'meeting_room' => $meetingRoom,
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
            'meeting_provider' => ['nullable', 'string', 'in:external,jitsi'],
            'meeting_room' => ['nullable', 'string', 'max:128', 'alpha_dash'],
            'meeting_url' => ['nullable', 'string', 'max:2048', 'required_if:meeting_provider,external'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date'],
            'batch_id' => ['nullable', 'integer', 'exists:batches,id'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $provider = $data['meeting_provider'] ?? $liveClass->meeting_provider ?? LiveClass::PROVIDER_EXTERNAL;
        $meetingRoom = null;
        $meetingUrl = $data['meeting_url'] ?? '';

        if ($provider === LiveClass::PROVIDER_JITSI) {
            $meetingRoom = $data['meeting_room'] ?? $liveClass->meeting_room ?? null;
            if (! $meetingRoom) {
                $meetingRoom = trim((string) Str::slug($data['title']));
                if ($meetingRoom === '') {
                    $meetingRoom = 'live-class';
                }
                $meetingRoom .= '-' . bin2hex(random_bytes(3));
            }
            $meetingUrl = 'https://' . config('live_classes.jitsi_domain', 'meet.jit.si') . '/' . $meetingRoom;
        }

        $liveClass->fill([
            'title' => $data['title'],
            'meeting_url' => $meetingUrl,
            'meeting_provider' => $provider,
            'meeting_room' => $meetingRoom,
            'starts_at' => $data['starts_at'] ?? null,
            'ends_at' => $data['ends_at'] ?? null,
            'batch_id' => $data['batch_id'] ?? null,
            'is_published' => (bool) ($data['is_published'] ?? false),
        ])->save();

        return redirect()->route('admin.live-classes.index')->with('status', 'Live class updated.');
    }

    public function start(Request $request, LiveClass $liveClass)
    {
        if (($liveClass->meeting_provider ?? LiveClass::PROVIDER_EXTERNAL) !== LiveClass::PROVIDER_JITSI || ! $liveClass->meeting_room) {
            return redirect()->to($liveClass->meetingJoinUrl());
        }

        return view('admin.live_classes.start', [
            'liveClass' => $liveClass,
            'jitsiDomain' => config('live_classes.jitsi_domain', 'meet.jit.si'),
        ]);
    }

    public function destroy(LiveClass $liveClass)
    {
        $liveClass->delete();

        return redirect()->route('admin.live-classes.index')->with('status', 'Live class deleted.');
    }
}
