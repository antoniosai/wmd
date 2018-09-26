<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Role;

use DataTables;
use File;

use App\User;

class KepegawaianController extends Controller
{
    public function index()
    {
        $data = NULL;

        return view('admin.kepegawaian.index', [
            'data' => $data
        ]);
    }

    public function data()
    {
        // $query = User::query();
        // $query = User::select(['*'])->get();
        // $query = User::select(['*']);
        $query = User::whereHas('roles', function ($qry) {
            // $qry->where('id', '!=', Auth::user()->id);
        });

        return DataTables::eloquent($query)
        ->editColumn('roles', function(User $user){
            return $user->roles->first()->name;
        })
        ->editColumn('foto', function(User $user){
            if($user->foto)
            {
                return "<img src='". asset($user->foto) ."' style='width: 100%' class='img img-responsive'/>";
            }
            else
            {
                return "<img src='/images/user/unavailable.png' style='width: 100%' class='img img-responsive'/>";
            }
        })
        ->addColumn('ttl', function(User $user){
            return $user->tempat_lahir . ', ' . \IndoTgl::tglIndo($user->tanggal_lahir);
        })
        ->addColumn('action', function(User $user){
            return "
            <a href='/auth/kepegawaian/edit/".$user->id."' class='btn btn-sm btn-warning'><i class='fa fa-pencil'></i></a> 
            <a href='javascript:void(0);' onclick='delete_bahan_baku(".$user->id.");' class='btn btn-sm btn-warning'><i class='fa fa-trash'></i></a>
            ";
        })
        ->rawColumns(['action', 'foto', 'roles'])->make(true);
    }

    public function add()
    {
        return view('admin.kepegawaian.add');
    }

    public function save(Request $request)
    {
        
        if($request->password != $request->c_password)
        {
            $request->session()->flash('alert-danger', 'Password konfirmasi tidak sama');
            return redirect()->back();
        }
        // return  $request->all();
        $role = Role::findOrFail($request->role_id);

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->name;
        $user->email = $request->email;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->kelamin = $request->kelamin;
        $user->alamat = $request->alamat;
        $user->password = bcrypt($request->password);

        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $destinationPath = 'images/user';
            $filename = rand(000,999).'-'.$file->getClientOriginalName();
            $user->foto = $destinationPath.'/'.$filename;

            $file->move($destinationPath, $filename);
        }

        if($user->save())
        {
            $user->assignRole($role);
            $request->session()->flash('alert-success', 'Berhasil menambahkan user '.$user->nama);
            return redirect()->route('admin.kepegawaian.index');

        }

    }

    public function edit($id)
    {
        $data = User::findOrFail($id);

        return view('admin.kepegawaian.edit', [
            'data' => $data
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $data = User::findOrFail($id);
        $data->name = $request->name;
        $data->username = $request->name;
        $data->email = $request->name;
        $data->password = bcrypt($request->password);
        
        if($data->save())
        {
            $request->session()->flash('alert-success', 'Berhasil mengupdate data ' . $user->name);
            return redirect()->route('admin.kepegawaian.index');
        }
    }

    public function delete_image($id)
    {
        $data = User::findOrFail($id);

        File::delete($data->foto);

        $data->foto = null;

        if($data->save())
        {
            return redirect()->back()->with('successMessage', 'Berhasil menghapus Gambar User ' . $data->name);
        }

    }

    public function delete($id)
    {
        $data = User::findOrFail($id);
        
        if($data->delete())
        {
            $data = [
                'status' => 'success',
                'message' => 'Berhasil menghapus User / Pegawai'
            ];

            return response()->json($data);
        }
    }
}
