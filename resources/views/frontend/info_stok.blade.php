@extends('layouts.app')

@section('title')
<h4 class="page-title">Info Stok</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Info Stok Bahan Pokok</li>
</ol>
@endsection

@section('content')
@if (count($data) == 0)
    
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20">
            <div class="btn-toolbar p-3" role="toolbar">
                <form method="get" action="/info-stok/search">
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
                        <th>Stok Bulan Lalu</th>
                        <th>Stok Terkini</th>
                        <th>Perubahan</th>
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
                <form method="get" action="/info-stok/search">
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
                            <th class="text-center">Stok Bulan Lalu <br />{{\Carbon\Carbon::parse($tanggal)->subMonth()->endOfMonth()->format('d-M-Y')}}</th>
                            <th class="text-center">Stok Terkini <br /> {{\Carbon\Carbon::parse($tanggal)->format('d-M-Y')}}</th>
                            <th class="text-center">Perubahan</th>
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
                            <td class="text-center">{{$item->bulan_lalu}}</td>
                            <td class="text-center">{{$item->stok_terkini}}</td>
                            <td class="text-center">{{$item->perubahan}}</td>
                            <td>
                                @if ($item->bulan_lalu == 0 AND $item->stok_terkini != 0) 
                                    100 %
                                @elseif($item->stok_terkini == 0 AND $item->bulan_lalu == 0)
                                0 %
                                @else
                                {{($item->stok_terkini / $item->bulan_lalu) * 100 - 100}} %
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>
@endif
@endsection