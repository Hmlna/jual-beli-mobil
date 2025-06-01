<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    // GET /api/categories
    public function index()
    {
        $categories = Category::paginate(10);
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    // POST /api/categories
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'not_regex:/-/'],
            'description' => 'nullable|string',
        ]);

        $category = Category::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Category successfully added.',
            'data' => $category
        ], 201);
    }

    // GET /api/categories/{id}
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category has not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    // PUT /api/categories/{id}
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'not_regex:/-/'],
            'description' => 'nullable|string',
        ]);

        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category has not found.'
            ], 404);
        }

        $category->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Category successfully updated.',
            'data' => $category
        ]);
    }

    // DELETE /api/categories/{id}
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category has not found.'
            ], 404);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category successfully deleted.'
        ]);
    }
}