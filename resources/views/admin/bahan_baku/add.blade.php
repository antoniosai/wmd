@extends('admin.layouts.app')

@section('title')
Formulir Tambah Bahan
@endsection

@section('content')
<h3>Formulir Tambah Bahan</h3>
<hr>
<form action="{{ route('admin.bahan_baku.save') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-sm-8 col-xs-12">
            
            <div class="form-group">
                <label>Nama Bahan *)</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>

            <div class="form-group">
                <label>Stok Awal</label>
                <input type="number" name="stok" class="form-control" value="{{ old('stok') }}" required>
            </div>

            <div class="form-group">
                <label>Satuan *)</label>
                <select name="satuan_id" class="form-control" required>
                    @foreach(App\Model\Menu\Satuan::all() as $satuan)
                    <option value="{{ $satuan->id }}">{{ $satuan->nama }}</option>
                    @endforeach
                </select>
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
            <a href="{{ route('admin.bahan_baku.index') }}" class="btn btn-block btn-info"><i class="fa fa-arrow-left"></i> Kembali ke Manajemen Bahan</a>
        </div>
    </div>
</form>
@endsection

@section('js')
@endsection