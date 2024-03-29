<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HargaAcuan extends Model
{

    protected $table = 'harga_acuan';
    protected $guarded = ['id'];

    public $timestamps = false;
    public function pasar()
    {
        return $this->belongsTo(Pasar::class, 'pasar_id');
    }
}
