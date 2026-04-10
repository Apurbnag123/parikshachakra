<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\ClassResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ClassResourceController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->string('type')->toString();

        $resources = ClassResource::with('batch')
            ->when($type, fn ($q) => $q->where('type', $type))
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('admin.class_resources.index', [
            'resources' => $resources,
            'type' => $type,
        ]);
    }

    public function create()
    {
        return view('admin.class_resources.create', [
            'batches' => Batch::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateRequest($request, isUpdate: false);

        $file = $request->file('file');
        $filePath = null;
        $mimeType = null;

        if ($file) {
            $filePath = $file->store($data['type'] === ClassResource::TYPE_VIDEO ? 'videos' : 'notes', 'public');
            $mimeType = $file->getClientMimeType();
        }

        $isPublished = (bool) ($data['is_published'] ?? false);

        ClassResource::create([
            'type' => $data['type'],
            'title' => $data['title'],
            'body' => $data['body'] ?? null,
            'url' => $data['url'] ?? null,
            'file_path' => $filePath,
            'mime_type' => $mimeType,
            'batch_id' => $data['batch_id'] ?? null,
            'is_published' => $isPublished,
            'published_at' => $isPublished ? now() : null,
            'created_by' => $request->user()?->id,
        ]);

        return redirect()->route('admin.class-resources.index')->with('status', 'Resource saved.');
    }

    public function edit(ClassResource $classResource)
    {
        return view('admin.class_resources.edit', [
            'resource' => $classResource,
            'batches' => Batch::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, ClassResource $classResource)
    {
        $data = $this->validateRequest($request, isUpdate: true);

        $file = $request->file('file');
        $filePath = $classResource->file_path;
        $mimeType = $classResource->mime_type;

        if ($file) {
            if ($filePath) {
                Storage::disk('public')->delete($filePath);
            }
            $filePath = $file->store($data['type'] === ClassResource::TYPE_VIDEO ? 'videos' : 'notes', 'public');
            $mimeType = $file->getClientMimeType();
        }

        $isPublished = (bool) ($data['is_published'] ?? false);

        $classResource->fill([
            'type' => $data['type'],
            'title' => $data['title'],
            'body' => $data['body'] ?? null,
            'url' => $data['url'] ?? null,
            'file_path' => $filePath,
            'mime_type' => $mimeType,
            'batch_id' => $data['batch_id'] ?? null,
            'is_published' => $isPublished,
        ]);

        if ($isPublished && ! $classResource->published_at) {
            $classResource->published_at = now();
        }
        if (! $isPublished) {
            $classResource->published_at = null;
        }

        $classResource->save();

        return redirect()->route('admin.class-resources.index')->with('status', 'Resource updated.');
    }

    public function destroy(ClassResource $classResource)
    {
        if ($classResource->file_path) {
            Storage::disk('public')->delete($classResource->file_path);
        }

        $classResource->delete();

        return redirect()->route('admin.class-resources.index')->with('status', 'Resource deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validateRequest(Request $request, bool $isUpdate): array
    {
        $rules = [
            'type' => ['required', 'string', 'in:video,note'],
            'title' => ['required', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'url' => ['nullable', 'string', 'max:2048'],
            'file' => ['nullable', 'file', 'max:512000'], // 500MB (php.ini may still limit)
            'batch_id' => ['nullable', 'integer', 'exists:batches,id'],
            'is_published' => ['nullable', 'boolean'],
        ];

        $validator = Validator::make($request->all(), $rules);

        $validator->after(function ($v) use ($request, $isUpdate) {
            $type = (string) $request->input('type');

            if ($type === ClassResource::TYPE_VIDEO) {
                if (! $isUpdate && ! $request->file('file') && ! $request->filled('url')) {
                    $v->errors()->add('url', 'Upload a video file or provide a video URL.');
                }
            }

            if ($type === ClassResource::TYPE_NOTE) {
                if (! $isUpdate && ! $request->file('file') && ! $request->filled('body')) {
                    $v->errors()->add('body', 'Upload a notes file or write notes text.');
                }
            }
        });

        return $validator->validate();
    }
}
