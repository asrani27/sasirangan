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
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12 border-right">
                        <h4 class="mt-0 header-title mb-4">Statistik Visitor.</h4>
                        <div id="myfirstchart" style="height: 250px;"></div>
                    </div>
                   
                    
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
    <!-- end col -->
    
    <div class="col-xl-3">
        <div class="card">
            <div class="card-body text-center">
                <h4 class="mt-0 header-title mb-4">Jumlah Pasar</h4>
                <div class="p-3 "><h2>{{$pasar}}</h2></div>
                {{-- <div id="morris-donut-example" class="dashboard-charts morris-charts"></div> --}}
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