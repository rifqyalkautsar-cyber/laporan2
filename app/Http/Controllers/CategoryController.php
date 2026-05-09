<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return response()->json(Category::all(), 200);
    }

    public function store(Request $request) {
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    public function show(string $id) {
        return response()->json(Category::findOrFail($id), 200);
    }

    public function update(Request $request, string $id) {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return response()->json($category, 200);
    }

    public function destroy(string $id) {
        Category::destroy($id);
        return response()->json(['message' => 'Kategori dihapus'], 200);
    }
}   