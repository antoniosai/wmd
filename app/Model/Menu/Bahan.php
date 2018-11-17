<?php

namespace App\Model\Menu;

use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    protected $table = 'bahan_baku_menu';

    public $timestamps = false;

    protected $fillable = ['menu_id', 'bahan_baku_id', 'qty'];
}
