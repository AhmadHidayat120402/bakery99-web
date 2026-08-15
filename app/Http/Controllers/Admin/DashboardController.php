<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Outlet;

class DashboardController extends Controller
{
    public function index()
    {
        $bannersCount = Banner::count();
        $activeBannersCount = Banner::where('is_active', true)->count();

        $categoriesCount = ProductCategory::count();

        $productsCount = Product::count();
        $activeProductsCount = Product::where('is_active', true)->count();

        $outletsCount = Outlet::count();
        $activeOutletsCount = Outlet::where('is_active', true)->count();

        return view('admin.dashboard', compact(
            'bannersCount',
            'activeBannersCount',
            'categoriesCount',
            'productsCount',
            'activeProductsCount',
            'outletsCount',
            'activeOutletsCount'
        ));
    }
}
