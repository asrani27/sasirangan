<?php

namespace App;

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
    
}
