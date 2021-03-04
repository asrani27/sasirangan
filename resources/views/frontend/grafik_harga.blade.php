@extends('layouts.app')

@section('title')
<h4 class="page-title">Grafik Harga Bahan Pokok</h4>
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
                <form method="get" action="/grafik/harga/search">
                    <div class="row">
                    <div class="col-md-4">
                        <div class="btn-group">
                            <select class="form-control" name="pasar_id" required>
                                <option value="">--Pilih Pasar--</option>
                                @foreach ($pasar as $item)                                    
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="btn-group">
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
                    </div>
                    <div class="col-md-5">
                        <div class="btn-group">
                            <select class="form-control" name="tahun" required>
                                <option value="">--Tahun--</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                            </select>&nbsp;
                            <button type="submit" class="btn btn-primary">Tampilkan <i class="fas fa-search"></i></button>
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
                <form method="get" action="/grafik/harga/search">
                    <div class="row">
                    <div class="col-md-4">
                        <div class="btn-group">
                            <select class="form-control" name="pasar_id" required>
                                <option value="">--Pilih Pasar--</option>
                                @foreach ($pasar as $item)                                    
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="btn-group">
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
                    </div>
                    <div class="col-md-5">
                        <div class="btn-group">
                            <select class="form-control" name="tahun" required>
                                <option value="">--Tahun--</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                            </select>&nbsp;
                            <button type="submit" class="btn btn-primary">Tampilkan <i class="fas fa-search"></i></button>
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
@endif
@endsection