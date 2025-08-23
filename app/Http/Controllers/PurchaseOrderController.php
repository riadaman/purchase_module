<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\PurchaseHelper;
use App\Http\Requests\PurchaseOrderRequest;
use Exception;

class PurchaseOrderController extends Controller
{
    public function create()
    {
        try {
            $products = PurchaseHelper::getActiveProducts();
            $suppliers = PurchaseHelper::getActiveSuppliers();
            return view('purchases.create', compact('products', 'suppliers'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load data: ' . $e->getMessage());
        }
    }

    public function store(PurchaseOrderRequest $request)
    {
        try {
            PurchaseHelper::createPurchaseOrder($request->validated());
            return redirect()->route('purchase-orders.index')->with('success', 'Purchase order created successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create purchase order: ' . $e->getMessage())->withInput();
        }
    }

    public function index(Request $request)
    {
        try {
            $filters = [
                'supplier_id' => $request->supplier_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ];
            
            $purchaseOrders = PurchaseHelper::getPaginatedPurchaseOrders(10, $filters);
            $suppliers = PurchaseHelper::getActiveSuppliers();
            
            return view('purchases.index', compact('purchaseOrders', 'suppliers', 'filters'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load purchase orders: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $purchaseOrder = PurchaseHelper::getPurchaseOrderWithItems($id);
            if (!$purchaseOrder) {
                return redirect()->route('purchase-orders.index')->with('error', 'Purchase order not found.');
            }
            return view('purchases.show', compact('purchaseOrder'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load purchase order: ' . $e->getMessage());
        }
    }
}
