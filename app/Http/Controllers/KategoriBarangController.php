<?php

namespace App\Http\Controllers;

use App\KategoriBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KategoriBarangController extends Controller
{
    public function index()
    {
        $categories = KategoriBarang::all();

        return view('kategori.index', compact('categories'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $requestData['umkm_id'] = Auth::user()->umkm()->first()->id;

        KategoriBarang::create($requestData);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori barang Berhasil Ditambahkan.');
    }

    public function edit(Request $request, $category)
    {
        $category = KategoriBarang::find($category);

        return view('kategori.edit', compact('category'));
    }

    public function update(Request $request, $category)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $category = KategoriBarang::find($category);
        $category->update($request->all());

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori barang Berhasil Diubah.');
    }

    public function destroy(Request $request, $category)
    {
        $category = KategoriBarang::find($category);
        $category->delete();

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori barang Berhasil Dihapus.');
    }
}
