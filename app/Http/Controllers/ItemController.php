<?php
namespace App\Http\Controllers;

use App\Services\ItemService;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest; 
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller {
    protected ItemService $svc;
    
    public function __construct(ItemService $svc) {
        $this->svc = $svc;
    }
    
    // INI ADALAH FUNGSI INDEX BARU UNTUK MODUL 6 (Filter Kategori)
    public function index(Request $request) {
        $query = Item::with('category');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        return response()->json([
            'status' => 'success',
            'data' => $query->get(),
            'message' => 'Berhasil menarik semua data Item'
        ]);
    }
    
    // SISA KODE DI BAWAH INI ADALAH HASIL MODUL 5 YANG HARUS DIPERTAHANKAN
    public function store(StoreItemRequest $req) {
        
        // Tambahkan kode dd() di sini 👇
        dd($req->all()); 

        $item = $this->svc->create($req->validated());
        return response()->json([
            'status' => 'success',
            'data' => $item,
            'message' => 'Item berhasil dibuat'
        ], 201);
    }
    
    public function show($id) {
        try {
            $item = $this->svc->find($id);
            return response()->json([
                'status' => 'success',
                'data' => $item,
                'message' => 'Berhasil menarik satu data Item'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function update(UpdateItemRequest $req, $id) {
        try {
            $item = $this->svc->update($id, $req->validated());
            return response()->json([
                'status' => 'success',
                'data' => $item,
                'message' => 'Item berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function destroy($id) {
        try {
            $this->svc->delete($id);
            return response()->json([
                'status' => 'success',
                'data' => null,
                'message' => 'Item berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => $e->getMessage()
            ], 404);
        }
    }
}