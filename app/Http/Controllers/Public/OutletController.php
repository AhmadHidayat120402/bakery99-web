<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Outlet;

class OutletController extends Controller
{
    public function index()
    {
        $outlets = Outlet::where('is_active', true)
            ->orderByDesc('is_main')
            ->orderBy('name')
            ->get();

        return view('public.outlet', compact('outlets'));
    }
}
