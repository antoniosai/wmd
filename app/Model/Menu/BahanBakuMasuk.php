<?php

namespace App\Model\Menu;

use Illuminate\Database\Eloquent\Model;

class BahanBakuMasuk extends Model
{
    protected $table = 'bahan_baku_masuk';

    public function bahan_baku()
    {
        return $this->belongsTo('App\Model\Menu\BahanBaku', 'bahan_baku_id');
    }
}
