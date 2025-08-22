<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSuppliers = Supplier::count();
        $totalPurchaseOrders = 0; // Placeholder
        $totalPendingOrders = 0; // Placeholder
        
        return view('dashboard', compact('totalSuppliers', 'totalPurchaseOrders', 'totalPendingOrders'));
    }
}
