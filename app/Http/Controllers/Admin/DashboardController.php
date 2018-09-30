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

    public function data_graf()
    {

        // menentukan timestamp 10 hari sebelumnya dari tanggal hari ini
        $data = [];

        $total = 0;

        for($i = 7; $i >= 1; $i--)
        {
            // echo $i;
            $prevN = mktime(0, 0, 0, date("m"), date("d") - $i, date("Y"));
            $total = OrderTemp::where('status', 'selesai')->whereDate('created_at', date('Y-m-d', $prevN))->sum('total');
            $temp = ['y'=>date('Y-m-d', $prevN), 'a'=>$total];
            array_push($data, $temp);

            unset($temp);

            $total = 0;
        }

        $total = OrderTemp::where('status', 'selesai')->whereDate('created_at', date('Y-m-d'))->sum('total');
        $temp = ['y'=>date('Y-m-d'), 'a'=>$total];
        array_push($data, $temp);

        // return response()->json($data);
        return $data;
        // menampilkan tanggal 10 hari berikutnya dari tanggal hari ini berdasarkan timestamp nya
        // echo date("d-m-Y", $nextN);
        // echo "<br/>";
        // menampilkan tanggal 10 hari sebelumnya dari tanggal hari ini berdasarkan timestamp nya
        // echo date("d-m-Y", $prevN);
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
