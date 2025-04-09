@extends('layouts.app')

@section('title')
<h4 class="page-title">Kenaikan Harga</h4>

@endsection

@push('css')
@include('frontend.cssaduan')
@endpush
@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body table-responsive">

                <div class="col-xl-12 border-right">
                    <h4 class="mt-0 header-title mb-2">DEDIKASI</h4>
                    <h4 class="mt-0 header-title mb-2">Tanggal Hari ini : {{\Carbon\Carbon::now()->format('d-m-Y')}}
                    </h4>

                </div>
                <div class="col-xl-12 border-left">

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

</div>
@include('frontend.aduan')
@endsection