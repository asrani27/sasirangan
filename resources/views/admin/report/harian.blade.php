@extends('layouts.app')
@push('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@push('css')


@endpush
@section('title')
<h4 class="page-title">Harga Rata-Rata Harian Bahan Pokok</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active"></li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20">
            
            <div class="btn-toolbar p-3" role="toolbar">
                <div class="col-md-12">
                <form method="get" action="/report/harga/rata-rata/harian/search">
                    @csrf
                    <div class="btn-group">
                        <input type="date" class="form-control" name="tanggal" value="{{$tanggal}}">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>&nbsp;
                        {{-- <a href="/report/harga/rata-rata/harian/tanggal/{{$tanggal}}" class="btn btn-danger">Export <i class="fas fa-file-pdf"></i></a> --}}
                    </div>
                </form>
                </div>
            </div>
            
                
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Bahan</th>
                        <th>Satuan</th>   
                        @foreach ($pasar as $p)
                        <th>{{$p->nama}} (Rp)</th>
                            
                        @endforeach 
                        <th>Rata-Rata (Rp)</th>   
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
                                @foreach ($b->pasar as $ht)
                                <td style="padding:5px 12px;">{{$ht->hargaToday == 0 ? 0 : number_format($ht->hargaToday)}}</td>
                                @endforeach
                                <td style="padding:5px 12px;">{{number_format(ceil($b->pasar->sum('hargaToday') / count($pasar)))}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush