<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Tranksaksi\OrderTemp;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'pendapatan_hari_ini' => OrderTemp::where('status', 'selesai')->whereDate('created_at', date('Y-m-d'))->sum('total'),
            'total_order' => OrderTemp::whereDate('created_at', date('Y-m-d'))->count()
        ];

        return view('admin.dashboard', $data);
    }

    public function data()
    {
        $order = OrderTemp::count();
        $pengunjung = Pengunjung::count();

        $data = [
            'order' => $order,
            'pengunjung' => $pengunjung
        ];

        return response()->json($data);
        
    }
}
