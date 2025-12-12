<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Client;
use App\Models\JobProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CandidateController extends Controller
{
    /**
     * Show Add Candidate Form
     */
   public function create()
{
    $clients = Client::all();  // Fetch all clients from DB
    $jobs = JobProfile::all();  // Fetch all jobs from DB

    return view('adminpannel.add_candidate', [
        'clients' => $clients,
        'jobs' => $jobs,
    ]);
}


    /**
     * Store candidate in database
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'        => 'required|string|max:100',
            'phone'             => 'required|regex:/^[0-9+\- ]{7,20}$/',
            'email'             => 'nullable|email|max:255',
            'last_salary'       => 'nullable|numeric',
            'expected_salary'   => 'nullable|numeric',
            'shift_preference'  => 'nullable|in:day,night,any,rotating',
            'client_id'         => 'nullable|uuid',
            'job_profile_id'    => 'nullable|uuid',
            'is_shortlisted'    => 'nullable|boolean',
            'shortlist_reason'  => 'nullable|string',
            'cv_url'            => 'nullable|file|mimes:pdf,doc,docx|max:4096',
        ], [
            'first_name.required' => "Please enter candidate's first name.",
            'phone.required'      => "Phone number is required.",
            'phone.regex'         => "Please enter a valid phone number.",
        ]);

        $cvPath = $request->hasFile('cv_url') ? $request->file('cv_url')->store('cvs', 'public') : null;

        Candidate::create([
            'id'                => Str::uuid(),
            'first_name'        => $request->first_name,
            'last_name'         => $request->last_name,
            'phone'             => $request->phone,
            'email'             => $request->email,
            'education'         => $request->education,
            'last_salary'       => $request->last_salary,
            'expected_salary'   => $request->expected_salary,
            'shift_preference'  => $request->shift_preference,
            'client_id'         => $request->client_id,
            'job_profile_id'    => $request->job_profile_id,
            'source'            => $request->source,
            'recruiter_id'      => Auth::id(),
            'status'            => 'new',
            'is_shortlisted'    => $request->is_shortlisted ? true : false,
            'shortlist_reason'  => $request->is_shortlisted ? $request->shortlist_reason : null,
            'notes'             => $request->notes,
            'cv_url'            => $cvPath,
            'doj'               => $request->doj,
            'doj_reminder_sent' => false,
        ]);

        \Log::info("Candidate created by " . Auth::user()->email . " (id: " . Auth::id() . ")");

        if ($request->action === 'save_next') {
            return redirect()->back()->with('success', 'Candidate saved successfully. Add next candidate.');
        }

        return redirect()->route('admin.candidates')->with('success', 'Candidate saved successfully.');
    }

    /**
     * List all candidates
     */
    public function index()
    {
        $candidates = Candidate::latest()->get();

        return view('adminpannel.candidates.index', compact('candidates'));
    }
}
