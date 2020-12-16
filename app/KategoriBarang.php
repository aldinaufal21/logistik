<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
        'umkm_id',
    ];
    
    public function umkm()
    {
        return $this->belongsTo('App\Umkm');
    }
}
