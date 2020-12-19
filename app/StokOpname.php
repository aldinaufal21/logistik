<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StokOpname extends Model
{
    protected $table = 'stok_opname';

    protected $fillable = [
        'kategori_id',
        'jumlah',
    ];

    public function kategori()
    {
        return $this->belongsTo('App\Kategori');
    }
}
