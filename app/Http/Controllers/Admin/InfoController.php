<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Info\Restaurant;

class InfoController extends Controller
{
    public function index()
    {
        $data = Restaurant::first();

        return view('admin.info.index', [
            'data' => $data
        ]);
    }

    public function save(Request $request)
    {
        $data = Restaurant::first();
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->email = $request->email;
        $data->tentang = $request->tentang;

        if($data->save())
        {
            $request->session()->flash('alert-success', 'Berhasil mengupdate informasi Restaurant');
            return redirect()->route('admin.dashboard');
        }
    }
}
