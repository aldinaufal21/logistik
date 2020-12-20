<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Distributor;
use App\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        $categories = Kategori::all();

        return view('barang.index', compact('categories'));
    }

    public function create()
    {
        $umkm = Auth::user()->umkm()->first();
        $distributors = Distributor::where('umkm_id', $umkm->id)->get();
        $categories = Kategori::where('umkm_id', $umkm->id)->get();
        return view('barang.create', compact('distributors', 'categories'));
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'harga_beli' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'kategori_id' => 'required',
            'distributor_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('barang.create')
                ->with('errors', $validator->errors());
        }

        Barang::create($requestData);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang Berhasil Ditambahkan.');
    }

    public function edit(Request $request, $barang)
    {
        $item = Barang::find($barang);
        $umkm = Auth::user()->umkm()->first();
        $distributors = Distributor::where('umkm_id', $umkm->id)->get();
        $categories = Kategori::where('umkm_id', $umkm->id)->get();

        return view('barang.edit', compact('item', 'distributors', 'categories'));
    }

    public function update(Request $request, $barang)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'harga_beli' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'kategori_id' => 'required',
            'distributor_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('barang.edit')
                ->with('errors', $validator->errors());
        }

        $barang = Barang::find($barang);
        $barang->update($request->all());

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang Berhasil Diubah.');
    }

    public function destroy(Request $request, $barang)
    {
        $barang = Barang::find($barang);
        $barang->delete();

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang Berhasil Dihapus.');
    }

    public function perKategori(Request $request, $kategori)
    {
        $category = Kategori::find($kategori);
        $items = Barang::with('kategori')
                    ->where('kategori_id', $kategori)
                    ->get();
        
        return view('barang.per_kategori', compact('items', 'category'));
    }
}
