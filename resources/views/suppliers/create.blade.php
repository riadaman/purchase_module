@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0">
        @include('partials.sideNav')
        
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