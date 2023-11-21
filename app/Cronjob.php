<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cronjob extends Model
{
    protected $table = 'cronjob';
    protected $guarded = ['id'];
    public $timestamps = false;
}
