@extends('layouts.app')
@push('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@push('css')


@endpush
@section('title')
<h4 class="page-title">Stok Bahan Di {{$pasar->nama}}</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Stok Bahan Pokok Pada Pasar</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20">
            <div class="btn-toolbar p-3" role="toolbar">
                <div class="col-md-10">

                <div class="btn-group">
                    <a href="/input/harga" class="btn btn-secondary waves-light waves-effect">    <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                </div>
                </div>
                <div class="col-md-2">

                <div class="btn-group">
                    <input type="text" class="form-control" placeholder="Cari"><a href="#" class="btn btn-secondary"><i class="fas fa-search"></i></a>
                </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Bahan</th>
                        <th>Satuan</th>
                        <th class="text-center">Jumlah Stok Tgl : {{$month->format('d M Y')}}</th>
                        
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
                                <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-pasar="{{$pasar->id}}" data-title="Enter username">{{$b->stok}}</a></td>
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