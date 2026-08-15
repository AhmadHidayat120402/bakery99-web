<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutContent;
use Illuminate\Support\Facades\Storage;

class AboutContentController extends Controller
{
    public function index()
    {
        $about = AboutContent::first();

        return view('admin.tentang', compact('about'));
    }

    /**
     * Simpan data pertama kali
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'description' => 'required|string',

            'store_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'halal_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        // Upload foto toko
        if ($request->hasFile('store_photo')) {
            $validated['store_photo'] = $request
                ->file('store_photo')
                ->store('about', 'public');
        }

        // Upload logo halal
        if ($request->hasFile('halal_logo')) {
            $validated['halal_logo'] = $request
                ->file('halal_logo')
                ->store('about', 'public');
        }

        AboutContent::create($validated);

        return redirect()
            ->route('admin.about.index')
            ->with('success', 'Konten profil toko berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $about = AboutContent::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'description' => 'required|string',

            'store_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'halal_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);


        //    foto toko

        if ($request->hasFile('store_photo')) {

            // Hapus foto lama jika ada
            if (
                $about->store_photo &&
                Storage::disk('public')->exists($about->store_photo)
            ) {
                Storage::disk('public')->delete($about->store_photo);
            }

            // Upload foto baru
            $validated['store_photo'] = $request
                ->file('store_photo')
                ->store('about', 'public');
        }


        // logo halal

        if ($request->hasFile('halal_logo')) {

            // Hapus logo lama jika ada
            if (
                $about->halal_logo &&
                Storage::disk('public')->exists($about->halal_logo)
            ) {
                Storage::disk('public')->delete($about->halal_logo);
            }

            // Upload logo baru
            $validated['halal_logo'] = $request
                ->file('halal_logo')
                ->store('about', 'public');
        }

        $about->update($validated);

        return redirect()
            ->route('admin.about.index')
            ->with('success', 'Konten profil toko berhasil diperbarui.');
    }
}
