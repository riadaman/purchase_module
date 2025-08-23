@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0">
        @include('partials.sideNav')
        
        <!-- Main Content -->
        <div class="col-md-9 col-lg-10" style="margin-left: 16.66%; padding: 20px;">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Purchase Order List</span>
                    <a href="{{ route('purchase-orders.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create Purchase Order
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    
                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('purchase-orders.index') }}" class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Supplier</label>
                                <select name="supplier_id" class="form-select">
                                    <option value="">All Suppliers</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ $filters['supplier_id'] == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-control" value="{{ $filters['start_date'] }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control" value="{{ $filters['end_date'] }}">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                                <a href="{{ route('purchase-orders.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                    
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order No</th>
                                    <th>Supplier</th>
                                    <th>Order Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Due Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($purchaseOrders->count() > 0)
                                    @foreach($purchaseOrders as $order)
                                        <tr>
                                            <td>PO - {{ $order->id }}</td>
                                            <td>{{ $order->supplier->name }}</td>
                                            <td>${{ number_format($order->order_amount, 2) }}</td>
                                            <td>${{ number_format($order->paid_amount, 2) }}</td>
                                            <td>${{ number_format($order->due_amount, 2) }}</td>
                                            <td>
                                                <span class="badge {{ $order->status ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $order->status ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <a href="{{ route('purchase-orders.show', $order->id) }}" class="btn btn-sm btn-info me-1" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button class="btn btn-sm btn-primary me-1" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">No purchase orders found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    
                    @if($purchaseOrders->total() >= 1)
                        <div class="mt-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted">
                                    Showing {{ $purchaseOrders->firstItem() ?? 0 }} to {{ $purchaseOrders->lastItem() ?? 0 }} of {{ $purchaseOrders->total() }} results
                                </div>
                                @if($purchaseOrders->hasPages())
                                    {{ $purchaseOrders->appends(request()->query())->links('custom.pagination') }}
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