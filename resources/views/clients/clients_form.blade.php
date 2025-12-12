@extends('layouts.admin.app')

@section('content')
<div class="form-container">
    <h2>{{ isset($client) ? 'Edit Client' : 'Add New Client' }}</h2>

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

    <form action="{{ isset($client) ? route('admin.clients.update', $client->id) : route('admin.clients.store') }}" method="POST">
        @csrf
        @if(isset($client))
            @method('PUT')
        @endif

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Company Name <span class="text-danger">*</span></label>
                <input type="text" name="company_name" class="form-control" required 
                       value="{{ old('company_name', $client->company_name ?? '') }}" 
                       placeholder="Enter company name">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Contact Person</label>
                <input type="text" name="contact_person" class="form-control" 
                       value="{{ old('contact_person', $client->contact_person ?? '') }}" 
                       placeholder="Enter contact person name">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Contact Email</label>
                <input type="email" name="contact_email" class="form-control" 
                       value="{{ old('contact_email', $client->contact_email ?? '') }}" 
                       placeholder="contact@company.com">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Contact Phone</label>
                <input type="text" name="contact_phone" class="form-control" 
                       value="{{ old('contact_phone', $client->contact_phone ?? '') }}" 
                       placeholder="+91 1234567890">
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="3" placeholder="Enter complete address">{{ old('address', $client->address ?? '') }}</textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Billing Rate (₹)</label>
                <input type="number" step="0.01" name="billing_rate" class="form-control" 
                       value="{{ old('billing_rate', $client->billing_rate ?? '') }}" placeholder="0.00">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">{{ isset($client) ? 'New Password (Optional)' : 'Password' }} <span class="{{ isset($client) ? '' : 'text-danger' }}">{{ isset($client) ? '' : '*' }}</span></label>
                <input type="password" name="password" class="form-control" placeholder="{{ isset($client) ? 'Enter new password if changing' : 'Enter secure password' }}" {{ isset($client) ? '' : 'required' }}>
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label">Notes</label>
                <textarea name="notes" class="form-control" rows="3" placeholder="Additional notes or comments">{{ old('notes', $client->notes ?? '') }}</textarea>
            </div>
        </div>

        <div class="button-group">
            <button type="submit" class="btn btn-primary">{{ isset($client) ? 'Update Client' : 'Add Client' }}</button>
            <a href="{{ route('admin.clients') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
