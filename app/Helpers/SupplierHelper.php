<?php

namespace App\Helpers;

use App\Models\Supplier;

class SupplierHelper
{
    public static function createSupplier(array $data): Supplier
    {
        return Supplier::create([
            'name' => $data['name'],
            'number' => $data['number'],
            'email' => $data['email'],
            'address' => $data['address'],
            'status' => isset($data['status']) ? true : false
        ]);
    }

    public static function getAllSuppliers()
    {
        return Supplier::all();
    }

    public static function findSupplier($id): ?Supplier
    {
        return Supplier::find($id);
    }

    public static function updateSupplier($id, array $data): bool
    {
        $supplier = self::findSupplier($id);
        if (!$supplier) {
            return false;
        }
        
        return $supplier->update([
            'name' => $data['name'],
            'number' => $data['number'],
            'email' => $data['email'],
            'address' => $data['address'],
            'status' => isset($data['status']) ? true : false
        ]);
    }
}