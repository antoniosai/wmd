<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Tranksaksi\OrderTemp;
use App\Order;

use DataTables;

class DapurController extends Controller
{
    public function index()
    {
        $data = [
            'data' => null
        ];
        
        return view('dapur.index', $data);
    }

    public function data($status)
    {
        $whereClause = [
            ['status', '=', $status],
            ['no_nota', '!=', 'test'],
        ];

        $query = OrderTemp::query()->where($whereClause)->orderBy('created_at', 'desc');
        // $query = OrderTemp::query()->orderBy('created_at', 'desc');

        return $data = DataTables::eloquent($query)
        ->addColumn('tanggal', function(OrderTemp $order){
            return $order->created_at->format('H:i');
        })
        ->editColumn('status', function(OrderTemp $order){
            // return '<label class="badge badge-sm badge-danger">'. $order->status .'</label>';
            return ucfirst($order->status);
        })
        ->editColumn('total', function(OrderTemp $order){
            return 'Rp ' . number_format($order->total);
        })
        ->addColumn('qty_order', function(OrderTemp $order){
            return count($order->detail);
        })
        ->addColumn('action', function(OrderTemp $order){
            $button = '';

            if($order->status == 'dimasak')
            {
                return $button = '<a href="/auth/dapur/detail_order/{{ $order->id }}" class="btn btn-sm btn-success">Sedang Dimasak</a>';
            }
            else if ($order->status == 'diajukan')
            {
                // return "<a href='story/".$story->id."/edit' class='btn btn-xs btn-primary'>Edit</a> <a href='javascript:void(0);' onclick='deleteStory(".$story->id.");' class='btn btn-xs btn-danger'>Hapus</a>";
                return "<button class='btn btn-sm btn-success' onclick='kerjakan(".$order->id.")'>Kerjakan</button>";
                return "<a href='/auth/dapur/kerjakan/".$order->no_nota."' class='btn btn-sm btn-success'>Kerjakan</a>";
            }
            else if ($order->status == 'selesai')
            {
                return $button = '<a href="/auth/dapur/detail_order/{{ $order->id }}" class="btn btn-sm btn-default">Selesai</a>';
            }

            return $button;
        })
        ->setRowClass(function (OrderTemp $order) {
            return $order->status == 'dimasak' ? 'alert-success' : 'alert-danger';
        })
        ->rawColumns(['total', 'status', 'action'])->make('true');
    }

    public function order_list()
    {
        $data = OrderTemp::all();
        return view('dapur.order_list', $data);

    }

    public function order_detail($order_temp_id)
    {
        $data = OrderTemp::findOrFail($id);
        return view('dapur.order_detail', $data);
    }

    public function kerjakan($id)
    {
        $order = OrderTemp::findOrFail($id);
        $order->status = 'dimasak';
        
        if($order->save())
        {
            $data = [
                'message' => 'Sedang memasak Order #'.$order->no_nota,
                'status' => 'success',
                'data' => $order 
            ];
            return response()->json($data);
        }

    }

    public function memasak($id)
    {
        $order = OrderTemp::findOrFail($id);
        
        return view('dapur.mengerjakan', [
            'data' => $order
        ]);
    }

    public function check_notif()
    {
        $whereClause = [
            ['status', '=', 'diajukan'],
            ['no_nota', '!=', 'test'],
            ['meja_id', '!=', NULL],
            ['nama_pengunjung', '!=', NULL],
        ];
        $order = OrderTemp::orderBy('created_at', 'desc')->where($whereClause)->count();

        $data = [
            'data' => $order
        ];

        return response()->json($order);
    }

    public function selesai($id)
    {
        $order = OrderTemp::findOrFail($id);
        $order->status = 'disajikan';
        
        if($order->save())
        {
            return redirect()->route('dapur.index');
        }
    }
}
