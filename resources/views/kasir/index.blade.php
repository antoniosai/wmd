@extends('admin.layouts.app')

@section('title')
Manajemen Bahan Baku
@endsection

@section('content')

<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget dash-widget4">
            <span class="dash-widget-icon bg-success"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
            <div class="dash-widget-info">
                <div class="clearfix">
                    <h4>Buat Penjualan Baru</h4>
                    <a href="{{ route('kasir.create_pos') }}" class="btn btn-primary">Klik Disini</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget dash-widget4">
            <span class="dash-widget-icon bg-info"><i class="fa fa-tasks" aria-hidden="true"></i></span>
            <div class="dash-widget-info">
                <h3>{{ $total_order }}</h3>
                <span>Order Hari Ini</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget dash-widget4">
            <span class="dash-widget-icon bg-success"><i class="fa fa-money" aria-hidden="true"></i></span>
            <div class="dash-widget-info">
                <h3>Rp {{ number_format($pendapatan_hari_ini) }}</h3>
                <span>Pendapatan</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Daftar Order Hari Ini {{ date('d M Y') }}
            </div>
            <div class="card-body">
                <table class="table table-hover table-striped" id="data-order">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>No Order</th>
                            <th>a/n Pengunjung</th>
                            <th>Meja</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th style="width: 5%"></th>
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

var data_menu =  $('#data-order').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{!! route('kasir.data') !!}',
    columns: [
        { data: 'tanggal', name: 'tanggal', orderable: false, searchable:false  },
        { data: 'no_nota', name: 'no_nota', orderable: false, searchable:false  },
        { data: 'nama_pengunjung', name: 'nama_pengunjung', orderable: false, searchable:false  },
        { data: 'meja', name: 'meja', orderable: false, searchable:false  },
        { data: 'total', name: 'total', orderable: false, searchable:false  },
        { data: 'status', name: 'status', orderable: false, searchable:false },
        { data: 'action', name: 'action', orderable: false, searchable:false  },
    ]
});

$('table').on('draw.dt', function() {
    $("#data-order").wrap("<div class='table-responsive'></div>");
});
var table = "";
$(function() {
   
});

function ready_to_pay(order_id)
{
    swal({
        title: "Menyelesaikan Order #"+order_id,
        text: "Dengan menekan tombol Selesai, Maka data pada Order ID#"+order_id + " akan masuk ke Report/Laporan dan tidak bisa diulang kembali",
        type: "info",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "Selesai",
    },function() {
        $.ajax({
            url: "/auth/kasir/ready_to_pay/" + order_id,
            type: "GET"
        })
        .done(function(data) {
            console.log(data.data);
            data_menu.ajax.reload();
            swal("Berhasil!", "Menyelesaikan Order ID #" +order_id, "success");
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