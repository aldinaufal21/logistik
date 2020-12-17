<?php

namespace App\Http\Controllers;

use App\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role == 1) {
            //daftar 5 terakhir umkm 
            $daftarUmkm = Umkm::limit(5)->orderBy('id', 'DESC')->get();
            
            return view('dashboard.index', compact('daftarUmkm'));
        }

        return view('dashboard.index');
    }
}
