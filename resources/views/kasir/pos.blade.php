@extends('admin.layouts.app')

@section('title')
Point of Sales
@endsection

@section('content')

<h2>Order #{{ $no_nota }}</h2>

<div class="input-group">
    <input type="text" name="search" id="search" placeholder="Ketikan nama makanan, minuman atau Paket" class="form-control">
    <span class="input-group-btn">
        <button type="submit" class="btn btn-primary" id="submit" onclick="submit()">
            <span class="glyphicon glyphicon-search"></span>
            Cari
        </button>
    </span>
</div>

<br>

<div class="row">
    <div class="col-md-6">
        <div id="suggest"></div>
    </div>
    <div class="col-md-6">
        
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Pesanan No Order #{{ $no_nota }}
            </div>
            <div class="card-body">
                <div id="order_list"></div>
            </div>
            <div class="card-footer">
                <input type="text" name="nama_pengunjung" id="nama_pengunjung" placeholder="Nama Pengunjung" class="form-control"><br/>
                <div class="input-group">
                    <select name="meja_id" id=meja_id class="form-control" required>
                        <option disabled selected>Silahkan Pilih Meja</option>
                        @foreach(App\Model\Meja\Meja::all() as $table)
                        <option value="{{ $table->id }}">{{ $table->no_meja }}</option>
                        @endforeach
                    </select>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-success" id="submit" onclick="finish_order()">
                            <span class="fa fa-check"></span>
                            Selesai
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
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
                url: "/api/menu/search/"+src,
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
                url: "/api/menu/search/"+src,
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


    //menyembunyikan form
    function hideStuff(id) {
        document.getElementById(id).style.display = 'none';
    }

    function show_menu()
    {
        axios.get('/api/menu/all_menu/'+5).then(function(response){
            console.log(response.data);
        });
    }

    function add_to_order(id) {
        var qty = $("#qty"+id).val();
        axios.get('/api/menu/detail/'+id).then(function(response){

            axios.post('/api/menu/add_menu', {
                qty: qty,
                id: id,
                no_nota : "{{ $no_nota }}"
            })
            .then(function (res) {
                // console.log(res);
                $("#order_list").html(res.data);
                console.log(res);
                toastr.success('Telah menambahkan ' + response.data.nama + ' sebanyak ' + qty, 'Berhasil');
            })
            .catch(function (err) {
                console.log(err);
            });

        });
    }

    function show_order_list(id)
    {
        axios.get('/api/menu/order_list/'+id).then(function(response){
            $("#order_list").html(response.data);
        });
    }

    show_order_list('{{ $no_nota }}');

    function add_item(order_temp_id, menu_id)
    {
        axios.post('/api/menu/add_item', {
            order_temp_id: order_temp_id,
            menu_id: menu_id
        })
        .then(function (res) {
            // console.log(res);
            $("#order_list").html(res.data);
            console.log(res);
            toastr.success('Telah menambahkan 1 item');
        })
        .catch(function (err) {
            console.log(err);
        });

    }

    function delete_item(order_temp_id, menu_id)
    {
        axios.post('/api/menu/delete_item', {
            order_temp_id: order_temp_id,
            menu_id: menu_id
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

    }

    function remove_item(order_temp_id, menu_id)
    {
        axios.post('/api/menu/remove_item', {
            order_temp_id: order_temp_id,
            menu_id: menu_id
        })
        .then(function (res) {
            // console.log(res);
            $("#order_list").html(res.data);
            console.log(res);
            toastr.success('Telah mengurangi 1 item');
        })
        .catch(function (err) {
            console.log(err);
        });
    }

    function finish_order()
    {
        var no_order = "{{ $no_nota }}";
        var meja_id = $("#meja_id").val();
        var nama_pengunjung = $("#nama_pengunjung").val();
        // console.log('Order No ' + no_order + ' Nomor Meja ' + meja_id + ' nama Pengunjung ' + nama_pengunjung);
        axios.post('/auth/kasir/finish_order', {
            nama_pengunjung: nama_pengunjung,
            no_order: no_order,
            meja_id: meja_id
        })
        .then(function (res) {
            toastr.success('Berhasil');
            console.log(res.data);

            // window.location.replace('/auth/kasir/');



        })
        .catch(function (err) {
            console.log(err);
        });
    }
</script>


<script>
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