@extends('admin.layouts.app')

@section('title')
Informasi Perusahaan
@endsection

@section('content')
<h3>Informasi Perusahaan</h3>
<hr>
<form action="{{ route('admin.info.save') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-sm-8 col-xs-12">
            <div class="form-group">
                <label>Nama Perusahaan *)</label>
                <input type="text" class="form-control" name="nama" value="{{ $data->nama }}">
            </div>
            <div class="form-group">
                <label>Email Perusahaan *)</label>
                <input type="email" name="email" class="form-control" value="{{ $data->email }}" required>
            </div>

            <div class="form-group">
                <label>Alamat *)</label>
                <textarea name="alamat" id="alamat" cols="30" rows="4" class="form-control">{{ $data->alamat }}</textarea>
            </div>

            <div class="form-group">
                <label>Tentang</label>
                <textarea name="tentang" id="tentang" cols="30" rows="4" class="form-control">{{ $data->tentang }}</textarea>
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