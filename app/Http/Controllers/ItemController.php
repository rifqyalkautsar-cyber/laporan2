<?php

namespace App\Http\Controllers;

use App\Models\Item; // 
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return response()->json(Item::all(), 200);
    }

    public function store(Request $request)
    {
        $item = Item::create($request->all());
        return response()->json($item, 201);
    }

    public function show(string $id)
    {
        return response()->json(Item::findOrFail($id), 200);
    }

    public function update(Request $request, string $id)
    {
        $item = Item::findOrFail($id);
        $item->update($request->all());
        return response()->json($item, 200);
    }

    public function destroy(string $id)
    {
        Item::destroy($id);
        return response()->json(['message' => 'Item dihapus'], 200);
    }
}