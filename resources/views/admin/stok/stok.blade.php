@extends('layouts.app')
@push('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@push('css')


@endpush
@section('title')
<h4 class="page-title">Stok Bahan Di Kota Banjarmasin</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Stok Bahan Pokok Kota Banjarmasin</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20">
            
            <div class="btn-toolbar p-3" role="toolbar">
                <div class="col-md-12">
                <form method="get" action="/input/stok/month">
                    @csrf
                    {{-- <div class="btn-group">
                        <a href="/input/stok" class="btn btn-secondary waves-light waves-effect"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                    </div> --}}
                    <div class="btn-group">
                        <select class="form-control" name="bulan" required>
                        <option value="">-Bulan-</option>
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
                        &nbsp;
                        <select class="form-control" name="tahun" required>
                        <option value="">-Tahun-</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        </select>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                </div>
                
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                    <tr class="text-center">
                        <th rowspan=2>No</th>
                        <th rowspan=2>Nama Bahan</th>
                        <th rowspan=2>Satuan</th>     
                        <th colspan=4>Bulan {{\Carbon\Carbon::today()->format('M Y')}}</th>                        
                    </tr>
                    <tr class="text-center">
                        <th>Minggu Ke 1</th>
                        <th>Minggu Ke 2</th>
                        <th>Minggu Ke 3</th>
                        <th>Minggu Ke 4</th>
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
                                @if (count($b->stok_kota) == 0)
                                    <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="1" data-bulan="{{$month}}" data-tahun="{{$year}}">0</a></td>
                                    <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="2" data-bulan="{{$month}}" data-tahun="{{$year}}">0</a></td>
                                    <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="3" data-bulan="{{$month}}" data-tahun="{{$year}}">0</a></td>
                                    <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="4" data-bulan="{{$month}}" data-tahun="{{$year}}">0</a></td>
                                @else    
                                    @foreach ($b->stok_kota as $sk)    
                                        <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="1" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$sk->minggu_1 == null ? '0': $sk->minggu_1}}</a></td>
                                        <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="2" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$sk->minggu_2 == null ? '0': $sk->minggu_2}}</a></td>
                                        <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="3" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$sk->minggu_3 == null ? '0': $sk->minggu_3}}</a></td>
                                        <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="4" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$sk->minggu_4 == null ? '0': $sk->minggu_4}}</a></td>
                                    @endforeach
                                @endif
                                {{-- <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-pasar="{{$pasar->id}}" data-title="Enter username">{{$b->stok}}</a></td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center">

            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush