<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Tranksaksi\Order;
use App\Model\Tranksaksi\OrderTemp;

use DataTables;

use DB;
use Auth;

class KasirController extends Controller
{
    public function index()
    {
        $data = [
            'pendapatan_hari_ini' => OrderTemp::where('status', 'selesai')->whereDate('created_at', date('Y-m-d'))->sum('total'),
            'total_order' => OrderTemp::whereDate('created_at', date('Y-m-d'))->count()
        ];


        return view('kasir.index', $data);
    }

    public function pos()
    {
        $data = [
            'no_nota' => $this->generate_nota()
        ];

        return view('kasir.pos', $data);
    }

    public function data()
    {
        $query = OrderTemp::query()->where('no_nota', '!=', 'test')->whereDate('created_at', date('Y-m-d'))->orderBy('created_at', 'desc');


        return $data = DataTables::eloquent($query)
        ->addColumn('tanggal', function(OrderTemp $order){
            return $order->created_at->format('d M Y H:i:s');
        })
        ->addColumn('meja', function(OrderTemp $order){
            return $order->meja->no_meja;
        })
        ->editColumn('status', function(OrderTemp $order){

            if ($order->status == 'selesai')
            {
                $button = '';
                $button .= '<label class="badge badge-md badge-success">'. ucfirst($order->status) . " " .$order->updated_at->format('H:i:s') .'</label>';
                return $button;
            }
            return '<label class="badge badge-sm badge-danger">'. ucfirst($order->status) .'</label>';
        })
        ->editColumn('total', function(OrderTemp $order){
            return 'Rp ' . number_format($order->total);
        })
        ->addColumn('qty_order', function(OrderTemp $order){
            return count($order->detail);
        })
        ->addColumn('action', function(OrderTemp $order){
            
            if($order->status == 'disajikan')
            {
                $button = '';
                $button .= "<a href='#' class='btn btn-sm btn-success' onclick='ready_to_pay(".$order->id.")'>Selesai</a>";
                return $button;
            }

        })
        ->rawColumns(['total', 'status', 'action'])->make('true');

    }

    public function order_list()
    {

    }

    private function generate_nota()
    {
        $no_order = 'WMD-';
        $no_order = $no_order.date('dm');
        $last_id = OrderTemp::orderBy('created_at', 'DESC')->first()->id;
        $last_id = $last_id + 1;
        $no_order = $no_order.$last_id;

        return $no_order;

    }

    public function add_order(Request $request)
    {
        $order_temp = new OrderTemp;
        $order_temp->user_id = Auth::user()->id;
        // $order_temp->
    }

    public function add_menu(Request $request)
    {

    }

    public function delete_menu(Request $request)
    {

    }

    public function ready_to_pay($order_id)
    {
        $order = OrderTemp::findOrFail($order_id);
        $order->status = 'selesai';

        if($order->save())
        {
            $data = [
                'message' => 'Berhasil menyelesaikan Order ID'. $order->id
            ];
            return response()->json($data);
        }
    }

    public function finish_order(Request $request)
    {
        // return $request->all();
        $no_order = $request->no_order;
        $meja_id = $request->meja_id;
        $nama_pengunjung = $request->nama_pengunjung;

        $order = OrderTemp::where('no_nota', $no_order)->first();
        $order->nama_pengunjung = $nama_pengunjung;
        $order->meja_id = $meja_id;

        if($order->save())
        {
            $data = [
                'message' => 'Berhasil menyimpan Order',
                'status' => 'success'
            ];

            return response()->json($data);
        }
    }
    
}
