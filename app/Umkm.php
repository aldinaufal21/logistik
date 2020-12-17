<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $table = 'umkm';
    protected $fillable = ['nama', 'deskripsi', 'alamat', 'gambar', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function kategori()
    {
        return $this->hasMany('App\Kategori');
    }
}
