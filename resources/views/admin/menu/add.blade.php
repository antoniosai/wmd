@extends('admin.layouts.app')

@section('title')
Formulir Tambah Menu
@endsection

@section('content')
<h3>Formulir Tambah Menu</h3>
<hr>
<form action="{{ route('admin.menu.save') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-sm-8 col-xs-12">
            <div class="form-group">
                <label>Kategori Menu *)</label>
                <select name="kategori_id" class="form-control" required>
                    @foreach(App\Model\Menu\Kategori::all() as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Nama Menu *)</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>
    
            <div class="form-group">
                <label>Foto Menu</label>
                <input type="file" name="file" class="form-control">
            </div>
    
            <div class="form-group">
                <label for="harga">Harga Menu *)</label>
    
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="validationTooltipUsernamePrepend">Rp</span>
                    </div>
                    <input type="number" class="form-control" name="harga" value="{{ old('harga') }}" required>
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
            order_temp_id: qty,
            menu_id: bahan_id
        })
        .then(function (res) {
            // console.log(res);
            $("#order_list").html(res.data);
            console.log(res.data);
            toastr.success('Berhasil menghapus item');
        })
        .catch(function (err) {
            console.log(err);
        });
        alert('Bahan Baku ' + bahan_id + ' & qty : ' + qty);
    }
}

//menyembunyikan form
function hideStuff(id) {
    document.getElementById(id).style.display = 'none';
}
</script>
@endsection