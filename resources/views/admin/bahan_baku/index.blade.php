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
                            <th style="width: 15%">Nama Bahan</th>
                            <th style="width: 10%">Stok</th>
                            <th style="width: 13%">Satuan</th>
                            <th style="width: 8%">Aksi</th>
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
                                <input type="number" class="form-control" name="stok_baru" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="harga">Pengeluaran *)</label>
                
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
                            <button class="btn btn-block" onclick="adding_stock()">Selesai Tambah Stok</button>
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
        $('#old_stok').val(data.stok);
        $('#nama_bahan_baku').val(data.nama);
        console.log(data.id);
        $('#modal_add_stock').modal('show');
    })
}

//Fungsi Delete Bahan Baku
function delete_menu(id) {
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