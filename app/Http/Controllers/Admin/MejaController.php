<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Meja\Meja;

class MejaController extends Controller
{
    public function index()
    {
        $data = [];

        return view('admin.meja.index', $data);
    }

    public function data()
    {
        $query = Meja::query();
        $data = DataTables::eloquent($query)->make('true');

        return $data;
    }

    public function add()
    {
        return view('admin.meja.add');
    }

    public function save(Request $request)
    {
        $meja = new Meja;
        $meja->no_meja = $request->no_meja;
        $meja->kapasitas = $request->kapasitas;

        if($meja->save())
        {
            $request->session()->flash('alert-success', 'Berhasil menambahkan Meja baru');
            return redirect()->route('admin.meja.index');
        }
    }

    public function edit($id)
    {
        $data = [
            'meja' => Meja::findOrFail($id)
        ];

        return view('admin.meja.edit', $data);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $meja = Meja::findOrFail($id);
        $meja->no_meja = $request->no_meja;
        $meja->kapasitas = $request->kapasitas;

        if($meja->save())
        {
            $request->session()->flash('alert-success', 'Berhasil mengupdate Meja ' . $meja->no_meja);
            return redirect()->route('admin.meja.index');
        }
    }

    public function delete($id)
    {
        $meja = Meja::findOrFail($id);

        if($meja->delete())
        {
            $data = [
                'status' => 'success',
                'message' => 'Berhasil menghapus meja'
            ];

            return response()->json($data);
            // $request->session();
            // return redirect()->route('admin.meja.index')->with('successMessage', 'Berhasil menghapus Meja ' . $meja->no_meja);
        }

    }

    public function detail($id)
    {
        $data = [
            'meja' => Meja::findOrFail($id)
        ];

        return view('admin.meja.detail', $data);
    }
}
