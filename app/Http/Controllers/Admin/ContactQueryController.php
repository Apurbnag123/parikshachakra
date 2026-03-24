<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactQuery;
use Illuminate\Http\Request;

class ContactQueryController extends Controller
{
    public function index(Request $request)
    {
        $status = (string) $request->query('status', 'new');
        if (! in_array($status, ['new', 'resolved', 'all'], true)) {
            $status = 'new';
        }

        $queries = ContactQuery::query()
            ->with('user')
            ->when($status !== 'all', fn ($q) => $q->where('status', $status))
            ->orderByDesc('id')
            ->paginate(25)
            ->withQueryString();

        return view('admin.contacts.index', [
            'queries' => $queries,
            'status' => $status,
        ]);
    }

    public function show(ContactQuery $contactQuery)
    {
        return view('admin.contacts.show', [
            'q' => $contactQuery->load('user'),
        ]);
    }

    public function resolve(ContactQuery $contactQuery)
    {
        $contactQuery->status = 'resolved';
        $contactQuery->resolved_at = now();
        $contactQuery->save();

        return redirect()->route('admin.contacts.show', $contactQuery)->with('status', 'Marked as resolved.');
    }

    public function destroy(ContactQuery $contactQuery)
    {
        $contactQuery->delete();

        return redirect()->route('admin.contacts.index')->with('status', 'Contact query deleted.');
    }
}

