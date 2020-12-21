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

    public static function getSumJumlahBiaya($umkmId = null)
    {
        $sql = "SELECT
            b.kategori_id,
            COALESCE(
                SUM((
                    SELECT
                        SUM(b2.harga_beli * b2.jumlah )
                    FROM barang b2
                    GROUP BY b2.id
                    HAVING b2.id = b.id
                ))
            , 0) AS biaya
        FROM barang b 
        GROUP BY b.kategori_id
        ";

        $data = DB::table('kategori')
            ->leftJoin(DB::raw('(' . $sql . ') as data'), 'data.kategori_id', '=', 'kategori.id')
            ->where('umkm_id', $umkmId)
            ->selectRaw('
                kategori.*,
                COALESCE(data.biaya, 0) AS biaya
            ');

        return $data;
    }

    public static function getAllDetail()
    {
        $items = DB::table('barang')
            ->join('kategori', 'kategori.id', '=', 'barang.kategori_id')
            ->join('distributor', 'distributor.id', '=', 'barang.distributor_id');

        return $items;
    }

    public function kategori()
    {
        return $this->belongsTo('App\Kategori');
    }

    public function distributor()
    {
        return $this->belongsTo('App\Distributor');
    }
}
