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
            $suppliers = SupplierHelper::getPaginatedSuppliers(10);
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

    public function edit($id)
    {
        try {
            $supplier = SupplierHelper::findSupplier($id);
            if (!$supplier) {
                return redirect()->route('suppliers.index')->with('error', 'Supplier not found.');
            }
            return view('suppliers.edit', compact('supplier'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load supplier: ' . $e->getMessage());
        }
    }

    public function update(SupplierRequest $request, $id)
    {
        try {
            $updated = SupplierHelper::updateSupplier($id, $request->validated());
            if (!$updated) {
                return redirect()->back()->with('error', 'Supplier not found or failed to update.');
            }
            return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update supplier: ' . $e->getMessage())->withInput();
        }
    }
}
