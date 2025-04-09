@extends('layouts.app')

@section('title')
<h4 class="page-title">Grafik Stok Bahan Pokok</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active"></li>
</ol>
@endsection

@section('content')

@if (count($data) == 0)

<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20">
            <div class="btn-toolbar p-3" role="toolbar">
                <form method="get" action="/report/stok/grafik/search">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="STOK BANJARMASIN KOTA" readonly>
                        </div>

                        <div class="col-md-5">
                            <select class="form-control" name="tahun" required>
                                <option value="">--Tahun--</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>

                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary">Tampilkan <i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body table-responsive">

            </div>
        </div>
    </div>
</div>
@else

<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20">
            <div class="btn-toolbar p-3" role="toolbar">
                <form method="get" action="/report/stok/grafik/search">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="STOK BANJARMASIN KOTA" readonly>
                        </div>

                        <div class="col-md-5">
                            <select class="form-control" name="tahun" required>
                                <option value="">--Tahun--</option>
                                <option value="2021" {{old('tahun')=='2021' ? 'selected' :''}}>2021</option>
                                <option value="2022" {{old('tahun')=='2022' ? 'selected' :''}}>2022</option>
                                <option value="2023" {{old('tahun')=='2023' ? 'selected' :''}}>2023</option>
                            </select>

                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary">Tampilkan <i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body table-responsive">
                <canvas id="myChart" width="500" height="120"></canvas>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20">
            <div class="btn-toolbar p-3" role="toolbar">
                <strong>DATA STOK TAHUN {{old('tahun')}} <br />
                    Data di bawah ini merupakan hasil rata-rata dalam 1 bulan</strong>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <tr>
                        <th>No</th>
                        <th>Nama Bahan</th>
                        <th>Jan</th>
                        <th>Feb</th>
                        <th>Mar</th>
                        <th>Apr</th>
                        <th>May</th>
                        <th>Jun</th>
                        <th>Jul</th>
                        <th>Aug</th>
                        <th>Sept</th>
                        <th>Okt</th>
                        <th>Nov</th>
                        <th>Des</th>
                    </tr>
                    @php
                    $no=1;
                    @endphp
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$item['label']}}</td>
                        <td>{{$item['data'][0]}}</td>
                        <td>{{$item['data'][1]}}</td>
                        <td>{{$item['data'][2]}}</td>
                        <td>{{$item['data'][3]}}</td>
                        <td>{{$item['data'][4]}}</td>
                        <td>{{$item['data'][5]}}</td>
                        <td>{{$item['data'][6]}}</td>
                        <td>{{$item['data'][7]}}</td>
                        <td>{{$item['data'][8]}}</td>
                        <td>{{$item['data'][9]}}</td>
                        <td>{{$item['data'][10]}}</td>
                        <td>{{$item['data'][11]}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>

        </div>
    </div>
</div>
@endif
@endsection

@push('js')

@if (count($data) == 0)

@else

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script>
    console.log(1);
    var ctx = document.getElementById('myChart').getContext('2d');
    
    data = {!!json_encode($data)!!}
    
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
          datasets: data,
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
</script>
@endif
@endpush