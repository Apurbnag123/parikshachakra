<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LiveClass;
use Illuminate\Http\Request;

class LiveClassController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $batchId = $user?->batch_id;

        $classes = LiveClass::query()
            ->where('is_published', true)
            ->where(function ($q) use ($batchId) {
                $q->whereNull('batch_id');
                if ($batchId) {
                    $q->orWhere('batch_id', $batchId);
                }
            })
            ->orderBy('starts_at')
            ->orderByDesc('id')
            ->paginate(20);

        return view('student.live_classes.index', [
            'classes' => $classes,
        ]);
    }

    public function join(Request $request, LiveClass $liveClass)
    {
        $user = $request->user();

        if (! $liveClass->is_published) {
            abort(404);
        }

        if ($liveClass->batch_id !== null && (int) $liveClass->batch_id !== (int) ($user?->batch_id ?? 0)) {
            abort(403);
        }

        if (($liveClass->meeting_provider ?? LiveClass::PROVIDER_EXTERNAL) !== LiveClass::PROVIDER_JITSI || ! $liveClass->meeting_room) {
            return redirect()->to($liveClass->meetingJoinUrl());
        }

        return view('student.live_classes.join', [
            'liveClass' => $liveClass,
            'jitsiDomain' => config('live_classes.jitsi_domain', 'meet.jit.si'),
        ]);
    }
}

