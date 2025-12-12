<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
    // Show user creation form
    public function create()
    {
        return view('users.create');
    }

    // Store new user
    public function store(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'required|max:100',
        'last_name' => 'nullable|max:100',
        'email' => 'required|email|unique:users,email',
        'phone' => 'nullable|max:20',
        'role' => 'required|in:admin,manager,recruiter,client',
        'password' => 'required|min:6',
        'is_active' => 'nullable|boolean',
        'timezone' => 'nullable|max:50',
    ]);

    $validated['id'] = (string) \Illuminate\Support\Str::uuid();
    $validated['password_hash'] = bcrypt($validated['password']);
    unset($validated['password']);
    $validated['is_active'] = $request->has('is_active') ? 1 : 0;

    User::create($validated);

    return redirect()->route('users.index')->with('success', 'User created successfully!');
}

    // List users with filters
    public function index(Request $request)
    {
        $query = User::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Role filter
        if ($request->filled('role')) {
            $query->where('role', $request->input('role'));
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('is_active', $request->input('status'));
        }

        $users = $query->orderBy('created_at', 'desc')->get();

        return view('users.user_view', compact('users'));
    }
}
