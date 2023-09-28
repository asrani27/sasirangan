<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EWS extends Model
{
    protected $table = 'ews';
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
