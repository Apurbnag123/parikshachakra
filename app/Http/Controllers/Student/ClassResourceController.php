<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ClassResource;
use Illuminate\Http\Request;

class ClassResourceController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $batchId = $user?->batch_id;

        $type = $request->string('type')->toString();

        $resources = ClassResource::query()
            ->where('is_published', true)
            ->when($type, fn ($q) => $q->where('type', $type))
            ->where(function ($q) use ($batchId) {
                $q->whereNull('batch_id');
                if ($batchId) {
                    $q->orWhere('batch_id', $batchId);
                }
            })
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('student.class_resources.index', [
            'resources' => $resources,
            'type' => $type,
        ]);
    }

    public function show(Request $request, ClassResource $classResource)
    {
        $user = $request->user();

        if (! $classResource->is_published) {
            abort(404);
        }

        if ($classResource->batch_id !== null && (int) $classResource->batch_id !== (int) ($user?->batch_id ?? 0)) {
            abort(403);
        }

        return view('student.class_resources.show', [
            'resource' => $classResource,
        ]);
    }
}

