<?php

namespace App\Model\Menu;

use Illuminate\Database\Eloquent\Model;

class BahanBakuKeluar extends Model
{
    protected $table = 'bahan_baku_keluar';

    public function bahan_baku()
    {
        return $this->belongsTo('App\Model\Menu\BahanBaku', 'bahan_baku_id');
    }
}
