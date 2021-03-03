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
}
