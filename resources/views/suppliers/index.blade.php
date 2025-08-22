@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- Side Navbar -->
        <div class="col-md-3 col-lg-2">
            <div class="bg-dark" style="height: 100vh; position: fixed; width: 16.66%; z-index: 1000;">
                <div class="list-group list-group-flush">
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
                            <li><a class="dropdown-item" href="#">Create</a></li>
                            <li><a class="dropdown-item" href="#">List</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-9 col-lg-10" style="margin-left: 16.66%; padding: 20px;">
            <div class="card">
                <div class="card-header">Supplier List</div>
                <div class="card-body">
                    <p>Supplier list will be displayed here.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection