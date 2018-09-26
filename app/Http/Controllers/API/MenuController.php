<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Menu\Menu;

use App\Model\Tranksaksi\Order;
use App\Model\Tranksaksi\OrderTemp;

class MenuController extends Controller
{
    public function show_menu($data)
    {
        return $data;
        $menu = Menu::all();

        return $menu;
    }

    public function search($query)
    {
        $menu = Menu::where('nama', 'LIKE', '%'.$query.'%')->get();

        return view('kasir.suggest', [
            'menu' => $menu
        ]);
    }

    public function detail($id)
    {
        $menu = Menu::findOrFail($id);

        return response()->json($menu);
    }

    public function add_menu(Request $request)
    {
        // return $request->all();
        // if()
        $model = OrderTemp::where('no_nota', $request->no_nota)->first();

        $order_temp = [];

        if(!$model)
        {
            $order_temp = new OrderTemp;
            $order_temp->no_nota = $request->no_nota;
        }
        else
        {
            $order_temp = $model;
        }

        if($order_temp->save())
        {
            $menu = Menu::findOrFail($request->id);

            $order_where_clause = [
                'order_temp_id' => $order_temp->id,
                'menu_id' => $request->id
            ];

            $order_list = Order::where($order_where_clause)->first();
            $order = [];
            if(!$order_list)
            {
                $order = new Order;
                $order->menu_id = $request->id;
                $order->qty = $request->qty;
                $order->order_temp_id = $order_temp->id;
                $order->subtotal = $menu->harga * $request->qty;
            }
            else
            {
                $order = $order_list;
                $order->qty = $order->qty + $request->qty;
                $order->subtotal = $order->subtotal + ($menu->harga * $request->qty);
            }
                
            if($order->save())
            {
                $order_temp->total = $order_temp->total + $order->subtotal;
                $order_temp->save();

                $data = [
                    'status' => 'success',
                    'message' => 'Telah menambahkan ' . $menu->nama . ' sebanyak ' . $request->qty . 'Berhasil'
                ];
                return view('kasir.order_list', [
                    'order_list' => $order_temp->detail
                ]);
            }

        }
    }

    public function add_item(Request $request)
    {
        $order_temp_id = $request->order_temp_id;
        $menu_id = $request->menu_id;
        
        $menu = Menu::findOrFail($menu_id);

        $order_where_clause = [
            'order_temp_id' => $order_temp_id,
            'menu_id' => $menu->id
        ];

        $order = Order::where($order_where_clause)->first();
        $order->qty = $order->qty + 1;
        $order->subtotal = $order->subtotal + $menu->harga;
        $order->save();

        // $this->sum_order($order_temp_id);

        return view('kasir.order_list', [
            'order_list' => $order->order_temp->detail
        ]);

    }

    public function remove_item(Request $request)
    {

        $order_temp_id = $request->order_temp_id;
        $menu_id = $request->menu_id;
        
        $menu = Menu::findOrFail($menu_id);

        $order_where_clause = [
            'order_temp_id' => $order_temp_id,
            'menu_id' => $menu->id
        ];

        $order = Order::where($order_where_clause)->first();
        $order->qty = $order->qty - 1;
        $order->subtotal = $order->subtotal - $menu->harga;
        $order->save();

        if($order->qty == 0)
        {
            $order->delete();
        }

        $data = OrderTemp::findOrFail($order_temp_id);

        // $this->sum_order($order_temp_id);

        return view('kasir.order_list', [
            'order_list' => $order->order_temp->detail
        ]);
    }

    public function delete_item(Request $request)
    {
        return $request->all();
    }

    public function order_list($no_nota)
    {
        $order_where_clause = [
            'no_nota' => $no_nota
        ];

        // return OrderTemp::all();
        $order = OrderTemp::where('no_nota', $no_nota)->first();

        if(!$order)
        {
            $order = [];
        }
        else if(count($order) == 0)
        {
            $order = [];
        }

        return view('kasir.order_list', [
            'order_list' => $order
        ]);
    }

    

    public function order_detail($no_nota)
    {

    }

    public function finish_order(Request $request)
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

    private function sum_order($order_temp_id)
    {
        $order_sum = Order::where('order_temp_id', $order_temp_id)->sum('total');
        
        $order_temp = OrderTemp::findOrFail($order_temp_id);
        $order_temp->total = $order_sum;
        $order_temp->save();
    }
}
