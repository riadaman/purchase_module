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
                <div class="card-header">Create Supplier</div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="number" class="form-label">Number</label>
                            <input type="text" class="form-control" id="number" name="number" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="status" name="status" checked>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Supplier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection