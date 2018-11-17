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

                <div class="clearfix">
                    <div class="pull-right">
                        <form id="filter_month" class="form-inline" method="POST">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="month">Pilih Tanggal&nbsp;</label>
                                <input type="number" placeholder="Masukan Tanggal" name="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="month">&nbsp;Pilih Bulan&nbsp;</label>
                                <select name="month" id="month" class="form-control">
                                    <option value="all" selected>-- Semua Bulan --</option>
                                    @foreach(IndoTgl::generateMonth() as $month)
                                    <option value="{{ $month['no']}}" @if($month['no'] == date('m'))  @endif>{{ $month['string'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="year">&nbsp;Tahun&nbsp;</label>
                                <select name="year" id="year" class="form-control">
                                    @foreach(IndoTgl::generateYear() as $year)
                                    <option value="{{ $year }}" @if($year == date('Y')) selected @endif >{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                            &nbsp;&nbsp;<button type="submit" class="btn btn-default">Filter</button>
                            &nbsp;&nbsp;<a href="javascript:void(0)" onclick="print()" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> Print</a>
                        </form>
                    </div>
                </div>
                <br>
                <div id="print_area">
                    <center>
                        <h3>{{ $string_header }}</h3>
                    </center>
                    <table class="table table-sm table-hover table-striped" id="data-order">
                        <thead class="thead-dark">
                            <tr>
                                <th>Tanggal</th>
                                <th>Nomor Nota</th>
                                <th>Total Belanja</th>
                            </tr>
                            <tr class="table-danger">
                                <td colspan="2"><center><strong>Total</strong></center></td>
                                <td><strong>Rp {{ number_format($total_order) }}</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $transaction)
                            <tr>
                                <td>{{ $transaction->created_at->format('d M Y H:i:s') }}</td>
                                <td>{{ $transaction->no_nota }}</td>
                                <td>Rp {{ number_format($transaction->detail->sum('subtotal')) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-danger">
                                <td colspan="2"><center><strong>Total</strong></center></td>
                                <td><strong>Rp {{ number_format($total_order) }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('js/jQuery.print.js') }}"></script>

<script>
function print()
{
    $("#print_area").print(/*options*/);
}
</script>
@endsection