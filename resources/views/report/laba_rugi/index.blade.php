@extends('admin.layouts.app')

@section('title')
Manajemen Bahan Baku
@endsection

@section('content')

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
                            <th>Nama Bahan Baku</th>
                            <th>Banyak</th>
                            <th>Alasan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $masuk)
                        <tr>
                            <td>{{ $masuk->created_at->format('d M Y H:i:s') }}</td>
                            <td>{{ $masuk->bahan_baku->nama }}</td>
                            <td>{{ $masuk->qty }}</td>
                            <td>{{ $masuk->tranksaksi }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
@endsection