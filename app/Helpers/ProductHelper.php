<?php

namespace App\Helpers;

use App\Models\Product;

class ProductHelper
{
    public static function createProduct(array $data): Product
    {
        return Product::create([
            'name' => $data['name'],
            'status' => isset($data['status']) ? true : false
        ]);
    }

    public static function getAllProducts()
    {
        return Product::all();
    }

    public static function getPaginatedProducts($perPage = 10)
    {
        return Product::paginate($perPage);
    }

    public static function findProduct($id): ?Product
    {
        return Product::find($id);
    }

    public static function updateProduct($id, array $data): bool
    {
        $product = self::findProduct($id);
        if (!$product) {
            return false;
        }
        
        return $product->update([
            'name' => $data['name'],
            'status' => isset($data['status']) ? true : false
        ]);
    }

    public static function deleteProduct($id): bool
    {
        $product = self::findProduct($id);
        if (!$product) {
            return false;
        }
        
        return $product->delete();
    }
}