<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RecruiterController extends Controller
{
    // List all recruiters
    public function index()
    {
        $recruiters = User::where('role', 'recruiter')->orderBy('created_at', 'desc')->get();
        return view('adminpannel.recruiters_view', compact('recruiters'));
    }

    // Edit recruiter
    public function edit($id)
    {
        $recruiter = User::findOrFail($id);
        return view('adminpannel.recruiter_edit', compact('recruiter'));
    }

    // Delete recruiter
    public function destroy($id)
    {
        $recruiter = User::findOrFail($id);
        $recruiter->delete();
        return redirect()->route('admin.recruiters')->with('success', 'Recruiter deleted successfully.');
    }
}
