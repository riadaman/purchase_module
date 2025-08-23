@extends('layouts.app')

@section('content')
<style>
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: none;
    }
    .btn-purple {
        background-color: #8b5cf6;
        border-color: #8b5cf6;
        color: white;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-weight: 500;
    }
    .btn-purple:hover {
        background-color: #7c3aed;
        border-color: #7c3aed;
        color: white;
    }
    .table {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        overflow: hidden;
    }
    .table th, .table td {
        border: 1px solid #dee2e6;
        text-align: center;
        padding: 0.75rem 0.5rem;
    }
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    .order-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 1.5rem 0;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .footer-labels {
        display: flex;
        justify-content: space-between;
        margin-top: 2rem;
        font-weight: 600;
    }
    @media print {
        .no-print { display: none !important; }
        .card { box-shadow: none; border: 1px solid #dee2e6; }
        body { background: white !important; }
    }
</style>

<div class="container-fluid p-0">
    <div class="row g-0">
        <div class="no-print">
            @include('partials.sideNav')
        </div>
        
        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 no-print" style="margin-left: 16.66%; padding: 20px;">
            <div class="card">
                <div class="card-body p-4">
                    <!-- Header Section -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold mb-0">Purchase Orders Details</h2>
                        <button class="btn btn-purple" onclick="window.print()">
                            <i class="fas fa-print me-2"></i>Print
                        </button>
                    </div>

                    <!-- Order Information Row -->
                    <div class="order-info">
                        <div><strong>Supplier:</strong> {{ $purchaseOrder->supplier->name }}</div>
                        <div><strong>ORDER NO.:</strong> PO-{{ str_pad($purchaseOrder->id, 4, '0', STR_PAD_LEFT) }}</div>
                        <div><strong>DATE:</strong> {{ $purchaseOrder->created_at->format('d-m-Y') }}</div>
                    </div>

                    <!-- Main Table -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S/L</th>
                                    <th>Product</th>
                                    <th>Code</th>
                                    <th>Unit</th>
                                    <th>Pur. Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchaseOrder->items as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->product->id }}</td>
                                        <td>Pcs</td>
                                        <td>{{ number_format($item->price, 2) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->quantity * $item->price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="fw-bold">
                                    <td colspan="5"><strong>Total:</strong></td>
                                    <td><strong>{{ $purchaseOrder->items->sum('quantity') }}</strong></td>
                                    <td><strong>{{ number_format($purchaseOrder->order_amount, 2) }}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="6"><strong>Payment:</strong></td>
                                    <td>{{ number_format($purchaseOrder->paid_amount, 2) }}</td>
                                </tr>
                                <tr class="fw-bold">
                                    <td colspan="6"><strong>Due:</strong></td>
                                    <td><strong>{{ number_format($purchaseOrder->due_amount, 2) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Footer Section -->
                    <div class="footer-labels">
                        <div><strong>Warehouse</strong></div>
                        <div><strong>Created By</strong></div>
                        <div><strong>Checked By</strong></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Print Version -->
        <div class="d-none d-print-block p-4">
            <!-- Header Section -->
            <div class="text-center mb-4">
                <h2 class="fw-bold">Purchase Orders Details</h2>
            </div>

            <!-- Order Information Row -->
            <div class="order-info">
                <div><strong>Supplier:</strong> {{ $purchaseOrder->supplier->name }}</div>
                <div><strong>ORDER NO.:</strong> PO-{{ str_pad($purchaseOrder->id, 4, '0', STR_PAD_LEFT) }}</div>
                <div><strong>DATE:</strong> {{ $purchaseOrder->created_at->format('d-m-Y') }}</div>
            </div>

            <!-- Main Table -->
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>S/L</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Product</th>
                            <th>Code</th>
                            <th>Unit</th>
                            <th>Pur. Unit Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchaseOrder->items as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>-</td>
                                <td>-</td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->product->id }}</td>
                                <td>Pcs</td>
                                <td>{{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->quantity * $item->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="fw-bold">
                            <td colspan="7"><strong>Total:</strong></td>
                            <td><strong>{{ $purchaseOrder->items->sum('quantity') }}</strong></td>
                            <td><strong>{{ number_format($purchaseOrder->order_amount, 2) }}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="8"><strong>Payment:</strong></td>
                            <td>{{ number_format($purchaseOrder->paid_amount, 2) }}</td>
                        </tr>
                        <tr class="fw-bold">
                            <td colspan="8"><strong>Due:</strong></td>
                            <td><strong>{{ number_format($purchaseOrder->due_amount, 2) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Footer Section -->
            <div class="footer-labels">
                <div><strong>Warehouse</strong></div>
                <div><strong>Created By</strong></div>
                <div><strong>Checked By</strong></div>
            </div>
        </div>
    </div>
</div>
@endsection