@extends('layouts.app')

@section('title')
<h4 class="page-title">Grafik Stok Bahan Pokok</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active"></li>
</ol>
@endsection

@push('css')
@include('frontend.cssaduan')
@endpush
@section('content')

@if (count($data) == 0)

<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20">
            <div class="btn-toolbar p-3" role="toolbar">
                <form method="get" action="/grafik/stok/search">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="btn-group">
                                <select class="form-control" name="pasar_id" required>
                                    <option value="">--Pilih Pasar--</option>
                                    @foreach ($pasar as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="btn-group">
                                <select class="form-control" name="tahun" required>
                                    <option value="">--Tahun--</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                </select>&nbsp;
                                <button type="submit" class="btn btn-primary">Tampilkan <i
                                        class="fas fa-search"></i></button>
                            </div>
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
                <form method="get" action="/grafik/stok/search">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="btn-group">
                                <select class="form-control" name="pasar_id" required>
                                    <option value="">--Pilih Pasar--</option>
                                    @foreach ($pasar as $item)
                                    <option value="{{$item->id}}" {{$pasar_id==$item->id ?
                                        'selected':''}}>{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="btn-group">
                                <select class="form-control" name="tahun" required>
                                    <option value="">--Tahun--</option>
                                    <option value="2021" {{$tahun=='2021' ? 'selected' :''}}>2021</option>
                                    <option value="2022" {{$tahun=='2022' ? 'selected' :''}}>2022</option>
                                    <option value="2023" {{$tahun=='2023' ? 'selected' :''}}>2023</option>
                                    <option value="2024" {{$tahun=='2024' ? 'selected' :''}}>2024</option>
                                    <option value="2025" {{$tahun=='2025' ? 'selected' :''}}>2025</option>
                                </select>&nbsp;
                                <button type="submit" class="btn btn-primary">Tampilkan <i
                                        class="fas fa-search"></i></button>
                            </div>
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
@endif
@include('frontend.aduan')
@endsection

@push('js')

@if (count($data) == 0)

@else

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    
    
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
          datasets: [
            {
              label: 'Beras Banjar',
              fill: false,
              data: [3,432,543,65,75,65,456,345,23],
              borderColor: [
                  'rgba(26, 193, 185, 1)'
              ],
              borderWidth: 2
            },
          
          ]
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