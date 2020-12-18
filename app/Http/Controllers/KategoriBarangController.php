<?php

namespace App\Http\Controllers;

use App\Distributor;
use App\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KategoriBarangController extends Controller
{
    public function index()
    {
        $categories = Kategori::all();

        return view('kategori.index', compact('categories'));
    }

    public function create()
    {
        $umkm = Auth::user()->umkm()->first();

        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'nama_kategori' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('kategori.create')
                ->with('errors', $validator->errors());
        }

        $requestData['umkm_id'] = Auth::user()->umkm()->first()->id;

        Kategori::create($requestData);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori barang Berhasil Ditambahkan.');
    }

    public function edit(Request $request, $category)
    {
        $umkm = Auth::user()->umkm()->first();
        $category = Kategori::find($category);

        return view('kategori.edit', compact('category'));
    }

    public function update(Request $request, $category)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'nama_kategori' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('kategori.edit')
                ->with('errors', $validator->errors());
        }

        $category = Kategori::find($category);
        $category->update($requestData);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori barang Berhasil Diubah.');
    }

    public function destroy(Request $request, $category)
    {
        $category = Kategori::find($category);
        $category->delete();

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori barang Berhasil Dihapus.');
    }
}
