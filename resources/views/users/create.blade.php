<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Create User</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="mb-3">
            <label for="first_name" class="form-label">First Name *</label>
            <input type="text" id="first_name" name="first_name" class="form-control" maxlength="100" required value="{{ old('first_name') }}">
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" id="last_name" name="last_name" class="form-control" maxlength="100" value="{{ old('last_name') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email *</label>
            <input type="email" id="email" name="email" class="form-control" maxlength="255" required value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="tel" id="phone" name="phone" class="form-control" maxlength="20" value="{{ old('phone') }}">
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role *</label>
            <select id="role" name="role" class="form-select" required>
                <option value="">Select role</option>
                <option value="admin" {{ old('role')=='admin'?'selected':'' }}>Admin</option>
                <option value="manager" {{ old('role')=='manager'?'selected':'' }}>Manager</option>
                <option value="recruiter" {{ old('role')=='recruiter'?'selected':'' }}>Recruiter</option>
                <option value="client" {{ old('role')=='client'?'selected':'' }}>Client</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password *</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3 form-check">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" id="is_active" name="is_active" value="1" class="form-check-input" {{ old('is_active',1)?'checked':'' }}>
            <label for="is_active" class="form-check-label">Active</label>
        </div>

        <div class="mb-3">
            <label for="timezone" class="form-label">Timezone</label>
            <input type="text" id="timezone" name="timezone" class="form-control" value="{{ old('timezone','Asia/Kolkata') }}" maxlength="50">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="/user_view" class=" btn btn-primary" >user list</a>
    </form>
</div>
</body>
</html>
