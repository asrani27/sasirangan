@extends('layouts.app')

@section('title')
<h4 class="page-title">Info Stok</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Info Stok Bahan Pokok</li>
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
                <form method="get" action="/info-stok/search">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group">
                                <select class="form-control" name="pasar_id" required>
                                    <option value="">--Pilih Pasar--</option>
                                    @foreach ($pasar as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>

                                <select class="form-control" name="bulan" required>
                                    <option value="">-Bulan-</option>
                                    <option value="01" {{$month=='01' ? 'selected' : '' }}>Januari</option>
                                    <option value="02" {{$month=='02' ? 'selected' : '' }}>Februari</option>
                                    <option value="03" {{$month=='03' ? 'selected' : '' }}>Maret</option>
                                    <option value="04" {{$month=='04' ? 'selected' : '' }}>April</option>
                                    <option value="05" {{$month=='05' ? 'selected' : '' }}>Mei</option>
                                    <option value="06" {{$month=='06' ? 'selected' : '' }}>Juni</option>
                                    <option value="07" {{$month=='07' ? 'selected' : '' }}>Juli</option>
                                    <option value="08" {{$month=='08' ? 'selected' : '' }}>Agustus</option>
                                    <option value="09" {{$month=='09' ? 'selected' : '' }}>September</option>
                                    <option value="10" {{$month=='10' ? 'selected' : '' }}>Oktober</option>
                                    <option value="11" {{$month=='11' ? 'selected' : '' }}>November</option>
                                    <option value="12" {{$month=='12' ? 'selected' : '' }}>Desember</option>
                                </select>

                                <select class="form-control" name="tahun" required>
                                    <option value="">-Tahun-</option>
                                    <option value="2021" {{$year=='2021' ? 'selected' : '' }}>2021</option>
                                    <option value="2022" {{$year=='2022' ? 'selected' : '' }}>2022</option>
                                    <option value="2023" {{$year=='2023' ? 'selected' : '' }}>2023</option>
                                    <option value="2024" {{$year=='2024' ? 'selected' : '' }}>2024</option>
                                    <option value="2025" {{$year=='2025' ? 'selected' : '' }}>2025</option>
                                    <option value="2026" {{$year=='2026' ? 'selected' : '' }}>2026</option>
                                </select>

                                <button type="submit" class="btn btn-primary">Tampilkan <i
                                        class="fas fa-search"></i></button>
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
                        <div class="col-md-12">
                            <div class="btn-group">
                                <select class="form-control" name="pasar_id" required>
                                    <option value="">--Pilih Pasar--</option>
                                    @foreach ($pasar as $item)
                                    <option value="{{$item->id}}" {{$pasar_id==$item->id ?
                                        'selected':''}}>{{$item->nama}}</option>
                                    @endforeach
                                </select>
                                <select class="form-control" name="bulan" required>
                                    <option value="">-Bulan-</option>
                                    <option value="01" {{$month=='01' ? 'selected' : '' }}>Januari</option>
                                    <option value="02" {{$month=='02' ? 'selected' : '' }}>Februari</option>
                                    <option value="03" {{$month=='03' ? 'selected' : '' }}>Maret</option>
                                    <option value="04" {{$month=='04' ? 'selected' : '' }}>April</option>
                                    <option value="05" {{$month=='05' ? 'selected' : '' }}>Mei</option>
                                    <option value="06" {{$month=='06' ? 'selected' : '' }}>Juni</option>
                                    <option value="07" {{$month=='07' ? 'selected' : '' }}>Juli</option>
                                    <option value="08" {{$month=='08' ? 'selected' : '' }}>Agustus</option>
                                    <option value="09" {{$month=='09' ? 'selected' : '' }}>September</option>
                                    <option value="10" {{$month=='10' ? 'selected' : '' }}>Oktober</option>
                                    <option value="11" {{$month=='11' ? 'selected' : '' }}>November</option>
                                    <option value="12" {{$month=='12' ? 'selected' : '' }}>Desember</option>
                                </select>
                                &nbsp;
                                <select class="form-control" name="tahun" required>
                                    <option value="">-Tahun-</option>
                                    <option value="2021" {{$year=='2021' ? 'selected' : '' }}>2021</option>
                                    <option value="2022" {{$year=='2022' ? 'selected' : '' }}>2022</option>
                                    <option value="2023" {{$year=='2023' ? 'selected' : '' }}>2023</option>
                                    <option value="2024" {{$year=='2024' ? 'selected' : '' }}>2024</option>
                                    <option value="2025" {{$year=='2025' ? 'selected' : '' }}>2025</option>
                                    <option value="2026" {{$year=='2026' ? 'selected' : '' }}>2026</option>
                                </select>
                                <button type="submit" class="btn btn-primary">Tampilkan <i
                                        class="fas fa-search"></i></button>


                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                        <tr class="text-center">
                            <th rowspan=2>No</th>
                            <th rowspan=2>Nama Bahan</th>
                            <th rowspan=2>Satuan</th>
                            @if ($week == 5)
                            <th colspan=5>Bulan {{\Carbon\Carbon::CreateFromFormat('m-Y', $month.'-'.$year)->format('M
                                Y')}}</th>
                            @else
                            <th colspan=4>Bulan {{\Carbon\Carbon::CreateFromFormat('m-Y', $month.'-'.$year)->format('M
                                Y')}}</th>
                            @endif
                        </tr>
                        <tr class="text-center">
                            <th>Minggu Ke 1</th>
                            <th>Minggu Ke 2</th>
                            <th>Minggu Ke 3</th>
                            <th>Minggu Ke 4</th>
                            @if ($week == 5)
                            <th>Minggu Ke 5.</th>
                            @endif
                        </tr>
                    </thead>
                    @php
                    $no =1;
                    @endphp
                    <tbody>

                        @foreach ($data as $b)
                        <tr style="padding:5px 12px;">
                            <td style="padding:5px 12px;">{{$no++}}</td>
                            <td style="padding:5px 12px;">{{$b->nama}}</td>
                            <td style="padding:5px 12px;">{{$b->satuan->nama}}</td>
                            <td style="padding:5px 12px;"><a href="#" data-type="text">{{$b->minggu_1}}</a></td>
                            <td style="padding:5px 12px;"><a href="#" data-type="text">{{$b->minggu_2}}</a></td>
                            <td style="padding:5px 12px;"><a href="#" data-type="text">{{$b->minggu_3}}</a></td>
                            <td style="padding:5px 12px;"><a href="#" data-type="text">{{$b->minggu_4}}</a></td>
                            @if ($week == 5)

                            <td style="padding:5px 12px;"><a href="#" class="inline-username2"
                                    data-type="text">{{$b->minggu_5}}</a></td>

                            @endif


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