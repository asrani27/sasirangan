@extends('layouts.app')

@section('title')
<h4 class="page-title">Grafik Harga Bahan Pokok</h4>
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
    <div class="col-12">
        <div class="card m-b-20">
            <form method="get" action="/grafik/harga/search">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-3">
                        <select class="form-control" name="pasar_id" required>
                            <option value="">--Pilih Pasar--</option>
                            @foreach ($pasar as $item)                                    
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="bulan" required>
                            <option value="">--Bulan--</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    
                    </div>
                    <div class="col-md-2">
                            <select class="form-control" name="tahun" required>
                                <option value="">--Tahun--</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                            </select>
                    </div>
                    <div class="col-md-3">
                            <select class="form-control" name="bahan_id">
                                <option value="">--Bahan--</option>
                                @foreach ($bahan as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary">Tampilkan <i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div> <!-- end col -->
</div>
@else
<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <form method="get" action="/grafik/harga/search">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-3">
                        <select class="form-control" name="pasar_id" required>
                            <option value="">--Pilih Pasar--</option>
                            @foreach ($pasar as $item)                                    
                            <option value="{{$item->id}}" {{$pasar_id == $item->id ? 'selected':''}}>{{$item->nama}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="bulan" required>
                            <option value="">--Bulan--</option>
                            <option value="01" {{$bulan == '01' ? 'selected':''}}>Januari</option>
                            <option value="02" {{$bulan == '02' ? 'selected':''}}>Februari</option>
                            <option value="03" {{$bulan == '03' ? 'selected':''}}>Maret</option>
                            <option value="04" {{$bulan == '04' ? 'selected':''}}>April</option>
                            <option value="05" {{$bulan == '05' ? 'selected':''}}>Mei</option>
                            <option value="06" {{$bulan == '06' ? 'selected':''}}>Juni</option>
                            <option value="07" {{$bulan == '07' ? 'selected':''}}>Juli</option>
                            <option value="08" {{$bulan == '08' ? 'selected':''}}>Agustus</option>
                            <option value="09" {{$bulan == '09' ? 'selected':''}}>September</option>
                            <option value="10" {{$bulan == '10' ? 'selected':''}}>Oktober</option>
                            <option value="11" {{$bulan == '11' ? 'selected':''}}>November</option>
                            <option value="12" {{$bulan == '12' ? 'selected':''}}>Desember</option>
                        </select>
                    
                    </div>
                    <div class="col-md-2">
                            <select class="form-control" name="tahun" required>
                                <option value="">--Tahun--</option>
                                <option value="2021" {{$tahun == '2021' ? 'selected':''}}>2021</option>
                                <option value="2022" {{$tahun == '2022' ? 'selected':''}}>2022</option>
                                <option value="2023" {{$tahun == '2023' ? 'selected':''}}>2023</option>
                            </select>
                    </div>
                    <div class="col-md-3">
                            <select class="form-control" name="bahan_id" required>
                                <option value="">--Bahan--</option>
                                @foreach ($bahan as $item)
                                <option value="{{$item->id}}" {{$bahan_id == $item->id ? 'selected':''}}>{{$item->nama}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary">Tampilkan <i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div> <!-- end col -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20">
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
    var dates = {!!json_encode($data['tanggal'])!!}
    var datasets = {!!json_encode($dataset)!!}
    console.log(datasets);
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: dates,
          datasets: datasets,
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