<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Tranksaksi\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $data = null;

        return view('admin.dashboard', [
            'data' => $data
        ]);
    }

    public function data()
    {
        $order = Order::count();
        $pengunjung = Pengunjung::count();

        $data = [
            'order' => $order,
            'pengunjung' => $pengunjung
        ];

        return response()->json($data);
        
    }
}
