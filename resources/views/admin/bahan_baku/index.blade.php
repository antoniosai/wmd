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