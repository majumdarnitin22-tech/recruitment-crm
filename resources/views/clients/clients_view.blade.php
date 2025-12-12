@extends('layouts.admin.app')

@section('content')
<style>
    /* Container Styles */
    .container {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        position: relative;
        overflow: hidden;
        animation: slideIn 0.5s ease-out;
        margin-top: 2rem;
        margin-bottom: 2rem;
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
    
    .container::before {
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
    
    /* Header Styles */
    .table_header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #e2e8f0;
    }
    
    .table_header h2 {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .table_header h2::before {
        content: '';
        width: 5px;
        height: 35px;
        background: linear-gradient(180deg, #667eea, #764ba2);
        border-radius: 10px;
    }
    
    /* Button Styles */
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 700;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: white;
        text-decoration: none;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
        background: linear-gradient(135deg, #5568d3 0%, #653a8b 100%);
        color: white;
    }
    
    .btn-toggle-filter {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        border: 2px solid #667eea;
        color: #667eea;
        border-radius: 10px;
        padding: 0.6rem 1.25rem;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }
    
    .btn-toggle-filter:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }
    
    /* Filter Section */
    .filter-section {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 2px solid #e2e8f0;
        display: none;
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .filter-section.show {
        display: block;
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
        display: block;
    }
    
    .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.6rem 1rem;
        transition: all 0.3s ease;
        font-size: 0.95rem;
        width: 100%;
    }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }
    
    .form-control:hover {
        border-color: #b4bfea;
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
        cursor: pointer;
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
        text-decoration: none;
        display: inline-block;
        margin-left: 0.5rem;
    }
    
    .btn-reset:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(250, 112, 154, 0.4);
        color: white;
    }
    
    /* Table Styles */
    .table-wrapper {
        overflow-x: auto;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }
    
    .table {
        margin-bottom: 0;
        border-radius: 15px;
        overflow: hidden;
        width: 100%;
    }
    
    .table-dark {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .table-dark th {
        border: none;
        padding: 1rem;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        color: white;
    }
    
    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #e2e8f0;
        font-size: 0.9rem;
    }
    
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(102, 126, 234, 0.05);
    }
    
    .table tbody tr {
        transition: all 0.3s ease;
    }
    
    .table tbody tr:hover {
        background-color: rgba(102, 126, 234, 0.1);
        transform: scale(1.002);
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        color: white;
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
    
    /* Alert */
    .alert-success {
        background: linear-gradient(135deg, rgba(67, 233, 123, 0.15), rgba(56, 249, 215, 0.15));
        border: 2px solid #43e97b;
        border-radius: 12px;
        color: #0d6832;
        font-weight: 600;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        border-left: 4px solid #43e97b;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #64748b;
    }
    
    .empty-state::before {
        content: '📋';
        font-size: 3rem;
        display: block;
        margin-bottom: 1rem;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 1.5rem;
            margin: 1rem;
        }
        
        .table_header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .table_header .d-flex {
            width: 100%;
            flex-direction: column;
        }
        
        .filter-row {
            flex-direction: column;
        }
        
        .filter-group {
            width: 100%;
        }
        
        .btn-primary, .btn-toggle-filter {
            width: 100%;
            justify-content: center;
        }
        
        .table_header h2 {
            font-size: 1.5rem;
        }
        
        .table {
            font-size: 0.85rem;
        }
        
        .table thead {
            display: none;
        }
        
        .table tbody tr {
            display: block;
            margin-bottom: 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.5rem;
        }
        
        .table tbody td {
            display: block;
            text-align: right;
            padding: 0.5rem;
            border: none;
        }
        
        .table tbody td::before {
            content: attr(data-label);
            float: left;
            font-weight: 700;
            color: #667eea;
        }
        
        .action-buttons {
            justify-content: flex-end;
        }
    }
</style>

<div class="container">
    <!-- Header -->
    <div class="table_header">
        <h2>Clients List</h2>
        <div class="d-flex gap-2">
            <button id="toggleFilterBtn" class="btn-toggle-filter" onclick="toggleFilter()">
                <span class="material-icons" style="font-size: 18px;">filter_alt</span> Show Filters
            </button>
            <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">
                <span class="material-icons" style="font-size: 18px;">add</span> Add New Client
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif

    <!-- Filter Section -->
    <div id="filterSection" class="filter-section">
        <form method="GET" action="{{ route('admin.clients') }}">
            <div class="filter-row">
                <div class="filter-group">
                    <label class="filter-label">Company Name</label>
                    <input type="text" name="search" class="form-control" placeholder="Search by company name..." value="{{ request('search') }}">
                </div>
                <div class="filter-group">
                    <label class="filter-label">Contact Person</label>
                    <input type="text" name="contact_person" class="form-control" placeholder="Contact person..." value="{{ request('contact_person') }}">
                </div>
                <div class="filter-group">
                    <label class="filter-label">Contact Email</label>
                    <input type="email" name="contact_email" class="form-control" placeholder="Contact email..." value="{{ request('contact_email') }}">
                </div>
                <div class="filter-group" style="flex: 0 0 auto; min-width: auto;">
                    <button type="submit" class="btn-filter">Filter</button>
                    <a href="{{ route('admin.clients') }}" class="btn-reset">Reset</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Clients Table -->
    <div class="table-wrapper">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Company Name</th>
                    <th>Contact Person</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Billing Rate (₹)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr>
                    <td data-label="Company Name">{{ $client->company_name }}</td>
                    <td data-label="Contact Person">{{ $client->contact_person ?? '-' }}</td>
                    <td data-label="Email">{{ $client->contact_email ?? '-' }}</td>
                    <td data-label="Phone">{{ $client->contact_phone ?? '-' }}</td>
                    <td data-label="Billing Rate">{{ $client->billing_rate ? '₹' . number_format($client->billing_rate, 2) : '-' }}</td>
                    <td data-label="Actions">
                        <div class="action-buttons">
                            <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn-action btn-edit" title="Edit">
                                <span class="material-icons">edit</span>
                            </a>
                            <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Delete" onclick="return confirm('Are you sure you want to delete this client?')">
                                    <span class="material-icons">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <strong>No clients found.</strong>
                            <p class="mb-0">Try adjusting your filters or add a new client.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
function toggleFilter() {
    const filterSection = document.getElementById('filterSection');
    const toggleBtn = document.getElementById('toggleFilterBtn');

    if (filterSection.classList.contains('show')) {
        filterSection.classList.remove('show');
        toggleBtn.innerHTML = '<span class="material-icons" style="font-size: 18px;">filter_alt</span> Show Filters';
    } else {
        filterSection.classList.add('show');
        toggleBtn.innerHTML = '<span class="material-icons" style="font-size: 18px;">filter_alt_off</span> Hide Filters';
    }
}

// Auto show filter if any filter applied
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('search') || urlParams.has('contact_person') || urlParams.has('contact_email')) {
        document.getElementById('filterSection').classList.add('show');
        document.getElementById('toggleFilterBtn').innerHTML = '<span class="material-icons" style="font-size: 18px;">filter_alt_off</span> Hide Filters';
    }
});
</script>
@endsection