<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('users.create');   // create form file
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:admin,manager,recruiter,client',
            'password' => 'required|string|min:8',
            'is_active' => 'nullable|boolean',
            'timezone' => 'nullable|string|max:50',
        ]);

        $isActive = $request->input('is_active', 0) ? true : false;

        User::create([
            'id' => Str::uuid(),
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'] ?? null,
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role' => $validated['role'],
            'password_hash' => Hash::make($validated['password']),
            'is_active' => $isActive,
            'timezone' => $validated['timezone'] ?? 'Asia/Kolkata',
        ]);

        return redirect()->route('users.index')
                         ->with('success', 'User created successfully!');
    }

    public function index()
    {
        $users = User::all();
        return view('users.user_view', compact('users'));
    }
}

