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
                    <div class="col-xl-8 border-right">
                        <h4 class="mt-0 header-title mb-4">Statistik Visitor.</h4>
                        <div id="myfirstchart" style="height: 250px;"></div>
                        {{-- <div id="morris-area-example" class="dashboard-charts morris-charts"></div> --}}
                    </div>
                    <div class="col-xl-4">
                        <h4 class="header-title mb-4"></h4>
                        <div class="p-3">
                            <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-first-tab" data-toggle="pill" href="#pills-first" role="tab" aria-controls="pills-first" aria-selected="true">2021</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-second-tab" data-toggle="pill" href="#pills-second" role="tab" aria-controls="pills-second" aria-selected="false">2022</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-third-tab" data-toggle="pill" href="#pills-third" role="tab" aria-controls="pills-third" aria-selected="false">2023</a>
                                </li>
                            </ul>
                            
                            <div class="tab-content">
                                <div class="tab-pane show active" id="pills-first" role="tabpanel" aria-labelledby="pills-first-tab">
                                    <div class="p-3">
                                        <h2>{{$tahun2021}} Pengunjung</h2>
                                        
                                    </div>
                                </div>
                                <div class="tab-pane" id="pills-second" role="tabpanel" aria-labelledby="pills-second-tab">
                                    <div class="p-3">
                                        <h2>0 Pengunjung</h2>
                                        
                                    </div>
                                </div>
                                <div class="tab-pane" id="pills-third" role="tabpanel" aria-labelledby="pills-third-tab">
                                    <div class="p-3">
                                        <h2>0 Pengunjung</h2>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
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