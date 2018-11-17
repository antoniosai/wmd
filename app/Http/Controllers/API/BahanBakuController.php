<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Menu\BahanBaku;

class BahanBakuController extends Controller
{
    public function search($query)
    {
        $bahan_baku = BahanBaku::where('nama', 'LIKE', '%'.$query.'%')->get();

        return view('bahan_baku.suggest', [
            'bahan_baku' => $bahan_baku
        ]);
    }
}
