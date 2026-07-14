<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CatalogController extends Controller
{
    /**
     * Halaman depan publik: tampilkan semua katalog tanpa login.
     */
    public function publicIndex(): View
    {
        $catalogs = Catalog::all();
        return view('welcome', compact('catalogs'));
    }

    /**
     * Daftar katalog untuk Admin.
     */
    public function index(): View
    {
        $catalogs = Catalog::latest()->paginate(10);
        return view('admin.catalogs.index', compact('catalogs'));
    }

    /**
     * Form tambah produk baru.
     */
    public function create(): View
    {
        return view('admin.catalogs.create');
    }

    /**
     * Simpan produk baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('catalogs', 'public');
        }

        Catalog::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $imagePath,
        ]);

        return redirect()->route('admin.catalogs.index')
            ->with('success', 'Produk katalog berhasil ditambahkan.');
    }

    /**
     * Form edit produk.
     */
    public function edit(Catalog $catalog): View
    {
        return view('admin.catalogs.edit', compact('catalog'));
    }

    /**
     * Simpan perubahan produk.
     */
    public function update(Request $request, Catalog $catalog): RedirectResponse
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($catalog->image) {
                Storage::disk('public')->delete($catalog->image);
            }
            $catalog->image = $request->file('image')->store('catalogs', 'public');
        }

        $catalog->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
        ]);

        return redirect()->route('admin.catalogs.index')
            ->with('success', 'Katalog produk berhasil diperbarui.');
    }

    /**
     * Hapus produk dari database.
     */
    public function destroy(Catalog $catalog): RedirectResponse
    {
        if ($catalog->image) {
            Storage::disk('public')->delete($catalog->image);
        }
        $catalog->delete();

        return redirect()->route('admin.catalogs.index')
            ->with('success', 'Katalog produk berhasil dihapus.');
    }
}
