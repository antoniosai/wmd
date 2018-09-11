<?php

namespace App\Model\Menu;

use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    protected $table = 'bahan_baku';

    public $timestamps = false;

    public function menu()
    {
        return $this->belongsToMany('App\Model\Menu\BahanBaku');
    }

    public function satuan()
    {
        return $this->hasMany('App\Model\Menu\Satuan', 'satuan_id');
    }
}
