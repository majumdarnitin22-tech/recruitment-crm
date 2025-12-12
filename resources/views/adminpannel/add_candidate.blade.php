@extends('layouts.admin.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Candidate</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .container {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
        }
        
        h2 {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        h2::before {
            content: "person_add";
            font-family: 'Material Icons';
            -webkit-text-fill-color: #667eea;
            font-size: 2rem;
        }
        
        /* Back Button */
        .btn-secondary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
            color: white;
        }
        
        .btn-secondary::before {
            content: "arrow_back";
            font-family: 'Material Icons';
            font-size: 18px;
        }
        
        /* Alert */
        .alert-success {
            background: linear-gradient(135deg, rgba(67, 233, 123, 0.1), rgba(56, 249, 215, 0.1));
            border: 2px solid #43e97b;
            border-radius: 10px;
            color: #0d6832;
            font-weight: 600;
            padding: 1rem 1.5rem;
        }
        
        /* Form Styling */
        .form-label, label {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .form-control, .form-select {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            outline: none;
        }
        
        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }
        
        /* Radio Buttons */
        input[type="radio"] {
            width: 18px;
            height: 18px;
            margin-right: 5px;
            accent-color: #667eea;
            cursor: pointer;
        }
        
        label:has(input[type="radio"]) {
            display: inline-flex;
            align-items: center;
            cursor: pointer;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        
        label:has(input[type="radio"]):hover {
            background-color: rgba(102, 126, 234, 0.05);
        }
        
        /* Shortlist Box */
        #shortlistBox {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
            border-radius: 15px;
            padding: 1.5rem;
            border: 2px solid #e2e8f0;
            animation: slideDown 0.3s ease;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* File Input */
        input[type="file"].form-control {
            padding: 0.6rem 1rem;
            cursor: pointer;
        }
        
        input[type="file"].form-control::file-selector-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            color: white;
            font-weight: 600;
            margin-right: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        input[type="file"].form-control::file-selector-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(102, 126, 234, 0.3);
        }
        
        /* Submit Buttons */
        .btn-success {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(67, 233, 123, 0.4);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(67, 233, 123, 0.5);
            color: white;
        }
        
        .btn-success::before {
            content: "save";
            font-family: 'Material Icons';
            font-size: 18px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 172, 254, 0.5);
            color: white;
        }
        
        .btn-primary::before {
            content: "arrow_forward";
            font-family: 'Material Icons';
            font-size: 18px;
        }
        
        /* Form Grid */
        .row {
            margin-bottom: 1rem;
        }
        
        .mb-3 {
            margin-bottom: 1.5rem !important;
        }
        
        /* Required Field Indicator */
        label:has(+ input[required])::after,
        label:has(+ select[required])::after {
            content: "*";
            color: #ef4444;
            margin-left: 4px;
            font-weight: 700;
        }
        
        /* Form Section Divider */
        .col-md-12.mb-3 {
            border-top: 2px dashed #e2e8f0;
            padding-top: 1.5rem;
            margin-top: 1rem;
        }
        
        .col-md-12.mb-3:first-of-type {
            border-top: none;
            padding-top: 0;
            margin-top: 0;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 1.5rem;
            }
            
            h2 {
                font-size: 1.5rem;
            }
            
            .btn-success,
            .btn-primary {
                width: 100%;
                margin-bottom: 0.5rem;
                justify-content: center;
            }
            
            .ms-2 {
                margin-left: 0 !important;
            }
            
            label:has(input[type="radio"]) {
                display: flex;
                width: 100%;
                margin-bottom: 0.5rem;
            }
            
            .ms-3 {
                margin-left: 0 !important;
            }
        }
        
        /* Select Dropdown Arrow */
        .form-select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23667eea' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 12px;
        }
        
        /* Placeholder Styling */
        .form-control::placeholder {
            color: #94a3b8;
            font-style: italic;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2>Add Candidate (Sourcing Form)</h2>
    <a href="{{ route('admin.candidates') }}" class="btn btn-secondary mb-3">Back to List</a>

    @if(session('success'))
        <div class="alert alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.candidates.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-md-6 mb-3">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" placeholder="Enter first name" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" placeholder="Enter last name">
            </div>

            <div class="col-md-6 mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" placeholder="+91 1234567890" required pattern="^[0-9+\- ]{7,20}$">
            </div>

            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="candidate@example.com">
            </div>

            <div class="col-md-6 mb-3">
                <label>Education</label>
                <input type="text" name="education" class="form-control" placeholder="B.Tech, MBA, etc.">
            </div>

            <div class="col-md-6 mb-3">
                <label>Last Salary</label>
                <input type="number" name="last_salary" class="form-control" placeholder="Enter amount">
            </div>

            <div class="col-md-6 mb-3">
                <label>Expected Salary</label>
                <input type="number" name="expected_salary" class="form-control" placeholder="Enter amount">
            </div>

            <div class="col-md-6 mb-3">
                <label>Shift Preference</label>
                <select name="shift_preference" class="form-control">
                    <option value="any">Any</option>
                    <option value="day">Day</option>
                    <option value="night">Night</option>
                    <option value="rotating">Rotating</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
    <label>Client</label>
    <select name="client_id" class="form-control">
        <option value="">General</option>
        @foreach($clients as $client)
            <option value="{{ $client->id }}">{{ $client->company_name }}</option>
        @endforeach
    </select>
</div>


            <div class="col-md-6 mb-3">
                <label>Job Profile</label>
                <select name="job_profile_id" class="form-control">
                    <option value="">-- Select Job --</option>
                    @foreach($jobs as $job)
                        <option value="{{ $job->id }}">{{ $job->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Source</label>
                <select name="source" class="form-control">
                    <option value="google_sheet">Google Sheet</option>
                    <option value="referral">Referral</option>
                    <option value="linkedin">LinkedIn</option>
                    <option value="naukri">Naukri</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Shortlisted?</label><br>
                <label><input type="radio" name="is_shortlisted" value="1" onclick="toggleShortlist(true)"> Yes</label>
                <label class="ms-3"><input type="radio" name="is_shortlisted" value="0" checked onclick="toggleShortlist(false)"> No</label>
            </div>

            <div class="col-md-12 mb-3" id="shortlistBox" style="display:none;">
                <label>Shortlist Reason</label>
                <textarea name="shortlist_reason" class="form-control" placeholder="Enter reason for shortlisting this candidate..."></textarea>
            </div>

            <div class="col-md-12 mb-3">
                <label>Notes</label>
                <textarea name="notes" class="form-control" placeholder="Add any additional notes or comments..."></textarea>
            </div>

            <div class="col-md-12 mb-3">
                <label>Attach CV (PDF/Doc)</label>
                <input type="file" name="cv_url" class="form-control" accept=".pdf,.doc,.docx">
            </div>

        </div>

        <button type="submit" name="action" value="save" class="btn btn-success">Save</button>
        <button type="submit" name="action" value="save_next" class="btn btn-primary ms-2">Save & Next</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleShortlist(show) {
        const box = document.getElementById("shortlistBox");
        if (show) {
            box.style.display = "block";
        } else {
            box.style.display = "none";
        }
    }
</script>

</body>
</html>
@endsection