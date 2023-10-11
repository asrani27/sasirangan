@extends('layouts.app')

@section('title')
<h4 class="page-title">Administrator</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">SELAMAT DATANG DI HALAMAN ADMINISTRATOR</li>
</ol>
@endsection

@section('content')


<div class="row">
    <div class="col-xl-9">
        <div class="card">
            <div class="card-body table-responsive">

                <div class="col-xl-12 border-right">
                    <h4 class="mt-0 header-title mb-2">Early Warning system (EWS) Formula</h4>
                    <h4 class="mt-0 header-title mb-2">Tanggal Hari ini : {{\Carbon\Carbon::now()->format('d-m-Y')}}</h4>
                    
                </div>
                <div class="col-xl-12 border-left">
                    {{-- <a href="/home/wa-notifikasi" class='btn btn-sm btn-success' onclick="return confirm('Yakin ingin mengirimkan notifikasi ke nomor yang terdaftar?');">WA NOTIFIKASI</a> --}}
                    <a href="/home/ews" class='btn btn-sm btn-danger' onclick="return confirm('harap menunggu proses EWS setelah klik OK');">Early Warning system </a><br/><br/>
                </div>
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Pasar</th>
                        <th>Komoditi</th>
                        <th>Harga Acuan</th>
                        <th>Batas Kenaikan Toleransi</th>
                        <th>H+1</th>
                        <th>H+2</th>
                        <th>H+3</th>
                        <th>H+4</th>
                        <th>Kesimpulan</th>
                    </tr>
                    </thead>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($ews as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$item->pasar->nama}}</td>
                            <td>{{$item->bahan->nama}}</td>
                            <td>{{number_format($item->acuan)}}</td>
                            <td>{{number_format($item->batas)}}</td>
                            <td>{{number_format($item->h1)}}</td>
                            <td>{{number_format($item->h2)}}</td>
                            <td>{{number_format($item->h3)}}</td>
                            <td>{{number_format($item->h4)}}</td>
                            <td><button type="button" class="btn btn-sm btn-danger">NAIK</button></td>

                        </tr>
                    @endforeach             
                    
                </table>
            </div>
            
        </div>
    </div>
    <!-- end col -->
    
    <div class="col-xl-3">
        <div class="card">
            <div class="card-body text-center">
                <h4 class="mt-0 header-title mb-2">Jumlah Pasar</h4>
                <div class="p-0"><h2>{{$pasar}}</h2></div>
                {{-- <div id="morris-donut-example" class="dashboard-charts morris-charts"></div> --}}
            </div>
        </div>
        <div class="card">
            <div class="card-body text-center">
                <h4 class="mt-0 header-title mb-2">Pengunjung Hari Ini</h4>
                <div class="p-0"><h2>{{$pengunjungHariIni}}</h2></div>
            </div>
            <div class="card-body text-center">
                <h4 class="mt-0 header-title mb-2">Total Pengunjung </h4>
                <div class="p-0"><h2>{{$totalPengunjung}}</h2></div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection

@push('js')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<script>
    
    var traffic = {!!json_encode($data)!!}
    
  new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: traffic,

  // The name of the data record attribute that contains x-values.
  xkey: 'tanggal',
  xLabelFormat: function (d) {
    return ("0" + d.getDate()).slice(-2) + '-' + ("0" + (d.getMonth() + 1)).slice(-2) + '-' + d.getFullYear();
  },
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Value']
});
    </script>
@endpush