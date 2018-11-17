<?php

namespace App\Model\Tranksaksi;

use Illuminate\Database\Eloquent\Model;

class OrderTemp extends Model
{
    protected $table = 'order_temp';

    public function detail()
    {
        return $this->hasMany('App\Model\Tranksaksi\Order');
    }

    public function meja()
    {
        return $this->belongsTo('App\Model\Meja\Meja');
    }
    
}
