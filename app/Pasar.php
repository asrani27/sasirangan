<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Pasar extends Model
{
    protected $table = 'pasar';
    protected $guarded = ['id'];

    public $timestamps = false;

    public function bahan()
    {
        return $this->belongsToMany(Bahan::class, 'bahan_pasar', 'pasar_id', 'bahan_id');
    }

    public function hargaToday()
    {
        return $this->hasMany(Harga::class, 'pasar_id');
    }

    public function bulanLalu()
    {

        return $this->hasMany(Harga::class, 'pasar_id');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'pasar_users');
    }
}
