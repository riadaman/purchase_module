@extends('layouts.app')

@section('content')
<style>
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: none;
    }
    .card-title {
        font-weight: 600;
        font-size: 1.25rem;
        margin-bottom: 1.5rem;
    }
    .form-control, .form-select {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.75rem;
        transition: all 0.2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #8b5cf6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }
    .btn-purple {
        background-color: #8b5cf6;
        border-color: #8b5cf6;
        color: white;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
    }
    .btn-purple:hover {
        background-color: #7c3aed;
        border-color: #7c3aed;
        color: white;
    }
    .btn-red {
        background-color: #ef4444;
        border-color: #ef4444;
        color: white;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
    }
    .btn-red:hover {
        background-color: #dc2626;
        border-color: #dc2626;
        color: white;
    }
    .table {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
    }
    .table th {
        background-color: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        font-weight: 600;
        padding: 1rem 0.75rem;
    }
    .table td {
        padding: 0.75rem;
        border-bottom: 1px solid #f1f5f9;
    }
    .required {
        color: #ef4444;
    }
</style>

<div class="container-fluid p-0">
    <div class="row g-0">
        @include('partials.sideNav')
        
        <!-- Main Content -->
        <div class="col-md-9 col-lg-10" style="margin-left: 16.66%; padding: 20px;">
            <form action="{{ route('purchase-orders.store') }}" method="POST" id="purchaseOrderForm">
                @csrf
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
            <div class="row g-4">
                <!-- Left Card - Product Information -->
                <div class="col-lg-8">
                    <div class="card h-100">
                        <div class="card-body p-4">
                            <h5 class="card-title">Product Information</h5>
                            
                            <!-- Product Form Row -->
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label">Product <span class="required">*</span></label>
                                    <select class="form-select" id="productSelect" required>
                                        <option value="">Select Product</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Qty <span class="required">*</span></label>
                                    <input type="number" class="form-control" id="qtyInput" placeholder="0" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Unit Price <span class="required">*</span></label>
                                    <input type="number" class="form-control" id="unitPriceInput" placeholder="0.00" step="0.01" required>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-purple w-100" onclick="addProduct()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Product Table -->
                            <div class="table-responsive mb-4">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 8%">S/L</th>
                                            <th style="width: 35%">Item Details</th>
                                            <th style="width: 15%">Qty</th>
                                            <th style="width: 15%">Unit Price</th>
                                            <th style="width: 15%">Total Price</th>
                                            <th style="width: 12%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productTable">
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">No items added yet</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr class="table-light">
                                            <th colspan="2">Total</th>
                                            <th id="totalQty">0</th>
                                            <th></th>
                                            <th id="totalPrice">0.00</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-purple" onclick="submitPurchaseOrder()">
                                    <i class="fas fa-save me-2"></i>Save
                                </button>
                                <a href="{{ route('purchase-orders.index') }}" class="btn btn-red">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Card - Other Information -->
                <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-body p-4">
                            <h5 class="card-title">Other Information</h5>
                            
                            <div class="mb-3">
                                <label class="form-label">Date <span class="required">*</span></label>
                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Supplier <span class="required">*</span></label>
                                <select class="form-select" name="supplier_id" required>
                                    <option value="">Select Supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Notes</label>
                                <textarea class="form-control" name="note" rows="4" placeholder="Enter Notes"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
let itemCounter = 0;

function addProduct() {
    const productSelect = document.getElementById('productSelect');
    const qtyInput = document.getElementById('qtyInput');
    const unitPriceInput = document.getElementById('unitPriceInput');
    
    // Validate inputs
    if (!productSelect.value || !qtyInput.value || !unitPriceInput.value) {
        alert('Please fill all required fields');
        return;
    }
    
    const qty = parseFloat(qtyInput.value);
    const unitPrice = parseFloat(unitPriceInput.value);
    const totalPrice = qty * unitPrice;
    
    itemCounter++;
    
    const tableBody = document.getElementById('productTable');
    
    // Remove "No items" row if it exists
    if (tableBody.children.length === 1 && tableBody.children[0].children.length === 1) {
        tableBody.innerHTML = '';
    }
    
    // Create new row
    const newRow = document.createElement('tr');
    newRow.dataset.productId = productSelect.value;
    newRow.innerHTML = `
        <td>${itemCounter}</td>
        <td>${productSelect.options[productSelect.selectedIndex].text}</td>
        <td><input type="number" class="form-control form-control-sm" value="${qty}" onchange="updateRowTotal(this)"></td>
        <td><input type="number" class="form-control form-control-sm" value="${unitPrice}" step="0.01" onchange="updateRowTotal(this)"></td>
        <td class="row-total">${totalPrice.toFixed(2)}</td>
        <td><button type="button" class="btn btn-sm btn-danger" onclick="deleteRow(this)"><i class="fas fa-trash"></i></button></td>
    `;
    
    tableBody.appendChild(newRow);
    
    // Clear form inputs
    productSelect.value = '';
    qtyInput.value = '';
    unitPriceInput.value = '';
    
    calculateTotals();
}

function deleteRow(button) {
    const row = button.closest('tr');
    row.remove();
    
    // If no rows left, show "No items" message
    const tableBody = document.getElementById('productTable');
    if (tableBody.children.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="6" class="text-center text-muted py-4">No items added yet</td></tr>';
    }
    
    calculateTotals();
}

function updateRowTotal(input) {
    const row = input.closest('tr');
    const qtyInput = row.querySelector('td:nth-child(3) input');
    const priceInput = row.querySelector('td:nth-child(4) input');
    const totalCell = row.querySelector('.row-total');
    
    const qty = parseFloat(qtyInput.value) || 0;
    const price = parseFloat(priceInput.value) || 0;
    const total = qty * price;
    
    totalCell.textContent = total.toFixed(2);
    calculateTotals();
}

function calculateTotals() {
    const tableBody = document.getElementById('productTable');
    let totalQty = 0;
    let totalPrice = 0;
    
    Array.from(tableBody.children).forEach(row => {
        if (row.children.length > 1) { // Skip "No items" row
            const qtyInput = row.querySelector('td:nth-child(3) input');
            const rowTotal = row.querySelector('.row-total');
            
            if (qtyInput && rowTotal) {
                totalQty += parseFloat(qtyInput.value) || 0;
                totalPrice += parseFloat(rowTotal.textContent) || 0;
            }
        }
    });
    
    document.getElementById('totalQty').textContent = totalQty;
    document.getElementById('totalPrice').textContent = totalPrice.toFixed(2);
}

function submitPurchaseOrder() {
    const tableBody = document.getElementById('productTable');
    const items = [];
    
    // Validate that items exist
    if (tableBody.children.length === 1 && tableBody.children[0].children.length === 1) {
        alert('Please add at least one product to the order');
        return;
    }
    
    // Collect items data
    Array.from(tableBody.children).forEach(row => {
        if (row.children.length > 1) {
            const productSelect = document.getElementById('productSelect');
            const productId = row.dataset.productId;
            const qtyInput = row.querySelector('td:nth-child(3) input');
            const priceInput = row.querySelector('td:nth-child(4) input');
            
            if (productId && qtyInput && priceInput) {
                items.push({
                    product_id: productId,
                    quantity: parseInt(qtyInput.value),
                    price: parseFloat(priceInput.value)
                });
            }
        }
    });
    
    // Add items to form as hidden inputs
    const form = document.getElementById('purchaseOrderForm');
    items.forEach((item, index) => {
        Object.keys(item).forEach(key => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `items[${index}][${key}]`;
            input.value = item[key];
            form.appendChild(input);
        });
    });
    
    form.submit();
}
</script>
@endsection