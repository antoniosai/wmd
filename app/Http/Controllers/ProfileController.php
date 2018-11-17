<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index', [
            'data' => Auth::user()
        ]);
    }

    public function save(Request $request)
    {
        $user = Auth::user();

        if($request->password != NULL)
        {
            if($request->password != $request->password_confirmation)
            {
                $request->session()->flash('alert-danger', 'Konfirmasi password tidak sama');
                return redirect()->back();
            }
            else
            {
                $user->password = bcrypt($request->password);
            }
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->kelamin = $request->kelamin;
        $user->alamat = $request->alamat;

        if($user->save())
        {
            $request->session()->flash('alert-success', 'Berhasil mengupdate Profile Anda');
            return redirect()->back();
        }
    }
}
