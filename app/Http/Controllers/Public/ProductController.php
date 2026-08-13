<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the public product catalog page.
     * All products are loaded so List.js handles instant client-side filtering and searching.
     */
    public function index(Request $request)
    {
        $categories = ProductCategory::where('is_active', true)->orderBy('sort_order', 'asc')->get();
        $products = Product::where('is_active', true)->with(['category', 'badge'])->orderBy('sort_order', 'asc')->get();

        return view('public.produk', compact('categories', 'products'));
    }
}
