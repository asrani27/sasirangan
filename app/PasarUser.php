<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasarUser extends Model
{
    protected $table = 'pasar_users';
    protected $guarded = ['id'];
    public $timestamps = false;
}
