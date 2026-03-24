<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function index()
    {
        return view('admin.batches.index', [
            'batches' => Batch::orderBy('name')->paginate(20),
        ]);
    }

    public function create()
    {
        return view('admin.batches.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:batches,name'],
            'starts_on' => ['nullable', 'date'],
            'ends_on' => ['nullable', 'date'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        Batch::create([
            'name' => $data['name'],
            'starts_on' => $data['starts_on'] ?? null,
            'ends_on' => $data['ends_on'] ?? null,
            'is_active' => (bool) ($data['is_active'] ?? false),
        ]);

        return redirect()->route('admin.batches.index')->with('status', 'Batch created.');
    }

    public function edit(Batch $batch)
    {
        return view('admin.batches.edit', [
            'batch' => $batch,
        ]);
    }

    public function update(Request $request, Batch $batch)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:batches,name,'.$batch->id],
            'starts_on' => ['nullable', 'date'],
            'ends_on' => ['nullable', 'date'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $batch->fill([
            'name' => $data['name'],
            'starts_on' => $data['starts_on'] ?? null,
            'ends_on' => $data['ends_on'] ?? null,
            'is_active' => (bool) ($data['is_active'] ?? false),
        ])->save();

        return redirect()->route('admin.batches.index')->with('status', 'Batch updated.');
    }

    public function destroy(Batch $batch)
    {
        $batch->delete();

        return redirect()->route('admin.batches.index')->with('status', 'Batch deleted.');
    }
}

