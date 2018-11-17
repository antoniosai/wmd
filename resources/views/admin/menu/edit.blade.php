@extends('admin.layouts.app')

@section('title')
Edit Menu {{ $menu->nama }}
@endsection



@section('content')
<h3>Edit Menu {{ $menu->nama }}</h3>
<hr>
<div class="row">
    
    <div class="col-md-12">
        <div class="card-box">
            <ul class="nav nav-tabs nav-tabs-bottom">
                <li class="nav-item"><a class="nav-link active show" href="#bottom-tab1" data-toggle="tab">Data Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Penggunaan Bahan Baku</a></li>
                <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Standar Operasional Produk (SOP)</a></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane active show" id="bottom-tab1">
                    <form action="{{ route('admin.menu.update') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $menu->id }}">
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
                    
                </div>
                <div class="tab-pane" id="bottom-tab2">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="input-group">
                                <input type="text" name="search" id="search" placeholder="Cari Bahan Baku Yang Akan Digunakan, Contoh : Ayam, Bawang dll." class="form-control">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary" id="submit" onclick="submit()">
                                        <i class="fa fa-plus"></i>
                                        Cari
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div id="suggest"></div>
                            <hr>
                        </div>
                        
                        <div class="col-sm-6 col-xs-12">
                            <div id="bahan"></div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane" id="bottom-tab3">
                    <div class="row">
                        <div class="col-sm-8 col-xs-12">
                            <form action="" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <textarea name="pos" id="pos" cols="30" rows="20">{{ old('pos') }}</textarea>
                                </div>
                            </form>
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

                </div>
            </div>
        </div>
    </div>

    
</div>
@endsection

@section('js')
<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace( 'pos' );
</script>

<script>
$('#search').keydown(function(event) {
    // enter has keyCode = 13, change it if you want to use another button
    if (event.keyCode == 13) {
        submit();
        return false;
    }
});

function submit()
{
    var src = $("#search").val();

    if(src.length == 0){
        $('#suggest').empty();
    } else {

        $.ajax({
            type: "GET",
            url: "/api/bahan_baku/search/"+src,
            data: {
                "src": src,
            },
            cache: true,
            success: function (data) {
                $('#suggest').empty();
                $('#suggest').html(data);
            }

        });
    }
}

function suggest(src) {
    if (src.length >= 4) {
        var loading = '<p align="center">Loading ...</p>';

        $('#suggest').html(loading);

        $.ajax({
            type: "GET",
            url: "/api/bahan_baku/search/"+src,
            data: {
                "src": src,
            },
            cache: true,
            success: function (data) {
                $('#suggest').empty();
                $('#suggest').html(data);
            }

        });

    } else if(src.length == 0){
        $('#suggest').empty();
    }
    return false;
}

//Fungsi untuk memilih kota dan memasukkannya pada input text
function get_bahan_baku(menu_id)
{
    axios.get('/auth/menu/get_bahan_baku/'+menu_id)
  .then(function (res) {
    // handle success
    $("#bahan").html(res.data);
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  })
}

get_bahan_baku({{ $menu->id }});

function tambah_bahan_baku(bahan_id)
{
    var qty =  $('#bahan_baku-'+bahan_id).val();

    if(qty <= 0)
    {
        toastr.error('Stok Yang Dibutuhkan Tidak Boleh Kosong');
    }
    else
    {
        axios.post('/auth/menu/add_bahan_baku', {
            qty: qty,
            bahan_id: bahan_id,
            menu_id: {{ $menu->id }}
        })
        .then(function (res) {
            console.log(res.data.status);

            if(res.data.status == 'existing')
            {
                toastr.warning('Bahan Baku sudah ada, silahkan Edit yang sudah ada');
            }
            else
            {
                toastr.success('Berhasil menambahkan bahan baku ke menu ');
            }
            get_bahan_baku({{ $menu->id }});
        })
        .catch(function (err) {
            console.log(err);
        });
    }
}

//menyembunyikan form
function hideStuff(id) {
    document.getElementById(id).style.display = 'none';
}
</script>
@endsection