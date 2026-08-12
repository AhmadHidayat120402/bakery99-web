<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Faq;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the public homepage.
     */
    public function index()
    {
        $banners = Banner::where('is_active', true)->orderBy('sort_order', 'asc')->get();
        $categories = ProductCategory::where('is_active', true)->withCount('products')->orderBy('sort_order', 'asc')->get();
        $popularProducts = Product::where('is_active', true)->with(['category', 'badge'])->latest()->take(8)->get();
        $faqs = Faq::where('is_active', true)->orderBy('sort_order', 'asc')->get();

        return view('public.home', compact('banners', 'categories', 'popularProducts', 'faqs'));
    }
}
