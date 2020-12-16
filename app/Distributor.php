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
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function umkm()
    {
        return $this->belongsTo('App\Umkm');
    }
}
