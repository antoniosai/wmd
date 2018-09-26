<?php

namespace App\Model\Meja;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    public $timestamps = false;

    protected $table = 'meja';

    public function order()
    {
        return $this->hasMany('App\Model\Tranksaksi\OrderTemp');
    }

}
