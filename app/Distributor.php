<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected $table = 'distributor';

    protected $fillable = [
        'nama',
        'alamat',
        'telefon',
        'email',
        'umkm_id',
    ];

    public function umkm()
    {
        return $this->belongsTo('App\Umkm');
    }
}
