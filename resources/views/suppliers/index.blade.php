@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0">
        @include('partials.sideNav')
        
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