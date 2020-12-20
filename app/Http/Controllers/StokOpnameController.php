<?php

namespace App\Http\Controllers;

use App\StokOpname;
use App\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StokOpnameController extends Controller
{
    public function index()
    {
        $categories = Kategori::all();

        return view('stok_opname.index', compact('categories'));
    }

    public function create()
    {
        $umkm = Auth::user()->umkm()->first();
        $categories = Kategori::where('umkm_id', $umkm->id)->get();
        return view('stok_opname.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'kategori_id' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('stok_opname.create')
                ->with('errors', $validator->errors());
        }

        StokOpname::create($requestData);

        return redirect()
            ->route('stok_opname.index')
            ->with('success', 'Stok opname Berhasil Ditambahkan.');
    }

    public function edit(Request $request, $stokOpname)
    {
        $stokOpname = StokOpname::find($stokOpname);
        $umkm = Auth::user()->umkm()->first();
        $categories = Kategori::where('umkm_id', $umkm->id)->get();

        return view('stok_opname.edit', compact('stokOpname', 'categories'));
    }

    public function update(Request $request, $stokOpname)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'kategori_id' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('stok_opname.edit')
                ->with('errors', $validator->errors());
        }

        $stokOpname = StokOpname::find($stokOpname);
        $stokOpname->update($requestData);

        return redirect()
            ->route('stok_opname.index')
            ->with('success', 'Stok opname Berhasil Diubah.');
    }

    public function destroy(Request $request, $stokOpname)
    {
        $stokOpname = StokOpname::find($stokOpname);
        $stokOpname->delete();

        return redirect()
            ->route('stok_opname.index')
            ->with('success', 'Barang keluar Berhasil Dihapus.');
    }

    public function perKategori(Request $request, $kategori)
    {
        $category = Kategori::find($kategori);
        $items = StokOpname::with('kategori')
                    ->where('kategori_id', $kategori)
                    ->get();
        
        return view('stok_opname.per_kategori', compact('items', 'category'));
    }
}
