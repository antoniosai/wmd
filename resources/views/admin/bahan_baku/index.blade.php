@extends('admin.layouts.app')

@section('title')
Manajemen Bahan Baku
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-8 col-4">
                <h3>Manajemen Bahan Baku</h3>
            </div>
            <div class="col-sm-4 col-8 text-right m-b-30">
                <a href="{{ route('admin.bahan_baku.add') }}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-plus"></i> Tambah Bahan Baku Baru</a>
            </div>
        </div>
        <div class="card-box">
            <div class="card-block">
                <table class="table table-stripped" id="data-menu">
                    <thead>
                        <tr>
                            <th>Nama Bahan</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Stok -->
<!-- Modal -->
<div id="modal_add_stock" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="judul_bahan_baku"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form_add_stok">
                    {{ csrf_field() }}
                    <input type="hidden" name="bahan_baku_id" id="bahan_baku_id">
                    <div class="form-group">
                        <label for="nama" id="nama"></label>
                        <input type="text" class="form-control" name="nama" disabled id="nama_bahan_baku">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Stok Awal</label>
                                <input type="number" class="form-control" id="old_stok" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Penambahan Stok *)</label>
                
                                <div class="input-group">
                                    <input type="number" class="form-control" name="stok_baru" id="new_stock" required>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text satuan_bahan" id="validationTooltipUsernamePrepend"></span>
                                    </div>
                                    <div class="invalid-tooltip">
                                        Please choose a unique and valid username.
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="harga">Pengeluaran *)</label>
                
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="validationTooltipUsernamePrepend">Rp</span>
                                    </div>
                                    <input type="number" class="form-control" name="harga" id="harga" value="{{ old('harga') }}" required>
                                    <div class="invalid-tooltip">
                                        Please choose a unique and valid username.
                                    </div>
                                </div>
                                
                            </div>
                            <button class="btn btn-block">Selesai Tambah Stok</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<!-- End of Modal -->

<!-- Modal -->
<div id="modal_reduce_stock" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="judul_bahan_baku-reduce"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form_reduce_stok">
                    {{ csrf_field() }}
                    <input type="hidden" name="bahan_baku_id" id="bahan_baku_id-reduce">
                    <div class="form-group">
                        <label for="nama" id="nama"></label>
                        <input type="text" class="form-control" name="nama" disabled id="nama_bahan_baku-reduce">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Stok Awal</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="old_stok-reduce" disabled>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text satuan_bahan" id="validationTooltipUsernamePrepend"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Pengurangan Stok *)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="stok_baru" id="stok_baru-reduce" required>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text satuan_bahan" id="validationTooltipUsernamePrepend"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="alasan" id="alasan" cols="30" rows="4" class="form-control" placeholder="Masukan Alasan Pengurangan Barang"></textarea>
                                
                            </div>
                            <button class="btn btn-block">Selesai Mengurangi Stok</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<!-- End of Modal -->
@endsection

@section('js')
<script>

var data_menu =  $('#data-menu').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{!! route('admin.bahan_baku.data') !!}',
    columns: [
        { data: 'nama', name: 'nama' },
        { data: 'stok', name: 'stok' },
        { data: 'satuan.nama', name: 'satuan.nama' },
        { data: 'action', name: 'action', orderable: false, searchable:false }
    ]
});

$('table').on('draw.dt', function() {
    $("#data-menu").wrap("<div class='table-responsive'></div>");
});
var table = "";
$(function() {
   
});

function add_stok(menu_id)
{
    axios.get('bahan_baku/show_single_data/'+menu_id)
    .then(function (response) {
        // handle success
        var data = response.data;
        var title = 'Penambahan Stok ';

        $('#nama').html('Nama Bahan Baku');
        $('#judul_bahan_baku').html(title+data.nama);
        $('#bahan_baku_id').val(data.id);
        $('.satuan_bahan').text(data.satuan.nama)
        $('#old_stok').val(data.stok);
        $('#nama_bahan_baku').val(data.nama);
        console.log(data.id);
        $('#modal_add_stock').modal('show');
    })
}


function reduce_stok(menu_id)
{
    axios.get('bahan_baku/show_single_data/'+menu_id)
    .then(function (response) {
        // handle success
        var data = response.data;
        var title = 'Pengurangan Stok ';

        $('#nama-reduce').html('Nama Bahan Baku');
        $('#judul_bahan_baku-reduce').html(title+data.nama);
        $('#bahan_baku_id-reduce').val(data.id);
        $('#old_stok-reduce').val(data.stok);
        $('.satuan_bahan').text(data.satuan.nama);
        $('#nama_bahan_baku-reduce').val(data.nama);
        console.log(data.id);
        $('#modal_reduce_stock').modal('show');
    })
}

$("#form_add_stok").on('submit', function(event){
    event.preventDefault();
    
    axios({
        method: 'post',
        url: '/auth/bahan_baku/add_stock',
        data: $( this ).serialize()
    })
    .then(function (response) {
        console.log(response.data);
        if (response.data.status == 'success')
        {
            $('#new_stock').val('');
            $('#harga').val('');
            $('#modal_add_stock').modal('hide');

            toastr.success(response.data.message)
            data_menu.ajax.reload();
        }
    })
    .catch(function(err){
        console.log(err)
    });

});

$( "#form_reduce_stok" ).on( "submit", function( event ) {
  event.preventDefault();
  console.log( $( this ).serialize() );

    axios({
        method: 'post',
        url: '/auth/bahan_baku/reduce_stock',
        data: $( this ).serialize()
    })
    .then(function (response) {
        console.log(response.data);
        if(response.data.status == 'error')
        {
            toastr.warning(response.data.message)
            data_menu.ajax.reload();

            $('#modal_reduce_stock').modal('hide');

        }
        else if (response.data.status == 'success')
        {
            $('#bahan_baku_id-reduce').val('');
            $('#stok_baru-reduce').val('');
            $('#alasan').val('');
            $('#modal_reduce_stock').modal('hide');

            toastr.success(response.data.message)
            data_menu.ajax.reload();
        }
    })
    .catch(function(err){
        console.log(err)
    });
});



//Fungsi Delete Bahan Baku
function delete_bahan_baku(id) {
    console.log(id);
    swal({
        title: "Apakah Anda yakin?",
        text: "Menghapus bahan baku dapat mempengaruhi menu, laporan dll.",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "Ya, hapus!",
        confirmButtonColor: "#ec6c62"
    },function() {
        $.ajax({
            url: "bahan_baku/delete/" + id,
            type: "GET"
        })
        .done(function(data) {
            swal("Berhasil!", data.message, "success");
            data_menu.ajax.reload();
        })
    });
}
</script>
@endsection