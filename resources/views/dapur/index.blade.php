@extends('admin.layouts.app')

@section('title')
Manajemen Bahan Baku
@endsection

@section('content')

<div class="row">
    {{-- <div class="col-md-12">
        <button class="btn btn-block btn-primary" onclick="play_audio()">Play Audio</button>
    </div> --}}
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Daftar Tranksaksi Hari Ini ({{ date('d M Y') }})
            </div>
            <div class="card-body">
                <div class="clearfix">
                    <div class="pull-right">
                        Status
                        <div class="btn-group">
                            <button class="btn btn-sm" onclick="call_datatables('diajukan')">Diajukan</button>
                            <button class="btn btn-sm" onclick="call_datatables('dimasak')">Sedang Dimasak</button>
                            <button class="btn btn-sm" onclick="call_datatables('selesai')">Selesai</button>
                        </div>
                    </div>
                </div>
                <br>
                <table class="table table-hover" id="data-order">
                    <thead>
                        <tr>
                            <th style="width: 10%">#ID</th>
                            <th style="width: 20%">Waktu Order</th>
                            <th style="width: 20%">No Order</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
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
        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
            <div class="dash-widget dash-widget4">
                <span class="dash-widget-icon bg-info"><i class="fa fa-tasks" aria-hidden="true"></i></span>
                <div class="dash-widget-info">
                    <h3>{{ 4 }}</h3>
                    <span>Order</span>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
            <div class="dash-widget dash-widget4">
                <span class="dash-widget-icon bg-success"><i class="fa fa-money" aria-hidden="true"></i></span>
                <div class="dash-widget-info">
                    <h3>Rp {{ number_format(256000) }}</h3>
                    <span>Pendapatan</span>
                </div>
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
    ajax: '/auth/dapur/data/diajukan',
    columns: [
        { data: 'id', name: 'id' },
        { data: 'tanggal', name: 'tanggal' },
        { data: 'no_nota', name: 'no_nota' },
        { data: 'status', name: 'status', orderable: true, searchable:true },
        { data: 'action', name: 'action' },
    ]
});


$('table').on('draw.dt', function() {
    $("#data-order").wrap("<div class='table-responsive'></div>");
});



function check_notif()
{
    axios.get('/auth/dapur/check_notif')
    .then(function (response) {
        // handle success

        if(response.data > 0)
        {
            play_audio();
            
            data_menu.ajax.reload();
        }
    })
}

setInterval(function(){
 
    check_notif();;
 
}, 5000);
 

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