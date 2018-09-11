@extends('admin.layouts.app')

@section('title')
Edit Menu {{ $menu->nama }}
@endsection

@section('content')
<h3>Edit Menu {{ $menu->nama }}</h3>
<hr>
<form action="{{ route('admin.menu.update') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-sm-8 col-xs-12">
            <div class="form-group">
                <label>Kategori Menu *)</label>
                <select name="kategori_id" class="form-control" required>
                    @foreach(App\Model\Menu\Kategori::all() as $kategori)
                    <option value="{{ $kategori->id }}" @if($kategori->id == $menu->kategori_id) selected @endif>{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Nama Menu *)</label>
                <input type="text" name="nama" class="form-control" value="{{ $menu->nama }}" required>
            </div>

            <div class="form-group">
                <label>Foto Menu</label><br/>
                @if($menu->foto)
                <div class="row">
                    <div class="col-md-12">
                        <center>
                            <img src="{{ asset($menu->foto) }}" class="img img-responsive" style="max-height: 200px">
                            <br><br>
                            <a href="{{ route('admin.menu.delete_image', $menu->id) }}" class="btn btn-xs btn-danger">Hapus Gambar</a>
                        </center>
                    </div>
                </div>
                <br>
                @endif
                <input type="file" name="file" class="form-control">
            </div>

            <div class="form-group">
                <label for="harga">Harga Menu *)</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="validationTooltipUsernamePrepend">Rp</span>
                    </div>
                    <input type="number" class="form-control" name="harga" value="{{ $menu->harga }}" required>
                    <div class="invalid-tooltip">
                        Please choose a unique and valid username.
                    </div>
                </div>
                
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