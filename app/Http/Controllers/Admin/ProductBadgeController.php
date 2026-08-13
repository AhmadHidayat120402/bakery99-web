<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductBadge;
use Illuminate\Http\Request;

class ProductBadgeController extends Controller
{
    /**
     * Display a listing of product badges.
     */
    public function index()
    {
        $badges = ProductBadge::withCount('products')->latest()->get();
        return view('admin.badge', compact('badges'));
    }

    /**
     * Store a newly created product badge.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'icon' => 'nullable|string|max:50',
            'bg_color' => 'required|string|max:30',
            'text_color' => 'required|string|max:30',
        ]);

        ProductBadge::create([
            'name' => $validated['name'],
            'icon' => $validated['icon'] ?? null,
            'bg_color' => $validated['bg_color'],
            'text_color' => $validated['text_color'],
            'is_active' => true,
        ]);

        return redirect()->route('admin.badge')->with('success', 'Badge Promo baru berhasil ditambahkan!');
    }

    /**
     * Update the specified product badge.
     */
    public function update(Request $request, ProductBadge $badge)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'icon' => 'nullable|string|max:50',
            'bg_color' => 'required|string|max:30',
            'text_color' => 'required|string|max:30',
            'is_active' => 'nullable|boolean',
        ]);

        $badge->name = $validated['name'];
        $badge->icon = $validated['icon'] ?? null;
        $badge->bg_color = $validated['bg_color'];
        $badge->text_color = $validated['text_color'];
        if ($request->has('is_active')) {
            $badge->is_active = $request->boolean('is_active');
        }
        $badge->save();

        return redirect()->route('admin.badge')->with('success', 'Data Badge Promo berhasil diperbarui!');
    }

    /**
     * Remove the specified product badge from storage.
     */
    public function destroy(ProductBadge $badge)
    {
        $badge->delete();

        return redirect()->route('admin.badge')->with('success', 'Badge Promo berhasil dihapus!');
    }
}
