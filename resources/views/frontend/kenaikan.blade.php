@extends('layouts.app')

@section('title')
<h4 class="page-title">Kenaikan Harga</h4>

@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body table-responsive">

                <div class="col-xl-12 border-right">
                    <h4 class="mt-0 header-title mb-2">Early Warning system (EWS) Formula</h4>
                    <h4 class="mt-0 header-title mb-2">Tanggal Hari ini : {{\Carbon\Carbon::now()->format('d-m-Y')}}</h4>
                    
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
</div>
@endsection