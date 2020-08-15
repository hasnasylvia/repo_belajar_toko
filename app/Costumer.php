<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Costumer extends Model
{
    protected $table = 'costumer';
    public $timestamps = false;

    protected $fillable = ['nama', 'alamat'];
}
