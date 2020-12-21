<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
        'umkm_id',
    ];

    public static function dataDetail($umkmId = null)
    {
        $sql = "SELECT
            k.*,
            COALESCE((
                CASE
                    WHEN stok_opname.created_at IS NULL THEN (
                        SELECT
                            SUM(b3.jumlah)
                        FROM barang b3
                        GROUP BY b3.kategori_id 
                        HAVING b3.kategori_id = k.id 
                    )
                    WHEN stok_opname.created_at IS NOT NULL 
                        AND stok_opname.created_at > barang.created_at THEN (
                        SELECT 
                            so3.jumlah
                        FROM stok_opname so3 
                        WHERE so3.kategori_id = k.id 
                        ORDER BY so3.created_at DESC
                        LIMIT 1
                    )
                    WHEN stok_opname.created_at IS NOT NULL 
                        AND stok_opname.created_at < barang.created_at THEN (
                        SELECT
                            SUM(jumlah)
                        FROM (
                            (
                                SELECT b2.kategori_id, b2.jumlah, b2.created_at 
                                FROM barang b2 
                            )
                            UNION
                            (
                                SELECT so.kategori_id, so.jumlah, so.created_at 
                                FROM stok_opname so 
                            )
                        ) stok_plus
                        WHERE stok_plus.kategori_id = k.id 
                        AND stok_plus.created_at >= stok_opname.created_at 
                    )
                END
            ) - COALESCE(barang_keluar.jumlah, 0), 0) AS stok,
            COALESCE(barang_keluar.jumlah, 0) AS stok_keluar
        FROM kategori k
        JOIN umkm u ON u.id = k.umkm_id 
        LEFT JOIN (
            SELECT
                so.kategori_id,
                so.jumlah,
                so.created_at
            FROM stok_opname so 
            WHERE so.created_at = (
                SELECT MAX(so2.created_at)
                FROM stok_opname so2 
                WHERE so2.kategori_id = so.kategori_id
            )
        ) stok_opname ON stok_opname.kategori_id = k.id
        LEFT JOIN (
            SELECT
                b.kategori_id,
                b.jumlah,
                b.created_at 
            FROM barang b
            WHERE b.created_at =(
                SELECT MAX(b2.created_at)
                FROM barang b2 
                WHERE b2.kategori_id = b.kategori_id
            )
        ) barang ON barang.kategori_id = k.id 
        LEFT JOIN (
            SELECT
                bk.kategori_id,
                SUM(bk.jumlah) AS jumlah,
                bk.created_at 
            FROM barang_keluar bk
            GROUP BY bk.kategori_id
        ) barang_keluar ON barang_keluar.kategori_id = k.id
        WHERE k.umkm_id = ?";

        $data = DB::table('kategori')
            ->join(DB::raw('(' . $sql . ') as data'), 'data.id', '=', 'kategori.id')
            ->setBindings([$umkmId]);
        
        return $data;
    }
    
    public function umkm()
    {
        return $this->belongsTo('App\Umkm');
    }

    public function barang()
    {
        return $this->hasMany('App\Barang');
    }

    public function barangKeluar()
    {
        return $this->hasMany('App\BarangKeluar');
    }

    public function stokOpname()
    {
        return $this->hasMany('App\StokOpname');
    }
}
