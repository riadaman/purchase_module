<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Helpers\ProductHelper;
use Exception;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = ProductHelper::getPaginatedProducts(10);
            return view('products.index', compact('products'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load products: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        try {
            ProductHelper::createProduct($request->validated());
            return redirect()->route('products.index')->with('success', 'Product created successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create product: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $product = ProductHelper::findProduct($id);
            if (!$product) {
                return redirect()->route('products.index')->with('error', 'Product not found.');
            }
            return view('products.edit', compact('product'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load product: ' . $e->getMessage());
        }
    }

    public function update(ProductRequest $request, $id)
    {
        try {
            $updated = ProductHelper::updateProduct($id, $request->validated());
            if (!$updated) {
                return redirect()->back()->with('error', 'Product not found or failed to update.');
            }
            return redirect()->route('products.index')->with('success', 'Product updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update product: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $deleted = ProductHelper::deleteProduct($id);
            if (!$deleted) {
                return redirect()->back()->with('error', 'Product not found or failed to delete.');
            }
            return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }
}
