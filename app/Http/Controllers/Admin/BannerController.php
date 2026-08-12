<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Services\ImageCompressor;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of hero banners.
     */
    public function index()
    {
        $banners = Banner::orderBy('sort_order', 'asc')->get();
        return view('admin.banner', compact('banners'));
    }

    /**
     * Store a newly created banner in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'badge_text' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'sort_order' => 'nullable|integer',
        ]);

        $imagePath = ImageCompressor::compressAndSave(
            $request->file('image'),
            'uploads/banners',
            $validated['badge_text'],
            900, // Max edge 900px (Target size ~50KB - 90KB)
            75   // Quality 75%
        );

        Banner::create([
            'title' => $validated['badge_text'],
            'badge_text' => $validated['badge_text'],
            'image' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? (Banner::count() + 1),
            'is_active' => true,
        ]);

        return redirect()->route('admin.banner')->with('success', 'Slide Banner baru berhasil ditambahkan!');
    }

    /**
     * Update the specified banner in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'badge_text' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old uploaded file if it exists in uploads/
            if ($banner->image && str_starts_with($banner->image, 'uploads/') && file_exists(public_path($banner->image))) {
                @unlink(public_path($banner->image));
            }

            $banner->image = ImageCompressor::compressAndSave(
                $request->file('image'),
                'uploads/banners',
                $validated['badge_text'],
                900, // Max edge 900px
                75   // Quality 75%
            );
        }

        $banner->title = $validated['badge_text'];
        $banner->badge_text = $validated['badge_text'];
        if (isset($validated['sort_order'])) {
            $banner->sort_order = $validated['sort_order'];
        }
        if ($request->has('is_active')) {
            $banner->is_active = $request->boolean('is_active');
        }

        $banner->save();

        return redirect()->route('admin.banner')->with('success', 'Slide Banner berhasil diperbarui!');
    }

    /**
     * Reorder banners via AJAX drag-and-drop.
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:banners,id',
            'orders.*.sort_order' => 'required|integer',
        ]);

        foreach ($request->orders as $order) {
            Banner::where('id', $order['id'])->update(['sort_order' => $order['sort_order']]);
        }

        return response()->json(['success' => true, 'message' => 'Urutan banner berhasil diperbarui!']);
    }

    /**
     * Remove the specified banner from storage.
     */
    public function destroy(Banner $banner)
    {
        // Delete uploaded file if exists in uploads/
        if ($banner->image && str_starts_with($banner->image, 'uploads/') && file_exists(public_path($banner->image))) {
            @unlink(public_path($banner->image));
        }

        $banner->delete();

        return redirect()->route('admin.banner')->with('success', 'Slide Banner berhasil dihapus!');
    }
}
