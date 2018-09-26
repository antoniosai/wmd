@extends('admin.layouts.app')

@section('title')
Manajemen Menu
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-8 col-4">
                <h3>Manajemen Menu</h3>
            </div>
            <div class="col-sm-4 col-8 text-right m-b-30">
                <a href="{{ route('admin.menu.add') }}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-plus"></i> Tambah Menu Baru</a>
            </div>
        </div>
        <div class="card-box">
            <div class="card-block">
                <table class="table table-stripped" id="data-menu">
                    <thead>
                        <tr>
                            <th style="width: 12%">Gambar Menu</th>
                            <th style="width: 15%">Kategori</th>
                            <th style="width: 15%">Nama Menu</th>
                            <th style="width: 10%">Harga</th>
                            <th style="width: 13%">Penjualan Hari Ini</th>
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
    ajax: '{!! route('admin.menu.data') !!}',
    columns: [
        { data: 'foto', name: 'foto', orderable: false, searchable:false },
        { data: 'kategori.nama', name: 'kategori.nama', orderable: false, searchable:false },
        { data: 'nama', name: 'nama' },
        { data: 'harga', name: 'harga' },
        { data: 'harga', name: 'harga' },
        { data: 'action', name: 'action', orderable: false, searchable:false }
    ]
});

$('table').on('draw.dt', function() {
    $("#data-menu").wrap("<div class='table-responsive'></div>");
});
var table = "";
$(function() {
   
});

//Fungsi Delete Menu
function delete_menu(id) {
    console.log(id);
    swal({
        title: "Apakah Anda yakin?",
        text: "Apakah Anda yakin ingin menghapus keluarga ini?",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "Ya, hapus!",
        confirmButtonColor: "#ec6c62"
    },function() {
        $.ajax({
            url: "menu/delete/" + id,
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