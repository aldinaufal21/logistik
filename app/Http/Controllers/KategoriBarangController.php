<?php

namespace App\Http\Controllers;

use App\Distributor;
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
        $umkm = Auth::user()->umkm()->first();
        $distributors = Distributor::where('umkm_id', $umkm->id)->get();

        return view('kategori.create', compact('distributors'));
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'nama_kategori' => 'required|string|max:255',
            'distributor_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('kategori.create')
                ->with('errors', $validator->errors());
        }

        $requestData['umkm_id'] = Auth::user()->umkm()->first()->id;

        KategoriBarang::create($requestData);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori barang Berhasil Ditambahkan.');
    }

    public function edit(Request $request, $category)
    {
        $umkm = Auth::user()->umkm()->first();
        $distributors = Distributor::where('umkm_id', $umkm->id)->get();
        $category = KategoriBarang::find($category);

        return view('kategori.edit', compact('category', 'distributors'));
    }

    public function update(Request $request, $category)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'nama_kategori' => 'required|string|max:255',
            'distributor_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('kategori.edit')
                ->with('errors', $validator->errors());
        }

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
