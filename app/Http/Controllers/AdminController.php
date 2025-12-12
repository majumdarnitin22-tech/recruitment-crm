<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Assuming clients are stored in users table with role 'client'

class AdminController extends Controller
{
    public function clientsView(Request $request)
    {
        // Fetch clients from DB
        $query = User::where('role', 'client');

        // Optional filters
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%'.$request->search.'%')
                  ->orWhere('last_name', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

        $clients = $query->orderBy('created_at', 'desc')->get();

        return view('adminpannel.clients_view', compact('clients'));
    }
}
