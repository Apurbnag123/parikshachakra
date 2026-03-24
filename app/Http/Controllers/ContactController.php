<?php

namespace App\Http\Controllers;

use App\Models\ContactQuery;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $referrer = (string) ($request->headers->get('referer') ?? '');

        ContactQuery::create([
            'user_id' => $request->user()?->id,
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'message' => $data['message'],
            'source_url' => $referrer ?: null,
            'referrer' => $referrer ?: null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'new',
        ]);

        return back()->with('contact_status', 'Thanks! We received your message. We will contact you soon.');
    }
}

