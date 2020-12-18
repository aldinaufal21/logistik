<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
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

    public function barang()
    {
        return $this->hasMany('App\Barang');
    }
}