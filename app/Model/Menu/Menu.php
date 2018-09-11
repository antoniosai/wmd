<?php

namespace App\Model\Menu;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';

    public $timestamps = false;

    public function bahan_baku()
    {
        return $this->belongsToMany('App\Model\Menu\BahanBaku');
    }

    public function kategori()
    {
        return $this->belongsTo('App\Model\Menu\Kategori', 'kategori_id');
    }
}
