<?php

namespace App\Exports;

use App\BarangKeluar;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PengeluaranExport implements FromView
{
    protected $tgl_awal;
    protected $tgl_akhir;

    function __construct($tgl_awal, $tgl_akhir)
    {
        $this->tgl_awal = $tgl_awal;
        $this->tgl_akhir = $tgl_akhir;
    }

    public function view(): View
    {
        $report = BarangKeluar::whereDate('updated_at', $this->tgl_awal)->whereDate('updated_at', $this->tgl_akhir)->get();

        return view('report.pengeluaran', compact('report'));
    }
}
