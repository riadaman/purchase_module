<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
      public function index()
    {
        $totalSuppliers = Supplier::count();
        $totalPurchaseOrders = 0; // Placeholder
        $totalPendingOrders = 0; // Placeholder
        
        return view('dashboard', compact('totalSuppliers', 'totalPurchaseOrders', 'totalPendingOrders'));
    }
}
