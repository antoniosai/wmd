<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DataTables;

use App\Model\Menu\BahanBaku;

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
            ";
        })
        ->rawColumns(['action'])->make(true);
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
