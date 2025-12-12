<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    // Show all clients
    public function index()
    {
        $clients = Client::orderBy('created_at', 'desc')->get();
        return view('clients.clients_view', compact('clients')); // Make sure this exists too
    }

    // Show create client form
    public function create()
    {
        return view('clients.clients_form'); // points to resources/views/clients/clients_form.blade.php
    }

    // Store new client
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name'   => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'contact_email'  => 'nullable|email|unique:clients,contact_email',
            'contact_phone'  => 'nullable|string|max:20',
            'address'        => 'nullable|string|max:500',
            'billing_rate'   => 'nullable|numeric',
            'password'       => 'required|string|min:6',
            'notes'          => 'nullable|string',
        ]);

        $client = new Client();
        $client->id              = Str::uuid();
        $client->company_name    = $validated['company_name'];
        $client->contact_person  = $validated['contact_person'] ?? null;
        $client->contact_email   = $validated['contact_email'] ?? null;
        $client->contact_phone   = $validated['contact_phone'] ?? null;
        $client->address         = $validated['address'] ?? null;
        $client->billing_rate    = $validated['billing_rate'] ?? null;
        $client->notes           = $validated['notes'] ?? null;
        $client->password_hash   = bcrypt($validated['password']);

        if (auth()->check()) {
            $client->created_by = auth()->id();
        }

        $client->save();

        return redirect()->route('admin.clients')->with('success', 'Client created successfully.');
    }

    // Edit client
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.clients_form', compact('client')); // reuse the form for editing
    }

    // Update client
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $validated = $request->validate([
            'company_name'   => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'contact_email'  => 'nullable|email|unique:clients,contact_email,' . $client->id . ',id',
            'contact_phone'  => 'nullable|string|max:20',
            'address'        => 'nullable|string|max:500',
            'billing_rate'   => 'nullable|numeric',
            'password'       => 'nullable|string|min:6',
            'notes'          => 'nullable|string',
        ]);

        $client->company_name    = $validated['company_name'];
        $client->contact_person  = $validated['contact_person'] ?? null;
        $client->contact_email   = $validated['contact_email'] ?? null;
        $client->contact_phone   = $validated['contact_phone'] ?? null;
        $client->address         = $validated['address'] ?? null;
        $client->billing_rate    = $validated['billing_rate'] ?? null;
        $client->notes           = $validated['notes'] ?? null;

        if (!empty($validated['password'])) {
            $client->password_hash = bcrypt($validated['password']);
        }

        $client->save();

        return redirect()->route('admin.clients')->with('success', 'Client updated successfully.');
    }

    // Delete client
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('admin.clients')->with('success', 'Client deleted successfully.');
    }
}
    