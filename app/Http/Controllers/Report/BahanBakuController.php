<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Menu\BahanBaku;
use App\Model\Menu\BahanBakuMasuk;
use App\Model\Menu\BahanBakuKeluar;

class BahanBakuController extends Controller
{
    public function masuk()
    {
        $data = BahanBakuMasuk::whereMonth('created_at', date('m'))->orderBy('created_at', 'DESC')->paginate(30);

        return view('report.bahan_baku.masuk', [
            'data' => $data
        ]);
    }

    public function keluar()
    {
        $data = BahanBakuKeluar::whereMonth('created_at', date('m'))->orderBy('created_at', 'DESC')->paginate(30);

        return view('report.bahan_baku.keluar', [
            'data' => $data
        ]);
    }
}
