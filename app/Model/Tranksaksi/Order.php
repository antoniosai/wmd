<?php

namespace App\Model\Tranksaksi;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    public function order_temp()
    {
        return $this->belongsTo('App\Model\Tranksaksi\OrderTemp', 'order_temp_id');
    }

    public function menu()
    {
        return $this->belongsTo('App\Model\Menu\Menu', 'menu_id');
    }
}
