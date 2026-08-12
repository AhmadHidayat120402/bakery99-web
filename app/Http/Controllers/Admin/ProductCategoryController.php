<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Services\ImageCompressor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index()
    {
        $categories = ProductCategory::withCount('products')->orderBy('sort_order', 'asc')->get();
        return view('admin.kategori', compact('categories'));
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $slug = Str::slug($validated['name']);
        $count = ProductCategory::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) {
            $slug = "{$slug}-" . ($count + 1);
        }

        $imagePath = 'img/products/roti/Sobek pisang.jpg'; // fallback
        if ($request->hasFile('image')) {
            $imagePath = ImageCompressor::compressAndSave(
                $request->file('image'),
                'uploads/categories',
                $validated['name'],
                800, // max edge 800px
                80   // quality 80%
            );
        }

        ProductCategory::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'image' => $imagePath,
            'icon' => $validated['icon'] ?? 'bi-box-seam-fill',
            'description' => $validated['description'] ?? null,
            'is_active' => true,
        ]);

        return redirect()->route('admin.kategori')->with('success', 'Kategori produk berhasil ditambahkan dan foto cover telah dikompresi!');
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, ProductCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validated['name'] !== $category->name) {
            $slug = Str::slug($validated['name']);
            $count = ProductCategory::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $category->id)->count();
            if ($count > 0) {
                $slug = "{$slug}-" . ($count + 1);
            }
            $category->slug = $slug;
        }

        if ($request->hasFile('image')) {
            $category->image = ImageCompressor::compressAndSave(
                $request->file('image'),
                'uploads/categories',
                $validated['name'],
                800, // max edge 800px
                80   // quality 80%
            );
        }

        $category->name = $validated['name'];
        $category->description = $validated['description'] ?? $category->description;
        if (isset($validated['icon'])) {
            $category->icon = $validated['icon'];
        }
        if ($request->has('is_active')) {
            $category->is_active = $request->boolean('is_active');
        }

        $category->save();

        return redirect()->route('admin.kategori')->with('success', 'Kategori produk berhasil diperbarui dan foto cover telah dikompresi!');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(ProductCategory $category)
    {
        $category->delete();

        return redirect()->route('admin.kategori')->with('success', 'Kategori produk berhasil dihapus!');
    }
}
