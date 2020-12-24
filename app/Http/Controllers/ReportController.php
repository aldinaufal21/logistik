<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Exports\PengeluaranExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }

    public function exportData(Request $request)
    {
        if ($request->data == "1") {
            return Excel::download(new BarangExport($request->tgl_awal, $request->tgl_akhir), 'Report_Barang.xlsx');   
        }
        else{
            return Excel::download(new PengeluaranExport($request->tgl_awal, $request->tgl_akhir), 'Report_pengeluaran_barang.xlsx');
        }
    }
}
