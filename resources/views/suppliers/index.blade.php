@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0">
        @include('partials.sideNav')
        
        <!-- Main Content -->
        <div class="col-md-9 col-lg-10" style="margin-left: 16.66%; padding: 20px;">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Supplier List</span>
                    <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create Supplier
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    
                    @if($suppliers->count() > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Number</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suppliers as $supplier)
                                    <tr>
                                        <td>{{ $supplier->id }}</td>
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->number }}</td>
                                        <td>{{ $supplier->email }}</td>
                                        <td>{{ $supplier->address }}</td>
                                        <td>
                                            <span class="badge {{ $supplier->status ? 'bg-success' : 'bg-danger' }}">
                                                {{ $supplier->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-primary me-1" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="#" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this supplier?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No suppliers found.</p>
                    @endif
                    
                    @if($suppliers->total() >= 1)
                        <div class="mt-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted">
                                    Showing {{ $suppliers->firstItem() ?? 0 }} to {{ $suppliers->lastItem() ?? 0 }} of {{ $suppliers->total() }} results
                                </div>
                                @if($suppliers->hasPages())
                                    {{ $suppliers->links('custom.pagination') }}
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection