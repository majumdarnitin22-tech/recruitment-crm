@extends('layouts.admin.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruiters List</title>

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
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }
        
        h2 {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            margin-bottom: 0;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
        }
        
        /* Table Header */
        .table_header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        /* Filter Section */
        .filter-section {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 2px solid #e2e8f0;
        }
        
        .filter-row {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            align-items: end;
        }
        
        .filter-group {
            flex: 1;
            min-width: 200px;
        }
        
        .filter-label {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .search-box {
            position: relative;
        }
        
        .search-box input {
            padding-left: 2.5rem;
        }
        
        .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
        }
        
        .form-control, .form-select {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.6rem 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }
        
        .btn-filter {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(67, 233, 123, 0.3);
        }
        
        .btn-filter:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(67, 233, 123, 0.4);
        }
        
        .btn-reset {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(250, 112, 154, 0.3);
        }
        
        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(250, 112, 154, 0.4);
        }
        
        .table {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        
        .table-dark {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(102, 126, 234, 0.05);
        }
        
        .table tbody tr {
            transition: all 0.3s ease;
        }
        
        .table tbody tr:hover {
            background-color: rgba(102, 126, 234, 0.1);
            transform: scale(1.01);
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }
        
        .btn-action {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: white;
            font-size: 0.875rem;
        }
        
        .btn-edit {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            box-shadow: 0 4px 10px rgba(67, 233, 123, 0.3);
        }
        
        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(67, 233, 123, 0.4);
        }
        
        .btn-delete {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            box-shadow: 0 4px 10px rgba(250, 112, 154, 0.3);
        }
        
        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(250, 112, 154, 0.4);
        }
        
        .material-icons {
            font-size: 18px;
        }
        
        /* Badge Styles */
        .badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.75rem;
        }
        
        .bg-success {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%) !important;
        }
        
        .bg-danger {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%) !important;
        }
        
        .bg-recruiter {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }
        
        /* Alert */
        .alert-success {
            background: linear-gradient(135deg, rgba(67, 233, 123, 0.1), rgba(56, 249, 215, 0.1));
            border: 2px solid #43e97b;
            border-radius: 10px;
            color: #0d6832;
            font-weight: 600;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .table_header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .filter-row {
                flex-direction: column;
            }
            
            .filter-group {
                width: 100%;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn-action {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="container mt-4">

    <div class="table_header">
        <h2>Recruiters List</h2>

        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <span class="material-icons" style="vertical-align: middle; margin-right: 5px;">add</span>
            Add New Recruiter
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif

    <!-- Filter Toggle Button -->
    <div style="margin-bottom: 1rem;">
        <button type="button" class="btn-filter" id="toggleFilterBtn" onclick="toggleFilter()">
            <span class="material-icons" style="vertical-align: middle; font-size: 18px;">filter_alt</span>
            Show Filters
        </button>
    </div>

    <!-- Filter Section (Hidden by default) -->
    <div class="filter-section" id="filterSection" style="display: none;">
        <form method="GET" action="{{ url('/admin/recruiters') }}">
            <div class="filter-row">
                <!-- Search Box -->
                <div class="filter-group">
                    <label class="filter-label">
                        <span class="material-icons" style="font-size: 16px;">search</span>
                        Search
                    </label>
                    <div class="search-box">
                        <span class="material-icons search-icon">search</span>
                        <input type="text" name="search" class="form-control" 
                               placeholder="Search by name or email..." 
                               value="{{ request('search') }}">
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="filter-group">
                    <label class="filter-label">
                        <span class="material-icons" style="font-size: 16px;">toggle_on</span>
                        Status
                    </label>
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Filter Buttons -->
                <div class="filter-group" style="display: flex; gap: 0.5rem;">
                    <button type="submit" class="btn btn-filter">
                        <span class="material-icons" style="vertical-align: middle; font-size: 18px;">done</span>
                        Apply
                    </button>
                    <a href="{{ url('/admin/recruiters') }}" class="btn btn-reset">
                        <span class="material-icons" style="vertical-align: middle; font-size: 18px;">refresh</span>
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Recruiters Table -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Active</th>
                <th>Timezone</th>
                <th>Created</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($recruiters as $recruiter)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $recruiter->first_name }} {{ $recruiter->last_name }}</td>
                    <td>{{ $recruiter->email }}</td>
                    <td>{{ $recruiter->phone }}</td>
                    <td><span class="badge bg-recruiter">{{ ucfirst($recruiter->role) }}</span></td>
                    <td>
                        @if($recruiter->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $recruiter->timezone }}</td>
                    <td>{{ $recruiter->created_at->format('d M Y, h:i A') }}</td>
                    <td>
                        <div class="action-buttons">
                            <!-- Edit Button -->
                            <a href="{{ route('admin.recruiters.edit', $recruiter->id) }}" class="btn-action btn-edit" title="Edit">
                                <span class="material-icons">edit</span>
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('admin.recruiters.delete', $recruiter->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this recruiter?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Delete">
                                    <span class="material-icons">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center" style="padding: 2rem;">
                        <span class="material-icons" style="font-size: 48px; color: #94a3b8;">search_off</span>
                        <p style="color: #64748b; margin-top: 1rem; font-weight: 600;">No recruiters found</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function toggleFilter() {
    const filterSection = document.getElementById('filterSection');
    const toggleBtn = document.getElementById('toggleFilterBtn');
    
    if (filterSection.style.display === 'none') {
        filterSection.style.display = 'block';
        toggleBtn.innerHTML = '<span class="material-icons" style="vertical-align: middle; font-size: 18px;">filter_alt_off</span> Hide Filters';
    } else {
        filterSection.style.display = 'none';
        toggleBtn.innerHTML = '<span class="material-icons" style="vertical-align: middle; font-size: 18px;">filter_alt</span> Show Filters';
    }
}

// Show filters automatically if any filter is applied
document.addEventListener('DOMContentLoaded', function() {
    const hasFilters = {{ request()->hasAny(['search', 'status']) ? 'true' : 'false' }};
    if (hasFilters) {
        toggleFilter();
    }
});
</script>

</body>
</html>
@endsection