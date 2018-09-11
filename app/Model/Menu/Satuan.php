<?php

namespace App\Model\Menu;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'satuan';

    public $timestamps = false;

    public function bahan_baku()
    {
        return $this->hasMany('App\Model\Menu\BahanBaku');
    }
}
