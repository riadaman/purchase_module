<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Http\Requests\SupplierRequest;
use App\Helpers\SupplierHelper;

class SupplierController extends Controller
{
    public function index()
    {
        return view('suppliers.index');
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(SupplierRequest $request)
    {
        SupplierHelper::createSupplier($request->validated());

        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully!');
    }
}
