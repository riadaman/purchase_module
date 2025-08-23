<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Http\Requests\SupplierRequest;
use App\Helpers\SupplierHelper;
use Exception;

class SupplierController extends Controller
{
    public function index()
    {
        try {
            $suppliers = SupplierHelper::getAllSuppliers();
            return view('suppliers.index', compact('suppliers'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load suppliers: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(SupplierRequest $request)
    {
        try {
            SupplierHelper::createSupplier($request->validated());
            return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create supplier: ' . $e->getMessage())->withInput();
        }
    }
}
