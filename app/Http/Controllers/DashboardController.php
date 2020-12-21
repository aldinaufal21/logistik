<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Kategori;
use App\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        switch (Auth::user()->role) {
            case 1:
                return $this->pengelolaDashboardData();
            case 2:
                return $this->umkmDashboardData();
        }

        return abort(403, 'Unauthorized');
    }

    /**
     * API REQUEST
     */
    public function jumlah_per_kategori(Request $request, $umkmId)
    {
        $categories = Kategori::dataDetail($umkmId)->get();
        
        return response()->json($categories, 200);
    }

    private function pengelolaDashboardData()
    {
        //daftar 5 terakhir umkm 
        $daftarUmkm = Umkm::limit(5)->orderBy('id', 'DESC')->get();

        return view('dashboard.pengelola', compact('daftarUmkm'));
    }

    private function umkmDashboardData()
    {
        $umkmId = Auth::user()->umkm()->first()->id;
        $items = Barang::with('kategori', 'distributor')
            ->limit(5)
            ->orderBy('created_at', 'DESC')
            ->get();
        $top5Categories = Kategori::dataDetail($umkmId)->limit(5)->orderBy('stok', 'desc')->get();

        return view('dashboard.umkm', compact('items', 'top5Categories'));
    }
}
