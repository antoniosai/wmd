<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DataTables;

use App\Model\Menu\BahanBaku;
use App\Model\Menu\BahanBakuMasuk;
use App\Model\Menu\BahanBakuKeluar;

class BahanBakuController extends Controller
{
    public function index()
    {
        $data = null;

        return view('admin.bahan_baku.index', [
            'data' => $data
        ]);
    }

    public function data()
    {
        $query = BahanBaku::with('satuan');

        return DataTables::eloquent($query)
        ->addColumn('action', function(BahanBaku $bahan){
            return "
            <a href='/auth/bahan_baku/edit/".$bahan->id."' class='btn btn-sm btn-warning'><i class='fa fa-pencil'></i></a> 
            <a href='javascript:void(0);' onclick='delete_bahan_baku(".$bahan->id.");' class='btn btn-sm btn-warning'><i class='fa fa-trash'></i></a>
            <a href='javascript:void(0);' onclick='add_stok(".$bahan->id.");' class='btn btn-sm btn-warning'><i class='fa fa-plus'></i> Tambah Stok</a>
            <a href='javascript:void(0);' onclick='reduce_stok(".$bahan->id.");' class='btn btn-sm btn-warning'><i class='fa fa-minus'></i> Tambah Pengeluaran</a>
            ";
        })
        ->rawColumns(['action'])->make(true);
    }

    public function show_single_data($id)
    {
        $data = BahanBaku::findOrFail($id);
        $data->satuan->nama;

        return $data;
    }

    public function detail($id)
    {
        $data = BahanBaku::findOrFail($id);

        return view('admin.bahan_baku.detail', [
            'id' => $data
        ]);
    }

    public function add()
    {
        return view('admin.bahan_baku.add');
    }

    public function save(Request $request)
    {
        $data = new BahanBaku;
        $data->nama = $request->nama;
        $data->stok = $request->stok;
        $data->satuan_id = $request->satuan_id;

        if($data->save())
        {
            $request->session()->flash('alert-success', 'Berhasil menambahkan bahan baku ' . $data->nama);
            return redirect()->route('admin.bahan_baku.index');
        }
    }

    public function edit($id)
    {
        $data = BahanBaku::findOrFail($id);

        return view('admin.bahan_baku.edit', [
            'data' => $data
        ]);

    }

    public function update(Request $request)
    {
        // return $request->all();
        $id = $request->id;
        
        $data = BahanBaku::findOrFail($id);
        $data->nama = $request->nama;
        // $data->stok = $request->stok;
        $data->satuan_id = $request->satuan_id;

        if($data->save())
        {
            $request->session()->flash('alert-success', 'Berhasil menambahkan bahan baku ' . $data->nama);
            return redirect()->route('admin.bahan_baku.index');
        }
    }

    public function add_stock(Request $request)
    {
        $bahan = BahanBaku::findOrFail($request->bahan_baku_id);

        $bahan->stok = $bahan->stok + $request->stok_baru;
        if($bahan->save())
        {
            $masuk = new BahanBakuMasuk;
            $masuk->bahan_baku_id = $request->bahan_baku_id;
            $masuk->stok_masuk = $request->stok_baru;
            $masuk->pengeluaran = $request->harga;

            if($masuk->save())
            {
                $data = [
                    'status' => 'success',
                    'message' => 'Berhasil melakukan penambahan stok barang'
                ];
    
                return response()->json($data);
            }
        }
    }

    public function reduce_stock(Request $request)
    {
        $bahan = BahanBaku::findOrFail($request->bahan_baku_id);

        if($request->stok_baru > $bahan->stok)
        {
            $data = [
                'status' => 'error',
                'message' => 'Stok pengurang tidak bisa lebih besar dari Stok yang tersedia'
            ];

            return response()->json($data);
        }

        $bahan->stok = $bahan->stok - $request->stok_baru;

        if($bahan->save())
        {

            
            $keluar = new BahanBakuKeluar;
            $keluar->bahan_baku_id = $request->bahan_baku_id;
            $keluar->qty = $request->stok_baru;
            $keluar->tranksaksi = $request->alasan;
            if($keluar->save())
            {
                $data = [
                    'status' => 'success',
                    'message' => 'Berhasil mengurangi stok'
                ];
    
                return response()->json($data);

            }
        }
    }

    public function delete($id)
    {
        $data = BahanBaku::findOrFail($id);

        if($data->delete())
        {
            $data = [
                'status' => 'success',
                'message' => 'Berhasil menghapus bahan baku'
            ];

            return response()->json($data);
        }
    }
}
