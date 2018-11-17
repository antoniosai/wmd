<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Tranksaksi\OrderTemp;

class PenjualanController extends Controller
{
    public function index()
    {
        $data = OrderTemp::where('no_nota', '!=', 'test')->orderBy('created_at', 'desc')->get();

        $total_order = $data->sum('total');
        $month = date('M');
        $year = date('Y');

        $string_header = 'Report Penjualan Bulan ' . $month . ' ' . $year;

        return view('report.penjualan.index', [
            'data' => $data,
            'string_header' => $string_header,
            'total_order' => $total_order,
        ]);
    }
        
    public function load_data()
    {
        $data = OrderTemp::where('no_nota', '!=', 'test')->orderBy('created_at', 'desc')->get();

        
    }
}
