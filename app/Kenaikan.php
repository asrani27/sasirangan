<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kenaikan extends Model
{

    protected $table = 'kenaikan';
    protected $guarded = ['id'];
    public function pasar()
    {
        return $this->belongsTo(Pasar::class, 'pasar_id');
    }

    public function bahan()
    {
        return $this->belongsTo(Bahan::class, 'bahan_id');
    }
}
