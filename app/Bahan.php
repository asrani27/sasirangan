<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    protected $table = 'bahan';
    protected $guarded = ['id'];

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'kelompok_id');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }

    public function pasar()
    {
        return $this->belongsToMany(Pasar::class, 'bahan_pasar', 'bahan_id', 'pasar_id');
    }

    public function harga()
    {
        return $this->hasMany(Harga::class, 'bahan_id');
    }

    public function stok()
    {
        return $this->hasMany(Stok_kota::class, 'bahan_id');
    }

    public function stok_kota()
    {
        return $this->hasMany(Stok_kota::class, 'bahan_id');
    }
}
