@extends('layouts.app')

@section('title')
<h4 class="page-title">Administrator</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">SELAMAT DATANG DI HALAMAN ADMINISTRATOR</li>
</ol>
@endsection

@push('css')
<style>
    .btn-floating {
        position: fixed;
        right: 25px;
        overflow: hidden;
        width: 100px;
        height: 50px;
        border-radius: 100px;
        border: 0;
        z-index: 9999;
        color: white;
        transition: .2s;
    }

    .btn-floating:hover {
        width: auto;
        padding: 0 20px;
        cursor: pointer;
    }

    .btn-floating span {
        font-size: 16px;
        margin-left: 5px;
        transition: .2s;
        line-height: 0px;
        display: none;
    }

    .btn-floating:hover span {
        display: inline-block;
    }

    .btn-floating:hover img {
        margin-bottom: -3px;
    }

    .btn-floating.whatsapp {
        bottom: 25px;
        background-color: #34af23;
        border: 2px solid #fff;
    }

    .btn-floating.whatsapp:hover {
        background-color: #1f7a12;
    }
</style>
@endpush
@section('content')
<div class="row">
    <div class="col-xl-9">
        <div class="card">
            <div class="card-body table-responsive">

                <div class="col-xl-12 border-right">
                    <h4 class="mt-0 header-title mb-2">DEDIKASI</h4>
                    <h4 class="mt-0 header-title mb-2">Tanggal Hari ini : {{\Carbon\Carbon::now()->format('d-m-Y')}}
                    </h4>

                </div>
                <div class="col-xl-12 border-left">
                    {{-- <a href="/home/wa-notifikasi" class='btn btn-sm btn-success'
                        onclick="return confirm('Yakin ingin mengirimkan notifikasi ke nomor yang terdaftar?');">WA
                        NOTIFIKASI</a> --}}
                    <a href="/home/ews" class='btn btn-sm btn-danger'
                        onclick="return confirm('harap menunggu proses DEDIKASI setelah klik OK');">DEDIKASI
                    </a><br /><br />
                </div>
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pasar</th>
                            <th>Komoditi</th>
                            <th>Harga Acuan (awal bulan)</th>
                            <th>Harga Hari ini</th>
                            <th>Persentase Kenaikan</th>
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
                        <td>{{number_format($item->harga)}}</td>
                        <td>{{number_format($item->kenaikan,2)}} %</td>
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
                <div class="p-0">
                    <h2>{{$pasar}}</h2>
                </div>
                {{-- <div id="morris-donut-example" class="dashboard-charts morris-charts"></div> --}}
            </div>
        </div>
        <div class="card">
            <div class="card-body text-center">
                <h4 class="mt-0 header-title mb-2">Pengunjung Hari Ini</h4>
                <div class="p-0">
                    <h2>{{$pengunjungHariIni}}</h2>
                </div>
            </div>
            <div class="card-body text-center">
                <h4 class="mt-0 header-title mb-2">Total Pengunjung </h4>
                <div class="p-0">
                    <h2>{{$totalPengunjung}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

<a href="https://api.whatsapp.com/send?phone=12341234" target="_blank">
    <button class="btn-floating whatsapp">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/WhatsApp_icon.png/598px-WhatsApp_icon.png"
            width="30px" alt="whatsApp">ADUAN
        <span>(00) 1234-1234</span>
    </button>
</a>
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