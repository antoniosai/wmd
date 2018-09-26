<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DataTables;
use File;
use App\Model\Menu\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $data = null;

        return view('admin.menu.index', [
            'data' => $data
        ]);

    }

    public function data()
    {
        $query = Menu::select('menu.*')->with('kategori')->distinct();

        return DataTables::eloquent($query)
        ->addColumn('action', function(Menu $menu){
            return "
            <a href='/auth/menu/edit/".$menu->id."' class='btn btn-sm btn-warning'><i class='fa fa-pencil'></i></a> 
            <a href='javascript:void(0);' onclick='delete_menu(".$menu->id.");' class='btn btn-sm btn-warning'><i class='fa fa-trash'></i></a>
            ";
        })
        ->editColumn('foto', function(Menu $menu){
            if($menu->foto)
            {
                return "<img src='". asset($menu->foto) ."' style='width: 100%' class='img img-responsive'/>";
            }
            else
            {
                return "<img src='/images/menu/unavailable.jpg' style='width: 100%' class='img img-responsive'/>";
            }
        })
        ->editColumn('harga', function(Menu $menu){
            return 'Rp ' . number_format($menu->harga);
        })
        ->editColumn('content', function(Menu $menu){
            return strlen(strip_tags($menu->deskripsi)) > 100 ?substr(strip_tags($menu->deskripsi),0,100)."...":strip_tags($menu->deskripsi);
        })
        ->rawColumns(['action', 'foto'])->make(true);
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);

        return view('admin.menu.edit', [
            'menu' => $menu
        ]);
    }

    public function add()
    {
        return view('admin.menu.add');
    }

    public function save(Request $request)
    {
        $menu = new Menu;
        $menu->kategori_id = $request->kategori_id;
        $menu->nama = $request->nama;
        $menu->harga = $request->harga;

        if ($request->hasFile('file')) {

            File::delete($menu->foto);

            $file = $request->file('file');

            $destinationPath = 'images/menu';
            $filename = rand(000,999).'-'.$file->getClientOriginalName();
            $menu->foto = $destinationPath.'/'.$filename;

            $file->move($destinationPath, $filename);
        }

        if($menu->save())
        {
            $request->session()->flash('alert-success', 'Berhasil mengupdate Menu '.$menu->nama);
            return redirect()->route('admin.menu.index');

        }
    }

    public function update(Request $request)
    {
        // return $request->all();
        $id = $request->id;

        $menu = Menu::findOrFail($id);

        if ($request->hasFile('file')) {

            File::delete($menu->foto);

            $file = $request->file('file');

            $destinationPath = 'images/menu';
            $filename = $id.'-'.$file->getClientOriginalName();
            $menu->foto = $destinationPath.'/'.$filename;

            $file->move($destinationPath, $filename);
        }

        if($menu->save())
        {
            $request->session()->flash('alert-success', 'Berhasil mengupdate Menu '.$menu->nama);
            return redirect()->route('admin.menu.index');

        }
    }

    public function delete_image($id)
    {
        $menu = Menu::findOrFail($id);

        File::delete($menu->foto);

        $menu->foto = null;

        if($menu->save())
        {
            return redirect()->back()->with('successMessage', 'Berhasil menghapus Gambar Menu ' . $menu->nama);
        }

    }

    public function delete($id)
    {
        $menu = Menu::findOrFail($id);

        if($menu->delete())
        {
            $data = [
                'status' => 'success',
                'message' => 'Berhasil menghapus Menu'
            ];

            return response()->json($data);
        }

    }
}
