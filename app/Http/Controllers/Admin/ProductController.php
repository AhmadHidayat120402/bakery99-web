<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductBadge;
use App\Services\ImageCompressor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'badge'])->latest();

        if ($request->filled('category_id') && $request->category_id !== 'all') {
            $query->where('product_category_id', $request->category_id);
        }

        $products = $query->get();
        $categories = ProductCategory::where('is_active', true)->orderBy('name')->get();
        $badges = ProductBadge::where('is_active', true)->orderBy('name')->get();
        $featuredProducts = Product::where('is_popular', true)->with('category')->orderBy('updated_at', 'desc')->get();

        return view('admin.produk', compact('products', 'categories', 'badges', 'featuredProducts'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if (isset($input['price'])) {
            $input['price'] = preg_replace('/[^0-9]/', '', $input['price']);
        }

        $validated = validator($input, [
            'name' => 'required|string|max:255',
            'product_category_id' => 'required|exists:product_categories,id',
            'product_badge_id' => 'nullable|exists:product_badges,id',
            'price' => 'required|numeric|min:0',
            'unit' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ])->validate();

        $slug = Str::slug($validated['name']);
        $count = Product::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) {
            $slug = "{$slug}-" . ($count + 1);
        }

        $imagePath = 'img/products/roti/Sobek pisang.jpg'; // default fallback
        if ($request->hasFile('image')) {
            $imagePath = ImageCompressor::compressAndSave(
                $request->file('image'),
                'uploads/products',
                $validated['name'],
                800, // max edge 800px
                75   // quality 75%
            );
        }

        Product::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'product_category_id' => $validated['product_category_id'],
            'product_badge_id' => $validated['product_badge_id'] ?? null,
            'price' => $validated['price'],
            'unit' => $validated['unit'] ?? 'pcs',
            'description' => $validated['description'] ?? null,
            'image' => $imagePath,
            'is_popular' => false,
            'is_active' => true,
        ]);

        return redirect()->route('admin.produk')->with('success', 'Produk baru berhasil ditambahkan!');
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->all();
        if (isset($input['price'])) {
            $input['price'] = preg_replace('/[^0-9]/', '', $input['price']);
        }

        $validated = validator($input, [
            'name' => 'required|string|max:255',
            'product_category_id' => 'required|exists:product_categories,id',
            'product_badge_id' => 'nullable|exists:product_badges,id',
            'price' => 'required|numeric|min:0',
            'unit' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ])->validate();

        if ($validated['name'] !== $product->name) {
            $slug = Str::slug($validated['name']);
            $count = Product::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $product->id)->count();
            if ($count > 0) {
                $slug = "{$slug}-" . ($count + 1);
            }
            $product->slug = $slug;
        }

        if ($request->hasFile('image')) {
            // Delete old uploaded file if exists in uploads/
            if ($product->image && str_starts_with($product->image, 'uploads/') && file_exists(public_path($product->image))) {
                @unlink(public_path($product->image));
            }

            $product->image = ImageCompressor::compressAndSave(
                $request->file('image'),
                'uploads/products',
                $validated['name'],
                800, // max edge 800px
                75   // quality 75%
            );
        }

        $product->name = $validated['name'];
        $product->product_category_id = $validated['product_category_id'];
        $product->product_badge_id = $validated['product_badge_id'] ?? null;
        $product->price = $validated['price'];
        if (isset($validated['unit'])) {
            $product->unit = $validated['unit'];
        }
        $product->description = $validated['description'] ?? $product->description;
        $product->save();

        return redirect()->route('admin.produk')->with('success', 'Data produk berhasil diperbarui!');
    }

    /**
     * Toggle featured status (is_popular) via AJAX.
     */
    public function toggleFeatured(Request $request, Product $product)
    {
        $swapId = $request->input('swap_product_id');

        // Case 1: Swapping one featured product with this one
        if ($swapId) {
            Product::where('id', $swapId)->update(['is_popular' => false]);
            $product->update(['is_popular' => true]);
            
            return response()->json([
                'success' => true,
                'message' => "{$product->name} berhasil dijadikan Produk Unggulan!",
                'featured_count' => Product::where('is_popular', true)->count(),
                'featured_products' => Product::where('is_popular', true)->with('category')->get(),
            ]);
        }

        // Case 2: Toggling OFF
        if ($product->is_popular) {
            $product->update(['is_popular' => false]);
            return response()->json([
                'success' => true,
                'is_popular' => false,
                'message' => "{$product->name} dilepas dari Produk Unggulan.",
                'featured_count' => Product::where('is_popular', true)->count(),
                'featured_products' => Product::where('is_popular', true)->with('category')->get(),
            ]);
        }

        // Case 3: Toggling ON - check quota (8/8)
        $currentCount = Product::where('is_popular', true)->count();
        if ($currentCount >= 8) {
            return response()->json([
                'success' => false,
                'quota_full' => true,
                'message' => 'Kuota produk unggulan sudah penuh (8/8). Silakan pilih produk mana yang ingin digantikan.',
                'featured_products' => Product::where('is_popular', true)->with('category')->get(),
            ], 422);
        }

        // Quota has space (<8), set to true
        $product->update(['is_popular' => true]);
        return response()->json([
            'success' => true,
            'is_popular' => true,
            'message' => "{$product->name} berhasil ditambahkan ke Produk Unggulan!",
            'featured_count' => Product::where('is_popular', true)->count(),
            'featured_products' => Product::where('is_popular', true)->with('category')->get(),
        ]);
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        // Delete uploaded file if exists in uploads/
        if ($product->image && str_starts_with($product->image, 'uploads/') && file_exists(public_path($product->image))) {
            @unlink(public_path($product->image));
        }

        $product->delete();

        return redirect()->route('admin.produk')->with('success', 'Produk berhasil dihapus!');
    }
}
