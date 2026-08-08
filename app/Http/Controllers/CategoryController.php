<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataAll = Category::all();
        return view('admin.pages.category', compact('dataAll'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'is_active' => 'required|boolean',
            ]);

            Category::create($validated);

            return redirect('/admin/kategori')->with('success', 'Kategori berhasil ditambahkan!');
        } catch (Exception $e) {
            Log::error('Error saat menyimpan kategori: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Terjadi kesalahan pada server. Silakan coba lagi.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'is_active' => 'nullable|boolean',
            ]);



            $kategori = Category::findOrFail($id);

            $kategori->name = $validated['name'];
            $kategori->description = $validated['description'];
            $kategori->is_active = $request->has('is_active');
            $kategori->save();
            return redirect('/admin/kategori')->with('success', 'Kategori berhasil diperbarui!');
        } catch (Exception $e) {
            Log::error('Error saat memperbarui kategori: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Terjadi kesalahan pada server. Silakan coba lagi.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Log::info("Menghapus pegawai dengan ID: " . $id);

        $kategori = Category::findOrFail($id);
        Log::info("Data ditemukan: " . json_encode($kategori));

        $kategori->delete();

        return redirect('/admin/kategori')->with('success', 'Data Berhasil dihapus!');
    }
}
