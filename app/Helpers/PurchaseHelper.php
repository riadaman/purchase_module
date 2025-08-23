<?php

namespace App\Helpers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use Illuminate\Support\Facades\DB;

class PurchaseHelper
{
    public static function getActiveProducts()
    {
        return Product::where('status', true)->get();
    }

    public static function getActiveSuppliers()
    {
        return Supplier::where('status', true)->get();
    }

    public static function createPurchaseOrder(array $data): PurchaseOrder
    {
        return DB::transaction(function () use ($data) {
            // Calculate total order amount
            $orderAmount = 0;
            foreach ($data['items'] as $item) {
                $orderAmount += $item['quantity'] * $item['price'];
            }

            // Create purchase order
            $purchaseOrder = PurchaseOrder::create([
                'supplier_id' => $data['supplier_id'],
                'note' => $data['note'] ?? null,
                'order_amount' => $orderAmount,
                'status' => true,
                'paid_amount' => 0,
                'due_amount' => $orderAmount
            ]);

            // Create purchase order items
            foreach ($data['items'] as $item) {
                PurchaseOrderItem::create([
                    'purchase_order_id' => $purchaseOrder->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            return $purchaseOrder;
        });
    }

    public static function getPaginatedPurchaseOrders($perPage = 10, $filters = [])
    {
        $query = PurchaseOrder::with('supplier');
        
       
        if (!empty($filters['supplier_id'])) {
            $query->where('supplier_id', $filters['supplier_id']);
        }
        
      
        if (!empty($filters['start_date'])) {
            $query->whereDate('created_at', '>=', $filters['start_date']);
        }
        
       
        if (!empty($filters['end_date'])) {
            $query->whereDate('created_at', '<=', $filters['end_date']);
        }
        
        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public static function getPurchaseOrderWithItems($id)
    {
        return PurchaseOrder::with(['supplier', 'items.product'])->find($id);
    }
}