@extends('layouts.admin.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .form-container {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
        }
        
        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #4facfe);
            background-size: 200% 100%;
            animation: gradient 3s ease infinite;
        }
        
        @keyframes gradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        h2 {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        h2::before {
            content: '';
            width: 5px;
            height: 35px;
            background: linear-gradient(180deg, #667eea, #764ba2);
            border-radius: 10px;
        }
        
        /* Form Labels */
        .form-label {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .form-label::before {
            content: '•';
            color: #667eea;
            font-size: 1.5rem;
            line-height: 1;
        }
        
        /* Form Inputs */
        .form-control, .form-select {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            outline: none;
        }
        
        .form-control:hover, .form-select:hover {
            border-color: #b4bfea;
        }
        
        /* Checkbox */
        .form-check {
            padding: 1rem;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .form-check:hover {
            border-color: #667eea;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        }
        
        .form-check-input {
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid #667eea;
            cursor: pointer;
        }
        
        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }
        
        .form-check-label {
            font-weight: 600;
            color: #1e293b;
            cursor: pointer;
            margin-left: 0.5rem;
        }
        
        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 2rem;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
            background: linear-gradient(135deg, #5568d3 0%, #653a8b 100%);
        }
        
        .btn-primary::before {
            content: '✓';
            font-size: 1.2rem;
        }
        
        .btn-outline-secondary {
            border: 2px solid #667eea;
            color: #667eea;
            border-radius: 12px;
            padding: 0.75rem 2rem;
            font-weight: 700;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-outline-secondary:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: transparent;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        
        .btn-outline-secondary::before {
            content: '←';
            font-size: 1.2rem;
        }
        
        /* Alerts */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.25rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        
        .alert-success {
            background: linear-gradient(135deg, rgba(67, 233, 123, 0.15), rgba(56, 249, 215, 0.15));
            color: #0d6832;
            border-left: 4px solid #43e97b;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, rgba(250, 112, 154, 0.15), rgba(254, 225, 64, 0.15));
            color: #991b1b;
            border-left: 4px solid #fa709a;
        }
        
        .alert ul {
            margin: 0;
            padding-left: 1.25rem;
        }
        
        .alert li {
            margin-bottom: 0.25rem;
        }
        
        /* Form Groups */
        .mb-3 {
            position: relative;
            margin-bottom: 1.5rem !important;
        }
        
        /* Input Icons */
        .input-wrapper {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1.25rem;
            pointer-events: none;
        }
        
        /* Required Asterisk */
        .form-label:has(+ .form-control[required])::after,
        .form-label:has(+ .form-select[required])::after {
            content: '*';
            color: #fa709a;
            margin-left: 0.25rem;
            font-weight: 700;
        }
        
        /* Button Container */
        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid #e2e8f0;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .form-container {
                padding: 1.5rem;
                margin: 1rem;
            }
            
            h2 {
                font-size: 1.5rem;
            }
            
            .button-group {
                flex-direction: column;
            }
            
            .btn-primary, .btn-outline-secondary {
                width: 100%;
                justify-content: center;
            }
        }
        
        /* Animation on Load */
        .form-container {
            animation: slideIn 0.5s ease-out;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Create User</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>⚠ Please fix the following errors:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" id="first_name" name="first_name" class="form-control" maxlength="100" required value="{{ old('first_name') }}" placeholder="Enter first name">
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" id="last_name" name="last_name" class="form-control" maxlength="100" value="{{ old('last_name') }}" placeholder="Enter last name">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" maxlength="255" required value="{{ old('email') }}" placeholder="user@example.com">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="tel" id="phone" name="phone" class="form-control" maxlength="20" value="{{ old('phone') }}" placeholder="+91 1234567890">
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select id="role" name="role" class="form-select" required>
                <option value="">Select role</option>
                <option value="admin" {{ old('role')=='admin'?'selected':'' }}>Admin</option>
                <option value="manager" {{ old('role')=='manager'?'selected':'' }}>Manager</option>
                <option value="recruiter" {{ old('role')=='recruiter'?'selected':'' }}>Recruiter</option>
                
            </select>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" required placeholder="Enter secure password">
        </div>

        <div class="mb-3 ">
    <input type="hidden" name="is_active" value="0">
    <input type="checkbox" id="is_active" name="is_active" value="1" 
           class="form-check-input" 
           style="border:none; outline:none; appearance: auto;" 
           {{ old('is_active',1) ? 'checked' : '' }}>
    <label for="is_active" class="form-check-label">Active User</label>
</div>


        <div class="mb-3">
            <label for="timezone" class="form-label">Timezone</label>
            <input type="text" id="timezone" name="timezone" class="form-control" value="{{ old('timezone','Asia/Kolkata') }}" maxlength="50" placeholder="Asia/Kolkata">
        </div>

        <div class="button-group">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ url('/users/view') }}" class="btn btn-outline-secondary">User List</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
@endsection