<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>

    <!-- Bootstrap (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h2 class="mb-3">User List</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add New User</a>

    <!-- User Table -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Active</th>
                <th>Timezone</th>
                <th>Created</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        @if($user->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $user->timezone }}</td>
                    <td>{{ $user->created_at->format('d M Y, h:i A') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No users found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

</body>
</html>
