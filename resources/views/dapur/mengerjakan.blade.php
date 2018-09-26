@extends('admin.layouts.app')

@section('title')
Manajemen Bahan Baku
@endsection

@section('content')

<div class="row">
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Order #{{ $data->no_nota }}
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 20%">Nama Menu</th>
                            <th style="width: 20%">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data->detail as $order)
                        <tr>
                            <td>{{ $order->menu->nama }}</td>
                            <td>{{ $order->qty }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                Pengunjung
            </div>
            <div class="card-body">
                
                <table class="table">
                    <tr>
                        <td>No Meja</td>
                        <td>:</td>
                        <td>{{ $data->no_nota }}</td>
                    </tr>
                    <tr>
                        <td>Pengunjung</td>
                        <td>:</td>
                        <td>{{ $data->nama_pengunjung }}</td>
                    </tr>

                    <tr>
                        <td>Nomor Meja</td>
                        <td>:</td>
                        <td>{{ $data->meja_id }}</td>
                    </tr>

                    <tr>
                        <td>Jam Order</td>
                        <td>:</td>
                        <td>{{ $data->created_at->format('d M Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="clearfix">
            <a href="/auth/dapur/selesai/{{ $data->id }}" class="btn btn-block btn-success"><i class="fa fa-check"></i> Selesai</a>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>

function call_datatables(status)
{
    var data_menu =  $('#data-order').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/auth/dapur/data/'+status,
        columns: [
            { data: 'id', name: 'id' },
            { data: 'tanggal', name: 'tanggal' },
        ]
    });
}

call_datatables('dimasak');

$('table').on('draw.dt', function() {
    $("#data-order").wrap("<div class='table-responsive'></div>");
});


function kerjakan(order_id)
{
    console.log(order_id);
    swal({
        title: "Anda akan mengerjakan Order dengan ID #"+order_id,
        text: "Menghapus bahan baku dapat mempengaruhi menu, laporan dll.",
        type: "info",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "Ya, Kerjakan!",
    },function() {
        $.ajax({
            url: "/auth/dapur/kerjakan/" + order_id,
            type: "GET"
        })
        .done(function(data) {
            console.log(data);
            window.location.replace('/auth/dapur/memasak/'+order_id);
            // swal("Berhasil!", data.message, "success");
            // data_menu.ajax.reload();
        })
    });
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