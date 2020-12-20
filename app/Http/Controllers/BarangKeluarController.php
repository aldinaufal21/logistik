<?php

namespace App\Http\Controllers;

use App\BarangKeluar;
use App\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $categories = Kategori::all();

        return view('barang_keluar.index', compact('categories'));
    }

    public function create()
    {
        $umkm = Auth::user()->umkm()->first();
        $categories = Kategori::where('umkm_id', $umkm->id)->get();
        return view('barang_keluar.create', compact('categories'));
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
                ->route('barang_keluar.create')
                ->with('errors', $validator->errors());
        }

        BarangKeluar::create($requestData);

        return redirect()
            ->route('barang_keluar.index')
            ->with('success', 'BarangKeluar barang Berhasil Ditambahkan.');
    }

    public function edit(Request $request, $outStock)
    {
        $outStock = BarangKeluar::find($outStock);
        $umkm = Auth::user()->umkm()->first();
        $categories = Kategori::where('umkm_id', $umkm->id)->get();

        return view('barang_keluar.edit', compact('outStock', 'categories'));
    }

    public function update(Request $request, $outStock)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'kategori_id' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('barang_keluar.edit')
                ->with('errors', $validator->errors());
        }

        $outStock = BarangKeluar::find($outStock);
        $outStock->update($requestData);

        return redirect()
            ->route('barang_keluar.index')
            ->with('success', 'BarangKeluar barang Berhasil Diubah.');
    }

    public function destroy(Request $request, $outStock)
    {
        $outStock = BarangKeluar::find($outStock);
        $outStock->delete();

        return redirect()
            ->route('barang_keluar.index')
            ->with('success', 'Barang Keluar barang Berhasil Dihapus.');
    }

    public function perKategori(Request $request, $kategori)
    {
        $category = Kategori::find($kategori);
        $items = BarangKeluar::with('kategori')
                    ->where('kategori_id', $kategori)
                    ->get();
        
        return view('barang_keluar.per_kategori', compact('items', 'category'));
    }
}
