@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0">
        @include('partials.sideNav')
        
        <!-- Main Content -->
        <div class="col-md-9 col-lg-10" style="margin-left: 16.66%; padding: 20px;">
            <div class="card">
                <div class="card-header">Edit Supplier</div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $supplier->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="number" class="form-label">Number</label>
                            <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" value="{{ old('number', $supplier->number) }}" required>
                            @error('number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $supplier->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required>{{ old('address', $supplier->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="status" name="status" value="1" {{ old('status', $supplier->status) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Supplier</button>
                        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection