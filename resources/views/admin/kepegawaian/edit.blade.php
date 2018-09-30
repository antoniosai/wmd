@extends('admin.layouts.app')

@section('title')
Formulir Edit User {{ $data->name }}
@endsection

@section('content')
<h3>Formulir Edit User {{ $data->name }}</h3>
<hr>
<form action="{{ route('admin.kepegawaian.save') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-sm-8 col-xs-12">
            <div class="alert alert-primary">
                <div class="form-group">
                    <label>Username *)</label>
                    <input type="text" class="form-control" name="username" value="{{ $data->username }}">
                </div>
                <div class="form-group">
                    <label>Email *)</label>
                    <input type="email" class="form-control" name="email" value="{{ $data->email }}">
                </div>

                <div class="form-group">
                    <label>Pilih Role *)</label>
                    <select name="role_id" class="form-control" required>
                        @foreach(Spatie\Permission\Models\Role::all() as $role)
                        <option value="{{ $role->id }}" @if($data->roles->first()->id == $role->id) selected @endif >{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </div>
                
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Kosongkan Password jika tidak ingin diganti</strong></p>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Password *)</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Konfirmasi Password *)</label>
                            <input type="password" class="form-control" name="c_password">
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="form-group">
                <label>Nama *)</label>
                <input type="text" name="name" class="form-control" value="{{ $data->name }}" required>
            </div>

            <div class="form-group">
                <label>Foto</label><br/>
                @if($data->foto)
                <div class="row">
                    <div class="col-md-12">
                        <center>
                            <img src="{{ asset($data->foto) }}" class="img img-responsive" style="max-height: 200px">
                            <br><br>
                            <a href="{{ route('admin.kepegawaian.delete_image', $data->id) }}" class="btn btn-xs btn-danger">Hapus Gambar</a>
                        </center>
                    </div>
                </div>
                <br>
                @endif
                <input type="file" name="file" class="form-control">
            </div>

            <div class="form-group">
                <label>Kelamin</label>
                <select name="kelamin" class="form-control">
                    <option value="L" @if($data->kelamin == 'L') selected @endif>Laki-laki</option>
                    <option value="P"@if($data->kelamin == 'P') selected @endif>Perempuan</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="{{ $data->tempat_lahir }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ $data->tanggal_lahir }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" id="alamat" cols="30" rows="4" class="form-control">{{ $data->alamat }}</textarea>
            </div>
            
        </div>
        
        <div class="col-sm-4 col-xs-12">
            <div class="alert alert-warning">
                <h3><i class="fa fa-exclamation-triangle"></i> Keterangan</h3>
                <ul>
                    <li>Form isian dengan tanda *) adalah wajib diisi</li>
                    <li>Mohon isi data dengan bijak</li>
                    <li>Jika sudah klik tombol Simpan di bawah ini</li>
                </ul>
            </div>

            <button type="submit" class="btn btn-block btn-success"><i class="fa fa-check"></i> Simpan</button>
            <a href="{{ route('admin.menu.index') }}" class="btn btn-block btn-info"><i class="fa fa-arrow-left"></i> Kembali ke Manajemen Menu</a>
        </div>
    </div>
</form>
@endsection

@section('js')
@endsection