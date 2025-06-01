<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    // API: Menampilkan semua produk (GET /api/products)
    public function index()
    {
        $products = Product::with('category')->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Product Lists',
            'data' => $products
        ]);
    }

    // API: Menyimpan produk baru (POST /api/products)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'not_regex:/-/'],
            'description' => ['required', 'string', 'not_regex:/-/'],
            'price' => 'required|numeric|min:1',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Product successfully added.',
            'data' => $product
        ], 201);
    }

    // API: Menampilkan detail produk (GET /api/products/{id})
    public function show($id)
    {
        $product = Product::with('category')->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product has not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product details',
            'data' => $product
        ]);
    }

    // API: Memperbarui produk (PUT /api/products/{id})
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'not_regex:/-/'],
            'description' => ['required', 'string', 'not_regex:/-/'],
            'price' => 'required|numeric|min:1',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product has not found'
            ], 404);
        }

        $product->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Product successfully updated.',
            'data' => $product
        ]);
    }

    // API: Menghapus produk (DELETE /api/products/{id})
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product has not found'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product successfully deleted.'
        ]);
    }
}