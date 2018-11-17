@extends('admin.layouts.app')

@section('title')
Manajemen Kepegawaian
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-8 col-4">
                <h3>Manajemen Kepegawaian</h3>
            </div>
            <div class="col-sm-4 col-8 text-right m-b-30">
                <a href="{{ route('admin.kepegawaian.add') }}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-plus"></i> Tambah Baru</a>
            </div>
        </div>
        <div class="card-box">
            <div class="card-block">
                <table class="table table-stripped" id="data-menu">
                    <thead>
                        <tr>
                            <th style="width: 7%">Foto</th>
                            <th style="width: 15%">Nama Lengkap</th>
                            <th style="width: 15%">TTL</th>
                            <th style="width: 10%">Role</th>
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
    ajax: '{!! route('admin.kepegawaian.data') !!}',
    columns: [
        { data: 'foto', name: 'foto', orderable: false, searchable:false },
        { data: 'name', name: 'name' },
        { data: 'ttl', name: 'ttl' },
        { data: 'roles', name: 'roles', orderable: false, searchable:false },
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
        text: "Apakah Anda yakin ingin menghapus User ini?",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "Ya, hapus!",
        confirmButtonColor: "#ec6c62"
    },function() {
        $.ajax({
            url: "kepegawaian/delete/" + id,
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