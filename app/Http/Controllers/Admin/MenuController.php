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
        $query = Menu::select('menu.*')->with('kategori')->distinct();;

        return DataTables::eloquent($query)
        ->addColumn('tagname', function (Menu $menu) {
            return $menu->bahan_baku->pluck('name')->implode(', ');
        })
        ->addColumn('action', function(Menu $menu){
            return "
            <div class='dropdown'>
                <button class='btn btn-secondary btn-sm dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    Aksi
                </button>
                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                    <a href='/auth/menu/edit/".$menu->id."' class='dropdown-item'>Edit</a> 
                    <a href='javascript:void(0);' onclick='delete_menu(".$menu->id.");' class='dropdown-item'>Hapus</a>
                </div>
            </div>
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

    public function save(Request $request)
    {
        $menu = Menu::findOrFail($id);
        

        if($menu->save())
        {
            $data = [
                'status' => 'success',
                'message' => 'Berhasil menghapus Menu'
            ];

            return response()->json($data);
        }
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $menu = Menu::findOrFail($id);

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $menu->foto = $file->getClientOriginalName();

            $destinationPath = 'uploads/pdf';
            $file->move($destinationPath,$file->getClientOriginalName());
        }

        if($menu->save())
        {
            $data = [
                'status' => 'success',
                'message' => 'Berhasil menghapus Menu'
            ];

            return response()->json($data);
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
