<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OutletController extends Controller
{
    public function index()
    {
        $outlets = Outlet::latest()->get();

        return view('admin.outlet', compact('outlets'));
    }

    /**
     * Menyimpan outlet baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_whatsapp' => 'nullable|string|max:30',
            'google_maps_url' => 'nullable|url|max:1000',
            'operating_hours' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'is_main' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ], [
            'name.required' => 'Nama outlet wajib diisi.',
            'address.required' => 'Alamat outlet wajib diisi.',
            'operating_hours.required' => 'Jam operasional wajib diisi.',
            'google_maps_url.url' => 'Link Google Maps tidak valid.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Generate slug
        |--------------------------------------------------------------------------
        */

        $slug = Str::slug($request->name);

        // Pastikan slug unik
        $originalSlug = $slug;
        $counter = 1;

        while (Outlet::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        /*
        |--------------------------------------------------------------------------
        | Jika outlet ini menjadi outlet utama,
        | outlet utama sebelumnya dibuat false
        |--------------------------------------------------------------------------
        */

        $isMain = $request->boolean('is_main');

        if ($isMain) {
            Outlet::query()->update([
                'is_main' => false
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Simpan
        |--------------------------------------------------------------------------
        */

        Outlet::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'address' => $validated['address'],
            'phone_whatsapp' => $validated['phone_whatsapp'] ?? null,
            'google_maps_url' => $validated['google_maps_url'] ?? null,
            'operating_hours' => $validated['operating_hours'],
            'image' => $validated['image'] ?? null,
            'is_main' => $isMain,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.outlets.index')
            ->with('success', 'Outlet berhasil ditambahkan.');
    }

    /**
     * Update outlet
     */
    public function update(Request $request, Outlet $outlet)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_whatsapp' => 'nullable|string|max:30',
            'google_maps_url' => 'nullable|url|max:1000',
            'operating_hours' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'is_main' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ], [
            'name.required' => 'Nama outlet wajib diisi.',
            'address.required' => 'Alamat outlet wajib diisi.',
            'operating_hours.required' => 'Jam operasional wajib diisi.',
            'google_maps_url.url' => 'Link Google Maps tidak valid.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Generate slug dari nama
        |--------------------------------------------------------------------------
        */

        $slug = Str::slug($request->name);

        $originalSlug = $slug;
        $counter = 1;

        while (
            Outlet::where('slug', $slug)
            ->where('id', '!=', $outlet->id)
            ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        /*
        |--------------------------------------------------------------------------
        | Outlet utama
        |--------------------------------------------------------------------------
        */

        $isMain = $request->boolean('is_main');

        if ($isMain) {
            Outlet::where('id', '!=', $outlet->id)
                ->update([
                    'is_main' => false
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $outlet->update([
            'name' => $validated['name'],
            'slug' => $slug,
            'address' => $validated['address'],
            'phone_whatsapp' => $validated['phone_whatsapp'] ?? null,
            'google_maps_url' => $validated['google_maps_url'] ?? null,
            'operating_hours' => $validated['operating_hours'],
            'image' => $validated['image'] ?? null,
            'is_main' => $isMain,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.outlets.index')
            ->with('success', 'Outlet berhasil diperbarui.');
    }

    /**
     * Hapus outlet
     */
    public function destroy(Outlet $outlet)
    {
        $outlet->delete();

        return redirect()
            ->route('admin.outlets.index')
            ->with('success', 'Outlet berhasil dihapus.');
    }
}
