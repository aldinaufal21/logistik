<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluar';

    protected $fillable = [
        'kategori_id',
        'jumlah',
    ];

    public function kategori()
    {
        return $this->belongsTo('App\Kategori');
    }
}
