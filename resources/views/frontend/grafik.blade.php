@extends('layouts.app')

@section('title')
<h4 class="page-title">Grafik</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Grafik Bahan Pokok</li>
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
                <form method="get" action="/info-harga/search">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="btn-group">
                            <select class="form-control" name="pasar_id" required>
                                <option value="">--Pilih Pasar--</option>
                                @foreach ($pasar as $item)                                    
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="btn-group">
                            <input type="date" class="form-control" name="tanggal" value="{{\Carbon\Carbon::today()->format('Y-m-d')}}" placeholder="Cari"> &nbsp; <button type="submit" class="btn btn-primary">Tampilkan <i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
            
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Bahan Pokok</th>
                        <th>Satuan</th>
                        <th>Harga Kemarin (Rp)</th>
                        <th>Harga Terkini (Rp)</th>
                        <th>Perubahan (Rp)</th>
                        <th>Perubahan (%)</th>                        
                    </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
    </div>
</div>
@else
    
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20">
            <div class="btn-toolbar p-3" role="toolbar">
                <form method="get" action="/info-harga/search">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="btn-group">
                            <select class="form-control" name="pasar_id" required>
                                <option value="">--Pilih Pasar--</option>
                                @foreach ($pasar as $item)                                    
                                <option value="{{$item->id}}" {{$pasar_id == $item->id ? 'selected':''}}>{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="btn-group">
                            <input type="date" class="form-control" name="tanggal" value="{{$tanggal}}" placeholder="Cari"> &nbsp; <button type="submit" class="btn btn-primary">Tampilkan <i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Bahan Pokok</th>
                            <th class="text-center">Satuan</th>
                            <th class="text-center">Harga Kemarin (Rp)<br/>{{\Carbon\Carbon::parse($tanggal)->subDay()->format('d-M-Y')}}</th>
                            <th class="text-center">Harga Terkini (Rp) <br/>{{\Carbon\Carbon::parse($tanggal)->format('d-M-Y')}}</th>
                            <th class="text-center">Perubahan (Rp)</th>
                            <th class="text-center">Perubahan (%)</th>                        
                        </tr>
                    </thead>
                    @php
                        $no =1;
                    @endphp
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td class="text-center">{{$no++}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->satuan->nama}}</td>
                            <td>@currency($item->harga_kemarin)</td>
                            <td>@currency($item->harga_terkini)</td>
                            <td>@currency($item->perubahan)</td>
                            <td>-</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>
@endif
@include('frontend.aduan')
@endsection