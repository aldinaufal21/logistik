<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $table = 'umkm';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function kategori()
    {
        return $this->hasMany('App\Kategori');
    }
}
