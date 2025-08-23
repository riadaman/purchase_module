<!-- Side Navbar -->
<div class="col-md-3 col-lg-2">
    <div class="bg-dark" style="height: 100vh; position: fixed; width: 16.66%; z-index: 1000;">
        <div class="list-group list-group-flush">
            <!-- Dashboard Menu -->
            <a class="list-group-item list-group-item-action bg-dark text-white" href="{{ route('dashboard') }}">
                Dashboard
            </a>
            <!-- Supplier Dropdown -->
            <div class="dropdown">
                <a class="list-group-item list-group-item-action bg-dark text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    Supplier
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('suppliers.create') }}">Create</a></li>
                    <li><a class="dropdown-item" href="{{ route('suppliers.index') }}">List</a></li>
                </ul>
            </div>
            <!-- Product Dropdown -->
            <div class="dropdown">
                <a class="list-group-item list-group-item-action bg-dark text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    Product
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('products.create') }}">Create</a></li>
                    <li><a class="dropdown-item" href="{{ route('products.index') }}">List</a></li>
                </ul>
            </div>
            <!-- Purchase Dropdown -->
            <div class="dropdown">
                <a class="list-group-item list-group-item-action bg-dark text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    Purchase
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('purchase-orders.create') }}">Purchase Order</a></li>
                    <li><a class="dropdown-item" href="{{ route('purchase-orders.index') }}">Purchase Order List</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>