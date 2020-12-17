<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'harga_beli',
        'jumlah',
        'kategori_id',
        'distributor_id',
    ];

    public static function getAllDetail()
    {
        $items = DB::table('barang')
            ->join('kategori', 'kategori.id', '=', 'barang.kategori_id')
            ->join('distributor', 'distributor.id', '=', 'barang.distributor_id');

        return $items;
    }

    public function kategoriBarang()
    {
        return $this->belongsTo('App\KategoriBarang');
    }

    public function distributor()
    {
        return $this->belongsTo('App\Distributor');
    }
}
