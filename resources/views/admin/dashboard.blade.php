@extends('admin.layouts.app')

@section('title')
Dashboard Admin
@endsection

@section('content')
<h2>Selamat Datang <small><br/>{{ Auth::user()->name }}</small></h2>
<hr>

<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
        <div class="dash-widget dash-widget5">
            <span class="dash-widget-icon bg-success"><i class="fa fa-money" aria-hidden="true"></i></span>
            <div class="dash-widget-info">
                <h3>Rp {{ number_format($pendapatan_hari_ini) }}</h3>
                <span>Hari Ini {{ date('d M Y') }}</span>
            </div>
            <br>
            <a href="{{ route('kasir.index') }}" class="btn btn-block btn-primary">Selengkapnya</a>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
        <div class="dash-widget dash-widget5">
            <span class="dash-widget-icon bg-info"><i class="fa fa-tasks" aria-hidden="true"></i></span>
            <div class="dash-widget-info">
                <h3>{{ $total_order }}</h3>
                <span>Order Diterima</span>
            </div>
            <br>
            <a href="{{ route('kasir.index') }}" class="btn btn-block btn-primary">Selengkapnya</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div id="line-example"></div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>

Morris.Line({
  element: 'line-example',
  data: [
    { y: '2006', a: 100, b: 90 },
    { y: '2007', a: 75,  b: 65 },
    { y: '2008', a: 50,  b: 40 },
    { y: '2009', a: 75,  b: 65 },
    { y: '2010', a: 50,  b: 40 },
    { y: '2011', a: 75,  b: 65 },
    { y: '2012', a: 100, b: 90 }
  ],
  xkey: 'y',
  ykeys: ['a', 'b'],
  labels: ['Series A', 'Series B']
});
</script>
@endsection